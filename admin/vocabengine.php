<?php

//This PHP script contains all the functions for handling and rotating the hanzi requests provided the deck id
//This is to be used in the Write Characters and Flashcards Pages
//This page pumps out all the hanzi output in json, which is linked with AJAX to the pages.

$output = "";
$dbhost = 'localhost';
$dbuser = 'Paing_Thet_Ko';
$dbpass = '2ndDennisRitchie';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(!$conn){
    //die('Could not connect to database - '.mysqli_error());
}
else{
    //echo'Connected to database successfully';
}
mysqli_select_db($conn,'ZW4');
mysqli_set_charset($conn,"utf8");
$deck = $_GET['deck'] ?? 1;


$sql = "SELECT a.*, b.* FROM HANZI a, IMG b WHERE topic_id = '$deck' AND b.img_id = a.img_id ORDER BY hanzi_id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {



      $output .= json_encode($row).",";

    }

} else {
    echo "0 results";
}

$output = substr($output, 0, -1);

$output = "{\"hanzi\":[".$output."]}";

echo $output;
?>
