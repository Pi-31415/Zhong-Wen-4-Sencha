<?php echo
require('dbconfig.php');
$topic = htmlspecialchars($_GET["topic"]) ?? '-';
$word = htmlspecialchars($_GET["word"]) ?? '-';
$pinyin = htmlspecialchars($_GET["pinyin"]) ?? '-';
$meaning1 = htmlspecialchars($_GET["meaning"]) ?? '-';
$imgid = htmlspecialchars($_GET["imgid"]) ?? 1;
$fact1 = htmlspecialchars($_GET["fact"]) ?? '-';
$year = htmlspecialchars($_GET["year"]) ?? 1;


if($imgid == 0){
  $imgid = 1;
}

$meaning = str_replace("'","\'",$meaning1);
$fact = str_replace("'","\'",$fact1);

$sql = "INSERT INTO `HANZI` (`topic_id`, `word`, `pinyin`, `meaning`, `img_id`, `fact`, `year`) VALUES ('$topic', '$word', '$pinyin', '$meaning', '$imgid', '$fact', '$year');";

echo $sql;


$result = $conn->query($sql);


$actual_link = str_replace("auth_new_word.php","char.php",$_SERVER['PHP_SELF']);

header("Location: $actual_link");

?>
