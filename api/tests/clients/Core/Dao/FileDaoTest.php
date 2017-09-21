<?php
namespace MobingiTest\Core\Dao;
use Mobingi\Core\Dao\Table;
use Mobingi\Core\Utility\Common;
use \DateTime;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Core\Dao\FileDao
 * @package MobingiTest\Core\Dao
 */
class FileDaoTest extends MobingiApiTestBase {
    /**
     * @override
     * @return null
     */
    protected function getTargetInstance() {
        return null;
    }

    /**
     * Test for createItem
     */
    function testCreateItem() {
        $user_id = $this->getUserId();
        $configuration = $this->getTemplateObject();
        $stack_id = 'mo-'. $user_id. '-'. Common::generateToken(9). '-'. Common::getRegionNickname($configuration->vendor->aws->region);
        $nickname = Common::generateNickname();
        $time = new DateTime;
        $create_time = $time->format(DateTime::ATOM);
        $actual = Table::STACK()->getDao()->createItem(compact('stack_id', 'user_id', 'nickname', 'configuration', 'create_time'));
        $this->assertNull($actual);
        return $stack_id;
    }

    /**
     * Test for listItems
     * @depends testCreateItem
     */ 
    function testListItems() {
       $user_id = $this->getUserId();
       $actual = Table::STACK()->getDao()->listItems(compact('user_id'), 'userIdIndex', ['stack_id' => 'mo-']);
       $this->assertInternalType("array", $actual);
    }

    /**
     * Test for getItem
     * @depends testCreateItem
     */
    function testGetItem($key) {
       $actual = Table::STACK()->getDao()->getItem($key);
       $this->assertInternalType("array", $actual);
       $this->assertSame($key, $actual["stack_id"]);
       $this->assertArrayHasKey("user_id", $actual);
       $this->assertArrayHasKey("nickname", $actual);
       $this->assertArrayHasKey("configuration", $actual);
       $this->assertArrayHasKey("create_time", $actual);
    }

    /**
     * Test for updateItem
     * @depends testCreateItem
     */
    function testUpdate($key) {
        $item = [];
        $actual = Table::STACK()->getDao()->updateItem($key, $item);
        $this->assertNull($actual);
    }

    /**
     * Test for deleteItem
     * @depends testCreateItem
     */
    function testDelete($key) {
        $actual = Table::STACK()->getDao()->deleteItem($key);
        $this->assertNull($actual);
        $actual = Table::STACK()->getDao()->getItem($key);
        $this->assertEmpty($actual);
    }
}
