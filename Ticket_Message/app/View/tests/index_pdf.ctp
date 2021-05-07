<?php 
    $fpdf->AliasNbPages();  // allows us to do the page numbering 
    $fpdf->AddPage(); 
    $fpdf->setTitle('Our Cool PDF'); 
    $pdf->SetFont('Times','',12); 
    for($i=1;$i<=40;$i++) 
        $fpdf->Cell(0,10,'Printing line number '.$i,0,1); // just fill up the page 
    echo $fpdf->fpdfOutput(); 
?>