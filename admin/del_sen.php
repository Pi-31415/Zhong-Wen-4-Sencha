<?php echo
require('dbconfig.php');

$sql = "delete from 'SENEXAMPLE' 
order by id desc limit 1";

echo $sql;


$result = $conn->query($sql);


$actual_link = str_replace("del_sen.php","index.html",$_SERVER['PHP_SELF']);

header("Location: $actual_link");

?>
