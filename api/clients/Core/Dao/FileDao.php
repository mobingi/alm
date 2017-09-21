<?php
namespace Mobingi\Core\Dao;
use Mobingi\Core\Dao\BaseDao;
/**
 * Local File Storage Dao
 * @package Mobingi\Core\Dao
 * @property string $TableName Table Name
 * @method string getPrimaryKey
 */
class FileDao extends BaseDao {
    const FILE_DIR = ".mobingi";
    const STACK_FILE_NAME = "alm-template";
    /**
     * @override
     * @see Mobingi\Core\Dao\BaseDao::listItems
     */
    public function listItems(array $conditions, $indexName = null, array $filter = []) {
        $result = [];
        $primaryKey = $this->getPrimaryKey();
        foreach(scandir($this->getDir("")) as $key) {
            if (in_array($key, [".", ".."]) || strpos($key, $filter[$primaryKey]) !== 0) continue;
            $item = $this->getItem($key);
            // Not match $condtions
            if (array_diff($item, $conditions) === $item) continue;
            $result[] = $item;
        }
        return $result;
    }

    /**
     * @override
     * @see Mobingi\Core\Dao\BaseDao::getItem
     */
    public function getItem($key) {
        $result = file_get_contents($this->getDir($key). $this->getFileName());
        return (array)json_decode($result, true);
    }

    /**
     * @override
     * @see Mobingi\Core\Dao\BaseDao::createItem
     */
    public function createItem(array $item) {
        $primaryKey = $this->getPrimaryKey();
        $this->saveItem($item[$primaryKey], $item);
    }

    /**
     * @override
     * @see Mobingi\Core\Dao\BaseDao::updateItem
     */
    public function updateItem($key, array $item) {
        $cuurentItem = $this->getItem($key);
        $this->saveItem($key, $item + $cuurentItem);
    }

    /**
     * @override
     * @see Mobingi\Core\Dao\BaseDao::deleteItem
     */
    public function deleteItem($key) {
        $dir = $this->getDir($key);
        foreach(scandir($dir) as $file) {
            if (in_array($file, [".", ".."])) continue;
            unlink($dir. $file);
        }
        rmdir($dir);
    }

    /**
     * Save Item Data
     * @param string $key Target item key
     * @param array $item Item Data to save
     * @return void
     */
    private function saveItem($key, array $item) {
        $dir = $this->getDir($key);
        if (!file_exists($dir)) mkdir($dir);
        file_put_contents($dir. $this->getFileName(), json_encode($item));
    }

    /**
     * Get Direcotry
     * @param string $key Target item key
     * @return string Directory
     */
    private function getDir($key) {
        $dir = $_SERVER['HOME']. "/". self::FILE_DIR.  "/". $key. "/";
        return str_replace("//", "/", $dir);
    }

    /**
     * Get File Name
     * @return string File Name
     */
    private function getFileName() {
        return ($this->getTableName() === Table::STACK)? self::STACK_FILE_NAME : time();
    }
}
