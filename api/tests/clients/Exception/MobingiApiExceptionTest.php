<?php
namespace MobingiTest\Exception;
use Mobingi\Exception\MobingiApiException;
use \MobingiApiTestBase;
use \InvalidArgumentException;
/**
 * Test Case for Mobingi\Exception\MobingiApiException
 */
class MobingiApiExceptionTest extends MobingiApiTestBase {
    const TEST_CODE = 1001;
    const TEST_MESSAGE = "MobingiApi Exception Test";
    const TEST_DESCRIPTION = "This exception is test exeception.";

    /**
     * @override
     * @return Mobingi\Exception\MobingiApiException
     */
    protected function getTargetInstance() {
        return new MobingiApiException(self::TEST_CODE, self::TEST_MESSAGE, self::TEST_DESCRIPTION);
    }

    /**
     * Test for __construct
     * @dataProvider getProvidorConstruct
     * @param long $code Error Code
     * @param string $message Error Message
     * @param boolean $hasErrorMessage True is to have error messaage
     */ 
    function testConstruct($code, $message = "", $hasErrorMessage = false) {
        $actual = new MobingiApiException($code, $message);
        if ($hasErrorMessage) {
            $message = MobingiApiException::MESSAGES[$code];
        }
        $this->assertSame($code, $actual->getCode());
        $this->assertSame($message, $actual->getMessage()); 
    }

    /**
     * Test Providor for __construct
     * @return array The list of Test Parameters
     */
    function getProvidorConstruct() {
        return [
            [self::TEST_CODE, self::TEST_MESSAGE],
            [MobingiApiException::VALIDATE_PARAMS, "", true],
            [MobingiApiException::FAILTURE_STACK, "test"],
        ];
    } 

    /**
     * Test for __toArray
     * @dataProvider getProvidorToArray
     * @params $expected Expected value
     */ 
    function testToArray($expected) {
        $actual = $this->target->__toArray();
        $this->assertSame($expected, $actual);
    }

    /**
     * Test Providor for __toArray
     * @return array The list of Test Parameters
     */
    function getProvidorToArray() {
        return [[[
            "code" => "".self::TEST_CODE."",
            "message" => self::TEST_MESSAGE,
            "description" => self::TEST_DESCRIPTION,
        ]]];

    }

    /**
     * Test for __toJson
     * @dataProvider getProvidorToArray
     * @params $expected Expected value
     */ 
    function testToJson($expected) {
        $actual = $this->target->__toJson();
        $this->assertSame(json_encode($expected), $actual);
    }

    /**
     * Test for convert
     * @dataProvider getProviderConvert
     * @param mixed $target The target exception to get the error code
     * @param mixed Expected Value
     */
    function testConvert($target, $expected) {
        try {
            $actual = MobingiApiException::convert($target);
            $this->assertSame("Mobingi\Exception\MobingiApiException", get_class($actual));
            $expected = [
                "code" => "".$expected."",
                "message" => $target->getMessage(),
                "description" => $target->getTraceAsString(),
            ];
            $this->assertSame($expected, $actual->__toArray());
        } catch (InvalidArgumentException $e) {
            $this->assertSame($expected, $e->getMessage());
        }
    }

    /**
     * Test Providor for Convert
     * @return array The list of Test Parameters
     */
    function getProviderConvert() {
        $errorMessage = "Not supported classes";
        return [
           [new \StdClass(), $errorMessage],
           ["testCode", $errorMessage],
           [new InvalidArgumentException(), MobingiApiException::CODE_BUG],
           [new MobingiApiException(), MobingiApiException::RUNTIME],
        ];
    }
}
