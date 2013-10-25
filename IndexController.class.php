<?php

class IndexController
{
    private $_colonneDebut = array();

    private $_colonneMilieu = array();

    private $_colonneFin = array();

    private $_cleanLettre;

    public function __construct()
    {
    }

    public function viewsManagement()
    {
        include_once 'IndexView.class.php';

        if (!empty($_POST['lettre'])) {

            include_once 'ListView.class.php';
        }

        include_once 'layout.php';
    }

    private function _setContent()
    {
        $results = array();
        $this->_cleanLettre = htmlspecialchars($_POST['lettre'], ENT_COMPAT);

        $results = file('words.txt');

        foreach ($results as $word) {

            if (in_array('debut', $_POST['place'])) {

                $pattern = '#^('.$this->_cleanLettre.'[a-z\ \'éèàêûîôïç\-]+) \| ([a-zA-Z0-9è]+)#';
                if (preg_match($pattern, $word, $matches)) {

                    if (in_array($matches[2], $_POST['classe'])) {

                        $this->_colonneDebut[] = $matches[1];
                    }
                }
            } 

            if (in_array('milieu', $_POST['place'])) {

                $pattern = '#^([a-zéèàêûîôïç-]+'.$this->_cleanLettre.'[a-zéèàêûîôïç-]+) \| ([a-zA-Z0-9è]+)#';
                if (preg_match($pattern, $word, $matches)) {

                    if (in_array($matches[2], $_POST['classe'])) {

                        $this->_colonneMilieu[] = $matches[1];
                    }
                }
            }

            if (in_array('fin', $_POST['place'])) {

                $pattern = '#^([a-zéèàêûîôïç-]+'.$this->_cleanLettre.') \| ([a-zA-Z0-9è]+)#';
                if (preg_match($pattern, $word, $matches)) {

                    if (in_array($matches[2], $_POST['classe'])) {

                        $this->_colonneFin[] = $matches[1];
                    }
                }
            }
        }
    }


    public function request()
    {
        if (!empty($_POST['lettre']) && !empty($_POST['place']) && !empty($_POST['classe'])) {

            $this->_setContent();
        }
    }
}
