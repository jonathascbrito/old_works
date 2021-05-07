<?php

class PdfReport extends FPDF
{
    protected $data;

    public function __construct($data){
        $this->data = $data;
        parent::__construct();
    }


    // Page header
    function Header()
    {
        // Logo
        $this->Image(WWW_ROOT . '/img/logo-cardim.png',10,6,40);
        /*
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(50);
        // Title
        $this->Cell(100,0,'Ordem de Serviço - ' . $this->data['Ticket']['code_number'] . '/' . $this->data['Ticket']['code_year'],0,0, 'C');
        // Line break
        $this->Ln(6);
        $this->Cell(50);
        // Username
        $this->SetFont('Arial',null,12);
        $this->Cell(100,0,utf8_decode($this->data['Entity']['name']),0,0, 'C');

        $this->Ln(8);
         * 
         */
    }

    // Page footer
    function Footer()
    {
        /*
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Ordem de Serviço - ' . $this->data['Ticket']['code_number'] . '/' . $this->data['Ticket']['code_year'] . utf8_decode(' - Página ').$this->PageNo().'/{nb}',0,0,'R');
        
        $this->SetY(-30);
        $this->SetX(120);
        $this->Cell(90,10,'_____________________________________________',0,0,'C');
        $this->Ln(3);
        $this->SetX(120);
        $this->Cell(90,10,utf8_decode($this->data['Entity']['name']),0,0,'C');
         * 
         */
    }

    public function setTable() {
        /*
        $days = date("t", mktime(0, 0, 0, $this->data['month'], 1, $this->data['year']));
        $data = array();

        foreach($this->data['pontos'] as $ponto){
            $date = strtotime($ponto['Ponto']['date']);
            $date = (int) date('d', $date);
            $data[$date] = array(
                'date' => ($date < 10 ? "0{$date}" : "{$date}") . '/' . $this->data['month'] . '/' . $this->data['year'],
                'e1' => $ponto['Ponto']['e1'],
                's1' => $ponto['Ponto']['s1'],
                'e2' => $ponto['Ponto']['e2'],
                's2' => $ponto['Ponto']['s2']
            );
        }

        for( $i=1; $i<=$days; $i++ ) {
            if ( ! isset($data[$i]) ){
                $data[$i] = array(
                    'date' => ($i < 10 ? "0{$i}" : "{$i}") . '/' . $this->data['month'] . '/' . $this->data['year'],
                    'e1' => '',
                    's1' => '',
                    'e2' => '',
                    's2' => ''
                );
            }
        }

        ksort($data);

        $this->BasicTable(array(utf8_decode('Data'),
                                utf8_decode('Entrada'),
                                utf8_decode('Saída'),
                                utf8_decode('Entrada'),
                                utf8_decode('Saída')), $data);
         * 
         */
    }
    // Simple table
    function BasicTable($header, $data)
    {
        /*
        $w = array(30, 40, 40, 40, 40);

        // Header
        $c=0;
        foreach($header as $col){
            $this->Cell($w[$c],7,$col,1, null,'C');
            $c++;
        }
        $this->Ln();
        // Data

        foreach($data as $row)
        {
            $c = 0;
            foreach($row as $col){
                $this->Cell($w[$c],6,$col,1,null, 'C');
                $c++;
            }
            $this->Ln();
        }
         * 
         */
    }

    // Better table
    function ImprovedTable($header, $data)
    {
        
        // Column widths
        //$w = array(15, 20, 20, 20, 20);
        // Header
        //for($i=0;$i<count($header);$i++)
        //    $this->Cell($w[$i],7,$header[$i],1,0,'C');
        //$this->Ln();
        // Data
        /*foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR');
            $this->Cell($w[1],6,$row[1],'LR');
            $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
            $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
            $this->Ln();
        }*/
        // Closing line
        //$this->Cell(array_sum($w),0,'','T');
        
        
    }

    // Colored table
    function FancyTable($header, $data)
    {
        /*
        // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(40, 35, 40, 45);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
            $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
         * 
         */
    }
}

?>