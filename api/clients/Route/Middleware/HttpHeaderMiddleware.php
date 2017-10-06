<?php
namespace Mobingi\Route\Middleware;
use Mobingi\Exception\MobingiApiException;
use \Exception;
/**
 * Invokable middleware class
 *
 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
 * @param  callable                                 $next     Next middleware
 *
 * @return \Psr\Http\Message\ResponseInterface
 */


class HttpHeaderMiddleware
{

    public function __invoke($request, $response, $next) {
        try {
            $newResponse = $response->withHeader('Content-Type', 'application/json; charset=utf-8');
            $newResponse = $response->withHeader('X-Powered-By', 'Mobingi API/2.0.0');
            $response = $next($request, $newResponse);
        } catch (MobingiApiException $mae) {
            $response = $newResponse->withStatus(400)->write($mae->__toJson());
        } catch (Exception $e) {
            $mae = MobingiApiException::convert($e);
            $response = $newResponse->withStatus(500)->write($mae->__toJson());
        }
        return $response;
    }

}
