<?php

namespace Libs\Web;

class Route
{
    protected static $routes = [];
    private static $beforeEnter = null;

    static function register($uri, $callback, $method = 'GET')
    {
        $uriName = strtolower($method) .'.'. $uri;
        self::$routes[$uriName] = [
            'uri' => $uri,
            'method' => $method,
            'callback' => $callback,
            'beforeEnter' => self::$beforeEnter
        ];
    }

    static function get($uri, $callback)
    {
        self::register($uri, $callback);
    }

    static function post($uri, $callback)
    {
        self::register($uri,  $callback, 'POST');
    }
    
    static function put($uri, $callback)
    {
        self::register($uri,  $callback, 'PUT');
    }
    
    static function delete($uri, $callback)
    {
        self::register($uri,  $callback, 'DELETE');
    }

    static function getAllRoutes()
    {
        return self::$routes;
    }

    static function beforeEnter($callback)
    {
        self::$beforeEnter = $callback;
        return new static;
    }
}