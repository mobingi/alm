<?php
namespace Mobingi\Core\Dao;
use Mobingi\Core\Enum\Enum;
/**
 * Mobingi Table Class
 * The constants only class for the argument to `Mobingi\Core\Dao\BaseDao`
 * @package Mobingi\Core\Dao
 */
class Table extends Enum {
   const STACK = 'ALM_STACKS';
   const CONTAINER_STATUS = 'ALM_CONTAINERS';
   const AGENT_STATUS = 'ALM_AGENT';

   /**
    * Get Dao Object
    * @return Mobingi\Core\Dao\BaseDao Dao Object
    */
   public function getDao() {
       $clazz = $this->getDaoClassName();
       return new $clazz($this);
   }

   /**
    * Get Dao Class Name
    * @return string Dao Class Name
    */
   private function getDaoClassName() {
       return "Mobingi\Core\Dao\FileDao";
   }
}
