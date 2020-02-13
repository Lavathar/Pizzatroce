<?php


namespace pizzatroce\controleur;

use pizzatroce\model\Besoin;
use pizzatroce\model\Creneau;
use pizzatroce\model\Role;
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
        }
        $rs->getBody()->write($html);
        return $rs;
    }

    public function creneau($rq, $rs, $args){
        $path = $rq->getURI()->getBasePath();
        $id_creneau = $args['id'];

        $besoins = Besoin::where('creneau','=', $id_creneau)
            ->get();
        $roles = Role::select('*')
            ->get();
        $res = $roles->intersect($besoins);
        $creneau = Creneau::where('id','=', $id_creneau)
            ->first();
        $tab = array("creneau"=>$creneau, "besoins"=>$res, "id"=>$id_creneau);

        $v = new VueCreneau($tab, $path);
        $html = $v->render(2);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function tableauDeBord($rq, $rs, $args){
        $path = $rq->getURI()->getBasePath();
        $listeCreneaux = array(
          "Lundi" => Creneau::where('jour','=',1)->orderBy('hDebut', 'asc')->get(),
          "Mardi" => Creneau::where('jour','=',2)->orderBy('hDebut', 'asc')->get(),
          "Mercredi" => Creneau::where('jour','=',3)->orderBy('hDebut', 'asc')->get(),
          "Jeudi" => Creneau::where('jour','=',4)->orderBy('hDebut', 'asc')->get(),
          "Vendredi" => Creneau::where('jour','=',5)->orderBy('hDebut', 'asc')->get(),
          "Samedi" => Creneau::where('jour','=',6)->orderBy('hDebut', 'asc')->get(),
          "Dimanche" => Creneau::where('jour','=',7)->orderBy('hDebut', 'asc')->get()
        );

        $v = new VueCreneau($listeCreneaux, $path);
        $html = $v->render(1);
        $rs->getBody()->write($html);
        return $rs;
    }
}

