<?php
namespace Mobingi\Exception;
/**
 * Validate Exception
 * Exception by validate, this class use.
 */
class ValidateException extends MobingiApiException {
    /**
     * Constructor
     * @param string $target The target of Validate Value
     * @param int $code Error Code
     */ 
    public function __construct($target, $code = self::VALIDATE_PARAMS) {
        parent::__construct($code, sprintf(self::MESSAGES[$code], $target));
    }
}
