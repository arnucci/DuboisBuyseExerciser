<?php

class IndexView
{
    private $_content;

    public function __construct($content, $colonneDebut, $colonneMilieu, $colonneFin) {

        $this->_content = $content;
        $this->_colonneDebut = $colonneDebut;
        $this->_colonneMilieu = $colonneMilieu;
        $this->_colonneFin = $colonneFin;
    }

    private function displayLayout()
    {
        $content = $this->_content;
        $colonneDebut = $this->_colonneDebut;
        $colonneMilieu = $this->_colonneMilieu;
        $colonneFin = $this->_colonneFin;
        require_once 'layout.php';
    }


    // function displayContent()
    // {
    //     return $this->_content;
    // }

    function display()
    {
        $this->displayLayout();
    }
}