<?php


namespace pizzatroce\controleur;


use pizzatroce\models\Utilisateur;
use pizzatroce\vue\VueCompte;

/**
 * Class ControleurCompte
 * @package mywishlist\controleur
 */
class ControleurCompte
{

    /**
     * Methode qui permet d'acceder à l'accueil
     * @param $rq
     * @param $rs
     * @param $args
     * @return mixed la reponse http
     */
    public function afficherAccueil($rq, $rs, $args)
    {
        $path = $rq->getURI()->getBasePath();
        $vue = new VueCompte("", $path);

        $html = $vue->render(2);
        $rs->getBody()->write($html);
        return $rs;
    }
}