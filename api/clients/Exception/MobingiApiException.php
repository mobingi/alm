<?php
namespace Mobingi\Exception;
use \Exception;
use \InvalidArgumentException;
/**
 * Mobingi API Exception
 * Especially if there is no reason, when implementing the exception classes, it is implemented by inheriting this class.
 */
class MobingiApiException extends Exception {
    /**
     * Error Codes
     * @var int
     */
    const VALIDATE_PARAMS = 1000;
    const DUPLICATE_ALM_TEMPLATE_ID = 1005;
    const FAILURE_ALM_TEMPLATE_VALIDATION = 1006;
    const FAILURE_TEMPLATE_EMPTY_VALIDATION = 1007;
    const FAILTURE_STACK = 2000;
    const CODE_BUG = 8000;
    const RUNTIME = 9000;

    /**
     * Error Messsages
     * @var array(error_code => string)
     */
    const MESSAGES = [
        self::VALIDATE_PARAMS => "%s not specified",
        self::DUPLICATE_ALM_TEMPLATE_ID => "stack_id provided already exist",
        self::FAILURE_ALM_TEMPLATE_VALIDATION => "Alm template failed to pass the format verification",
    ];

    /**
     * Error description
     * @var string
     */
    protected $description;

    /**
     * Construct the exception
     * @param int $code Error code
     * @param string $message Error message
     * @param string $description Error description
     */
    public function __construct($code = 0, $message = '', $description = '') {
        if (!empty(self::MESSAGES[$code]) && empty($message)) $message = self::MESSAGES[$code];
        parent::__construct($message, $code);
        $this->description = $description;
    }

    /**
     * Array representation of the exception
     * @return array Key-values that includes the following key.
     * ["code", "message", "description"]
     */
    public function __toArray() {
        return ["code" => sprintf("%04d", $this->code), "message" => $this->message, "description" => $this->description];
    }

    /**
     * JSON representation of the exception
     * @return string JSON Value that includes the following key.
     * ["code", "message", "description"]
     */
    public function __toJson() {
        return json_encode($this->__toArray());
    }

    /**
     * Convert to Exception
     * @param Exception $target Target Exception
     * @throw InvalidArgumentException The argument isn't instance of Exception.
     * @return MobingiApiException
     */
    static function convert($target) {
        $parents = class_parents($target);
        if ($parents === false || !array_key_exists("Exception", $parents)) {
            throw new InvalidArgumentException("Not supported classes");
        }
        $code = array_key_exists("LogicException", $parents)? self::CODE_BUG : self::RUNTIME;
        $code += $target->getCode();
        return new MobingiApiException($code, $target->getMessage(), $target->getTraceAsString());
    }
}
