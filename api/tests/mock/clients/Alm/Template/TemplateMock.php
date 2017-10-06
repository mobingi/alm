<?php
namespace Mobingi\Alm\Template;
use Mobingi\Alm\Template\Template;
use Mobingi\Alm\Template\Traits\WebHookTraitMock;
/**
 * Template Client Mock
 * @package Mobingi\Alm\Template
 */
class TemplateMock extends Template {
    /**
     * Traits
     */
    use WebHookTraitMock;

    /**
     * StackID for test
     * @var string
     */
    private $stack_id = null;

    /**
     * Set StackID
     * @param string $stack_id StackID
     * @return void
     */
    public function setStackId($stack_id) {
        $this->stack_id = $stack_id;
    }

    /**
     * @override
     */
    protected function getStackByStackID($stack_id) {
        if ($this->stack_id) $stack_id = $this->stack_id;
        return parent::getStackByStackID($stack_id);
    }
}
