<?php
namespace Mobingi\Core;
use Mobingi\Core\Factory\AwsSdkClientFactory;
use Mobingi\Exception\ValidateException;
/**
 * The base class of All Mobingi Clients
 * If there is no particular reason when implementing a client, it is recommended to implement by inheriting this class.
 * Common processing and constants to be used in each class are defined here.
 */
abstract class ClientBase {
    /**
     * Constructor
     * @param Mobingi\Core\ClientBase $ownerClient The owner client to call by.
     */
    final function __construct($ownerClient = null) {
        $properties = $propertyNames = [];
        if ($this->isExtends($ownerClient)) {
            // Merge properties from owner client to call by.
            $properties = get_object_vars($ownerClient);
            $propertyNames = array_keys($properties);
        } else {
            // Owner client is nothing.
            $this->awsSdkFactory = new AwsSdkClientFactory();
        }

        // Set properties of AWS SDK Clients
        foreach ($propertyNames as $name) {
            if (array_key_exists($name, $properties)) {
                $this->$name = $properties[$name];
            } else {
                $this->$name = $this->awsSdkFactory->createClient($name);
            }
        }
        $this->initClients();
    }

    /**
     * Check extends from Mobingi\Core\ClientBase
     * @param mixed $target Check Value
     * @return boolean True is extends from Mobingi\Core\ClientBase
     */
    final protected function isExtends($target) {
        $parents = class_parents($target);
        return $parents !== false && array_key_exists("Mobingi\Core\ClientBase", $parents);
    }

    /**
     * Init Clients
     * The initialize to use each clients is here.
     * @return void
     */
    abstract protected function initClients();

    /**
     * Validate for request parameters.
     * @param array $params Reuqest paramters.
     * @param array $targetKeys The target keys for validate
     * @throw ValidateException Have the validation error.
     * @return $this;
     */
    function validate(array $params, array $targetKeys) {
        foreach ($targetKeys as $key) {
            if (empty($params[$key])) {
                // empty check
                throw new ValidateException($key);
            }
        }
        return $this;
    }

    /**
     * Set Client for Property
     * @param string $propertyName Setting Property Name('stack', 'template' ...etc)
     * @param string $className Setting Propery Object Name ('Mobingi\Alm\Stack\Stack', ...etc)
     */
    protected function setClient($propertyName, $className) {
        if (empty($this->$propertyName)) $this->$propertyName = new $className($this);
        return $this;
    }
}
