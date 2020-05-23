<?php
//This is the application programming interface for the Zhong Wen Offline API
header('Content-Type: text/html; charset=utf-8');

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



require('admin/dbconfig.php');
$string = "";

if ($_GET['data'] == 'hanzi'){
    $topic = $_GET['topic'];
    $sql = "SELECT * FROM HANZI WHERE topic_id = ".$topic;
    $result = $conn->query($sql);
    $dbdata = array();
  while ( $row = $result->fetch_assoc())  {
    $row['word'] = $row['word'];
	$dbdata[]=$row;
  }
 echo json_encode($dbdata);
}

else if ($_GET['data'] == 'topic'){
    $sql = "SELECT * FROM TOPIC";
    $result = $conn->query($sql);
$dbdata = array();
  while ( $row = $result->fetch_assoc())  {
    $row['word'] = $row['word'];
	$dbdata[]=$row;
  }
 echo json_encode($dbdata);
}

else if ($_GET['data'] == 'max'){
    $sql = "SELECT MAX(topic_id) FROM TOPIC";
    $result = $conn->query($sql);
    while ( $row = $result->fetch_assoc())  {
    echo $row['MAX(topic_id)'];
  }
}


else if ($_GET['data'] == 'hanzionly'){
    $sql = "SELECT * FROM HANZI";
    $result = $conn->query($sql);
    while ( $row = $result->fetch_assoc())  {
    echo $row['word'];
  }
}

else if ($_GET['data'] == 'hanzionlycs'){
    $sql = "SELECT * FROM HANZI";
    $result = $conn->query($sql);
    while ( $row = $result->fetch_assoc())  {
    echo "\"".$row['word']."\",";
  }
}


?>
