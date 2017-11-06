<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    public function Footer() {

        $this->SetY(-15);
        $this->SetFont('Calibri', 'N', 6);
        $this->Cell(0, 5, date("m/d/Y H\hi:s"), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
