<?php
use PHPUnit\Framework\TestCase;
use Mobingi\Alm\Stack\Traits\StackTrait;
use Mobingi\Core\Utility\Common;
use Mobingi\Exception\ValidateException;
/**
 * Test base class for Mobingi-API
 * Especially if there is no reason, when implementing the test cases, it is implemented by inheriting this class.
 * Common processing and constants to be used in each class be defined here.
 */
abstract class MobingiApiTestBase extends TestCase {
    /**
     * Traits
     */
    use StackTrait;
    /**
     * True is set to OAuthId.
     * @var boolean
     */ 
    protected $isSetOAuthId = true;
    /**
     * Instance object of test target class
     */ 
    protected $target; 

    public function setUp() {
        parent::setUp();
        $this->startTime = time();
        $this->target = $this->getTargetInstance();
        $this->setOAuthId();
    }

    public function tearDown() {
        $this->target = null;
        parent::tearDown();
        unset($this->startTime);
    }

    /**
     * Get instance object of test target class
     * @return test target class
     */ 
    abstract protected function getTargetInstance();

    /**
     * Get UserID for test
     * @return string UserID
     */ 
    protected function getUserId() {
        return getenv(TEST_USER_ID);
    }

    /**
     * Get Credentials ID for test
     * @param $string $vendor Vendor Name(Default: 'aws')
     * @return string Credentials ID
     */
    protected function getCredentialsId($vendor = 'aws') {
        return getenv(TEST_CREDENTIAL_ID);
    }

    /**
     * Assert Validate Exception
     * @param Exception $actual Target Exception
     * @param string $expectedMessage Expected error message
     */
    protected function assertValidateException(Exception $actual, $expectedMessage) {
        $this->assertSame("Mobingi\Exception\ValidateException", get_class($actual));
        $this->assertSame(ValidateException::VALIDATE_PARAMS, $actual->getCode());
        $this->assertSame($expectedMessage, $actual->getMessage());
    }

    /**
     * Set OAuth User ID or client ID
     */ 
    protected function setOAuthId() {
        if (!defined('OAUTH_USER_ID')) {
           define('OAUTH_USER_ID', $this->getUserId());
        }
    }

    const DEFAULT_TEMPLATE_JSON_NAME = "aws-single_ec2_with_container.json";
    /**
     * Get Test Template JSON
     * @return string Test Template JSON
     */
    function getTemplateJson($fileName = self::DEFAULT_TEMPLATE_JSON_NAME) {
       $jsonFileName = __DIR__. "/../clients/Alm/Template/Examples/2017-03-03/". $fileName;
       return file_get_contents($jsonFileName);
    }

    /**
     * Get Test Template Object
     * @return object Test Template Object
     */
    function getTemplateObject($fileName = self::DEFAULT_TEMPLATE_JSON_NAME) {
        $template = json_decode($this->getTemplateJson($fileName));
        $template->vendor->aws->cred = getenv(TEST_CREDENTIAL_ID);
        $template->vendor->aws->secret = getenv(TEST_CREDENTIAL_SECRET);
        $template->vendor->aws->region = AWS_REGION;
        return $template;
    }
}
