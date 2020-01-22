<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE, $orientation = 'portrait') 
{

    require_once("dompdf/dompdf_config.inc.php");
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper('A4', $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
}

/* End of file dompdf_helper.php */
/* Location: ./application/helpers/dompdf_helper.php */
