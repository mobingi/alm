<?php
namespace Mobingi\Alm\Stack;
use Mobingi\Core\ClientBase;
use Mobingi\Core\Dao\Table;
/**
 * Stack Instance Client
 * @package Mobingi\Alm\Stack
 */
class Instance extends ClientBase {
    /**
     * {@inheritdoc}
     */
    protected function initClients() {}

    /**
     * Update Container Status
     * @param string $stack_id StackID
     * @param string $agent_id AgentID
     * @param string $container_id ContainerID
     * @param string $status Update Status
     * @param string $instance_id Instance ID
     * @return array Update Result
     */
    function updateInstanceStatus($stack_id, $agent_id, $container_id, $status, $instance_id = '') {
        $update_time = (string)time();
        $targets = compact("stack_id", "agent_id", "status", "update_time", "instance_id");
        Table::CONTAINER_STATUS()->getDao()->updateItem($container_id, array_filter($targets));
        return compact("stack_id", "agent_id", "container_id", "status", "update_time", "instance_id");
    }

    /**
     * Update Agent Status
     * @param string $stack_id StackID
     * @param string $agent_id AgentID
     * @param string $status Update Status
     * @param string $instance_id Instance ID
     * @param string $message Message
     * @return array Update Result
     */
    function updateAgentStatus($stack_id, $agent_id, $status, $instance_id = '', $message = '') {
        $update_time = (string)time();
        $targets = compact("stack_id", "status", "update_time", "instance_id", "message");
        Table::AGENT_STATUS()->getDao()->updateItem($agent_id, array_filter($targets));
        return compact("stack_id", "agent_id", "status", "update_time", "instance_id", "message");
    }
}
