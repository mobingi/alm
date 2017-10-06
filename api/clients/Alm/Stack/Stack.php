<?php
namespace Mobingi\Alm\Stack;
use Mobingi\Alm\Stack\Traits\StackTrait;
use Mobingi\Core\ClientBase;
use Mobingi\Core\Dao\Table;
use Mobingi\Core\Enum\Vendor;
use Mobingi\Core\Utility\Common;
use \Exception;
/**
 * ALM Stack Client
 * @package Mobingi\Alm\Stack
 */
class Stack extends ClientBase {
    /**
     * Traits
     */
    use StackTrait;
    /**
     * Providers by vendor
     * @var array(Provider Key => Client Key)
     */
    const PROVIDERS_BY_VENDER = [
        Vendor::AWS => "cloudformation"
    ];

    /**
     * {@inheritdoc}
     */
    protected function initClients() {
        $this->setClient('cloudformation', "Mobingi\Provider\Aws\CloudFormation\CloudFormationStack");
    }

    /**
     * List Stacks
     * @return array List of Stacks
     */
    function listStacks() {
        extract(Common::getInfoByToken());
        return Table::STACK()->getDao()->listItems(compact('user_id'), 'userIdIndex', ['stack_id' => 'mo-']);
    }

    /**
     * Describe Stack
     * @param string $stack_id StackID
     * @return array Stack Info
     */
    function describeStack($stack_id) {
        $item = $this->getStackByStackID($stack_id);
        $vendorName = $this->getVendorNameByStackInfo($item);
        return $this->getProvider($vendorName)->addDescribeItem($stack_id, $item);
    }

    /**
     * Create Stack
     * @param string $stack_id StackID
     * @param string $vendorName Vendor Name(ex:'aws', 'aliyun', ...)
     * @param array $vendor The vendor info(cred, secret, region)
     * @param string $region Region to deploy to
     * @param object $template Converted Template Body
     * @return true
     */
    function createStack($stack_id, $vendorName, array $vendor, $template) {
        $this->getProvider($vendorName)->createProcess($stack_id, $vendor, $template);
        return true;
    }

    /**
     * Change Stack
     * @param string $stack_id StackID
     * @param string $vendorName Vendor Name(ex:'aws', 'aliyun', ...)
     * @param array $vendor The vendor info(cred, secret, region)
     * @param object CloudFormation's Template Body
     * @throw Mobingi\Exception\FailtureStackException
     * @return true
     */
    function changeStack($stack_id, $vendorName, array $vendor, $template = null) {
        $this->getProvider($vendorName)->updateProcess($stack_id, $vendor, $template);
        return true;
    }

    /**
     * Terminate Stack
     * @param string $stack_id StackID
     * @return true
     */
    function terminateStack($stack_id) {
        $info = $this->getStackByStackID($stack_id);
        $vendorName = $this->getVendorNameByStackInfo($info);
        $vendor = $this->getVendorByStackInfo($info, $vendorName);
        $this->getProvider($vendorName)->deleteProcess($stack_id, $vendor);
        Table::STACK()->getDao()->deleteItem($stack_id);
        return true;
    }

    /**
     * Get Provider Client
     * @param string $vendorName Vendor Name(ex: "aws", "aliyun", ...)
     * @return Mobingi\Alm\Stack\StackProviderInterface Provider Client
     */
    private function getProvider($vendorName) {
         $provider = self::PROVIDERS_BY_VENDER[$vendorName];
         return $this->$provider;
    }
}
