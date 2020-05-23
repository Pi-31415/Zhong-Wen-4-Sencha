<?php
require('admin/dbconfig.php');

$maxhanziid = 0;

 $sql = "SELECT MAX(hanzi_id) FROM HANZI";
    $result = $conn->query($sql);
    while ( $row = $result->fetch_assoc())  {
    $maxhanziid = $row['MAX(hanzi_id)'];
  }

$random_id = rand(0,$maxhanziid);

 $sql = "SELECT * FROM HANZI where hanzi_id =".$random_id;
    $result = $conn->query($sql);
    while ( $row = $result->fetch_assoc())  {
    $hanzi = $row['word'];
    $meaning = ucfirst($row['meaning']);
    $pinyin = strtolower($row['pinyin']);
    $img_id = strtolower($row['img_id']);
  }


$sql = "SELECT * FROM IMG where img_id =".$img_id;
    $result = $conn->query($sql);
    while ( $row = $result->fetch_assoc())  {
    $img_url = $row['img_name'];
  }

$img_url_final = "\"uploads/".$img_url."\"";

?>


<!DOCTYPE html>

    <head><meta charset="UTF-8"> <title>Character 
Recognition</title></head>
    <body>
        
    <center>
    Press <b>Space</b> for next word.
        Press <b>Q</b> to show meaning.<br><br>
        <p style="font-size:7em;"><?=$hanzi?></p>
        <div id="meaningslide">
        <p style="font-size:2em;"><i><?=$pinyin?></i><br><?=$meaning?></p> 
            <img src=<?=$img_url_final?> height="300px;">
        </div>
        
    </center>
        
        <script>
            var meaning = document.getElementById("meaningslide");
            meaning.style.visibility = "hidden";
        
            function showmeaning(){
                meaning.style.visibility = "visible";
            }
            
            
            document.body.onkeyup = function(e){
                if(e.keyCode == 81){
                    showmeaning()
                }
                if(e.keyCode == 32){
                   location.reload();
                }
            }
            
        </script>
    </body>
</html>










