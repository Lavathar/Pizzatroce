<?php

namespace pizzatroce;

require '../src/vendor/autoload.php';

use pizzatroce\bd\Eloquent;
use pizzatroce\controleur\ControleurBase;
use pizzatroce\controleur\ControleurBesoin;
use pizzatroce\controleur\ControleurCompte;
use pizzatroce\controleur\ControleurCreneau;
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

$app->get('[/]',
    function($req, $resp, $args) {
        $controleur = new ControleurBase($this);
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

$app->get('/creneau[/]',
    function($req, $resp, $args){
        $controleur = new ControleurCreneau($this);
        return $controleur->creerCreneau($req, $resp, $args);
    });

$app->post('/creneau[/]',
    function($req, $resp, $args){
        $controleur = new ControleurCreneau($this);
        return $controleur->creerCreneau($req, $resp, $args);
    });

//////////////////////////////////////////
////           BESOINS                ////
//////////////////////////////////////////

$app->post('/besoin[/]',
    function($req, $resp, $args){
        $controleur = new ControleurBesoin($this);
        return $controleur->creerBesoin($req, $resp, $args);
    });

$app->get('/afficherUsers[/]',
    function($req, $resp, $args){
        $controleur = new ControleurCompte($this);
        return $controleur->allUser($req, $resp, $args);
    });

$app->run();