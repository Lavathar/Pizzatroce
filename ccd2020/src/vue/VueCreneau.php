<?php


namespace pizzatroce\vue;


class VueCreneau
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
                $contenu = $this->afficherFormulaireAjoutCreneau();
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


    private function afficherFormulaireAjoutCreneau() : string {
        $html = <<<END
<form  action="" method="post">
    <h2>Ajouter un Creneau</h2>
    <div class="formulaire">
        <input style="text-align:center" type="number" name="jour" placeholder="Jour" min="1" max="31" step="1" required>
    </div>
    <div class="formulaire">
        <input style="text-align:center" type="text" name="semaine" placeholder="Semaine" required>
    </div>
    <div class="formulaire">
        <input style="text-align:center" type="number" name="hDeb" placeholder="Heure de Debut" required>
    </div>
    <div class="formulaire">
        <input style="text-align:center" type="number" name="hFin" placeholder="Heure de Fin" required>
    </div>
    <div class="formulaire">
        <input type="submit" value="Valider">
    </div>
</form>
END;
        return $html;
    }

}