<?php
namespace MobingiTest\Exception;
use Mobingi\Exception\FailtureStackException;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Exception\FailtureStackException
 * @package  MobingiTest\Exception
 */
class FailtureStackExceptionTest extends MobingiApiTestBase {

    /**
     * @override
     * @return null 
     */
    protected function getTargetInstance() {
        return null;
    }

    /**
     * Test to throw Exception
     */ 
    function testToArray() {
        // parameters
        $stackName = "mo-3sdfjls-3dsfasdfja-tk";
        $reason = "Failture create";
        $expected = [
            "code" => "". FailtureStackException::FAILTURE_STACK. "",
            "message" => $stackName,
            "description" => $reason,
        ]; 

        // Run function & check return value
        $this->target = new FailtureStackException($stackName, $reason);
        $actual = $this->target->__toArray();
        $this->assertSame($expected, $actual);
    }
}
