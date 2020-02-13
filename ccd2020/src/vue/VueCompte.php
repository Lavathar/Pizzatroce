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
        }

        $path = $this->path;
        $header = VueBase::getHeader($path);

        $html = <<<END
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="$path/../css/style.css">
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
     * Methode qui affiche le formulaire d'inscription
     * @return string contenu html
     */
    private function afficherFromulaireInscription() : string {
        $html = <<<END
<form  action="" method="post">
    <h2>Inscription</h2>
    <div class="formulaire">
        <input style="text-align:center" type="text" name="username" placeholder="Pseudonyme" required>
    </div>
    <div class="formulaire">
        <input style="text-align:center" type="password" name="password" placeholder="Mot de passe" required>
    </div>
    <div class="formulaire">
        <input type="submit" value="Valider">
    </div>
</form>
END;
        return $html;
    }

    /**
     * Methode qui affiche le formulaire de connexion
     * @return string contenu html
     */
    private function afficherFromulaireConnexion() : string {

        $erreur = "";
        if ($this->elem == false)
            $erreur = "<h3>Mot de passe ou nom d'utilisateur incorrect(s)</h3>";

        $html = <<<END
$erreur
<form  action="" method="post">
    <h2>Connexion</h2>
    <div class="formulaire">
        <input style="text-align:center" type="text" name="username" placeholder="Pseudonyme" required>
    </div>
    <div class="formulaire">
        <input style="text-align:center" type="password" name="password" placeholder="Mot de passe" required>
    </div>
    <div class="formulaire">
        <input type="submit" value="Valider">
    </div>
</form>
END;
        return $html;
    }

}