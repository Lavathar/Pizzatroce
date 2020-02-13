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
        $creneaux="";
        if (isset($this->elem['creneaux']))
        foreach ($this->elem['creneaux'] as $creneau)
            $creneaux = $creneaux."<option>".$creneau->id./*$creneau->jour." ".$creneau->semaine." ".$creneau->hDebut." ".$creneau->hFin.*/"</option> ";

        $roles="";
        if (isset($this->elem['roles']))
            foreach ($this->elem['roles'] as $role)
                $roles = $roles."<option>".$role->label."</option> ";

        if(isset($this->elem["info"])) $info=$this->elem['info']; else $info="";

        $html = <<<END
<form  action="" method="post">
    <p class="succes">$info</p>
    <h2>Création d'un besoin</h2>
    <div class="formulaire">
        <input style="text-align:center" type="text" name="description" placeholder="Description">
    </div>
    <div class="formulaire">
        <div class="select">
            <select name="role" required>
                $roles
            </select>
        </div>
    </div>
    <h2>Créneau</h2>
    <div class="formulaire">
        <div class="select">
            <select name="creneau" required>
                $creneaux
            </select>
        </div>
    </div>
    <div class="formulaire">
        <input type="submit" value="Valider">
    </div>
</form>
END;
        return $html;
    }
}