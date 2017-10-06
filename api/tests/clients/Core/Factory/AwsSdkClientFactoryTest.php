<?php
namespace MobingiTest\Core\Factory;
use Mobingi\Core\Factory\AwsSdkClientFactory;
use Mobingi\Core\User\Traits\InfoTraitMock;
use \InvalidArgumentException;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Core\Factory\AwsSdkClientFactory
 * @package Mobingi\Core\Factory
 */
class AwsSdkClientFactoryTest extends MobingiApiTestBase {
    const EXCEPTED_EXCEPTION_MESSAGE = "No such AWS Client Class!!";
    /**
     * @override
     * @return Mobingi\Core\Factory\AwsSdkClientFactory
     */ 
    protected function getTargetInstance() {
        return new AwsSdkClientFactory();
    }

    /**
     * Test for createClient 
     * @dataProvider getProvidorCreateClient
     * @param string $clientName Client class name
     * @param mixed $expected Expected value
     */ 
    function testCreateClient($clientName, $expected) {
        try {
            $actual = $this->target->createClient($clientName, $this->getOptions());
            $this->assertSame($expected, get_class($actual));
        } catch (InvalidArgumentException $e) {
            $this->assertSame($expected, $e->getMessage());
        }
    }

    /**
     * Test Providor for createClient
     * @return array The list of Test Parameters
     */ 
    function getProvidorCreateClient() {
        return [
            ['cloudformation', 'Aws\CloudFormation\CloudFormationClient'],
            ['ec2', 'Aws\Ec2\Ec2Client'],
            ['aws', self::EXCEPTED_EXCEPTION_MESSAGE],
        ];
    }

    /**
     * Test for createClientList
     * @dataProvider getProvidorCreateCientList
     * @param array $clientNameList the list of client class name
     * @param mixed $expected Expected value
     */ 
    function testCreateClientList($clientNameList, $expected) {
        $actualList = $this->target->createClientList($clientNameList, $this->getOptions());
        foreach ($actualList as $key => $actual) {
            $this->assertSame($expected[$key], get_class($actual));
        }
    }

    /**
     * Test Providor for createClientList
     * @return array The list of Test Parameters
     */ 
    function getProvidorCreateCientList() {
        $clientList = $this->getProvidorCreateClient();
        $expectedList = [];
        foreach ($clientList as $clientInfo) {
            if ($clientInfo[1] === self::EXCEPTED_EXCEPTION_MESSAGE) {
                continue;
            }
            $expectedList[$clientInfo[0]] = $clientInfo[1];
        }
        return [[array_keys($expectedList), $expectedList]];
    }

    /**
     * Test for createClientByVendor
     * @dataProvider getProvidorCreateCientList
     */
    function testCreateClientByVendor($clientNameList, $expected) {
        $actualList = $this->target->createClientByVendor($clientNameList, $this->getVendor());
        foreach ($actualList as $key => $actual) {
            $this->assertSame($expected[$key], get_class($actual));
        }
    }

    /**
     * Get Vendor Info
     * @return array Vendor Info
     */
    private function getVendor() {
        $template = $this->getTemplateObject();
        return (array)($template->vendor->aws);
    }

    /**
     * Get Options
     * @return array Options
     */
    private function getOptions() {
        $vendor = $this->getVendor();
        extract($vendor);
        return ["key" => $cred] + compact("secret", "region");
    }
}
