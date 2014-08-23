<?php

class View
{
    private $_script;

    private $_content;


    /**
     * Constructeur de la classe View
     */
    function __construct()
    {
    }


    /**
     * Initialise le(s) chemin des scripts et leur type
     *
     * @param array $script le tableau associatif nom-fichier => type
     *
     * @return empty
     */
    function initScript($script = null)
    {
        if ($script === null || !is_array($script)) {
            $this->_script = '';
        } else {
            foreach ($script as $file) {
                $this->_script .= '<script type="text/javascript" src="js/'.$file.'" ></script>'."\n\t\t";
            }
        }
    }

    /**
     * Initialise le contenu de la vue
     *
     * @param string $content le contenu de la vue
     *
     * @return empty
     */
    function setContent($content = null)
    {
        $this->_content = $content;
    }


    /**
     * Inclue le header à la vue
     *
     * @param string $content le contenu de la vue
     * @param array  $script  les scripts associés à la vue
     *
     * @return empty
     */
    function setLayout($content = null, $script = null)
    {
        $this->setContent($content);
        $this->initScript($script);
        require_once 'layout.php';
	}
}