<?php
namespace Mobingi\Exception;
/**
 * Alm Template Exception
 * Validating and processing of class Alm\Template will use this exception class
 */
class TemplateException extends MobingiApiException {

    /**
     * Constructor
     * @param string $code error code
     * @param string $description Description
     */
    public function __construct($code,$description) {
        parent::__construct($code, null, $description);
    }
}
