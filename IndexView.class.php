<?php
$content  = '<form action="index.php" method="post">';
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

$content .= '<p>';
$content .= 'Classe';
$content .= '<input type="checkbox" name="classe[]" id="cp" value="CP" ';

if (isset($_POST['classe']))
    if (in_array('CP', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="cp">CP</label>';

$content .=  '<input type="checkbox" name="classe[]" id="ce1" value="CE1" ';

if (isset($_POST['classe']))
    if (in_array('CE1', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="ce1">CE1</label>';

$content .= '<input type="checkbox" name="classe[]" id="ce2" value="CE2" ';

if (isset($_POST['classe']))
    if (in_array('CE2', $_POST['classe']))
        $content .= 'checked="checked"';

$content .='><label for="ce2">CE2</label>';

$content .= '<input type="checkbox" name="classe[]" id="cm1" value="CM1" ';

if (isset($_POST['classe']))
    if (in_array('CM1', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="cm1">CM1</label>';

$content .= '<input type="checkbox" name="classe[]" id="cm2" value="CM2" ';

if (isset($_POST['classe']))
    if (in_array('CM2', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="cm2">CM2</label>';

$content .= '<input type="checkbox" name="classe[]" id="6eme" value="6ème" ';

if (isset($_POST['classe']))
    if (in_array('6ème', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="6eme">6ème</label>';

$content .= '<input type="checkbox" name="classe[]" id="5eme" value="5ème" ';

if (isset($_POST['classe']))
    if (in_array('5ème', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="5eme">5ème</label>';

$content .= '<input type="checkbox" name="classe[]" id="4eme" value="4ème" ';

if (isset($_POST['classe']))
    if (in_array('4ème', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="4eme">4ème</label>';

$content .= '<input type="checkbox" name="classe[]" id="3eme" value="3ème"';

if (isset($_POST['classe']))
    if (in_array('3ème', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="3eme">3ème</label>';

$content .= '<input type="checkbox" name="classe[]" id="2nd" value="2nd" ';

if (isset($_POST['classe']))
    if (in_array('2nd', $_POST['classe']))
        $content .= 'checked="checked"';

$content .= '><label for="2nd">2nd</label>';

$content .= '</p>';

$content .= '<p>';
$content .= '<input type="submit" name="submit" value="Rechercher" />';
$content .= '</p>';

$content .= '</form>';

$script = '<script src="js/select.js" type="text/javascript"></script>';
