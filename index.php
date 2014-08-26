<?php

$content = '';

$content = '<h1>Générateur de liste de mots</h1>';

$content .= '<form action="index.php" method="post">';
$content .= '<p>';
$content .= 'Suite de lettres recherchées';
$content .= '<input type="text" name="lettre" ';

if (isset($_POST['lettre']))
    $content .= 'value="'.htmlspecialchars($_POST['lettre'], ENT_QUOTES).'"';

$content .= ' />';
$content .= '</p>';

$content .= '<p><a href="#" id="select">Tout sélectionner</a> - <a href="#" id="unselect">Tous déselectionner</a></p>';

$content .= '<p>';
$content .= '<input type="checkbox" name="place[]" value="debut" id="debut" class="checkplace" ';

if (isset($_POST['place']))
    if (in_array('debut', $_POST['place']))
        $content .= 'checked="checked"';

$content .= ' />';
$content .= '<label for="debut">Début du mot</label>';
$content .= '</p>';

$content .= '<p>';
$content .= '<input type="checkbox" name="place[]" value="milieu" id="milieu" class ="checkplace" ';

if (isset($_POST['place']))
    if (in_array('milieu', $_POST['place']))
        $content .= 'checked="checked"';

$content .= ' />';
$content .= '<label for="milieu">Milieu du mot</label>';
$content .= '</p>';

$content .= '<p>';
$content .= '<input type="checkbox" name="place[]" value="fin" id="fin" class="checkplace" ';

if (isset($_POST['place']))
    if (in_array('fin', $_POST['place']))
        $content .= 'checked="checked"';

$content .= ' />';
$content .= '<label for="fin">Fin du mot</label>';
$content .= '</p>';

$content .= '<p><a href="#" id="selectcl">Tout sélectionner</a> - <a href="#" id="unselectcl">Tous déselectionner</a></p>';

$content .= '<p>';
$content .= 'Classe';
$content .= '<input type="checkbox" name="classe[]" id="cp" value="CP" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('CP', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="cp">CP</label>';

$content .=  '<input type="checkbox" name="classe[]" id="ce1" value="CE1" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('CE1', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="ce1">CE1</label>';

$content .= '<input type="checkbox" name="classe[]" id="ce2" value="CE2" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('CE2', $_POST['classe']))
        $content .= 'checked="checked"';

$content .='><label for="ce2">CE2</label>';

$content .= '<input type="checkbox" name="classe[]" id="cm1" value="CM1" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('CM1', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="cm1">CM1</label>';

$content .= '<input type="checkbox" name="classe[]" id="cm2" value="CM2" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('CM2', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="cm2">CM2</label>';

$content .= '<input type="checkbox" name="classe[]" id="6eme" value="6ème" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('6ème', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="6eme">6ème</label>';

$content .= '<input type="checkbox" name="classe[]" id="5eme" value="5ème" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('5ème', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="5eme">5ème</label>';

$content .= '<input type="checkbox" name="classe[]" id="4eme" value="4ème" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('4ème', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="4eme">4ème</label>';

$content .= '<input type="checkbox" name="classe[]" id="3eme" value="3ème" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('3ème', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="3eme">3ème</label>';

$content .= '<input type="checkbox" name="classe[]" id="2nd" value="2nd" class="checkclasse" ';

if (isset($_POST['classe']))
    if (in_array('2nd', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="2nd">2nd</label>';

$content .= '</p>';

$content .= '<p>';
$content .= '<input type="submit" name="submit" value="Rechercher" />';
$content .= '</p>';

$content .= '</form>';


 if ($_POST['lettre'] !== '' && !empty($_POST['place']) && !empty($_POST['classe'])) {

     $results = array();
     $cleanLettre = htmlspecialchars($_POST['lettre'], ENT_COMPAT);

     $results = file('words.txt');

     foreach ($results as $word) {

         if (in_array('debut', $_POST['place'])) {

             $pattern = '#^('.$cleanLettre.'[a-z\ \'éèàêûîôïç\-]+) \| ([a-zA-Z0-9è]+)#';
             if (preg_match($pattern, $word, $matches)) {

                 if (in_array($matches[2], $_POST['classe'])) {

                     $colonneDebut[] = $matches[1];
                 }
             }
         } 

         if (in_array('milieu', $_POST['place'])) {

             $pattern = '#^([a-zéèàêûîôïç-]+'.$cleanLettre.'[a-zéèàêûîôïç-]+) \| ([a-zA-Z0-9è]+)#';
             if (preg_match($pattern, $word, $matches)) {

                 if (in_array($matches[2], $_POST['classe'])) {

                     $colonneMilieu[] = $matches[1];
                 }
             }
         }

         if (in_array('fin', $_POST['place'])) {

             $pattern = '#^([a-zéèàêûîôïç-]+'.$cleanLettre.') \| ([a-zA-Z0-9è]+)#';
             if (preg_match($pattern, $word, $matches)) {

                 if (in_array($matches[2], $_POST['classe'])) {

                     $colonneFin[] = $matches[1];
                 }
             }
         }
     }


 }


if (!empty($colonneDebut) || !empty($colonneMilieu) || !empty($colonneFin)) {

    $content .= '<form action="index.php?action=edit" method="post">';

    if (!empty($colonneDebut)) {

        $content .= '<div id="colonneDebut">';

        $content .= '<h3>Mots commençant par "'.$cleanLettre.'"</h3>';

        foreach ($colonneDebut as $mot) {

            $content .= '<input type="checkbox" checked="checked" name="debut[]" value="'.$mot.'" id="debut_'.$mot.'" /><label for="debut_'.$mot.'">'.$mot.'</label><br />';
        }

        $content .= '</div>';
    }

    if (!empty($colonneMilieu)) {

        $content .= '<div id="colonneMilieu">';

        $content .= '<h3>Mots contenant "'.$cleanLettre.'"</h3>';

        foreach ($colonneMilieu as $mot) {

            $content .= '<input type="checkbox" checked="checked" name="milieu[]" value="'.$mot.'" id="milieu_'.$mot.'" /><label for="milieu_'.$mot.'">'.$mot.'</label><br />';
        }

        $content .= '</div>';
    }

    if (!empty($colonneFin)) {

        $content .= '<div id="colonneFin">';

        $content .= '<h3>Mots finissant par "'.$cleanLettre.'"</h3>';

        foreach ($colonneFin as $mot) {

            $content .= '<input type="checkbox" checked="checked" name="fin[]" value="'.$mot.'" id="fin_'.$mot.'" /><label for="fin_'.$mot.'">'.$mot.'</label><br />';
        }

        $content .= '</div>';
    }

    $content .= '<div class="clear"><hr /></div>';
    $content .= '<p>';
    $content .= '<input type="radio" name="editiontype" value="pdf" id="pdf" /><label for="pdf">PDF</label>';
    $content .= '<input type="radio" name="editiontype" value="excel" id="excel" /><label for="excel">Excel</label>';
    $content .= '</p>';

    $content .= '<p>';
    $content .= '<label for="fileName">Nom du fichier pdf</label>';
    $content .= '<input type="text" name="filename" id="fileName" value="exemple.pdf" />';
    $content .= '</p>';

    $content .= '<div class="clear"><hr /></div>';
    $content .= '<p>';
    $content .= '<input type="hidden" name="lettre" value="'.$cleanLettre.'" />';
    $content .= '<input type="submit" name="submit" value="Editer">';
    $content .= '</p>';

 } else {

    $content .= '<p>Il n\'y a aucun mot correspondant à vos critères de recherche</p>';
 }

require_once 'layout.php';
