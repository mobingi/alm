<?php
namespace MobingiTest\Alm\Template;
use Mobingi\Alm\Template\Validate;
use \MobingiApiTestBase;
use \StdClass;
/**
 * Test Case for Mobingi\Alm\Template\Validate
 * @package MobingiTest\Alm\Template
 */
class ValidateTest extends MobingiApiTestBase {
    /**
     * @override
     * @return Mobingi\Alm\Template\Validate
     */
    protected function getTargetInstance() {
        return new Validate();
    }

    /**
     * Test case of success for validateAlmTemplate
     */
    function testValidateAlmTemplate_Success() {
        $actual = $this->target->validateAlmTemplate($this->getTemplateObject());
        $this->assertTrue($actual);
    }

    /**
     * Test case of error for validateAlmTemplate
     * @dataProvider getProviderValidateAlmTemplate
     * @param object $template Template
     * @expectedException Exception
     */
    function testValidateAlmTemplate_Error($template) {
        $this->target->validateAlmTemplate($template);
    }

    /**
     * Test case of error provider for validateAlmTemplate
     * @return array The list of Test Parameters
     */
    function getProviderValidateAlmTemplate() {
        $vendorError = $this->getTemplateObject();
        unset($vendorError->vendor);
        $configurationsError = $this->getTemplateObject();
        unset($configurationsError->configurations);
        return [[null], [$vendorError], [$configurationsError]];
    }
}
