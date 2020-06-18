<?php
//This script searches the sentence structures and returns txt
require('dbconfig.php');
$output = "";
$search = $_GET['s'] ?? "";
$sql = "SELECT * FROM SENSTRU WHERE struct LIKE '%$search%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $char = $row['struct'];
      $output .= "<ons-list  modifier=\"inset\">
        <ons-list-header><h3 style='color:#ef5350'>".$row['struct']."</h3></ons-list-header>
        <ons-list-item>".$row['struct_description']."</ons-list-item>
      <ons-list-item expandable>
       <span style='color:#f57c00;'>Show Examples</span>
       <div class=\"expandable-content\">
        <ons-list>";
      $id = $row['struct_id'];
      $sql2 = "SELECT * FROM SENEXAMPLE WHERE struct_id = '$id'";
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0) {
          // output data of each row
          $counter = 1;
          while($row1 = $result2->fetch_assoc()) {

            $sen = str_replace($char,"<span style='color:#ef5350'>".$char."</span>", $row1['sen']);

            $output .= "<ons-list-item style='font-size:1.1em;'><i>".$counter.". ".$sen."</i></ons-list-item>";
            //echo $row1['sen']."<br>";
            $counter = $counter + 1;
          }
      } else {
          $output .= "<ons-list-item>No example sentences.</ons-list-item>";
      }

      $output .= "</ons-list>
     </div>
    </ons-list-item>
  </ons-list><br>";
    }

    echo $output;
} else {
    echo "Sorry, no results are found.";
}


?>
