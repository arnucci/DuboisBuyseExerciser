<?php
if (!empty($this->_colonneDebut) || !empty($this->_colonneMilieu) || !empty($this->_colonneFin)) {

    $content .= '<form action="index.php?action=edit" method="post">';

    if (!empty($this->_colonneDebut)) {

        $content .= '<div id="colonneDebut">';

        $content .= '<h3>Mots commençant par "'.$this->_cleanLettre.'"</h3>';

        foreach ($this->_colonneDebut as $mot) {

            $content .= '<input type="checkbox" checked="checked" name="debut[]" value="'.$mot.'" id="debut_'.$mot.'" /><label for="debut_'.$mot.'">'.$mot.'</label><br />';
        }

        $content .= '</div>';
    }

    if (!empty($this->_colonneMilieu)) {

        $content .= '<div id="colonneMilieu">';

        $content .= '<h3>Mots contenant "'.$this->_cleanLettre.'"</h3>';

        foreach ($this->_colonneMilieu as $mot) {

            $content .= '<input type="checkbox" checked="checked" name="milieu[]" value="'.$mot.'" id="milieu_'.$mot.'" /><label for="milieu_'.$mot.'">'.$mot.'</label><br />';
        }

        $content .= '</div>';
    }

    if (!empty($this->_colonneFin)) {

        $content .= '<div id="colonneFin">';

        $content .= '<h3>Mots finissant par "'.$this->_cleanLettre.'"</h3>';

        foreach ($this->_colonneFin as $mot) {

            $content .= '<input type="checkbox" checked="checked" name="fin[]" value="'.$mot.'" id="fin_'.$mot.'" /><label for="fin_'.$mot.'">'.$mot.'</label><br />';
        }

        $content .= '</div>';
    }

    $content .=	'<div class="clear"><hr /></div>';
    $content .= '<p>';
    $content .=	'<input type="radio" name="editiontype" value="pdf" id="pdf" /><label for="pdf">PDF</label>';
    $content .=	'<input type="radio" name="editiontype" value="excel" id="excel" /><label for="excel">Excel</label>';
    $content .=	'</p>';

    $content .= '<p>';
    $content .= '<label for="fileName">Nom du fichier pdf</label>';
    $content .= '<input type="text" name="filename" id="fileName" value="exemple.pdf" />';
    $content .= '</p>';

    $content .=	'<div class="clear"><hr /></div>';
    $content .= '<p>';
    $content .= '<input type="hidden" name="lettre" value="'.$this->_cleanLettre.'" />';
    $content .=	'<input type="submit" name="submit" value="Editer">';
    $content .=	'</p>';

} else {

    $content .= '<p>Il n\'y a aucun mot correspondant à vos critères de recherche</p>';
}
