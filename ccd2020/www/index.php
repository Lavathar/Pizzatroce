<?php

namespace pizzatroce;

require '../src/vendor/autoload.php';

use mywishlist\bd\Eloquent;
use\Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

session_start();

Eloquent::start('../src/conf/conf.ini');

$configuration = [
    'settings'=> [
        'displayErrorDetails' => true,
        'dbconf' => '/conf/db.conf.ini' ]
];
$c=new\Slim\Container($configuration);
$app = new \Slim\App($c);



///////////////////////////////////


$app->run();