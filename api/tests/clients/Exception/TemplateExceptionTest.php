<?php
namespace MobingiTest\Exception;
use Mobingi\Exception\TemplateException;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Exception\TemplateException
 * @package  MobingiTest\Exception
 */
class TemplateExceptionTest extends MobingiApiTestBase {
    /**
     * @override
     * @return null 
     */
    protected function getTargetInstance() {
        return null;
    }

    /**
     * Test for set invalid argument error
     * @expectedException Mobingi\Exception\TemplateException
     * @expectedExceptionCode 1006
     * @expectedExceptionMessage Alm template failed to pass the format verification
     */
    function testThrowException() {
        $this->target = new TemplateException(TemplateException::FAILURE_ALM_TEMPLATE_VALIDATION, "unittest");
        throw $this->target;
    }
}
