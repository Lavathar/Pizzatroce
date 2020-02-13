<?php


namespace pizzatroce\controleur;

use pizzatroce\model\Creneau;
use pizzatroce\vue\VueCreneau;

class ControleurCreneau
{

    public function creerCreneau($rq, $rs, $args)
    {
        $path = $rq->getURI()->getBasePath();

        if (!isset($rq->getParsedBody()['jour']) || !isset($rq->getParsedBody()['semaine']) || !isset($rq->getParsedBody()['hDeb']) || !isset($rq->getParsedBody()['hFin'])) {
            $vue = new VueCreneau("", $path);
            $html = $vue->render(0);
        } else {
            $jour = $rq->getParsedBody()['jour'];
            $semaine = $rq->getParsedBody()['semaine'];
            $hDeb = $rq->getParsedBody()['hDeb'];
            $hFin = $rq->getParsedBody()['hFin'];

            // Filtrage
            filter_var($jour, FILTER_SANITIZE_NUMBER_INT);
            filter_var($semaine, FILTER_SANITIZE_STRING);
            filter_var($hDeb, FILTER_SANITIZE_NUMBER_INT);
            filter_var($hFin, FILTER_SANITIZE_NUMBER_INT);

            $heure = Creneau::select('hDebut', 'hFin')
                ->where('jour', '=', $jour)
                ->where('semaine', '=', $semaine)
                ->get();

            foreach($heure as $h) {
                if(($hDeb >= $h->hDebut) && ($hDeb <= $h->hFin)) {
                    $vue = new VueCreneau("Le creneau existe deja", $path);
                    $html = $vue->render(0);
                    $rs->getBody()->write($html);
                    return $rs;
                }
                elseif(($hFin >= $h->hDebut) && ($hFin <= $h->hFin)) {
                    $vue = new VueCreneau("Le creneau existe deja", $path);
                    $html = $vue->render(0);
                    $rs->getBody()->write($html);
                    return $rs;
                }
            }
                $creneau = new Creneau();
                $creneau->jour = $jour;
                $creneau->semaine = $semaine;
                $creneau->hDebut = $hDeb;
                $creneau->hFin = $hFin;
                $creneau->save();
                $vue = new VueCreneau("", $path);
                $html = $vue->render(0);

            /*$memeJour = Creneau::where('jour', '=', $jour)
                ->where('semaine', '=', $semaine)
                ->whereBetween($hDeb, array())
                ->whereBetween($hFin, 'hDeb', 'hFin')
                ->first();

            if (is_null($memeJour)) {
                $creneau = new Creneau();
                $creneau->jour = $jour;
                $creneau->semaine = $semaine;
                $creneau->hDebut = $hDeb;
                $creneau->hFin = $hFin;
                $creneau->save();
                $vue = new VueCreneau("", $path);
                $html = $vue->render(0);
           } else {
                $vue = new VueCreneau("Le creneau existe deja", $path);
                $html = $vue->render(0);
            }
            */
        }
        $rs->getBody()->write($html);
        return $rs;
    }

    public function afficherCreneau($rq, $rs, $args){
        $path = $rq->getURI()->getBasePath();
        $listeCreneaux = array(
          1 => Creneau::where('jour','=',1)->get(),
          2 => Creneau::where('jour','=',2)->get(),
          3 => Creneau::where('jour','=',3)->get(),
          4 => Creneau::where('jour','=',4)->get(),
          5 => Creneau::where('jour','=',5)->get(),
          6 => Creneau::where('jour','=',6)->get(),
          7 => Creneau::where('jour','=',7)->get()
        );

        $v = new VueCreneau($listeCreneaux, $path);
        $html = $v->render(1);
        $rs->getBody()->write($html);
        return $rs;
    }
}

