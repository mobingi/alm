<?php
namespace Mobingi\Alm\Template;
use Mobingi\Alm\Template\Traits\TemplateTrait;
use Mobingi\Exception\TemplateException;
use Mobingi\Core\ClientBase;
/**
 * Template Validate Client
 * @package Mobingi\Alm\Template
 */
class Validate extends ClientBase {
    /**
     * Traits
     */
    use TemplateTrait;

    /**
     * {@inheritdoc}
     */
    protected function initClients() {}

    public function validateAlmTemplate($template) {
        // Checks on supported alm template version
        if ($this->getVersion($template) !== '2017-03-03') {
            throw new TemplateException(TemplateException::FAILURE_ALM_TEMPLATE_VALIDATION, "Alm template version is not supported, current supported version is '2017-03-03'.");
        }

        // Checks on supported vendors
        if (!in_array($this->getVendor($template), array_column(VENDOR_KEY_LIST, "vendor"))) {
            throw new TemplateException(TemplateException::FAILURE_ALM_TEMPLATE_VALIDATION, "This cloud vendor is not supported, please check your template's 'vendor' section.");
        }

        // Checks on configurations section:
        $configurations = $this->getConfiguration($template);
        if (empty($configurations)) {
            throw new TemplateException(TemplateException::FAILURE_ALM_TEMPLATE_VALIDATION, "Missing 'configurations' section in your alm template.");
        }
        return true;
    }




}
