<?php
require('admin/dbconfig.php');
$deck = $_GET['deck'];

//get deckname
$deckname = "none";
$sql = "SELECT topic_name FROM TOPIC where topic_id = '$deck'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $deckname = $row["topic_name"];
    }
} else {
    echo "0 results";
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Zhong Wen 3.0 </title>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon Management-->
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta charset="utf-8">
    <link rel="stylesheet" href="css/onsenui.min.css">
    <link rel="stylesheet" href="css/onsen-css-components.min.css">
    <link rel="stylesheet" href="css/onsenui-core.min.css">
    <link rel="stylesheet" href="css/onsenui-fonts.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="lib/jquery.min.js"></script>
    <script src="lib/onsenui.min.js"></script>


    <!--Additional Libraries are loaded here. P5 is for the write only.-->

    <script src="http://code.responsivevoice.org/responsivevoice.js"></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hanzi-writer@1.3/dist/hanzi-writer.min.js"></script>
    <!--Main App Scripts come here-->

    <script src="js/main.js" charset="utf-8"></script>
    <script src="js/chinese.js" charset="utf-8"></script>
    <script src="js/tutorial.js" charset="utf-8"></script>
    <style>
    a {
      color: #fff;
    }
    </style>
  </head>

<body onload="switchpage('home');">
  <!--This script is required to set Materail Design as Default-->
  <script>
    ons.platform.select('android');
  </script>

  <ons-page>
    <ons-toolbar>
      <div class="left">
        <ons-toolbar-button>
          <a href="index.php" style="color:white;"><ons-icon icon="md-arrow-back"></ons-icon></a>
        </ons-toolbar-button>
      </div>
      <div class="center">Browse Characters</div>

    </ons-toolbar>

    <!-- Warning: Do not edit the splitter code apart from list items -->
    <ons-splitter>
      <!-- Everything not in the side menu -->
      <ons-splitter-content>
        <ons-navigator id="navigator">
        </ons-navigator>
      </ons-splitter-content>
    </ons-splitter>
  </ons-page>


  <!--From here to below are additional pages which appears on split view-->
  <!-- Home page template -->
  <template id="home.html">
    <ons-page id="home">
      <a href="index.html">
      </a>

      <ons-card  style="width:95%">
<!--Content goes here-->
<h1><?=$deckname?></h1>
<p>Tap on the Chinese words to hear the sound. </p>
<br><br>


<table style="width:100%">
  <tr>
    <th>Word</th>
    <th>Pinyin</th>
    <th>Meaning</th>
    <th class='browseimgheader'>Image</th>
  </tr>
<?php
$sql = "SELECT * FROM HANZI WHERE topic_id = '$deck' ORDER BY topic_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //This code is to get the topic
      $topicid = $row["topic_id"];
      $result2 = $conn->query("SELECT topic_name FROM TOPIC WHERE topic_id='$topicid'");
      $row2 = mysqli_fetch_array($result2);
      $topic = $row2['topic_name'];
      //This code is to get the image
      $imgid = $row["img_id"];
      $result3 = $conn->query("SELECT img_name FROM IMG WHERE img_id='$imgid'");
      $row3 = mysqli_fetch_array($result3);
      $img = "<img src=uploads/".$row3['img_name']." width='60px' class='browseimg'>";
      //editing link for each
      $edit = "<a href=\"\" style=\"color:#3eb489;\"><ons-icon icon=\"ion-edit\"></ons-icon></a>";

      $hanzistroke = "<div class=\"hanzi-container-large\" onclick=\"speakchin('".$row["word"]."')\" id=\"".$row["word"]."\"></div>";

      $string = "<tr>"."<td>"."<div class='chinword' onclick=\"speakchin('".$row["word"]."')\">".$row["word"]."</div>".$hanzistroke."</td>"."<td onclick=\"speakchin('".$row["word"]."')\">".strtolower($row["pinyin"])."</td>"."<td>".ucfirst($row["meaning"])."</td>"."<td>".$img."</td>"."</tr>";

        echo $string;

    }
} else {
    echo "0 results";
}


$conn->close();

 ?>




 </table>


<br><br>
      </ons-card>
<br><br>
<script type="text/javascript">
//This code automatically adjusts the chinese character size according to device width
var w = window.innerWidth;

var x = document.getElementsByClassName("browseimg");
var y = document.getElementsByClassName("browseimgheader");


if(w<800){
  generatechar(0);
  y[0].innerHTML = "";
  var l;
  for (l = 0; l < x.length; l++) {
    x[l].width = 0;
  }
}
else{
  generatechar(130);
  var l;
  for (l = 0; l < x.length; l++) {
    x[l].width = 90;
  }
}
</script>
    </ons-page>
  </template>

</body>

</html>
