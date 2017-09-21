<?php
namespace Mobingi\Core\Enum;
use \InvalidArgumentException;
use \ReflectionClass;
/**
 * Mobingi Enum Base Class
 * @package Mobingi\Core\Enum
 */ 
abstract class Enum {
    private $value;

    /**
     * Constructor
     * @param constant $value Contains Constant Value
     */ 
    public function __construct($value) {
       $reflectionClass = new ReflectionClass($this);
       if (!in_array($value, $reflectionClass->getConstants(), true)) {
           throw new InvalidArgumentException("Not have such value!!");
       }
       $this->value = $value;
    }

    /**
     * @override
     */
    final public static function __callStatic($name, $arguments) {
        $clazz = get_called_class();
        return new $clazz(constant("$clazz::$name"));
    }

    /**
     * @override
     */
    final public function valueOf() {
        return $this->value;
    }

    /**
     * override
     */ 
    final public function __toString() {
        return (string)$this->valueOf();
    }
}
