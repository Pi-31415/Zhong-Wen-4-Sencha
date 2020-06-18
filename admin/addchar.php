<?php
require('dbconfig.php');
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Zhong Wen 4.0 </title>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--../favicon Management-->
    <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../favicon/../favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/../favicon-16x16.png">
    <link rel="manifest" href="../favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/onsenui.min.css">
    <link rel="stylesheet" href="../css/onsen-css-components.min.css">
    <link rel="stylesheet" href="../css/onsenui-core.min.css">
    <link rel="stylesheet" href="../css/onsenui-fonts.css">
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../lib/jquery.min.js"></script>
    <script src="../lib/onsenui.min.js"></script>


    <!--Additional Libraries are loaded here. P5 is for the write only.-->

    <!--Main App Scripts come here-->

    <script src="../js/main.js" charset="utf-8"></script>
    <script src="../js/chinese.js" charset="utf-8"></script>
    <script src="../js/tutorial.js" charset="utf-8"></script>
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

      <div class="center">Characters</div>

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
      <a href="char.php">
        <ons-fab position="top left" ripple>
          <ons-icon icon="md-arrow-back"></ons-icon>
        </ons-fab>
      </a>
        <ons-card  style="width:95%">
          <center><h1>Add New Word</h1></center>
<form action="auth_new_word.php" method="get">
          <div style="margin-top: 30px;margin-left: 100px;">
<p>Topic</p>
            <ons-select id="choose-sel" name="topic">

                <?php

                $sql = "SELECT * FROM TOPIC ORDER BY year,topic_name";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {

                      $string = "<option value=\"".$row["topic_id"]."\">".$row["topic_name"]."</option>";

                      echo $string;

                    }
                } else {
                    echo "0 results";
                }


                 ?>

              </ons-select>
              <br>
<br>
              <p>
                <ons-input id="username" modifier="underbar" name = "word" placeholder="Word" float autofocus></ons-input>
              </p><br>
              <p>
                <ons-input id="username" modifier="underbar" name = "pinyin" placeholder="Pinyin" float></ons-input>
              </p><br>
              <p>
                <ons-input id="username" modifier="underbar" name = "meaning" placeholder="Meaning" float></ons-input>
              </p><br><a href="add_image.html" target="_blank">
              <ons-button>
                <ons-icon icon="md-plus"></ons-icon>
                Attach Image
              </ons-button></a><br>
              <p>
                <ons-input id="username" modifier="underbar" name = "imgid" placeholder="Image ID" float></ons-input>
              </p><br>
              <p>
                <ons-input id="username" modifier="underbar" name = "fact" placeholder="Fact" float></ons-input>
              </p><br>


              <ons-list>

    <ons-list-item tappable>
      <label class="left">
        <ons-radio name="year" input-id="radio-1"  value="1" checked></ons-radio>
      </label>
      <label for="radio-1" class="center">
        Year 1
      </label>
    </ons-list-item>

    <ons-list-item tappable>
      <label class="left">
        <ons-radio name="year" input-id="radio-2" value="2"></ons-radio>
      </label>
      <label for="radio-2" class="center">
        Year 2
      </label>
    </ons-list-item>

  </ons-list>
              <p style="margin-top: 30px;">
                <input type="submit" value="ADD WORD" class="form-submit-button">
              </p>
            </div>

</form>
        </ons-card>
      <br>
<br><br>
    </ons-page>
  </template>

</body>

</html>
