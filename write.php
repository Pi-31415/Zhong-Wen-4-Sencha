<?php
require('admin/dbconfig.php');
$deck = $_GET['deck'] ?? 15;
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
//General PHP functions for the rotating

 ?>
<!DOCTYPE html>
<html>

<head>
  <title>Zhong Wen 3.0</title>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Favicon Management-->
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
    <link rel="stylesheet" href="./css/onsenui.min.css">
    <link rel="stylesheet" href="./css/onsen-css-components.min.css">
    <link rel="stylesheet" href="./css/onsenui-core.min.css">
    <link rel="stylesheet" href="./css/onsenui-fonts.css">
    <link rel="stylesheet" href="./css/theme.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="./lib/jquery.min.js"></script>
    <script src="./lib/onsenui.min.js"></script>


    <script src="https://code.responsivevoice.org/responsivevoice.js?key=kqPJ0rUe"></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hanzi-writer@1.3/dist/hanzi-writer.min.js"></script>
    <script type="text/javascript" src="lib/p5.min.js"></script>
    <script type="text/javascript" src="lib/p5.play.js"></script>
    <!--Main App Scripts come here-->

    <script src="js/main.js" charset="utf-8"></script>
    <script src="js/chinese.js" charset="utf-8"></script>
    <script src="js/tutorial.js" charset="utf-8"></script>
  </head>
<body onload="localStorage.setItem('curdeck',<?=$deck?>);">
  <script>
    ons.platform.select('android');
  </script>

  <!--This write page is implemented with p5.js and fully working, don't edit this section and sketch.js-->
  <!--Note: clear function basically refresh the page, should store the word ID in localstorage first-->
  <ons-page>
    <ons-toolbar>
      <div class="left">
        <ons-toolbar-button>
          <a href="index.php" style="color:white;"><ons-icon icon="md-arrow-back"></ons-icon></a>
        </ons-toolbar-button>
      </div>
      <div class="center"><?=$deckname ?> - Write</div></div>

    </ons-toolbar>

    <!-- Warning: Do not edit the splitter code apart from list items -->
    <ons-splitter>
      <!-- The side menu -->
      <ons-splitter-side id="menu" collapse width="220px">
        <ons-page>
          <!-- Menu here -->
          <ons-list>

            <!-- Warning: Do not edit the parent splitter code apart from list items -->
            <!-- Warning: remember to change the name of the page files -->
            <ons-list-item>
              <a href="write.html">Write</a>
            </ons-list-item>
            <ons-list-item onclick="switchpage('components')">
              Components
            </ons-list-item>
            <ons-list-item onclick="switchpage('sandbox')">
              Sandbox
            </ons-list-item>
            <ons-list-item onclick="switchpage('colophon')">
              Colophon
            </ons-list-item>
          </ons-list>
        </ons-page>
      </ons-splitter-side>
      <!-- Everything not in the side menu -->
      <ons-splitter-content>
        <script type="text/javascript">
        localStorage.setItem('curdeck',<?=$deck?>);
        </script>
        <ons-navigator id="navigator">

            <script src="./js/sketch.js" charset="utf-8"></script>
            <ons-card id = "card_chin_front">
                <center>
                    <h3>
                        <div class="card-meaning"></div>
                    </h3>
                    <div class="card-img"></div>
                    <ons-button class="btn-show">
                        Show Answer (Space)
                    </ons-button>
                </center>
            </ons-card>

            <!--Chinese card back-->

            <ons-card id = "card_chin_back">
                <div class="content">
                  <div class="card-stroke" id="writestroke"></div>
                  <center>
                    <div class="pinyin card-pinyin" onclick="speakchin(localStorage.curchin);" style="clear: left;"></div>
                  <br>
                    <div class="button-bar" style="width:280px;clear: left;">
                        <div class="button-bar__item">
                            <button class="button-bar__button btn-know">Correct (Q)</button>
                        </div>
                        <div class="button-bar__item">
                            <button class="button-bar__button btn-dunnoknow">Wrong (R)</button>
                        </div>
                    </div>
                    </center>
                </div>
            </ons-card>
            <ons-fab position="bottom right" ripple>
              <ons-icon icon="md-delete" onclick="clearscreen();"></ons-icon>
            </ons-fab>
            <ons-fab position="bottom left">
              <ons-icon icon="md-volume-up" onclick="speakchin(localStorage.curchin);"></ons-icon>
            </ons-fab>
            <div id='p5canvas'></div>
            <script src="js/write.js" charset="utf-8"></script>

        </ons-navigator>
      </ons-splitter-content>
    </ons-splitter>
  </ons-page>



</body>

</html>
