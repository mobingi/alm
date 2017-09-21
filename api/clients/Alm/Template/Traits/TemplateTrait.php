<?php
namespace Mobingi\Alm\Template\Traits;
/**
 * Template Clients Trait
 * @package Mobingi\Alm\Template\Traits
 */
trait TemplateTrait {
    /**
     * Get Meta Data
     * @param object $template template body in Json format
     * @param string $key Target key
     * @return mixed Meta Data
     */
    protected function getMetadata($template, $key) {
        return $template->$key;
    }

    /**
     * Get the template Version found in Alm-template
     * @param object $template template body in Json format
     * @return string Version
     */
    protected function getVersion($template) {
        return $this->getMetadata($template, "version");
    }

    /**
     * Get the template Vendor found in Alm-template
     * @param object $template template body in Json format
     * @return string Vendor Name
     */
    protected function getVendor($template) {
        return key($this->getMetadata($template, "vendor"));
    }

    /**
     * Get the template Configurations found in Alm-template
     * @param object $template template body in Json format
     * @return array Configurations
     */
    protected function getConfiguration($template) {
        return $this->getMetadata($template, "configurations");
    }
}
