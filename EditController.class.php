<?php

class EditController
{
    private function processData()
    {
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

        while ($i <$max) {

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

        return $arrayRows;
    }


    private function createHtmlDoc()
    {
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

        return $html;
    }

    private function renderPdf()
    {
        $html = $this->createHtmlDoc();

        require_once "dompdf/dompdf_config.inc.php";

        

        $dompdf = new DOMPDF();
 
        
 
        $dompdf->load_html($html);
        $dompdf->render();
 
        $dompdf->stream("hello.pdf");

    }


    private function renderExcel() {

        $arrayRows = $this-> processData();

        $fp = fopen('tmp/file.csv', 'w');
        foreach ($arrayRows as $fields) {

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
			
            echo 'Le fichier csv n\'a pas pu être généré pour une raison inconnue !';
        }
    }


    public function request()
    {
        if (isset($_POST['editiontype'])) {

            if ($_POST['editiontype'] === 'pdf') {

                $this->renderPdf();

            } else if ($_POST['editiontype'] === 'excel') {

                $this->renderExcel();
            }
        }
    }
}
