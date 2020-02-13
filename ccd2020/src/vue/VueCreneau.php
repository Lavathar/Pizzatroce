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
    public function render(int $index): string
    {
        switch ($index) {
            case 0:
                $contenu = $this->afficherFormulaireAjoutCreneau();
                break;
            case 1:
                $contenu = $this->afficherAllCrenaux();
                break;
            case 2:
                $contenu = $this->afficherCreneauDetail();
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

    private function afficherCreneauDetail(){
        $jours = array (
          1=>"Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"
        );

        $creneau = $this->elem['creneau'];
        $besoins = $this->elem['besoins'];
        $id = $this->elem['id'];

        $liste='<div class="infos_besoin">';
        foreach ($besoins as $besoin)
            $liste = $liste.'<p>'.$besoin->label.'</p>';
        $liste=$liste.'</div>';

        $jour = $creneau->jour;
        $semaine = $creneau->semaine;
        $hDebut = $creneau->hDebut;
        $hFin = $creneau->hFin;


        $html = <<<END
<div class="infos_creneau">
    <p>$jours[$jour], semaine $semaine, de $hDebut à $hFin</p>
</div>
   $liste
   
<form  action="$this->path/besoin/$id" method="get">
    <div class="formulaire">
        <input type="submit" value="Ajouter un besoin">
    </div>
</form>
END;
        return $html;
        
    }


    private function afficherFormulaireAjoutCreneau() : string {
        $erreur = $this->elem;

        $html = <<<END
<form  action="" method="post">
    <h3 class="erreur">$erreur</h3>
    <h2>Ajouter un Creneau</h2>
    <div class="formulaire">
        <input style="text-align:center" type="number" name="jour" placeholder="Jour" min="1" max="7" step="1" required>
    </div>
    <div class="formulaire">
            <select name="semaine" size="1">
                <option>A
                <option>B
                <option>C
                <option>D
            </select>
    </div>
    <div class="formulaire">
        <input style="text-align:center" type="number" name="hDeb" placeholder="H.Debut" min="1" max="24" step="1" required>
    </div>
    <div class="formulaire">
        <input style="text-align:center" type="number" name="hFin" placeholder="H.Fin" min="1" max="24" step="1" required>
    </div>
    <div class="formulaire">
        <input type="submit" value="Valider">
    </div>
</form>
END;
        return $html;
    }

    public function afficherAllCrenaux(): string
    {
        $tab = "<div class='tableau'>";
        foreach($this->elem as $key=>$jour)
        {
            $tab = $tab.'<div class="colonne"><h3 class="jour">'.$key.'</h3>';
            foreach ($jour as $c)
                $tab = $tab.'<a href="'.$this->path.'/creneauDetail/'.$c->id.'"><div class="creneau"><p>'.$c->hDebut.' - '.$c->hFin.'</p></div></a>';
            $tab = $tab.'</div>';
        }
        return $tab."</div><div class='formulaire'><a href='$this->path/creneau/'>Ajouter créneau</a></div>";
    }
}
