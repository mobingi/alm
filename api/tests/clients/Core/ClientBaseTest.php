<?php
namespace MobingiTest\Core;
use Mobingi\Core\ClientBaseMock;
use \MobingiApiTestBase;
use \Exception;
/**
 * Test Case for Mobingi\Core\ClientBase
 * @package MobingiTest\Core
 */
class ClientBaseTest extends MobingiApiTestBase {
    private static $EXCEPTED_CLIENT_LIST = [
        'awsSdkFactory' => 'Mobingi\Core\Factory\AwsSdkClientFactory',
    ];

    /**
     * @override
     * @return Mobingi\Core\ClientBaseMock
     */ 
    protected function getTargetInstance() {
        return new ClientBaseMock();
    }

    /**
     * Test for __construct
     */ 
    function test__construct() {
        $this->assertClients();
    }

    /**
     * Test for __constructFromOwnerClient
     */ 
    function test__constructFromOwnerClient() {
        $subClazz = new ClientBaseMock();
        $this->target = new ClientBaseMock($subClazz);
        $this->assertClients($subClazz);
    }

    /**
     * Assert clients for target
     * @param Mobingi\Core\Client $targetClazz;
     */ 
    function assertClients($targetClazz = null) {
        foreach (self::$EXCEPTED_CLIENT_LIST as $propertyName => $className) {
            $actual = $this->target->$propertyName;
            $this->assertSame($className, get_class($actual));

            if (!empty($targetClazz)) {
                $expected = $targetClazz->$propertyName;
                $this->assertSame($expected, $actual);
            }
        }
    }

    /**
     * Test for validate.
     * @dataProvider getProvidorValidate
     * @param array $params Reuqest paramters.
     * @param array $targetKeys The target keys for validate
     * @param mixed $expected Expected value
     */
    function testValidate(array $params, array $targetKeys, $expected = null) {
        try {
            $actual = $this->target->validate($params, $targetKeys);
            $this->assertSame($this->target, $actual);
            if (!empty($expected)) $this->fail();
        } catch (Exception $e) {
            $this->assertValidateException($e, $expected);
        }
    }

    /**
     * Test Providor for validate
     * @return array The list of Test Parameters
     */
    function getProvidorValidate() {
        // case of success
        $params = [
            "user_id" => $this->getUserId(),
            "cred" => $this->getCredentialsId(),
        ];
        $testData = [$params, array_keys($params)];
        $testDataList = [$testData];
 
        // case of error of no instance_id
        $targetKey = "instance_id";
        $testData[1][] = $targetKey;
        $testData[2] = $targetKey. " not specified";
        $testDataList[] = $testData;
 
        // case of error of no stack_id
        $targetKey = "user_id";
        unset($testData[0][$targetKey]);
        $testData[2] = $targetKey. " not specified";
        $testDataList[] = $testData;
 
        return $testDataList;
    }
}
