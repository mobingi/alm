<?php
namespace Mobingi\Route;

class NotDefine
{

  public function Endpoint($request, $response, $args) {

    $result = [];
    return $response->withJson($result);
  }

}
