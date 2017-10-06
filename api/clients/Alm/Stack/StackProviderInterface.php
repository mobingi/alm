<?php
namespace Mobingi\Alm\Stack;
/**
 * Stack Provider Interface
 * If there is no particular reason when implementing each vendor-specific process of the Stack class, it is recommended to implement it by inheriting this interface.
 * For unnecessary processing by the vendor, define only the method and leave the implementation body empty.
 * @package Mobingi\Alm\Stack\Interface
 */
interface StackProviderInterface {
    /**
     * Add describe item
     * @param string $stack_id StackID
     * @param array $item Stack Describe Item form DB
     * @reutrn array Added item
     */
    public function addDescribeItem($stack_id, array $item);

    /**
     * Create Stack Process
     * @param string $stack_id StackID
     * @param array $vendor The vendor info(cred, secret, region)
     * @param object $template Converted Template Body
     * @return void
     */
    public function createProcess($stack_id, array $vendor, $template);

    /**
     * Update Stack Process
     * @param string $stack_id StackID
     * @param array $vendor The vendor info(cred, secret, region)
     * @param object $template Converted Template Body
     * @return void
     */
    public function updateProcess($stack_id, array $vendor, $template);

    /**
     * Delete Stack Process
     * @param string $stack_id StackID
     * @param array $vendor The vendor info(cred, secret, region)
     * @return void
     */
    public function deleteProcess($stack_id, array $vendor);
}
