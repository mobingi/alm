<?php
namespace Mobingi\Core\Dao;
use Mobingi\Core\Dao\Table;
/**
 * Mobingi Data Access Object Base Class
 * @package Mobingi\Core\Dao
 */
abstract class BaseDao {
   /**
    * Table Class
    * @var Mobingi\Core\Dao\Table
    */
   private $table;

   /**
    * Constructor
    * @param Mobingi\Core\Dao\Table $table Table Class
    */
   function __construct(Table $table) {
       $this->table = $table;
   }

   /**
    * Get Primary Key
    * @return string Primary key
    */
   protected function getPrimaryKey() {
       $prefix = substr($this->getTableName(), strlen("ALM_"));
       if ($this->getTableName() !== Table::AGENT_STATUS) $prefix = substr($prefix, 0, strlen($prefix) - 1);
       return strtolower($prefix). "_id";
   }

   /**
    * Get Table Name
    * @return string Table Name
    */
   protected function getTableName() {
       return $this->table->valueOf();
   }

   /**
    * Get List Item Data
    * @param array $conditions Search items condtions
    * @param string $indexName Search index name
    * @param array $filter Search filter
    * @retun array List item data
    */
   abstract public function listItems(array $conditions, $indexName = null, array $filter = []);

   /**
    * Get Item Data
    * @param string $key Search item key
    * @return array Item data
    */
   abstract public function getItem($key);

   /**
    * Create Item Data
    * @param array $item Item Data to Create
    * @return void
    */
   abstract public function createItem(array $item);

   /**
    * Update Item Data
    * @param string $key Target item key
    * @param array $item Item Data to Update
    * @return void
    */
   abstract public function updateItem($key, array $item);

   /**
    * Delete Item Data
    * @param string $key Target item key
    * @return void
    */
   abstract public function deleteItem($key);
}
