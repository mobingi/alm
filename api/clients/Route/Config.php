<?php
namespace Mobingi\Route;

use Symfony\Component\Yaml\Parser;
use Mobingi\Exception\MobingiApiException;

class Config
{
    private static $logger;
    public static function setLogger($logger) {
        self::$logger=$logger;
    }
    public static function getServiceRoutingFormat() {
        $yaml = new Parser();
        $value = $yaml->parse( file_get_contents( __DIR__.'/Config/Routing.yaml' ) );
        return $value['ROUTING'];
    }
    public static function createRoutingClosure($routingdetail, $app){
        return $routingdetail['app'] ? self::createRoutingClosureClass($routingdetail, $app) : self::createRoutingClosureClient($routingdetail);
    }

    public static function createRoutingClosureClass($routingdetail, $app){
        $client = new $routingdetail['client']($app);
        $action = $routingdetail['action'];
        if ( isset($routingdetail['method']) && $routingdetail['method'] ) {
            $action = $routingdetail['method'];
        }
        $closure = function($request, $response, $args) use ($app, $client, $action) {
            return $client->$action($request, $response, $args, $app);
        };
        return $closure;
    }
    public static function createRoutingClosureClient($routingdetail){
        $client = new $routingdetail['client']();
        $action = $routingdetail['action'];
        if ( isset($routingdetail['method']) && $routingdetail['method'] ) {
            $action = $routingdetail['method'];
        }
        $closure = function($request, $response, $args) use ($client, $action, $routingdetail) {
            $params = $request->getParams();
            if ( isset($routingdetail['validate']) ) {
                foreach ( $routingdetail['validate'] as $valid ) {
                    $_p = null;
                    $_v = null;
                    foreach ( $valid as $key => $target ) {
                        if ( $key == 'params' && $target ) $_p = ${$key}[$target];
                        if ( $key == 'params' && is_null($target) ) $_p = ${$key};
                        if ( $key == 'target' ) $_v = $target;
                    }
                    if ( is_null($_p) || is_null($_v) ) continue;
                    $client->validate( $_p , $_v );
                }
            }
            // build call params
            $callparams = null;
            if ( isset($routingdetail['params']) ) {
                foreach ( $routingdetail['params'] as $v ) {
                    foreach ( $v as $varname => $paramname ) {
                        if ($varname == "*") {
                            $callparams[] = ${$paramname};
                        }elseif ($varname == "_var") {
                            $callparams[] = $paramname;
                        }else{
                            $callparams[] = ${$paramname}[$varname];
                        }
                    }
                }
            }
            if ( $callparams ) {
              $result = call_user_func_array(array($client, $action), $callparams);
            }else{
              $result = $client->$action();
            }
            if ( isset($routingdetail['method_chain']) && $routingdetail['method_chain']) {
                foreach ($routingdetail['method_chain'] as $methods => $params) {
                    $callparams = null;
                    if ($params) {
                        foreach ( $params['params'] as $v ) {
                            foreach ( $v as $varname => $paramname ) {
                                if ($varname == "*") {
                                    $callparams[] = ${$paramname};
                                }elseif ($varname == "_var") {
                                    $callparams[] = $paramname;
                                }else{
                                    $callparams[] = ${$paramname}[$varname];
                                }
                            }
                        }
                    }
                    if ( $callparams ) {
                        $result = call_user_func_array(array($result, $methods), $callparams);
                    }else{
                        $result = $result->$methods();
                    }
                }
            }
            if (isset($routingdetail['resultkey']) && $routingdetail['resultkey']) {
                $result = $result[$routingdetail['resultkey']];
            }

            if (isset($routingdetail['response']) && $routingdetail['response']) {

                if (isset($routingdetail['response']['options']) && $routingdetail['response']['options']) {
                    $const = 0;
                    foreach($routingdetail['response']['options'] as $cstr) { $const += constant($cstr);}
                    if ($const) return $response->withJson($result, $routingdetail['response']['returncode'], $const);
                }

                return $response->withJson($result, $routingdetail['response']['returncode']);
            }
            return $response->withJson($result);
        };
        return $closure;
    }

}
