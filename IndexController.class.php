<?php

class IndexController
{
    public function __construct()
    {
    }

    public function viewsManagement()
    {
        require_once 'IndexView.class.php';

        if (!empty($_POST['lettre'])) {

            require_once 'ListView.class.php';
        }

        require_once 'layout.php';
    }

    private function setContent()
    {
        $this->_colonneDebut  = array();
        $this->_colonneMilieu = array();
        $this->_colonneFin    = array();

        $results = array();
        $cleanLettre = htmlspecialchars($_POST['lettre'], ENT_COMPAT);

        $results = file('words.txt');

        foreach ($results as $word) {

            if (in_array('debut', $_POST['place'])) {
	
                $pattern = '#^('.$cleanLettre.'[a-zéèàêûîôïç-]+) \| ([a-zA-Z0-9è]+)#';
                if (preg_match($pattern, $word, $matches)) {
			
                    if (in_array($matches[2], $_POST['classe'])) {
			
                        $this->_colonneDebut[] = $matches[1];
                    }
                }
            } 
		
            if (in_array('milieu', $_POST['place'])) {

                $pattern = '#^([a-zéèàêûîôïç-]+'.$cleanLettre.'[a-zéèàêûîôïç-]+) \| ([a-zA-Z0-9è]+)#';
                if (preg_match($pattern, $word, $matches)) {

                    if (in_array($matches[2], $_POST['classe'])) {
				
                        $this->_colonneMilieu[] = $matches[1];
                    }
                }
            }
		
            if (in_array('fin', $_POST['place'])) {

                $pattern = '#^([a-zéèàêûîôïç-]+'.$cleanLettre.') \| ([a-zA-Z0-9è]+)$#';
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
        if (!empty($_POST['lettre'])) {

            $this->setContent();
        }
    }
}
