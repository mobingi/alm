<?php
namespace Mobingi\Route\Providor;
use League\OAuth2\Server\ResourceServer;
use League\OAuth2\Server\Middleware\ResourceServerMiddleware;

use Mobingi\OAuth2\TokenInfoMiddleware;

use Mobingi\Route\Middleware\HttpHeaderMiddleware;
use Mobingi\Route\Middleware\HttpCorsMiddleware;

use Mobingi\Rbac\RbacInfoMiddleware;

class RouteProvidor
{
    public function __construct($app) {

        // Middleware (1) : Set 'Content-Type', 'application/json; charset=utf-8' Headers
        $set_header = new HttpHeaderMiddleware();

        // Middleware (3) : CORS
        $app->add( new HttpCorsMiddleware() );

        $rf = \Mobingi\Route\Config::getServiceRoutingFormat();
        foreach ($rf as $routingpattern => $routingdetail) {
            if ($routingpattern == 'default_config') {
                $default_config = $routingdetail;
                continue;
            }
            list($method,$url) = explode(":",$routingpattern);
            if (isset($routingdetail['class']) && $routingdetail['class']) {
                $rg = $app->$method($url,$routingdetail['class']);
            }else{
                //\Mobingi\Route\Config::setLogger($container->logger);
                $rg = $app->$method($url,\Mobingi\Route\Config::createRoutingClosure($routingdetail,$app));
            }
            if (isset($routingdetail['binding_chain']) && $routingdetail['binding_chain']) {
                foreach($routingdetail['binding_chain'] as $methods => $params) {
                    // build call params
                    $callparams = null;
                    if ( isset($params['params']) && !is_null($params['params'])) {
                        foreach ( $params['params'] as $v ) {
                            $callparams[] = $v;
                        }
                    }
                    if ( $callparams ) {
                        $rg = call_user_func_array(array($rg, $methods), $callparams);
                    }else{
                        $rg = $rg->$methods();
                    }
                }
            }
            $mw = $default_config;
            if (isset($routingdetail['middleware'])) {
                foreach ($routingdetail['middleware'] as $mk => $mv) {
                    if ($mk == "header") $mw['middleware']['header'] = $mv;
                }
            }

            foreach ($mw['middleware'] as $mk => $mv) {
                if ($mk == "header" && $mv && $set_header) $rg->add($set_header);
            }

        }

    }
}
