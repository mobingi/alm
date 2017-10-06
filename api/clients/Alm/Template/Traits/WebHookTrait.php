<?php
namespace Mobingi\Alm\Template\Traits;
/**
 * WebHook Trait
 * If you want to use webhook, in the classes to use, you should set this trait as follows.
 * `use WebHookTrait;` 
 * @package Mobingi\Alm\Template\Traits
 */
trait WebHookTrait {
    /**
     * Get Request Object
     * @return \StdClass Request Object
     */ 
    protected function getRequestObject() {
        return json_decode(file_get_contents("php://input"));
    }
}
