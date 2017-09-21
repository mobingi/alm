<?php
namespace MobingiTest\Alm\Template;
use Mobingi\Alm\Template\Convert;
use \MobingiApiTestBase;
use \StdClass;
/**
 * Test Case for Mobingi\Alm\Template\Convert
 * @package MobingiTest\Alm\Template
 */
class ConvertTest extends MobingiApiTestBase {
    /**
     * @override
     * @return Mobingi\Alm\Template\Convert
     */
    protected function getTargetInstance() {
        return new Convert();
    }

    const CONFIGURATION_ROLES = ['web', 'bastion', 'nat_gateway', 'rds', 'elsticcash'];
    /**
     * Test for convertToCFTemplate
     * @dataProvider getProviderConvertToCFTemplate
     * @param object $template Template
     */
    function testConvertToCFTemplate($template) {
        $actual = $this->target->convertToCFTemplate($template);
        $this->assertNotEmpty($actual);
    }

    /**
     * Test provider for convertToCFTemplate
     * @return array The list of Test Parameters
     */
    function getProviderConvertToCFTemplate() {
         // Role only options
         $template = new StdClass;
         $configurations = [];
         foreach (self::CONFIGURATION_ROLES as $role) {
             $configuration = new StdClass;
             $configuration->role = $role;
             $configurations[] = $configuration;
         }
         $template = new StdClass;
         $template->configurations = $configurations;
         $testDataList = [[$template]];

         // Has Spot Range
         $configuration = new StdClass;
         $configuration->role = "web";
         $configuration->container = $configuration->provision = new StdClass;
         $configuration->provision->auto_scaling = new StdClass;
         $configuration->provision->auto_scaling->spot_range = 100;
         $configuration->provision->auto_scaling->spotMin = 1;
         $configuration->provision->auto_scaling->spotMax = 2;
         $template = new StdClass;
         $template->configurations = [$configuration];
         $testDataList[] = [$template];
         return $testDataList;
    }

    /**
     * Test for convertToAliyun
     */
    function testConvertToAliyun() {
        $actual = $this->target->convertToAliyun(null);
        $this->assertNull($actual);
    }
}
