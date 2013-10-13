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
