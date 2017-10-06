<?php
namespace MobingiTest\Core\Enum;
use Mobingi\Core\Dao\Table;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Core\Enum\Enum
 * Since `Mobingi\Core\Enum\Enum` is abstract class,
 * this test class use `Mobingi\Core\Dao\Table`
 * @package MobingiTest\Core\Enum
 */
class EnumTest extends MobingiApiTestBase {
    /**
     * @override
     * @return null
     */ 
    protected function getTargetInstance() {
        return null;
    }

    /**
     * Test for __construct
     */ 
    function test__construct() {
        $this->target = new Table(Table::STACK);
        $this->assertInstanceOf("Mobingi\Core\Enum\Enum", $this->target);
        $this->assertSame(Table::STACK, $this->target->valueOf());
    }

    /**
     * Test for __construct Error
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Not have such value!!
     */ 
    function test__construct_Error() {
        new Table("test");
    }

    /**
     * Test for __callStatic
     */ 
    function test__callStatic() {
        $this->target = Table::STACK();
        $this->assertInstanceOf("Mobingi\Core\Enum\Enum", $this->target);
        $this->assertSame((string)Table::STACK, $this->target->__toString());
    }
}
