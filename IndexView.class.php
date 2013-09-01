<?php

class IndexView
{
    public function __construct($colonneDebut, $colonneMilieu, $colonneFin)
    {
        $this->_colonneDebut = $colonneDebut;
        $this->_colonneMilieu = $colonneMilieu;
        $this->_colonneFin = $colonneFin;
    }

    private function displayLayout()
    {
        $colonneDebut = $this->_colonneDebut;
        $colonneMilieu = $this->_colonneMilieu;
        $colonneFin = $this->_colonneFin;
        require_once 'layout.php';
    }


    function display()
    {
        $this->displayLayout();
    }
}