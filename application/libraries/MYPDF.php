class MYPDF extends TCPDF {
    public function Footer() {
        $image_file = "img/bg_bottom_releve.jpg";
        $this->Image($image_file, 11, 241, 189, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $this->SetY(-15);
        $this->SetFont('helvetica', 'N', 6);
        $this->Cell(0, 5, date("m/d/Y H\hi:s"), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
