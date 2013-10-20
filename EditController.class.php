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


    private function renderPdf()
    {
        require_once('tcpdf/tcpdf.php');

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 007');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 007', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // set font
        $pdf->SetFont('times', '', 12);

        // add a page
        $pdf->AddPage();

        // create columns content

	if (isset($_POST['debut'])) {

	    $leftColumn = '<h1>Mots commençant par "'.$_POST['lettre'].'" </h1>';

            $leftColumn .= implode('<br />', $_POST['debut']);
        }

        if (isset($_POST['fin'])) {

            $rightColumn = '<h1>Mot finissant par "'.$_POST['lettre'].'" </h1>';

            $rightColumn .= implode('<br />', $_POST['fin']);
        }

        // get current vertical position
        $y = $pdf->getY();

        // set color for background
        $pdf->SetFillColor(255, 255, 200);

        // set color for text
        $pdf->SetTextColor(0, 63, 127);

        // write the first column
        $pdf->writeHTMLCell(80, '', '', $y, $leftColumn, 1, 0, 1, true, 'J', true);

        // set color for background
        $pdf->SetFillColor(215, 235, 255);

        // set color for text
        $pdf->SetTextColor(127, 31, 0);

        // write the second column
        $pdf->writeHTMLCell(80, '', '', '', $rightColumn, 1, 1, 1, true, 'J', true);

        // reset pointer to the last page
        $pdf->lastPage();

	//Close and output PDF document
        $pdf->Output('example_007.pdf', 'I');

    }


    private function renderExcel()
    {
        $arrayRows = $this-> processData();

        $fp = fopen('tmp/file.csv', 'w');

        foreach ($arrayRows as $fields) {

            fputcsv($fp, $fields);
        }

        fclose($fp);

        $csvname = 'tmp/file.csv';

        if (file_exists($csvname)) {

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
