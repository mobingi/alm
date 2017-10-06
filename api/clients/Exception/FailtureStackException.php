<?php
namespace Mobingi\Exception;
/**
 * Failture Stack Exception
 * Exception by failture Stack to create or update, this class use.
 * @package Mobingi\Exception
 */
class FailtureStackException extends MobingiApiException {
    /**
     * Constructor
     * @param string $stackName The exception of Stack Name
     * @param string $reason Error Reason
     */
    public function __construct($stackName, $reason) {
        parent::__construct(self::FAILTURE_STACK, $stackName, $reason);
    }
}
