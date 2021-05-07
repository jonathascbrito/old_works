<?php
    App::import('Vendor','tcpdf/tcpdf');
    header("Content-type: application/pdf");

    class Report extends TCPDF {

        public function __construct($title) {
            parent::__construct();
            $this->title_for_layout = $title;
        }

        public function Header() {
            $this->Image(FULL_BASE_URL . '/' . IMAGES_URL . 'logo-big.png', $this->w-$this->original_rMargin-50, 10, 50, '', 'PNG');

            $this->SetY(20, true);
            $this->SetX($this->original_lMargin);
            $this->SetFont('helvetica', '', 14);
            $this->Cell(0, 15, $this->title_for_layout, 0, false, 'L', 0, '', 0, false, 'M', 'M');

            $this->SetY(25, true);
            $this->SetX($this->original_lMargin);
            $this->SetFont('helvetica', 'I', 9);
            $this->Cell(0, 15, 'Gerado em: ' . date('d/m/Y H:i \G\M\T'), 0, false, 'L', 0, '', 0, false, 'M', 'M');

            $this->SetY(35, true);
            $line_width = (0.85 / $this->k);
            $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(60,60,60)));
            $this->Cell($this->w-$this->original_lMargin-$this->original_rMargin, 0, '', 'T', 0, 'C');
        }

        public function Footer() {
            $this->SetY(-15);

            $line_width = (0.85 / $this->k);
            $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(60,60,60)));
            $this->Cell($this->w-$this->original_lMargin-$this->original_rMargin, 0, '', 'T', 0, 'C');

            $this->SetX($this->original_lMargin);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        }
    }

    $pdf = new Report($title_for_layout);

    $pdf->SetAuthor("MVTL - Sistema de Gestão");
    $pdf->SetTitle($title_for_layout);

    $pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(true, 30);

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('helvetica','',9);

    $pdf->AddPage();

    $pdf->writeHTML($content_for_layout, true, 0, true, 0);
    $pdf->Output('relatorio-' . mb_strtolower(str_replace(' ', '-', $title_for_layout)) . date('-d-m-Y-H-i\G\M\T') . '.pdf', 'D');
?>