<?php
namespace MobingiTest\Exception;
use Mobingi\Exception\ValidateException;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Exception\ValidateException
 * @package  MobingiTest\Exception
 */
class ValidateExceptionTest extends MobingiApiTestBase {

    /**
     * @override
     * @return null 
     */
    protected function getTargetInstance() {
        return null;
    }

    /**
     * Test to throw Exception
     * @expectedException Mobingi\Exception\ValidateException
     * @expectedExceptionCode 1000
     * @expectedExceptionMessage stack_id not specified
     */ 
    function testThrowException() {
        $this->target = new ValidateException("stack_id");
        throw $this->target;
    }
}
