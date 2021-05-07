
<?php  
vendors('fpdf/fpdf'); 

if (!defined('PARAGRAPH_STRING')) define('PARAGRAPH_STRING', '~~~'); 

class fpdfHelper extends FPDF { 
    var $title;
    
    /** 
    * Allows you to change the defaults set in the FPDF constructor 
    * 
    * @param string $orientation page orientation values: P, Portrait, L, or Landscape    (default is P) 
    * @param string $unit values: pt (point 1/72 of an inch), mm, cm, in. Default is mm 
    * @param string $format values: A3, A4, A5, Letter, Legal or a two element array with the width and height in unit given in $unit
    */ 
    function setup ($orientation='P',$unit='mm',$format='A4') { 
        $this->FPDF($orientation, $unit, $format);  
    } 
    /** 
    * Allows you to control how the pdf is returned to the user, most of the time in CakePHP you probably want the string
    * 
    * @param string $name name of the file. 
    * @param string $destination where to send the document values: I, D, F, S 
    * @return string if the $destination is S 
    */ 
    function fpdfOutput ($name = 'page.pdf', $destination = 's') {
        // I: send the file inline to the browser. The plug-in is used if available.  
        //    The name given by name is used when one selects the "Save as" option on the link generating the PDF.
        // D: send to the browser and force a file download with the name given by name. 
        // F: save to a local file with the name given by name. 
        // S: return the document as a string. name is ignored. 
        return $this->Output($name, $destination); 
    } 
     
    function Header() 
    { 
        //Logo 
        $this->Image(WWW_ROOT.DS.'img/logo.png',10,8,33);   
        // you can use jpeg or pngs see the manual for fpdf for more info 
        //Arial bold 15 
        $this->SetFont('Arial','B',15); 
        //Move to the right 
        $this->Cell(80); 
        //Title 
        $this->Cell(30,10,$this->title,1,0,'C'); 
        //Line break 
        $this->Ln(20); 
    } 

    //Page footer 
    function Footer() 
    { 
        //Position at 1.5 cm from bottom 
        $this->SetY(-15); 
        //Arial italic 8 
        $this->SetFont('Arial','I',8); 
        //Page number 
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C'); 
    } 
} 
?>
