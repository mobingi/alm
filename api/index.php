<?php

/**
 * Mobingi RESTful API
 *
 *
 * @author Mobingi Enterprise Team
 * @version 3.0.0
 */
date_default_timezone_set('Asia/Tokyo');
ini_set('display_errors', 'On');

error_reporting(0);
header_remove("X-Powered-By");

require __DIR__ . '/autoload.php';

use Mobingi\Application;
use Mobingi\Route\Providor\RouteProvidor;


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = true;

// Initial Slim Routing App
$app = new Application($config);
$result = new RouteProvidor($app);
// Run
$app->run();
