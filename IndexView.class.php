<?php

class IndexView
{
    private $_content;

    public function __construct($content) {

        $this->_content = $content;
    }

    private function displayLayout()
    {
        $content = $this->_content;
        require_once 'layout.php';
    }


    function displayContent()
    {
        return $this->_content;
    }

    function display()
    {
        $this->displayLayout();
    }
}