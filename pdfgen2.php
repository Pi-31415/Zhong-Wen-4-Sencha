<?php
//This is the application programming interface for the Zhong Wen Offline API
header('Content-Type: text/html; charset=utf-8');

require('admin/dbconfig.php');


//Function to replace tofu pinyins

function replace_tofu($output) {
    $output = str_replace("̄","",$output);
    $output = str_replace("̌","",$output);
    $output = str_replace("́","",$output);
    $output = str_replace("̌","",$output);
    $output = str_replace("̌","",$output);
    $output = str_replace("̀","",$output);
    $output = str_replace("̀","",$output);
    $output = str_replace("̀","",$output);
    $output = str_replace("","",$output);   
    $output = str_replace("À","à",$output);
    $output = str_replace("È","è",$output);
    $output = str_replace("Ě","ě",$output);
    $output = str_replace("Ǒ","ǒ",$output);
    $output = str_replace(" ​","",$output);
    $output = str_replace("​","",$output);
    $output = str_replace("̄","",$output);
    $output = str_replace("̌","",$output);
    $output = str_replace("́","",$output);
    $output = str_replace("̌","",$output);
    $output = str_replace("̌","",$output);
    $output = str_replace("̀","",$output);
    $output = str_replace("̀","",$output);
    $output = str_replace("̀","",$output);
    $output = str_replace("","",$output);
    $output = str_replace(" ​","",$output);
    $output = str_replace("​","",$output);
    return $output;
}

$max_topic = 0;
$max_hanzi = 0;
$topics = array();
$hanzi = array();
$string_output = "";

//Determine maximum in topics
 $sql = "SELECT MAX(topic_id) FROM TOPIC";
    $result = $conn->query($sql);
    while ( $row = $result->fetch_assoc())  {
    $max_topic = $row['MAX(topic_id)']-1;
  }

$sql = "SELECT * FROM TOPIC";
$result = $conn->query($sql);
  while ( $row = $result->fetch_assoc())  {
      $topics[]=$row;
  }

//Get all Hanzi
$sql = "SELECT * FROM HANZI";
    $result = $conn->query($sql);
      while ( $row = $result->fetch_assoc())  {
          $hanzi[] = $row;
      }  

//Max Hanzi
$max_hanzi = count($hanzi)-1;

$currentDateTime = date('Y-M-d (H:i:s a)');

//PDF Generation
require('tfpdf.php');
$pdf = new tFPDF();
$pdf->AddPage("P","A4");

$pdf->Image('logo.png',180,6,20);


//  Add a Unicode font like MSJH
$pdf->AddFont('DejaVuSansMono','','DejaVuSansMono.ttf',true);
$pdf->SetFont('DejaVuSansMono','',10);

$pdf->AddFont('c','','KaiTi.ttf',true);
$pdf->SetFont('KaiTi','',18);
$countertitle = 1;

$pdf->SetFont('DejaVuSansMono','',10);
$infostring = "PDF automatically generated by Zhong Wen 4.0 on ".$currentDateTime;
$pdf->Write(5,$infostring);

//Get individual topics
for ($x = 0; $x <= $max_topic; $x++) {
    $counter = 1;
    
    $print_topic = $countertitle.". ".$topics[$x]['topic_name'];
    $current_topic_id = $topics[$x]['topic_id'];
    
    $pdf->SetFont('DejaVuSansMono','',12);
    $pdf->Write(5,"---------------------------------------\n".$print_topic."\n---------------------------------------\n");

    
    for ($y = 0; $y <= $max_hanzi; $y++) {
        
        if($hanzi[$y]['topic_id'] == $current_topic_id){ 
            
            $print_hanzi = $hanzi[$y]['word'];
            $print_pinyin = replace_tofu(strtolower($hanzi[$y]['pinyin']));
            $print_meaning = $hanzi[$y]['meaning'];
            
            
            $pdf->SetFont('DejaVuSansMono','',10);
            $pdf->Write(8,$counter.".   ");
            $pdf->SetFont('Kaiti','',18);
            $pdf->Write(8,$print_hanzi);
            $pdf->SetFont('DejaVuSansMono','',10);
            $pdf->Write(8,"    ( ".$print_pinyin." )      ".ucfirst($print_meaning)."\n");
            
            
            $counter++;
            
        }  
    }
   $countertitle++; 
}

class PDF extends tFPDF
{
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('DejaVuSansMono','',10);
        // Print centered page number
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}
$pdf->Footer();
//echo $string_output;
$pdf->Output();


?>
