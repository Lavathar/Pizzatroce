<?php

// Changement de locale pour être en français
if (!setlocale(LC_TIME, 'fr_FR.utf8', 'fr_FR', 'fr'))
    throw new Exception ('Français introuvable : corriger ou commenter cette ligne (pour la langue par défaut)');

/**
 * Fonction de calcul de date.
 *
 * @param string $ancre date de départ (ancrage de départ)
 * @param integer $cycle n° de cycle (premier cycle = 0)
 * @param string $semaine nom de la semaine (de 'A' à 'D')
 * @param integer $jour n° du jour (de 1 à 7)
 * @return object
 */
function calc_date($ancre, $semaine, $jour, $cycle = 0)
{
    // On vérifie les paramètres...
    if ((gettype($cycle) !== 'integer') || ($cycle < 0))
        throw new Exception('calc_date : mauvais numéro de cycle');
    
    if ((gettype($semaine) !== 'string') || (strlen($semaine) != 1) ||
        (ord($semaine) - ord('A') < 0) || (ord($semaine) - ord('A') > 3))
        throw new Exception('calc_date : le n° de semaine doit être entre A et D (inclus)');

    if ((gettype($jour) !== 'integer') || ($jour < 1) || ($jour > 7))
        throw new Exception('calc_date : le n° de jour doit être entre 1 et 7 (inclus)');

    // On calcule le jour recherché (décalage entier par rapport
    // à la date de départ -- « l'ancre »)
    $nb_jours = $cycle * 28 + (ord($semaine) - ord('A')) * 7 + $jour - 1;
    $date_init = new DateTime($ancre);
    $date_res = $date_init->add(new DateInterval('P' . $nb_jours . 'D'))->format('U');

    // Attention, distinguo Windows/reste du monde (Windows, WinNT, Win32)
    $format_jour_no = (preg_match('#win[dn3]#', PHP_OS))? '%#d' : '%e';
                
    // Génération du résultat
    return (object) [
        'jour_no' => strftime($format_jour_no, $date_res),
        'jour_nom_court' => strftime('%a', $date_res),
        'jour_nom' => strftime('%A', $date_res),
        'mois_no' => strftime('%m', $date_res),
        'mois_nom_court' => strftime('%b', $date_res),
        'mois_nom' => strftime('%B', $date_res),
        'annee_no' => strftime('%Y', $date_res),
        'annee_no_court' => strftime('%y', $date_res)
    ];
}

//
// QUELQUES TESTS
//

// Jour de départ (ancre) :
// format = YYYY-MM-DD
// Attention : cela doit être un lundi !
$ancre = '2020-01-20';

// Tests unitaires
echo 'Test auj.' . print_r(calc_date($ancre, 0, 'A', 1)) . '<br/>';
echo 'Test auj.' . calc_date($ancre, 0, 'A', 1)->jour_nom . '<br/>';
echo 'Test lundi proch' . print_r(calc_date($ancre, 0, 'B', 1)) . '<br/>';
echo 'Test début pr. cycle' .  print_r(calc_date($ancre, 1, 'A', 1)) . '<br/>';
