<?php

class EditController
{
    public function viewsManagement()
    {
    }

    private function setContent()
    {
        if (isset($_POST['editiontype'])) {

            if ($_POST['editiontype'] === 'pdf') {
        
                require_once "dompdf/dompdf_config.inc.php";

                $dompdf = new DOMPDF();
 
                $html  = '<html>';
                $html .= '<head>';
                $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
                $html .= '<title>Générateur de liste de mots - échelle Dubois-Buyse</title>';
                $html .= '</head>';
                $html .= '<body>';

                $html .= '<table>';

                if (!empty($_POST['debut'])) {

                    $html .= '<tr>';
                    $html .= '<td id="colonneDebut">';
                    $html .= 'Mots commençant par "'.$_POST['lettre'].'"<br />';
                    foreach ($_POST['debut'] as $word) {

                        $html .= $word.'<br />';
                    }
	
                    $html .= '</td>';
                    $html .= '</tr>';
                }

                if (!empty($_POST['milieu'])) {

                    $html .= '<tr>';
                    $html .= '<td id="colonneMilieu">';
                    $html .= 'Mots contenant "'.$_POST['lettre'].'"</td></tr>';
                    foreach ($_POST['milieu'] as $word) {

	
                        $html .= '<tr><td>'.$word.'</td></tr>';
                    }
                }

                if (!empty($_POST['fin'])) {

                    $html .= '<tr>';
                    $html .= '<td id="colonneFin">';
                    $html .= 'Mots finissant par "'.$_POST['lettre'].'"<br />';
                    foreach ($_POST['fin'] as $word) {

                        $html .= $word.'<br />';
                    }
	
                    $html .= '</td>';
                    $html .= '</tr>';
                }
                
                $html .= '</table>';
                $html .= '</body>';
                $html .= '</html>';
 
                $dompdf->load_html($html);
                $dompdf->render();
 
                $dompdf->stream("hello.pdf");

            } else if ($_POST['editiontype'] === 'excel') {
            
                $csv = array();
	
                if (!empty($_POST['debut'])) {

                    $debut = array();

			
                    $debut[] = 'Mots commençant par "'.$_POST['lettre'].'"';

                    foreach ($_POST['debut'] as $word) {

                        $debut[] = $word;
                    }
                    
                    $csv[] = $debut;
                }

                if (!empty($_POST['milieu'])) {

                    $milieu = array();
			
                    $milieu[] = 'Mots contenant "'.$_POST['lettre'].'"';

                    foreach ($_POST['milieu'] as $word) {

                        $milieu[] = $word;
                    }
                    $csv[] = $milieu;
                }

                if (!empty($_POST['fin'])) {

                    $fin = array();

                    
                    $fin[] = 'Mots finissant par "'.$_POST['lettre'].'"';
            
                    foreach ($_POST['fin'] as $word) {

                        $fin[] = $word;
                    }
                    $csv[] = $fin;
                }
		
                $fp = fopen('tmp/file.csv', 'w');

                foreach ($csv as $fields) {

                    fputcsv($fp, $fields);
                }

                fclose($fp);
		
                $csvname = 'tmp/file.csv';

                if(file_exists($csvname)) {
		
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
			
                    echo 'Le fichier cvs n\'a pas pu être généré pour une raison inconnue !';
                }
                
            }
        }

    }


    public function request()
    {
        $this->setContent();
    }
}
