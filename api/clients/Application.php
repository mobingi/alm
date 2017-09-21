<?php
namespace Mobingi;
use Slim\App;
/**
 * Application
 * @package Mobingi 
 */
class Application extends App {
    public function __construct($config) {
        parent::__construct(["settings" => $config]);
    }
}
