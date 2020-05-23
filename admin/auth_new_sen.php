<?php echo
require('dbconfig.php');
$struct_id = htmlspecialchars($_GET["structure"]) ?? '-';
$sentence = htmlspecialchars($_GET["sentence"]) ?? '-';

$sql = "INSERT INTO `SENEXAMPLE` (`struct_id`, `sen`) VALUES ('$struct_id', '$sentence');";

echo $sql;


$result = $conn->query($sql);


$actual_link = str_replace("auth_new_sen.php","sen.php",$_SERVER['PHP_SELF']);

header("Location: $actual_link");

?>
