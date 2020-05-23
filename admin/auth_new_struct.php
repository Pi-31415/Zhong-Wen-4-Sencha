<?php echo
require('dbconfig.php');
$struct = htmlspecialchars($_GET["struct"]) ?? '-';
$description = htmlspecialchars($_GET["struct_description"]) ?? '-';

$sql = "INSERT INTO `SENSTRU` (`struct`, `struct_description`) VALUES ('$struct', '$description');";

echo $sql;


$result = $conn->query($sql);


$actual_link = str_replace("auth_new_struct.php","senstru.php",$_SERVER['PHP_SELF']);

header("Location: $actual_link");

?>
