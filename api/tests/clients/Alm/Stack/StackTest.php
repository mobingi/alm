<?php
namespace MobingiTest\Alm\Stack;
use Aws\CloudFormation\Exception\CloudFormationException;
use Mobingi\Alm\Stack\Stack;
use Mobingi\Alm\Template\Template;
use Mobingi\Core\Dao\Table;
use Mobingi\Core\Utility\Common;
use Mobingi\Exception\FailtureStackException;
use \DateTime;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Alm\Stack\Stack
 * @package Mobingi\Alm\Stack
 */
class StackTest extends MobingiApiTestBase {
    /**
     * @override
     * @return Mobingi\Alm\Stack\Stack
     */
    protected function getTargetInstance() {
        return new Stack();
    }

    /**
     * Test for createStack
     */
    function testCreateStack() {
         // Create test parameters
         extract(Common::getInfoByToken());
         $template = $this->getTemplateObject();
         $stack_id = 'mo-'. $user_id. '-'. Common::generateToken(9). '-'. Common::getRegionNickname($template->vendor->aws->region);
         $time = new DateTime;
         $create_time = $time->format(DateTime::ATOM);
         $item = ['nickname' => Common::generateNickname(), 'configuration' => $template] + compact('stack_id', 'user_id', 'create_time');
         Table::STACK()->getDao()->createItem($item);

         // Convert CloudFormation's template & execute test 
         $templateClient = new Template($this->target);
         $templateBody = $templateClient->applyAlmTemplate($template, $stack_id);
         $actual = $this->target->createStack($stack_id, "aws", (array)($template->vendor->aws), $templateBody);
         $this->assertTrue($actual);
         return $stack_id;
    }

    /**
     * Test for listStacks
     */
    function testListStacks() {
        $actual = $this->target->listStacks();
        $this->assertInternalType("array", $actual);
    }

    /**
     * Test for describeStack
     * @depends testCreateStack
     */
    function testDescribeStack($stack_id) {
        $actual = $this->target->describeStack($stack_id);
        $this->assertInternalType("array", $actual);
        $this->assertArrayHasKey("configuration", $actual);
        $this->assertArrayNotHasKey("vendor", $actual);
    }

    /**
     * Test for changeStack
     * @depends testCreateStack
     * @param string $stack_id StackID
     * @expectedException Aws\CloudFormation\Exception\CloudFormationException
     */
    function testChangeStack($stack_id) {
        $template = $this->getTemplateObject();
        $templateClient = new Template($this->target);
        $templateBody = $templateClient->applyAlmTemplate($template, $stack_id);
        $actual = $this->target->changeStack($stack_id, "aws", (array)($template->vendor->aws), $templateBody);
        $this->assertTrue($actual);      
    }

    /**
     * Test for terminateStack
     * @depends testCreateStack
     */
    function testTerminateStack($stack_id) {
        $actual = $this->target->terminateStack($stack_id);
        $this->assertTrue($actual);
    }
}
