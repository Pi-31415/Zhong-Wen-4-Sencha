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
//General PHP functions for the rotating

 ?>
<!DOCTYPE html>
<html>

<head>
    <title>Zhong Wen 3.0 </title>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--faviconvicon Management-->
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
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/faviconvicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="favicon/faviconvicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/faviconvicon-16x16.png">
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

<body onload="localStorage.setItem('curdeck',<?=$deck?>);switchpage('home');">
    <!--This script is required to set Materail Design as Default-->
    <script>
        ons.platform.select('android');

    </script>

    <ons-page>
        <ons-toolbar>
            <div class="left">
                <ons-toolbar-button>
                    <a href="index.php" style="color:white;">
                        <ons-icon icon="md-arrow-back"></ons-icon>
                    </a>
                </ons-toolbar-button>
            </div>
            <div class="center">
                <?=$deckname ?> - Flashcards</div>



        </ons-toolbar>
        <div id="progressbar"></div>

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

            <ons-fab position="bottom left">
              <ons-icon icon="md-volume-up" onclick="speakchin(localStorage.curchin);"></ons-icon>
            </ons-fab>
            <br>
            <!--Chinese card front-->
            <ons-card id = "card_chin_front">
                <center>
                    <h1>
                        <div class="card-meaning"></div>
                    </h1>
                    <div class="card-img"></div>
                      <br><br>
                    <ons-button class="btn-show">
                        Show Answer (Space)
                    </ons-button>
                    <br> <br>
                </center>
            </ons-card>

            <!--Chinese card back-->

            <ons-card id = "card_chin_back">
                <div class="title card-meaning">
                </div>
                <div class="content">
                    <div class="chinword card-word" onclick="speakchin(localStorage.curchin);"></div>
                    <div class="pinyin card-pinyin" onclick="speakchin(localStorage.curchin);"> </div>
                    <br>
                    <div class="card-stroke"></div>
                    <center>
                        <div class="card-img"></div>
                    </center>
                    <br><br>
                    <center>
                        <div class="button-bar" style="width:280px;">
                            <div class="button-bar__item">
                                <button class="button-bar__button btn-know">Know (Q)</button>
                            </div>
                            <div class="button-bar__item">
                                <button class="button-bar__button btn-dunnoknow">Don't Know (R)</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="card-fact"></div>
                    </center>
                </div>
                <br>
            </ons-card>

            <!--English card front-->
            <ons-card id = "card_eng_front">
                <center> <br>
                    <div class="chinesebig card-word">
                        Sorry, no words are here.
                    </div>
                    <br> <br>
                    <ons-button  class="btn-show">
                        Show Answer (Space)
                    </ons-button>
                    <br> <br>
                </center>
            </ons-card>


            <!--English card back-->
            <ons-card id = "card_eng_back">
                <div class="title chinword card-word" onclick="speakchin(localStorage.curchin);" style='font-size:3em;'>
                    Sorry, no words are here.
                </div>
                <div class="content">
                    <div class="pinyin card-pinyin" onclick="speakchin(localStorage.curchin);"> </div>
                    <div class="card-meaning"> </div>
                    <br>
                    <center>
                      <div class="card-img"></div>
                    </center>
                    <br><br>
                    <center>
                        <div class="button-bar" style="width:280px;">
                            <div class="button-bar__item">
                                <button class="button-bar__button btn-know">Know (Q)</button>
                            </div>
                            <div class="button-bar__item">
                                <button class="button-bar__button btn-dunnoknow">Don't Know (R)</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="card-fact"></div>
                    </center>
                </div>
                <br>
            </ons-card>
            <br>
            <center><div id="study"></div></center>
            <br><br>
            <script src="js/flashcard.js" charset="utf-8"></script>
        </ons-page>
    </template>

</body>

</html>
