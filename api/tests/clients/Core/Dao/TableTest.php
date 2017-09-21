<?php
namespace MobingiTest\Core\Dao;
use Mobingi\Core\Dao\Table;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Core\Dao\Table
 * @package MobingiTest\Core\Dao
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
    function testGetDao() {
        $this->target = Table::STACK()->getDao();
        $this->assertInstanceOf("Mobingi\Core\Dao\BaseDao", $this->target);
    }
}
