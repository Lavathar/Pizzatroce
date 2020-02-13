<?php


namespace pizzatroce\controleur;


use pizzatroce\vue\VueBase;

class ControleurBase
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
        $vue = new VueBase("", $path);

        $html = $vue->render(0);
        $rs->getBody()->write($html);
        return $rs;
    }


}