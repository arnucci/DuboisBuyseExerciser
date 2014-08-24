<?php

require_once 'View.class.php';

class IndexView extends View
{
    private $_content;

    private $_letter;

    private $_colonneDebut;

    private $_colonneMilieu;

    private $_colonneFin;

    function __construct($letter, $colonneDebut, $colonneMilieu, $colonneFin)
    {
        $this->_letter        = $letter;
        $this->_colonneDebut  = $colonneDebut;
        $this->_colonneMilieu = $colonneMilieu;
        $this->_colonneFin    = $colonneFin;
    }

    function displayLayout()
    {
        parent::setLayout($this->displayContent(), array('select.js'));
    }

    function displayContent()
    {

        $this->_content = '<h1>Générateur de liste de mots</h1>';

        if (isset($_SESSION['error'])) {

            foreach ($_SESSION['error'] as $error) {

                $this->_content .= $error.'<br />';
            }
        }

        $this->_content .= '<form action="index.php" method="post">';
        $this->_content .= '<p>';
        $this->_content .= 'Suite de lettres recherchées';
        $this->_content .= '<input type="text" name="lettre" ';

        if (isset($_POST['lettre']))
            $this->_content .= 'value="'.htmlspecialchars($_POST['lettre'], ENT_QUOTES).'"';

        $this->_content .= ' />';
        $this->_content .= '</p>';

        $this->_content .= '<p><a href="#" id="select">Tout sélectionner</a> - <a href="#" id="unselect">Tous déselectionner</a></p>';

        $this->_content .= '<p>';
        $this->_content .= '<input type="checkbox" name="place[]" value="debut" id="debut" class="checkplace" ';

        if (isset($_POST['place']))
            if (in_array('debut', $_POST['place']))
                $this->_content .= 'checked="checked"';

        $this->_content .= ' />';
        $this->_content .= '<label for="debut">Début du mot</label>';
        $this->_content .= '</p>';

        $this->_content .= '<p>';
        $this->_content .= '<input type="checkbox" name="place[]" value="milieu" id="milieu" class ="checkplace" ';

        if (isset($_POST['place']))
            if (in_array('milieu', $_POST['place']))
                $this->_content .= 'checked="checked"';

        $this->_content .= ' />';
        $this->_content .= '<label for="milieu">Milieu du mot</label>';
        $this->_content .= '</p>';

        $this->_content .= '<p>';
        $this->_content .= '<input type="checkbox" name="place[]" value="fin" id="fin" class="checkplace" ';

        if (isset($_POST['place']))
            if (in_array('fin', $_POST['place']))
                $this->_content .= 'checked="checked"';

        $this->_content .= ' />';
        $this->_content .= '<label for="fin">Fin du mot</label>';
        $this->_content .= '</p>';

        $this->_content .= '<p><a href="#" id="selectcl">Tout sélectionner</a> - <a href="#" id="unselectcl">Tous déselectionner</a></p>';

        $this->_content .= '<p>';
        $this->_content .= 'Classe';
        $this->_content .= '<input type="checkbox" name="classe[]" id="cp" value="CP" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('CP', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="cp">CP</label>';

        $this->_content .=  '<input type="checkbox" name="classe[]" id="ce1" value="CE1" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('CE1', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="ce1">CE1</label>';

        $this->_content .= '<input type="checkbox" name="classe[]" id="ce2" value="CE2" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('CE2', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .='><label for="ce2">CE2</label>';

        $this->_content .= '<input type="checkbox" name="classe[]" id="cm1" value="CM1" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('CM1', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="cm1">CM1</label>';

        $this->_content .= '<input type="checkbox" name="classe[]" id="cm2" value="CM2" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('CM2', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="cm2">CM2</label>';

        $this->_content .= '<input type="checkbox" name="classe[]" id="6eme" value="6ème" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('6ème', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="6eme">6ème</label>';

        $this->_content .= '<input type="checkbox" name="classe[]" id="5eme" value="5ème" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('5ème', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="5eme">5ème</label>';

        $this->_content .= '<input type="checkbox" name="classe[]" id="4eme" value="4ème" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('4ème', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="4eme">4ème</label>';

        $this->_content .= '<input type="checkbox" name="classe[]" id="3eme" value="3ème" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('3ème', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="3eme">3ème</label>';

        $this->_content .= '<input type="checkbox" name="classe[]" id="2nd" value="2nd" class="checkclasse" ';

        if (isset($_POST['classe']))
            if (in_array('2nd', $_POST['classe']))
                $this->_content .= 'checked="checked"';

        $this->_content .= '><label for="2nd">2nd</label>';

        $this->_content .= '</p>';

        $this->_content .= '<p>';
        $this->_content .= '<input type="submit" name="submit" value="Rechercher" />';
        $this->_content .= '</p>';

        $this->_content .= '</form>';

        if (!empty($this->_colonneDebut) || !empty($this->_colonneMilieu) || !empty($this->_colonneFin)) {

            $this->_content .= '<form action="index.php?action=edit" method="post">';

            if (!empty($this->_colonneDebut)) {

                $this->_content .= '<div id="colonneDebut">';

                $this->_content .= '<h3>Mots commençant par "'.$this->_letter.'"</h3>';

                foreach ($this->_colonneDebut as $mot) {

                    $this->_content .= '<input type="checkbox" checked="checked" name="debut[]" value="'.$mot.'" id="debut_'.$mot.'" /><label for="debut_'.$mot.'">'.$mot.'</label><br />';
                }

                $this->_content .= '</div>';
            }

            if (!empty($this->_colonneMilieu)) {

                $this->_content .= '<div id="colonneMilieu">';

                $this->_content .= '<h3>Mots contenant "'.$this->_letter.'"</h3>';

                foreach ($this->_colonneMilieu as $mot) {

                    $this->_content .= '<input type="checkbox" checked="checked" name="milieu[]" value="'.$mot.'" id="milieu_'.$mot.'" /><label for="milieu_'.$mot.'">'.$mot.'</label><br />';
                }

                $this->_content .= '</div>';
            }

            if (!empty($this->_colonneFin)) {

                $this->_content .= '<div id="colonneFin">';

                $this->_content .= '<h3>Mots finissant par "'.$this->_letter.'"</h3>';

                foreach ($this->_colonneFin as $mot) {

                    $this->_content .= '<input type="checkbox" checked="checked" name="fin[]" value="'.$mot.'" id="fin_'.$mot.'" /><label for="fin_'.$mot.'">'.$mot.'</label><br />';
                }

                $this->_content .= '</div>';
            }

            $this->_content .= '<div class="clear"><hr /></div>';
            $this->_content .= '<p>';
            $this->_content .= '<input type="radio" name="editiontype" value="pdf" id="pdf" /><label for="pdf">PDF</label>';
            $this->_content .= '<input type="radio" name="editiontype" value="excel" id="excel" /><label for="excel">Excel</label>';
            $this->_content .= '</p>';

            $this->_content .= '<p>';
            $this->_content .= '<label for="fileName">Nom du fichier pdf</label>';
            $this->_content .= '<input type="text" name="filename" id="fileName" value="exemple.pdf" />';
            $this->_content .= '</p>';

            $this->_content .= '<div class="clear"><hr /></div>';
            $this->_content .= '<p>';
            $this->_content .= '<input type="hidden" name="lettre" value="'.$this->_letter.'" />';
            $this->_content .= '<input type="submit" name="submit" value="Editer">';
            $this->_content .= '</p>';

        } else {

            $this->_content .= '<p>Il n\'y a aucun mot correspondant à vos critères de recherche</p>';
        }


        return $this->_content;
    }

    function display()
    {
        $this->displayLayout();
    }
}