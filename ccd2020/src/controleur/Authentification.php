<?php


namespace pizzatroce\controleur;


use pizzatroce\model\User;

/**
 * Pizzatroce trop bien
 * Class Authentification
 * @package pizzatroce\controleur
 */
class Authentification
{

    /**
     * Methode static qui permet de creer un utilisateur
     * @param $userName nom de l'utilisateur
     * @param $password mot de passe de l'utilisation
     */
    public static function createUser($userName, $password){
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $newUser = new User();
        $newUser->nom = $userName;
        $newUser->mdp = $hash;
        $newUser->save();
    }

    /**
     * Methode static qui permet de s'authentifier
     * @param $userName nom de l'utilisateur
     * @param $password mot de passe de l'utilisation
     */
    public static function authenticate( $username, $password) {
        $user = User::select('*')
            ->where("nom","=",$username)
            ->first();

        if (is_null($user)) return false;
            if (password_verify($password, $user->mdp)) {
                self::loadProfile($user);
                return true;
            }
            else return false;
    }

    /**
     * Methode qui charge un profile utilisateur dans une variable de session
     * @param $user utilisateur
     */
    private static function loadProfile($user){
        $_SESSION['profile'] = array(
            'id' => $user->id,
            'username'   => $user->nom,
            'client_ip'  => $_SERVER['REMOTE_ADDR']
         );
    }

    /**
     * Methode qui permet de controler les droits d'accès
     * @param $required niveau requis
     * @throws AuthException
     */
    public static function checkAccessRights($required){
    }


}
