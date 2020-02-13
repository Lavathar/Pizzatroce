<?php


namespace pizzatroce\controleur;


use pizzatroce\model\Creneau;
use pizzatroce\vue\VueBesoin;

class ControleurBesoin
{

    public function creerBesoin($rq, $rs, $args)
    {
        $path = $rq->getURI()->getBasePath();

        if (! isset($rq->getParsedBody()['jour'])) {
            $crenaux = Creneau::select("*")
                -> get();

            $vue = new VueBesoin($crenaux, $path);
            $html = $vue->render(0);
        }
        else {
            $desc = $rq->getParsedBody()['description'];
            $jour = $rq->getParsedBody()['jour'];
            $semaine = $rq->getParsedBody()['semaine'];

            $verif = $jour<8 && $jour>0
                && (semaine=='A'||semaine=='B'||semaine=='C'||semaine=='D');

        }

        $rs->getBody()->write($html);
        return $rs;
    }


}