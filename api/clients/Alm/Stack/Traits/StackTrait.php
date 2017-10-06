<?php
namespace Mobingi\Alm\Stack\Traits;
use Mobingi\Core\Dao\Table;
use Mobingi\Core\Utility\Common;
/**
 * Stack Clients Trait
 * If you want to get or update on stack information in your classes,
 * you should set this trait in your class code as follows
 * `use StackTrait;`
 * @package Mobingi\Alm\Stack\Traits
 */
trait StackTrait {
    /**
     * Get stack info from Storage
     * @param string $stack_id StackID
     * @return array Stack Info
     */
    protected function getStackByStackID($stack_id) {
        return Table::STACK()->getDao()->getItem($stack_id);
    }

    /**
     * Get Vendor Info By StackInfo
     * @param array $stackInfo Stack Info from Storage
     * @param string $vendor Vendor Name(ex:'aws', 'aliyun', ...). Default is 'aws'
     * @return array  Vendor Info
     */
    protected function getVendorByStackInfo($stackInfo, $vendor = "aws") {
        return $stackInfo["configuration"]["vendor"][$vendor];
    }

    /**
     * Get Vendor Code By StackInfo
     * @param array $stackInfo Stack Info from Storage
     * @return string $vendor Vendor Name(ex:'aws', 'aliyun', ...)
     */
    protected function getVendorNameByStackInfo($stackInfo) {
        return array_keys($stackInfo["configuration"]["vendor"])[0];
    }
}
