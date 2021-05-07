<?php  

    class PdfsController extends AppController  
    { 
        var $name = 'Tests'; 
        var $helpers = array('fpdf'); // this will use the pdf.php class 
         
        function indexPdf() 
        { 
            $this->layout = 'pdf'; //this will use the pdf.thtml layout 
            $this->set('data','hello world!'); 
            $this->render(); 
        } 
    } 

?>
