<?php
$dbhost = 'localhost';
$dbuser = '***';
$dbpass = '***';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(!$conn){
    //die('Could not connect to database - '.mysqli_error());
}
else{
    //echo'Connected to database successfully';
}
mysqli_select_db($conn,'ZW4');
mysqli_set_charset($conn,"utf8");

//A function to take out english characters out of chinese
function takeouteng($chin) {
  $englishalphabet = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
  foreach ($englishalphabet as $value) {
    $valuebig = strtoupper($value);
    if (strpos($chin,$value) !== false) { //first we check if the url contains the string 'en-us'
      $chin = str_replace($value, "", $chin); //if yes, we simply replace it with en
    }
    if (strpos($chin,$valuebig) !== false) { //first we check if the url contains the string 'en-us'
      $chin = str_replace($valuebig, "", $chin); //if yes, we simply replace it with en
    }

  }
    $chin2 = str_replace("...","",$chin);
return $chin2;
}





 ?>
