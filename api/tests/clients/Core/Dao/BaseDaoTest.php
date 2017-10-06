<?php
namespace MobingiTest\Core\Dao;
use Mobingi\Core\Dao\FileDao;
use Mobingi\Core\Dao\Table;
use \MobingiApiTestBase;
use \ReflectionClass;
/**
 * Test Case for Mobingi\Core\Dao\BaseDao
 * Since `Mobingi\Core\Dao\BaseDao` is abstract class,
 * this test class use `Mobingi\Core\Dao\FileDao`
 * @package MobingiTest\Core\Db
 */
class BaseDaoTest extends MobingiApiTestBase {
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
        $this->target = new FileDao(Table::STACK());
        $this->assertInstanceOf("Mobingi\Core\Dao\BaseDao", $this->target);
    }

    /**
     * Test for getPrimaryKey
     * @dataProvider getProviderGetPrimaryKey
     * @param Mobingi\Core\Dao\Table $table Table Class
     * @param string $expected Expected value
     */
    function testGetPrimaryKey(Table $table, $expected) {
        $this->target = new FileDao($table);
        $reflection = new ReflectionClass($this->target);
        $method = $reflection->getMethod("getPrimaryKey");
        $method->setAccessible(true);
        $actual = $method->invokeArgs($this->target, []);
        $this->assertSame($expected, $actual);
    }

    /**
     * Test provider for getPrimaryKey
     * @return array The list of Test Parameters
     */
    function getProviderGetPrimaryKey() {
        return [
            [Table::STACK(), "stack_id"],
            [Table::CONTAINER_STATUS(), "container_id"],
            [Table::AGENT_STATUS(), "agent_id"],
        ];
    }
}
