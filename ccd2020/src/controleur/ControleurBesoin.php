<?php


namespace pizzatroce\controleur;


use pizzatroce\vue\VueBesoin;

class ControleurBesoin
{

    public function creerBesoin($rq, $rs, $args)
    {
        $path = $rq->getURI()->getBasePath();

        if (! isset($rq->getParsedBody()['jour'])) {
            $vue = new VueBesoin("", $path);
            $html = $vue->render(0);
        }

        $rs->getBody()->write($html);
        return $rs;
    }


}