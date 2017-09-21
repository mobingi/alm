<?php
namespace Mobingi\Route;

class Vendors
{

  public function describeVendors($request, $response, $args) {

    $result = VENDOR_KEY_LIST;
    return $response->withJson($result);
  }

}
