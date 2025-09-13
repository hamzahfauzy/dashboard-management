<?php

use Dotenv\Dotenv;
use Libs\Web\Session;

session_start();

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '//../');
$dotenv->safeLoad();

function isFile($fileName)
{
    return !is_array($fileName) && get_class($fileName) == 'Libs\\System\\File';
}

function app($key, $default = null)
{
    $config = config('app');
    return isset($config[$key]) ? $config[$key] : $default;
}

function env($key, $default = null)
{
    return isset($_ENV[$key]) ? $_ENV[$key] : (isset($_SERVER[$key]) ? $_SERVER[$key] : $default);
}

function config($key)
{
    $file =  'config/' . $key .'.php';

    if(file_exists($file))
    {
        return require $file;
    }

    return [];
}

function sessionRequired()
{
    if(!isset($_SESSION['user_id']))
    {
        header('location: /login');
        die;
    }
}

function loadFile($path, $additionalCode = null)
{
    require $path .'.php';
}

function auth()
{
    return Session::get('auth');
}