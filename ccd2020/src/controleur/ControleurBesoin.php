<?php


namespace pizzatroce\controleur;


use pizzatroce\model\Besoin;
use pizzatroce\model\Creneau;
use pizzatroce\model\Role;
use pizzatroce\vue\VueBesoin;

class ControleurBesoin
{

    public function creerBesoin($rq, $rs, $args)
    {
        $path = $rq->getURI()->getBasePath();

        if (! isset($rq->getParsedBody()['jour'])) {
            $crenaux = Creneau::select("*")
                -> get();
            $roles = Role::select("*")
                ->get();

            $elem = array("roles"=>$roles, "creneaux"=>$crenaux);
            $vue = new VueBesoin($elem, $path);
            $html = $vue->render(0);
        }
        else {
            $desc = $rq->getParsedBody()['description'];
            $role = $rq->getParsedBody()['role'];
            $creneau = $rq->getParsedBody()['creneau'];
            $id_creneau = substr($creneau, 1);

            $besoin = new Besoin();
            $besoin->creneau =  $id_creneau;
            if (!is_null($desc)) $besoin->description = $desc;
            $besoin->role=$role;

        }

        $rs->getBody()->write($html);
        return $rs;
    }


}