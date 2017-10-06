<?php
namespace Mobingi\Route\Middleware;

/**
 * Invokable middleware class
 *
 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
 * @param  callable                                 $next     Next middleware
 *
 * @return \Psr\Http\Message\ResponseInterface
 */


class HttpCorsMiddleware
{
    public function __invoke($request, $response, $next) {
        $route = $request->getAttribute("route");

        $methods = [];

        if (!empty($route)) {
            $pattern = $route->getPattern();

            foreach ($this->router->getRoutes() as $route) {
                if ($pattern === $route->getPattern()) {
                    $methods = array_merge_recursive($methods, $route->getMethods());
                }
            }
            //Methods holds all of the HTTP Verbs that a particular route handles.
        } else {
            $methods[] = $request->getMethod();
        }
        // Header [From] include user_id
        if($request->getHeaders()['HTTP_FROM'][0]){
            define("OAUTH_USER_ID", $request->getHeaders()['HTTP_FROM'][0]);
        }

        $response = $next($request, $response);

        return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withHeader("Access-Control-Allow-Origin", "*")
        ->withHeader("Access-Control-Allow-Headers", "Content-Type")
        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, PUT, DELETE");
    }
}
