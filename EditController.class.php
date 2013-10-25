<?php

class EditController
{
    private function _processData()
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

        while ($i < $max) {

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


    private function _renderPdf()
    {
        include_once 'tcpdf/tcpdf.php';

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

            include_once dirname(__FILE__).'/lang/eng.php';
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

        if (isset($_POST['milieu'])) {

            $middleColumn = '<h1>Mots contenant "'.$_POST['lettre'].'" </h1>';

            $middleColumn .= implode('<br />', $_POST['milieu']);
        }

        if (isset($_POST['fin'])) {

            $rightColumn = '<h1>Mot finissant par "'.$_POST['lettre'].'" </h1>';

            $rightColumn .= implode('<br />', $_POST['fin']);
        }

        // get current vertical position
        $y = $pdf->getY();

        // set color for background
        $pdf->SetFillColor(255, 255, 255);

        // set color for text
        $pdf->SetTextColor(0, 0, 0);

        // write the first column
        $pdf->writeHTMLCell(60, '', '', $y, $leftColumn, 0, 0, 1, true, 'J', true);

        // set color for background
        $pdf->SetFillColor(255, 255, 255);

        // set color for text
        $pdf->SetTextColor(0, 0, 0);

        // write the first column
        $pdf->writeHTMLCell(60, '', '', '', $middleColumn, 0, 0, 1, true, 'J', true);

        // set color for background
        $pdf->SetFillColor(255, 255, 255);

        // set color for text
        $pdf->SetTextColor(0, 0, 0);

        // write the second column
        $pdf->writeHTMLCell(60, '', '', '', $rightColumn, 0, 1, 1, true, 'J', true);

        // reset pointer to the last page
        $pdf->lastPage();

        //Close and output PDF document
        $pdf->Output('example_007.pdf', 'I');
    }


    private function _renderExcel()
    {
        $arrayRows = $this->_processData();

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

                $this->_renderPdf();

            } else if ($_POST['editiontype'] === 'excel') {

                $this->_renderExcel();
            }
        }
    }
}
