<?php


namespace pizzatroce\vue;


class VueBesoin
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
                $contenu = $this->afficherFormCreerBesoin();
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

    private function afficherFormCreerBesoin(){
        $option="";
        foreach ($this->elem as $creneau)
            $option = $option."<option>".$creneau->id."</option> ";

        $html = <<<END
<form  action="" method="post">
    <h2>Création d'un besoin</h2>
    <div class="formulaire">
        <input style="text-align:center" type="text" name="description" placeholder="Description">
    </div>
    <h2>Créneau</h2>
    <div class="formulaire">
        <select>
            $option
        </select>
    </div>
    <div class="formulaire">
        <input type="submit" value="Valider">
    </div>
</form>
END;
        return $html;
    }
}