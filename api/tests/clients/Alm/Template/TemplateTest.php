<?php
namespace MobingiTest\Alm\Template;
use Mobingi\Alm\Template\TemplateMock;
use \MobingiApiTestBase;
use \ReflectionClass;
/**
 * Test Case for Mobingi\Alm\Template\Template
 * @package MobingiTest\Alm\Template
 */
class TemplateTest extends MobingiApiTestBase {
    /**
     * @override
     */ 
    public function tearDown() {
        if ($this->getName(true) === "testUpdateAlmTemplate") {
            $this->target->stack->terminateStack(self::$TEST_STACK_ID);
        }
        parent::tearDown();
    }

    private static $TEST_STACK_ID = null;

    /**
     * @override
     * @return Mobingi\Alm\Template\TemplateMock
     */
    protected function getTargetInstance() {
        return new TemplateMock();
    }

    /**
     * Test for saveAlmTemplate
     */
    function testSaveAlmTemplate() {
        $this->target->setRequestObject($this->getTemplateObject());
        $actual = $this->target->saveAlmTemplate();
        $this->assertInternalType("array", $actual);
        $this->assertSame("success", $actual["status"]);
        $this->assertArrayHasKey("stack_id", $actual);
        return $actual["stack_id"];
    }

    /**
     * Test for saveAlmTemplate(Error case of failure createStack)
     * @expectedException Mobingi\Exception\FailtureStackException
     * @expectedExceptionCode 2000
     */
    function testSaveAlmTemplate_CreateStackError() {
        $template = $this->getTemplateObject();
        $template->vendor->aws->cred = $template->vendor->aws->cred. "qwert";
        $this->target->setRequestObject($template);
        $this->target->saveAlmTemplate();
    }

    /**
     * Test for checkKeyOwner
     * @dataProvider getProviderCheckKeyOwner
     * @param array $db User info from db
     * @param string $user_id UserID
     * @param string $username Sub User Name
     * @param boolean $expected Expected value
     */
    function testCheckKeyOwner($db, $user_id, $username, $expected) {
         $reflection = new ReflectionClass($this->target);
         $method = $reflection->getMethod("checkKeyOwner");
         $method->setAccessible(true);
         $actual = $method->invokeArgs($this->target, [$db, $user_id, $username]);
         $this->assertSame($expected, $actual);
    }

    /**
     * Test provider for checkKeyOwner
     * @return array The list of Test Parameters
     */
    function getProviderCheckKeyOwner() {
         $user_id = $this->getUserId();
         $username = getenv(TEST_SUB_USER_NAME);
         $db = compact("user_id", "username");
         return [
             [$db, $user_id, $username, true],
             [$db, $user_id, null,      true],
             [$db, null,     null,      false],
         ];
    }

    /**
     * Test case of no set version_id for describeAlmTemplate
     * @depends testSaveAlmTemplate
     * @param string $stack_id StackID
     */ 
    function testDescribeAlmTemplate_NoSetVersionId($stack_id) {
        $actual = $this->target->describeAlmTemplate($stack_id);
        $this->assertInternalType("object", $actual);
    }

    /**
     * Test for describeContainerConfig
     * @depends testSaveAlmTemplate
     * @param string $stack_id StackID
     */
    function testDescribeContainerConfig($stack_id) {
        $actual = $this->target->describeContainerConfig($stack_id, "");
        $this->assertNotEmpty($actual);
    }

    /**
     * Test for updateAlmTemplate
     * @depends testSaveAlmTemplate
     * @expectedException Aws\CloudFormation\Exception\CloudFormationException
     * @param string $stack_id StackID
     */
    function testUpdateAlmTemplate($stack_id) {
        self::$TEST_STACK_ID = $stack_id;
        $this->target->setRequestObject($this->getTemplateObject());
        $actual = $this->target->updateAlmTemplate($stack_id);
        $this->assertInternalType("array", $actual);
        $this->assertSame("success", $actual["status"]);
        $this->assertSame($stack_id, $actual['stack_id']);
    }

    /**
     * Test case of Void Return for applyAlmTemplate
     * @dataProvider getProviderApplyAlmTemplate_VoidReturn
     * @param object $template Template body in Json format
     */
    function testApplyAlmTemplate_VoidReturn($template) {
        $actual = $this->target->applyAlmTemplate($template);
        $this->assertEmpty($actual);
    }

    /**
     * Test case of Void Return provider for applyAlmTemplate
     * @return array The list of Test Parameters
     */
    function getProviderApplyAlmTemplate_VoidReturn() {
         $object = $this->getTemplateObject();
         unset($object->vendor);
         $object->vendor->aliyun = null;
         return [[null], [$object]];
    }
}
