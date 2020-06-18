<?php
require('admin/dbconfig.php');
$deck = $_GET['deck'] ?? 1;

//get deckname
$deckname = "none";
$sql = "SELECT * FROM SHADOW where txt_id = '$deck'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $shadow_title = "Sentence Pronounciation";
      $shadow_about = "N/A";
      $shadow_txt = "昨天妈妈生病了，她头疼，嗓子疼，还咳嗽。妹妹从今天早上开始不舒服，发烧三十九度。医生说弟弟感冒了，让他在家休息两天。医生给我开了很多药，还给我开了一张病假条。哥哥昨天吃了太多辣的和冷的东西，他今天开始肚子疼，还拉肚子。";

    }
} else {
    echo "0 results";
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Zhong Wen 4.0 </title>

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

    <script src="https://code.responsivevoice.org/responsivevoice.js?key=kqPJ0rUe"></script>
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
      <div class="center">Shadowing - <?=$shadow_title?></div>

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


      <ons-card class="shadowcard">
        <div class="title">
          Settings
        </div>
        <!--<img src="https://cdn.thegentlemansjournal.com/wp-content/uploads/2017/10/greatwall-900x600-c-center.jpg" alt="Onsen UI" style="width: 70%">
        --><div class="content">
<p>Adjust the settings, then click Start Shadowing. <span style="color:red;">Please note that the male voice currently does not work properly when sentences are not shown, so please use female voice instead if it happens. <b>Also, please go back if the shadowing is completed.</b></span></p>
<h4>Voice</h4>
<ons-list>
    <ons-list-item tappable>
      <label class="left">
        <ons-radio name="gender" input-id="rmale" value="Chinese Female" checked></ons-radio>
      </label>
      <label for="rmale" class="center">
        Female (女)
      </label>
    </ons-list-item>
    <ons-list-item tappable>
      <label class="left">
        <ons-radio name="gender" input-id="rfemale" value="Chinese Male"></ons-radio>
      </label>
      <label for="rfemale" class="center">
        Male (男)
      </label>
    </ons-list-item>
  </ons-list>

<h4>Speed</h4>

  <ons-row>
      <ons-col width="40px" style="text-align: center; line-height: 31px;">
        <ons-icon icon="fa-walking" size="30px" ></ons-icon>
        <span>Slow</span>
      </ons-col>
      <ons-col>
        <ons-range name = "speed" style="width: 100%;" value="45" id="speedr"></ons-range>
      </ons-col>
      <ons-col width="40px" style="text-align: center; line-height: 31px;">
        <ons-icon icon="fa-fighter-jet" size="30px" ></ons-icon>
        <span>Fast</span>
      </ons-col>
    </ons-row>
    <ons-list>
    <ons-list-item tappable>
      <label class="left">
        <ons-checkbox input-id="check-1" name ="showsen" id = "showsen" checked></ons-checkbox>
      </label>
      <label for="check-1" class="center">
        Show Sentences (be careful)
      </label>
    </ons-list-item>
  <center><br>
<ons-button onclick="shadow();">Start Shadowing</ons-button>
  </center>
        </div>
      </ons-card>

<br><div id="shadowtextcard">
      <ons-card class="shadowcard">
        <div class="title">
          <?=$shadow_title?>
        </div>
        <!--<img src="https://cdn.thegentlemansjournal.com/wp-content/uploads/2017/10/greatwall-900x600-c-center.jpg" alt="Onsen UI" style="width: 70%">
        --><div class="content">
        <center><p id="shadowtextxp"></p></center>
        <div class="shadowtext" id="shadowtextx"><?=$shadow_txt?></div>

        <div id="split"></div>


        </div>
      </ons-card>
</div>


<br><br>
<script type="text/JavaScript">
//preset value
var speaker = 'Chinese Male';

var showsentence = true;

var speed = 0.90;

var data = document.getElementById("shadowtextx").innerHTML;

function stop(){
  responsiveVoice.cancel();
}


function speak(x){
  responsiveVoice.speak(x, speaker, {
      rate: speed
  });
}


function split() {
    document.getElementById("shadowtextx").innerHTML = "";

    var str = data;
    var res0 = str;
    var res1 = res0.replace("?", "。");
    var res2 = res1.replace(".", "。");
    var res3 = res2.replace("!", "。");
    var res4 = res3.replace(/\n/g,"");
    var res5 = res4.replace(/(?:\r\n|\r|\n)/g, '');
    var res = res5.split("。");
    var i;

    if (showsentence){
      document.getElementById("shadowtextx").innerHTML += "<ons-list>";
      document.getElementById("shadowtextxp").innerHTML += "Tap on each sentence to hear.";
      for (i = 0; i < res.length - 1; i++) {
          document.getElementById("shadowtextx").innerHTML += "<ons-list-item style = 'margin-top:10px;margin-bottom:10px;line-height: 100%;' tappable onclick=\"update();speak('"+res[i]+"');\">"+(i+1)+". "+res[i]+"。</ons-list-item>";
      }
      document.getElementById("shadowtextx").innerHTML += "</ons-list>";
    }
    else{


      document.getElementById("shadowtextcard").innerHTML = "<center><ons-button onclick=\"stop();\">Stop</ons-button></center>";

      for (i = 0; i < res.length - 1; i++) {
        speak(res[i]);
      }

      responsiveVoice.speak('Shadowing is finished. You may go back.', 'UK English Male', {
          rate: 1
      });

    }

}

function update(){
  speaker = document.querySelector('input[name="gender"]:checked').value;

  showsentence =document.getElementById("showsen").checked;

  speed = 2*(document.getElementById("speedr").value/100);
}


function shadow(){

  speaker = document.querySelector('input[name="gender"]:checked').value;

  showsentence =document.getElementById("showsen").checked;

  speed = 2*(document.getElementById("speedr").value/100);

  split();

}
</script>
    </ons-page>
  </template>

</body>

</html>
