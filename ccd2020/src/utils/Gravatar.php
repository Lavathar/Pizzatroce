<?php


namespace pizzatroce\utils;


/**
 * Class Gravatar
 */
class Gravatar
{
    /**
     * Implemantation des gravatar.
     * @param $email string Email de l'utilisateurs.
     * @param int $s int Taille de l'images (256 par défaut).
     * @return string Url du gravatar
     */
    public static function getGravatar($email, $s = 256) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=retro&r=g";
        return $url;
    }
}