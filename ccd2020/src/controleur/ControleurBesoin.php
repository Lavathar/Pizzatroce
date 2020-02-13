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

        $crenaux = Creneau::select("*")
            -> get();
        $roles = Role::select("*")
            ->get();

        $elem = array("roles"=>$roles, "creneaux"=>$crenaux);

        if (! isset($rq->getParsedBody()['role'])) {

            $vue = new VueBesoin($elem, $path);
            $html = $vue->render(0);
        }
        else {
            $elem["info"]="Besoin ajouté avec succès";
            $desc = $rq->getParsedBody()['description'];
            $role = $rq->getParsedBody()['role'];
            $role_id = Role::select("id")
                ->where('label','=',$role)
                ->first();
            $creneau = $rq->getParsedBody()['creneau'];
            $id_creneau = substr($creneau, 1);

            $besoin = new Besoin();
            $besoin->creneau =  $creneau;
            if (!is_null($desc)) $besoin->description = $desc; else $besoin->description="Pas de description";
            $besoin->role=$role_id->id;
            $besoin->save();

            $vue = new VueBesoin($elem, $path);
            $html = $vue->render(0);
        }

        $rs->getBody()->write($html);
        return $rs;
    }


}