<?php
namespace Mobingi\Alm\Template\Traits;
/**
 * WebHook Trait Mock
 * @package Mobingi\Alm\Template\Traits
 */
trait WebHookTraitMock {
    /**
     * @override
     */ 
    protected function getRequestObject() {
        parent::getRequestObject();
        return $this->requestObject;
    }

    /**
     * Set Request Mock Object
     * @param $requestObject \StdClass Request Object 
     */ 
    public function setRequestObject($requestObject) {
        $this->requestObject = $requestObject;
    }
}
