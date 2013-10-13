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


    private function renderPdf() {

require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

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

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

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
