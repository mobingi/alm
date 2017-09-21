<?php
namespace MobingiTest\Alm\Stack;
use Mobingi\Alm\Stack\Instance;
use Mobingi\Alm\Stack\InstanceMock;
use Mobingi\Core\Dao\Table;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Alm\Stack\Instance
 * @package  MobingiTest\Alm\Stack
 */
class InstanceTest extends MobingiApiTestBase {
    const TEST_INSTANCE_ID = "i-dummy12345abcde";
    const TEST_AGENT_ID = "mobingiapiunittest";
    const TEST_INSTANCE_TYPE = "m3.medium";

    /**
     * @override
     */
    public function tearDown() {
        if ($this->getName(true) === "testUpdateInstanceStatus") {
            Table::CONTAINER_STATUS()->getDao()->deleteItem(self::TEST_INSTANCE_ID);
        } elseif ($this->getName(true) === "testUpdateAgentStatus") {
            Table::AGENT_STATUS()->getDao()->deleteItem(self::TEST_AGENT_ID);
        }
        parent::tearDown();
    }

    /**
     * @override
     * @return Mobingi\Alm\Stack\Instance
     */
    protected function getTargetInstance() {
        return new Instance();
    }

    /**
     * Test for updateInstanceStatus
     */
    function testUpdateInstanceStatus() {
        $stack_id = getenv(TEST_STACK_ID);
        $container_id = self::TEST_INSTANCE_ID;
        $agent_id = self::TEST_AGENT_ID;
        $status = "complete";
        $actual = $this->target->updateInstanceStatus($stack_id, $agent_id, $container_id, $status);
        $this->assertArrayHaskey("update_time", $actual);
        unset($actual["update_time"]);
        $instance_id = "";
        $this->assertSame(compact("stack_id", "agent_id", "container_id", "status", "update_time", "instance_id"), $actual);
    }

    /**
     * Test for updateAgentStatus
     */
    function testUpdateAgentStatus() {
        $stack_id = getenv(TEST_STACK_ID);
        $agent_id = self::TEST_AGENT_ID;
        $status = "complete";
        $actual = $this->target->updateAgentStatus($stack_id, $agent_id, $status);
        $this->assertArrayHaskey("update_time", $actual);
        unset($actual["update_time"]);
        $instance_id = $message = "";
        $this->assertSame(compact("stack_id", "agent_id", "status", "update_time", "instance_id", "message"), $actual);
    }
}
