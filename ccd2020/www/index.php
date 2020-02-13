<?php

namespace pizzatroce;

require '../src/vendor/autoload.php';

use pizzatroce\bd\Eloquent;
use pizzatroce\controleur\ControleurCompte;
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


//////////////////////////////////////////
////           ACCUEIL                ////
//////////////////////////////////////////

$app->get('/accueil[/]',
    function($req, $resp, $args) {
        $controleur = new ControleurCompte($this);
        return $controleur->afficherAccueil($req, $resp, $args);
    });


//////////////////////////////////////////
////           COMPTES                ////
//////////////////////////////////////////


$app->get('/inscription[/]',
    function($req, $resp, $args){
        $controleur = new ControleurCompte($this);
        return $controleur->creerCompte($req, $resp, $args);
    });

$app->post('/inscription[/]',
    function($req, $resp, $args){
        $controleur = new ControleurCompte($this);
        return $controleur->creerCompte($req, $resp, $args);
    });

$app->get('/connexion[/]',
    function($req, $resp, $args){
        $controleur = new ControleurCompte($this);
        return $controleur->seConnecter($req, $resp, $args);
    });

$app->post('/connexion[/]',
    function($req, $resp, $args){
        $controleur = new ControleurCompte($this);
        return $controleur->seConnecter($req, $resp, $args);
    });

$app->get('/deconnexion[/]',
    function($req, $resp, $args){
        $controleur = new ControleurCompte($this);
        return $controleur->seDeconnecter($req, $resp, $args);
    });


$app->run();