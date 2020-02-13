<?php


namespace pizzatroce\vue;

/**
 * Class VueCompte
 * @package mywishlist\vue
 */
class VueCompte
{
    /**
     * @var valeurs quelconques
     */
    private $elem;

    /**
     * @var debut de l'url
     */
    private $path;

    /**
     * Constructeur de la classe.
     * @param $tab valeurs quelconques
     * @param $path debut de l'url
     */
    function __construct($tab, $path)
    {
        $this->elem = $tab;
        $this->path = $path;
    }

    /**
     * Methode qui creee la base de la page html dont le contenu est
     * cree par des fonctions privees
     * @param int $index numero de la methode à utiliser
     * @return string contenu html
     */
    public function render(int $index) : string {
        switch ($index){
            case 0 :
                $contenu = $this->afficherFromulaireInscription();
                break;
            case 1 :
                $contenu = $this->afficherFromulaireConnexion();
                break;
            case 2 :
                $contenu = $this->afficherAccueil();
                break;
        }

        $path = $this->path;
        $header = self::getHeader($path);

        $html = <<<END
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="$path/css/style.css">
		<title>Pizzatroce</title>
	</head>
<body>
	$header
    
    $contenu
</body>
<html>
END;
        return $html;
    }


    /**
     * Methode qui affiche l'accueil
     * @return string contenu html
     */
    private function afficherAccueil() :string {
        $html = <<<END
<div class="accueil">
    <h1>Accueil</h1>
</div>
END;
        return $html;
    }


    /**
     * Methode static qui creer le header
     * @return string contenu html
     */
    public static function getHeader($path) : string {
        if (isset($_SESSION['profile'])) {
            $pseudo = $_SESSION['profile']['username'];
            $option = "<li><a href=\"$path/creation/listes\">Mes Listes</a></li>
                        <li><a href=\"$path/deconnexion\">Se déconnecter</a></li>
		                <li>$pseudo</li>";
        } else {
            $option = "<li><a href=\"$path/connexion\">Se connecter</a></li>
		                <li><a href=\"$path/inscription\">S'inscrire</a></li>";
        }

        $html = <<<END
<header>
     <div id="rubrique">
         <h1 id="titreR"><a href="$path/accueil">Pizzatroce </a></h1>
         <nav>
             <ul>
                  $option
             </ul>
         </nav>
     </div>
</header>

END;
        return $html;
    }

}