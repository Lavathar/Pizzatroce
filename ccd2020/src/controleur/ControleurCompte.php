<?php
namespace pizzatroce\controleur;

use pizzatroce\model\User;
use pizzatroce\utils\Authentification;
use pizzatroce\vue\VueBase;
use pizzatroce\vue\VueCompte;

/**
 * Class ControleurCompte
 * @package pizzatroce\controleur
 */
class ControleurCompte
{

    /**
     * Methode qui permet de creer un compte createur
     * @param $rq
     * @param $rs
     * @param $args
     * @return mixed la reponse http
     */
    public function creerCompte($rq, $rs, $args)
    {
        $path = $rq->getURI()->getBasePath();

        if (!isset($rq->getParsedBody()['username'])) {
            $vue = new VueCompte("", $path);
            $html = $vue->render(0);
        } else {
            $pseudo = $rq->getParsedBody()['username'];
            $mdp = $rq->getParsedBody()['password'];

            // Filtrage
            filter_var($pseudo, FILTER_SANITIZE_STRING);
            filter_var($mdp, FILTER_SANITIZE_STRING);

            $compteDejaCree = User::where('nom', '=', $pseudo)->first();

            if (is_null($compteDejaCree)) {
                Authentification::createUser($pseudo, $mdp);
                $vue = new VueCompte("", $path);
                $html = $vue->render(1);
            } else {
                $vue = new VueCompte(true, $path);
                $html = $vue->render(0);
            }
        }

        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * Methode qui permet de se connecter
     * @param $rq
     * @param $rs
     * @param $args
     * @return mixed la reponse http
     */
    public function seConnecter($rq, $rs, $args)
    {
        $path = $rq->getURI()->getBasePath();

        if (!isset($rq->getParsedBody()['username'])) {
            $vue = new VueCompte(true, $path);
            $html = $vue->render(1);
        } else {
            $pseudo = $rq->getParsedBody()['username'];
            $mdp = $rq->getParsedBody()['password'];

            // Filtrage
            filter_var($pseudo, FILTER_SANITIZE_STRING);
            filter_var($mdp, FILTER_SANITIZE_STRING);

            $etat = Authentification::authenticate($pseudo, $mdp);
            if ($etat == true) {
                $vue = new VueBase($etat, $path);
                $html = $vue->render(0);
            } else {
                $vue = new VueCompte($etat, $path);
                $html = $vue->render(1);
            }
        }
        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * Methode qui permet de se deconnecter
     * @param $rq
     * @param $rs
     * @param $args
     * @return mixed la reponse http
     */
    public function seDeconnecter($rq, $rs, $args)
    {
        $path = $rq->getURI()->getBasePath();

        if (isset($_SESSION['profile'])) {
            unset($_SESSION['profile']);
        }

        $vue = new VueBase('', $path);
        $html = $vue->render(0);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function allUser($rq, $rs, $args)
    {
        $users = User::all();
        $path = $rq->getURI()->getBasePath();
        $v = new VueCompte($users, $path);
        $html = $v->render(2);
        $rs->getBody()->write($html);
        return $rs;
    }
}
