<?php
namespace Mobingi\Alm\Template;
use Mobingi\Alm\Template\Traits\TemplateTrait;
use Mobingi\Alm\Stack\Traits\StackTrait;
use Mobingi\Alm\Template\Traits\WebHookTrait;
use Mobingi\Core\ClientBase;
use Mobingi\Core\Dao\Table;
use Mobingi\Core\Enum\Vendor;
use Mobingi\Core\Utility\Common;
use Mobingi\Exception\FailtureStackException;
use Mobingi\Exception\TemplateException;
use \Exception;
/**
 * Template Client
 * @package Mobingi\Alm\Template
 */
class Template extends ClientBase {
    /**
     * Tratis
     */
    use TemplateTrait, WebHookTrait, StackTrait;

    /**
     * {@inheritdoc}
     */
    protected function initClients() {
        $this->setClient('stack', "Mobingi\Alm\Stack\Stack")
             ->setClient('validator', "Mobingi\Alm\Template\Validate")
             ->setClient('converter', "Mobingi\Alm\Template\Convert");
    }

    private function checkKeyOwner($db, $user_id, $username = null) {
        if ($db['user_id'] !== $user_id) return false;
        return ($db['username'] === $username || empty($username));
    }

    /**
     * Describes the alm template body
     * @param string $stack_id StackID
     * @param string $version If empty or "latest" provided, then get from db; if not, retrieve from s3
     * @return object Template detail
     */
    public function describeAlmTemplate($stack_id, $version_id = null) {
        $result = $this->getStackByStackID($stack_id);
        extract(Common::getInfoByToken());
        return ($this->checkKeyOwner($result, $user_id, $username))? (object)$result['configuration'] : (object)[];
    }

    /**
     * Get the container configuration of a layer defined by $flag found in Alm Template
     * [EE] This function will be used by Alm-Agent so we don't need to apply RBAC here
     * [EE] Common::getInfoByToken() extract the stack's origin owner's $user_id, not current logged in user. Since the token passed by were called from Alm-Agent
     * @param string $stack_id StackID
     * @param string $flag Flag of the layer found in Alm Template configuration body
     * @return object Template body detail
     */
    public function describeContainerConfig($stack_id, $flag) {
        $result = $this->getStackByStackID($stack_id);
        extract(Common::getInfoByToken());
        if ($this->checkKeyOwner($result, $user_id)) {
            foreach($result['configuration']['configurations'] as $config) {
                if ($config['flag'] === $flag) return (object)$config['container'];
            }
        }
        return (object)[];
    }

    /**
     * Generate ALM Template ID
     * @return string ALM Template ID
     */ 
    private function generateAlmTemplateId() {
        extract(Common::getInfoByToken());
        return 'mo-'.$user_id.'-'.Common::generateToken(9).'-'.Common::getRegionNickname($region);
    }

    /**
     * Save the saved ALM template, and create new stack
     * @throw Mobingi\Exception\FailtureStackException
     * @return array Status of template stack creation
     */
    public function saveAlmTemplate() {
        // Validate ALM Tempalte
        $template = $this->getRequestObject();
        $this->validator->validateAlmTemplate($template);

        // Save ALM Template
        $stack_id = $this->generateAlmTemplateId();
        if (!empty($this->getStackByStackID($stack_id))) {
            throw new TemplateException(TemplateException::DUPLICATE_ALM_TEMPLATE_ID, "Creating stack failed due to duplicate of stack_id value.");
        }
        $create_time = Common::getDateTime();
        extract(Common::getInfoByToken());
        $item = ['nickname' => Common::generateNickname(), 'configuration' => $template] + compact('stack_id', 'user_id', 'create_time');
        Table::STACK()->getDao()->createItem($item);

        // Apply ALM Template
        try {
            $extra = ["UserId" => $user_id, "StackId" => $stack_id, "APIHost" => "https:".substr(getenv(ENV_API_URL),0,-3), "AuthorizationToken" => $auth_token];
            $templateBody = $this->applyAlmTemplate($template, $stack_id, $extra);
            $vendor = $this->getVendor($template);
            $this->stack->createStack($stack_id, $vendor, (array)($template->vendor->$vendor), $templateBody);
        } catch(Exception $e) {
           Table::STACK()->getDao()->deleteItem($stack_id);
           throw new FailtureStackException($stack_id, $e->getMessage());
        }
        return ['status' => 'success'] + compact('stack_id');
    }

    /**
     * Update the saved ALM template to storage or rollback old version as latest
     * @note vendor section will be ignored when performing this call
     * @param string $stack_id  targetId in url parameter
     * @return result and created versionId
     */
    public function updateAlmTemplate($stack_id) {
        $template = $this->getRequestObject();
        $this->validator->validateAlmTemplate($template);
        $templateBody = $this->applyAlmTemplate($template, $stack_id);
        $vendor = $this->getVendor($template);
        $this->stack->changeStack($stack_id, $vendor, (array)($template->vendor->$vendor), $templateBody);
        Table::STACK()->getDao()->updateItem($stack_id, ['configuration' => $template, 'update_time' => Common::getDateTime()]);
        return ['status' => 'success'] + compact('stack_id');
    }


    const CONVERT_METHOD = [
        Vendor::AWS => "convertToCFTemplate",
        Vendor::ALICLOUD => "convertToAlicloud",
    ];

    /**
     * Applys the ALM template and thus trigger the stack create/update
     * @param object $template Template body in Json format
     * @param string $stack_id StackID
     * @param array $extra Extra Optinal Values
     * @return object Converted template body for each vendor
     */
    public function applyAlmTemplate($template = null, $stack_id = null, $extra = []) {
        if (!$template) $template = $this->getRequestObject();
        if (!$stack_id) $stack_id = $this->generateAlmTemplateId();
        $vendor = new Vendor($this->getVendor($template));
        $method = self::CONVERT_METHOD[(string)$vendor];
        return $this->converter->$method($template, $stack_id, (string)$vendor, $extra);
    }
}
