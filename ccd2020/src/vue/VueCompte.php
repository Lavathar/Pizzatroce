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
            case 2:
                $contenu = $this->afficherAllUsers();
                break;
            default:
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
        $users = $this->elem["user"];
        if ($this->elem["etat"] == false)
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
<div class="users">
END;
        foreach ($users as $user) {
           $html .=  <<<END
<div class="user">
<img src="../../bdd/img/$user->id.jpg">
<form class="user" action="" method="post">
    <button type="submit" name="nom" value=$user->nom class="btn-link">$user->nom</button>
</form>
</div>
END;
        }
$html .= <<<END
</div>
END;
        return $html;
    }

    public function afficherAllUsers(): string
    {
        $html = <<<END
<div class="all_users">
    <table><tr><th>nom</th><th>prenom</th><th>mail</th><th>tel</th><th>photo</th><th>permanence</th><th>absence</th></tr>
END;
        foreach ($this->elem as $key => $value) {
            $html .= <<<END
            <tr><td>$value->nom</td><td>$value->prenom</td><td>$value->mail</td><td>$value->tel</td><td>$value->photo</td><td>$value->permanence</td><td>$value->absence</td>
END;
        }
        $html .= <<<END
    </table>
</div>
END;

        return $html;
    }
}