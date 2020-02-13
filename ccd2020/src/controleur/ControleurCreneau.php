<?php


namespace pizzatroce\controleur;

use pizzatroce\model\Creneau;
use pizzatroce\vue\VueCreneau;

class ControleurCreneau
{

    public function creerCreneau($rq, $rs, $args){
        $path = $rq->getURI()->getBasePath();

        if (! isset($rq->getParsedBody()['jour']) || ! isset($rq->getParsedBody()['semaine']) || ! isset($rq->getParsedBody()['hDebut']) || ! isset($rq->getParsedBody()['hFin'])) {
            $vue = new VueCreneau("", $path);
            $html = $vue->render(0);
        } else {
            $jour = $rq->getParsedBody()['jour'];
            $semaine = $rq->getParsedBody()['semaine'];
            $hDeb = $rq->getParsedBody()['hDebut'];
            $hFin = $rq->getParsedBody()['hFin'];

            // Filtrage
            filter_var($jour, FILTER_SANITIZE_NUMBER_INT);
            filter_var($semaine, FILTER_SANITIZE_STRING);
            filter_var($hDeb, FILTER_SANITIZE_NUMBER_INT);
            filter_var($hFin, FILTER_SANITIZE_NUMBER_INT);

            $memeJour = Creneau::where('jour', '=', $jour)->where('semaine', '=', $semaine)->get();
            $pasDeChevauchement = Creneau::where('hDeb', '<', $hDeb)->where('hFin', '>', $hFin)->first();

            if (is_null($memeJour)){
                $creneau = new Creneau();
                $creneau->jour = $jour;
                $creneau->semaine = $semaine;
                $creneau->hDebut = $hDeb;
                $creneau->hFin = $hFin;
                $creneau->save();
            } else if (is_null($pasDeChevauchement)){
                $creneau = new Creneau();
                $creneau->jour = $jour;
                $creneau->semaine = $semaine;
                $creneau->hDebut = $hDeb;
                $creneau->hFin = $hFin;
                $creneau->save();
            } else {
                $vue = new VueCreneau("", $path);
                $html = $vue->render(0);
            }
        }
    }
}