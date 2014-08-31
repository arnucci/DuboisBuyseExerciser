<?php

$errors = array();

$content = '';

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

if (isset($_POST['submit'])) {

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

            $content .= '<p id="edittype">';
            $content .= '<input type="radio" name="editiontype" value="pdf" id="pdf" /><label for="pdf">PDF</label>';
            $content .= '<input type="radio" name="editiontype" value="excel" id="excel" /><label for="excel">Excel</label>';
            $content .= '</p>';
    
            $content .= '<p id="pfiletype">';
            $content .= '<label for="fileName">Nom du fichier </label>';
            $content .= '<input type="text" name="filename" id="fileName" value="exemple.pdf" />';
            $content .= '</p>';

            $content .= '<div class="clear"><hr /></div>';
            $content .= '<p>';
            $content .= '<input type="hidden" name="lettre" value="'.$cleanLettre.'" />';
            $content .= '<input type="submit" name="submit" value="Editer">';
            $content .= '</p>';

        } else {

            $errors[] = 'Il n\'y a aucun mot correspondant à vos critères de recherche.';
        }

    } else {
        $errors[] = 'Le formulaire est incomplet.';
    }
 }


if (isset($_GET['action']) && $_GET['action'] === 'edit') {

   
    if (isset($_POST['editiontype'])) {

        if ($_POST['editiontype'] === 'pdf') {

        include_once 'tcpdf/tcpdf.php';

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

            include_once dirname(__FILE__).'/lang/eng.php';
            $pdf->setLanguageArray($l);
        }

        // set font
        $pdf->SetFont('times', '', 12);

        // add a page
        $pdf->AddPage();

        // create columns content
        if (isset($_POST['debut'])) {

            $leftColumn = '<h1>Mots commençant par "'.$_POST['lettre'].'" </h1>';

            $leftColumn .= implode('<br />', $_POST['debut']);
        }

        if (isset($_POST['milieu'])) {

            $middleColumn = '<h1>Mots contenant "'.$_POST['lettre'].'" </h1>';

            $middleColumn .= implode('<br />', $_POST['milieu']);
        }

        if (isset($_POST['fin'])) {

            $rightColumn = '<h1>Mot finissant par "'.$_POST['lettre'].'" </h1>';

            $rightColumn .= implode('<br />', $_POST['fin']);
        }

        // get current vertical position
        $y = $pdf->getY();

        // set color for background
        $pdf->SetFillColor(255, 255, 255);

        // set color for text
        $pdf->SetTextColor(0, 0, 0);

        // write the first column
        $pdf->writeHTMLCell(60, '', '', $y, $leftColumn, 0, 0, 1, true, 'J', true);

        // set color for background
        $pdf->SetFillColor(255, 255, 255);

        // set color for text
        $pdf->SetTextColor(0, 0, 0);

        // write the first column
        $pdf->writeHTMLCell(60, '', '', '', $middleColumn, 0, 0, 1, true, 'J', true);

        // set color for background
        $pdf->SetFillColor(255, 255, 255);

        // set color for text
        $pdf->SetTextColor(0, 0, 0);

        // write the second column
        $pdf->writeHTMLCell(60, '', '', '', $rightColumn, 0, 1, 1, true, 'J', true);

        // reset pointer to the last page
        $pdf->lastPage();

        //Close and output PDF document
        $pdf->Output($_POST['filename'], 'I');

        } else if ($_POST['editiontype'] === 'excel') {


 $arrayData = array();

    $countDebut  = 0;
    $countMilieu = 0;
    $countFin    = 0;

    if (!empty($_POST['debut'])) {

        $debut = array();

        $debut[] = 'Mots commençant par "'.$_POST['lettre'].'"';

        foreach ($_POST['debut'] as $word) {

            $debut[] = $word;
        }

        $arrayData['debut'] = $debut;
        $countDebut = count($debut);
    }

    if (!empty($_POST['milieu'])) {

        $milieu = array();

        $milieu[] = 'Mots contenant "'.$_POST['lettre'].'"';

        foreach ($_POST['milieu'] as $word) {

            $milieu[] = $word;
        }

        $arrayData['milieu'] = $milieu;
        $countMilieu = count($milieu);
    }

    if (!empty($_POST['fin'])) {

        $fin = array();

        $fin[] = 'Mots finissant par "'.$_POST['lettre'].'"';

        foreach ($_POST['fin'] as $word) {

            $fin[] = $word;
        }

        $arrayData['fin'] = $fin;
        $countFin = count($fin);
    }

    $max = max($countDebut, $countMilieu, $countFin);

    $i = 0;

    $arrayRows = array();

    while ($i < $max) {

        if ($countDebut !== 0) {

            if (array_key_exists('debut', $arrayData)) {

                $arrayRows[$i][] = (array_key_exists($i, $arrayData['debut'])) ? $arrayData['debut'][$i] : "";
            }
        }

        if ($countMilieu !== 0) {

            if (array_key_exists('milieu', $arrayData)) {

                $arrayRows[$i][] = (array_key_exists($i, $arrayData['milieu'])) ? $arrayData['milieu'][$i] : "";
            }
        }

        if ($countFin !== 0) {

            if (array_key_exists('fin', $arrayData)) {

                $arrayRows[$i][] = (array_key_exists($i, $arrayData['fin'])) ? $arrayData['fin'][$i] : "";
            }
        }

        $i++;
    }




        $fp = fopen('tmp/file.csv', 'w');

        foreach ($arrayRows as $fields) {

            fputcsv($fp, $fields);
        }

        fclose($fp);

        $csvname = 'tmp/file.csv';

        if (file_exists($csvname)) {

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($csvname));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($csvname));
            ob_clean();
            flush();
            readfile($csvname);

        } else {

            echo 'Le fichier csv n\'a pas pu être généré pour une raison inconnue !';
        }








        }
    }




 }



require_once 'layout.php';
