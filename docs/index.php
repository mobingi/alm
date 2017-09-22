<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('./template/');
};





// Load route files
$routeFiles = (array) glob('urls/*.php');
foreach($routeFiles as $routeFile) {
    require $routeFile;
}



// Default Homepage
$app->get('/', function ($request, $response, $args) {

    return $this->view->render($response, 'page-home.php', [
        'title' => 'Mobingi Documentation Site (CE)'
    ]);

});




// Run
$app->run();
