<!DOCTYPE html>
<html>
<?php
  require('admin/dbconfig.php');

  function getwordnumber($topic) {
    $dbhost = 'localhost';
    $dbuser = 'Paing_Thet_Ko';
    $dbpass = '2ndDennisRitchie';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$conn){
        //die('Could not connect to database - '.mysqli_error());
    }
    else{
        //echo'Connected to database successfully';
    }
    mysqli_select_db($conn,'ZW4');
    mysqli_set_charset($conn,"utf8");
    $sql = "SELECT COUNT('hanzi_id') FROM HANZI WHERE topic_id = '$topic'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          return $row["COUNT('hanzi_id')"];
        }
    } else {
        return "0 results";
    }
}

?>

<head>
	<title>Zhong Wen 4.0</title>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="A free online platform for revising full IB Mandarin Ab Initio syllabus with no ads">
		<meta name="keywords" content="IB, Mandarin, Ab Initio, International Baccalaureate">
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


		<!--Additional Libraries are loaded here. P5 is for the write only.-->
		<script src="https://code.responsivevoice.org/responsivevoice.js?key=kqPJ0rUe"></script>
		<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/hanzi-writer@1.3/dist/hanzi-writer.min.js"></script>

		<!--Main App Scripts come here-->

		<script src="./js/main.js" charset="utf-8"></script>
		<script src="./js/chinese.js" charset="utf-8"></script>
		<script src="./js/tutorial.js" charset="utf-8"></script>
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
					<ons-icon icon="ion-navicon, material:md-menu" onclick="togglemenu();"></ons-icon>
				</ons-toolbar-button>
			</div>
			<div class="center">中文 4.0</div>
			<div class="right">
				<ons-toolbar-button icon="md-help-outline" onclick="showPopover(flashcard);"></ons-toolbar-button>
			</div>
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

						<ons-list-item onclick="switchpage('flashcard')">
							Flashcards
						</ons-list-item>
						<ons-list-item onclick="switchpage('char')">
							Write Characters
						</ons-list-item>
						<ons-list-item onclick="switchpage('browse')">
							Browse Characters
						</ons-list-item>
						<ons-list-item onclick="switchpage('dict')">
							Dictation Mode
						</ons-list-item>
						<ons-list-item onclick="switchpage('sentence')">
							Sentences/ Notes
						</ons-list-item>
						<ons-list-item onclick="switchpage('shadow')">
							Shadowing Practice
						</ons-list-item>

						<ons-list-item onclick="switchpage('colophon')">
							Colophon
						</ons-list-item>

					</ons-list>
				</ons-page>
			</ons-splitter-side>
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
			<ons-card>
				<center>
					<h3>中文 (Zhong Wen)</h3>
					<img src="logo.png" height="100" width="100">
					<p>Version 4.0 (Sencha)</p>
					<ons-button modifier="large" class="homebtn" id="flashcard" onclick="switchpage('flashcard')">Flashcards - <ons-icon size="15px" icon="images"></ons-icon>
					</ons-button>
					<br><br>
					<ons-button modifier="large" class="homebtn" id="char" onclick="switchpage('char')">Write Characters - <ons-icon size="20px" icon="md-brush"></ons-icon>
					</ons-button>
					<br><br>
					<ons-button modifier="large" class="homebtn" id="browse" onclick="switchpage('browse')">Browse Characters - <ons-icon size="15px" icon="book-open"></ons-icon>
					</ons-button>
					<br><br>
					<ons-button modifier="large" class="homebtn" id="dict" onclick="switchpage('dict')">Dictation Mode - <ons-icon size="15px" icon="pencil-alt"></ons-icon>
					</ons-button>
					<br><br>
					<a href="monster.php" target="_blank">
						<ons-button modifier="large" class="homebtn">Character Recognition (PC only) - <ons-icon size="20px" icon="ion-eye"></ons-icon>
						</ons-button>
					</a>
					<br><br>
					<ons-button modifier="large" class="homebtn" onclick="switchpage('sentence')">Sentences / Notes - <ons-icon size="20px" icon="language"></ons-icon>
					</ons-button>
					<br><br>
					<ons-button modifier="large" class="homebtn" onclick="switchpage('shadow')">Shadowing Practice - <ons-icon size="15px" icon="headphones"></ons-icon>
					</ons-button>
					<br><br>
					<a href="shuo.html" target="_blank">
						<ons-button modifier="large" class="homebtn">Shuo (Pronunciation Tool) - <ons-icon size="20px" icon="ion-volume-high"></ons-icon>
						</ons-button>
					</a>

					<br><br>
					<ons-button modifier="large" class="homebtn" onclick="switchpage('colophon')">About - <ons-icon size="15px" icon="info-circle"></ons-icon>
					</ons-button>
					<br><br>
					<a href="pdfgen_hanzi.php">
						<ons-button modifier="large" class="homebtn">Wifi-Break? Download PDF (Vocabulary) - <ons-icon size="15px" icon="download"></ons-icon>
						</ons-button>
					</a>
					<br><br>
					<a href="pdfgen_gram.php">
						<ons-button modifier="large" class="homebtn">Wifi-Break? Download PDF (Grammar) - <ons-icon size="15px" icon="download"></ons-icon>
						</ons-button>
					</a>
					<br>

					<br>
				</center>
			</ons-card>
			<br>
			<center>
				<div class="chip">
					<img src="pi.jpg" alt="Pi">
					created by Pi @ LPCUWC/NYUAD, 2018-
					<?php echo date("Y"); ?>
				</div><br><br>

				<div id="dis">
					<ons-list modifier="inset">
						<ons-list-header style="color:red">Disclaimer</ons-list-header>
						<ons-list-item modifier="longdivider">Please note that for the Chinese characters which have more than one pronunciation (such as 长，得), the app may not pronounce the correct sound in the context.</ons-list-item>
					</ons-list>
				</div>
			</center>

			<br><br>
		</ons-page>
	</template>


	<!--This part is for the tutorial. Tutorial Popovers-->
	<ons-popover direction="up" id="popover" cancelable>
		<div style="padding: 10px; text-align: center;">
			<p>
				Hi, welcome to 中文 4.0. To get started, tap any of the buttons below.
			</p>
		</div>
	</ons-popover>


	<template id="sandbox.html">
		<ons-page id="sandbox">
			<ons-card>
				<div class="title">
					Sandbox Area
				</div>
				<div class="content">
					<p>Zhong Wen 4.0 is a web-based Chinese learning app created by Pi, based on the IB Mandarin Ab Initio Syllabus. It is free to use for everyone, without any charge and without any ads.</p>
				</div>

				<div class="hanzi-container-large" id="我有很多中文作业"></div>

				<div class="hanzi-container-large" id="我爸爸喜欢我的妈妈"></div>

				<div class="hanzi-container-large" id="爸爸长得很帅"></div>
				<br><br><br>
				<ons-button onclick="generatechar();">Genchar</ons-button>

			</ons-card>
			<br>
		</ons-page>
	</template>

	<!--These are the actual autogenerated menu pages-->

	<!--These are the actual autogenerated menu pages-->


	<template id="flashcard.html">
		<ons-page id="flashcard">
			<ons-fab position="top left" ripple onclick="switchpage('home')">
				<ons-icon icon="md-arrow-back"></ons-icon>
			</ons-fab>
			<div class="fabescape"></div>
			<ons-card>
				<div class="title">
					Flashcards
				</div>
				<div class="content">
					<center>
						<p>Choose a topic</p>
						<table style="width:100%">
							<tr>
								<th>Topic</th>
							</tr>
							<?php
                      $sql = "SELECT * FROM TOPIC ORDER BY year,topic_name";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {

                            $wordcount = " <i><span style='color:#ef5350'> - (".getwordnumber($row['topic_id'])." words)</span></i>";

                            $string = "<tr><td><a style='color:#111;' href='flashcard.php?deck=".$row["topic_id"]."'>".$row["topic_name"].$wordcount."</a></td></tr>";
                              echo $string;
                          }
                      } else {
                          echo "0 results";
                      }
                       ?>

						</table>
					</center>
				</div>
			</ons-card>
			<br>
		</ons-page>
	</template>


	<template id="sentence.html">
		<ons-page id="sentence">
			<ons-fab position="top left" ripple onclick="switchpage('home')">
				<ons-icon icon="md-arrow-back"></ons-icon>
			</ons-fab>
			<div class="fabescape"></div>
			<ons-card>
				<div class="title">
					Sentence Structures</div>
				<div class="content">
					<p>Here are Pi's own notes for the Mandarin sentence structures. They are for the entire syllabus, so try searching only the ones you need. Pi does not guarantee that everything is correct, but good enough is good enough. Use at your own risk.</p><p>You can click on the example sentences to hear them.</p><br>
					<p style="text-align: center;">
						<ons-search-input placeholder="Search" id="sensearchbar" onchange="sentencesearch(this.value);"></ons-search-input><br><br>
						<ons-button onclick="sentencesearch(document.getElementById('sensearchbar').value);">Search</ons-button>
					</p> <br>
					<div id="sentencedisplay">
						<?php
$output = "";
$sql = "SELECT * FROM SENSTRU";
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

            $output .= "<ons-list-item style='font-size:1.1em;'><i onclick=\"speakchin('".explode("(",$row1['sen'])[0]."')\">".$counter.". ".$sen."</i></ons-list-item>";
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
					</div>

				</div>
			</ons-card>
			<br>
			<script type="text/javascript">
				function sentencesearch(query) {
					document.getElementById('sentencedisplay').innerHTML = "";

					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById('sentencedisplay').innerHTML =
								this.responseText;
						}
					};
					xhttp.open("GET", "./admin/sensearch.php?s=" + query, true);
					xhttp.send();

				}

			</script>
		</ons-page>
	</template>

	<template id="shadow.html">
		<ons-page id="shadow">
			<ons-fab position="top left" ripple onclick="switchpage('home')">
				<ons-icon icon="md-arrow-back"></ons-icon>
			</ons-fab>
			<div class="fabescape"></div>
			<ons-card>
				<div class="title">
					Shadowing Practice
				</div>
				<div class="content">
					<p style="color:red;">It is recommended to use on a computer or the voice will not work properly on a phone.</p>
					<p>Choose a paragraph. Have a quick look, then repeat after the voice.</p>
					<br><br>
					<div id="dis">
						<ons-list modifier="inset">
							<ons-list-header style="color:red">Additional Resources</ons-list-header>
							<ons-list-item modifier="longdivider">If you are using the Chinese Made Easy Books 1 and 2 (which are the books you get in the class), the audio files for those books can be found - <a href="https://www.chinesemadeeasy.com/techDetail.aspx?id=1" target="_blank"> here </a> - and - <a href="https://www.chinesemadeeasy.com/techDetail.aspx?id=2" target="_blank"> here. </a><br><br>More listening resources on different Chinese accents are available on - <a href="https://hanyu123.weebly.com/" target="_blank">https://hanyu123.weebly.com/</a><br><br>Tool to convert Chinese Paragraphs into pinyin and meaning - <a href="https://www.pin1yin1.com" target="_blank">https://www.pin1yin1.com</a></ons-list-item>
						</ons-list>
					</div>
					<br><br>

					<table style="width:100%">
						<tr>
							<th>Topic</th>
						</tr>
						<?php
                      $sql = "SELECT * FROM SHADOW";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            $string = "<tr><td><a style='color:#111;' href='shadow.php?deck=".$row["txt_id"]."'><h3>".$row["title"]."</h3>".$row["about"]."</a></td></tr>";
                              echo $string;
                          }
                      } else {
                          echo "0 results";
                      }
                       ?>

					</table>
					<br>
				</div>
			</ons-card>
			<br>
		</ons-page>
	</template>


	<template id="char.html">
		<ons-page id="char">
			<ons-fab position="top left" ripple onclick="switchpage('home')">
				<ons-icon icon="md-arrow-back"></ons-icon>
			</ons-fab>
			<div class="fabescape"></div>
			<ons-card>
				<div class="title">
					Write Characters
				</div>
				<div class="content">
					<center>
						<p>Choose a topic. <br> Select "Learn" if you do not know how to write.<br> Select "Practice" if you already know and want to practice.</p>
						<br>
						<table style="width:100%">
							<tr>
								<th>Topic</th>
								<th> </th>
								<th> </th>
							</tr>
							<?php
            $sql = "SELECT * FROM TOPIC ORDER BY year,topic_name";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  $wordcount = " <i><span style='color:#ef5350'> - (".getwordnumber($row['topic_id'])." words)</span></i>";
                  $string = "<tr><td>".$row["topic_name"].$wordcount."</td><td><a style='color:#ef5350;' href='write_learn.php?deck=".$row["topic_id"]."'>[Learn]</td><td><a style='color:#ef5350;' href='write.php?deck=".$row["topic_id"]."'>[Practice]</td></tr>";
                    echo $string;
                }
            } else {
                echo "0 results";
            }
             ?>

						</table>



					</center>
				</div>
			</ons-card>
			<br>
		</ons-page>
	</template>

	<template id="browse.html">
		<ons-page id="browse">
			<ons-fab position="top left" ripple onclick="switchpage('home')">
				<ons-icon icon="md-arrow-back"></ons-icon>
			</ons-fab>
			<div class="fabescape"></div>
			<ons-card>
				<div class="title">
					Browse Characters
				</div>
				<div class="content">
					<center>
						<p>Choose a topic.</p>
						<table style="width:100%">
							<tr>
								<th>Topic</th>
							</tr>
							<?php
                      $sql = "SELECT * FROM TOPIC ORDER BY year,topic_name";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            $wordcount = " <i><span style='color:#ef5350'> - (".getwordnumber($row['topic_id'])." words)</span></i>";
                            $string = "<tr><td><a style='color:#111;' href='browse.php?deck=".$row["topic_id"]."'>".$row["topic_name"].$wordcount."</a></td></tr>";
                              echo $string;
                          }
                      } else {
                          echo "0 results";
                      }
                       ?>

						</table>



					</center>
				</div>
			</ons-card>
			<br>
		</ons-page>
	</template>


	<template id="dict.html">
		<ons-page id="dict">
			<ons-fab position="top left" ripple onclick="switchpage('home')">
				<ons-icon icon="md-arrow-back"></ons-icon>
			</ons-fab>
			<div class="fabescape"></div>
			<ons-card>
				<div class="title">
					Dictation Mode
				</div>
				<div class="content">
					<center>
						<p>Get a pen and a paper, turn up the volume and choose a topic.</p>
						<table style="width:100%">
							<tr>
								<th>Topic</th>
							</tr>
							<?php
                      $sql = "SELECT * FROM TOPIC ORDER BY year,topic_name";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            $wordcount = " <i><span style='color:#ef5350'> - (".getwordnumber($row['topic_id'])." words)</span></i>";
                            $string = "<tr><td><a style='color:#111;' href='dictation.php?deck=".$row["topic_id"]."'>".$row["topic_name"].$wordcount."</a></td></tr>";
                              echo $string;
                          }
                      } else {
                          echo "0 results";
                      }
                       ?>

						</table>



					</center>
				</div>
			</ons-card>
			<br>
		</ons-page>
	</template>


	<!--Colophon as in Jon's site, please do not edit anymore-->
	<template id="colophon.html">
		<ons-page id="colophon">
			<ons-fab position="top left" ripple onclick="switchpage('home')">
				<ons-icon icon="md-arrow-back"></ons-icon>
			</ons-fab>
			<div class="fabescape"></div>
			<ons-card>

				<div class="title">
					Colophon
				</div>
				<div class="content">
					<p>This section is inspired by <a href="https://www.jon.hk/jon/colophon.html">Jon Chui's website</a> and it features the list of libraries and other resources used to build 中文 4.0.</p>
					<p>The content of 中文 4.0 is based on the International Baccalaureate Diploma Program - Mandarin Ab Initio Syllabus taught at Li Po Chun United World College of Hong Kong and the Chinese Minor classes at New York University Abu Dhabi.</p>
					<center>
						<h3>中文 (Zhong Wen)</h3>
						<img src="logo.png" height="100" width="100">
						<p>Version 4.0 (Sencha)</p>
					</center>
					<br>
					<ons-list-header>The source code is written using </ons-list-header>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://seeklogo.com/images/A/atom-logo-19BD90FF87-seeklogo.com.png">
						</div>
						<div class="center">
							<span class="list-item__title">Atom</span><span class="list-item__subtitle"><a href="https://atom.io/">https://atom.io/</a></span>
						</div>
					</ons-list-item>
					<ons-list-header>This repository lives on Github as </ons-list-header>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png">
						</div>
						<div class="center">
							<span class="list-item__title">ZhongWen4.0</span><span class="list-item__subtitle"><a href="https://github.com/Pi-31415/ZhongWen4.0">https://github.com/Pi-31415/ZhongWen4.0</a></span>
						</div>
					</ons-list-item>
					<br><br>
					<p>The list of Javascript libraries used are </p>
					<ons-list-header>User Interface</ons-list-header>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://onsen.io/images/logo/onsen_with_text.png">
						</div>
						<div class="center">
							<span class="list-item__title">Onsen UI</span><span class="list-item__subtitle"><a href="https://onsen.io/">https://onsen.io/</a></span>
						</div>
					</ons-list-item>
					<ons-list-header>Graphics and Interaction</ons-list-header>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://p5js.org/assets/img/p5js.svg">
						</div>
						<div class="center">
							<span class="list-item__title">p5js</span><span class="list-item__subtitle"><a href="https://p5js.org/">https://p5js.org/</a></span>
						</div>
					</ons-list-item>
					<ons-list-header>Text-To-Speech API</ons-list-header>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://responsivevoice.org/wp-content/uploads/2015/06/mouth.png">
						</div>
						<div class="center">
							<span class="list-item__title">ResponsiveVoiceJS</span><span class="list-item__subtitle"><a href="https://responsivevoice.org/">https://responsivevoice.org/</a></span>
						</div>
					</ons-list-item>
					<ons-list-header>Images</ons-list-header>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://image.flaticon.com/teams/slug/google.jpg">
						</div>
						<div class="center">
							<span class="list-item__title">Google Images</span><span class="list-item__subtitle">All images used in this app, apart from the logo, are extracted from Google images. All images are the properties of their respective owners. Zhong Wen 4.0 or Pi does not own the images unless stated otherwise.</span>
						</div>
					</ons-list-item>
					<br><br>
					<p>Chinese Character Stroke Orders</p>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="http://1.bp.blogspot.com/-HAnef2oRL04/T5dIJ88rAuI/AAAAAAAAAbs/Zop2U6swX-o/s1600/chinese_character_ni_you.jpg">
						</div>
						<div class="center">
							<span class="list-item__title">Hanzi Writer</span><span class="list-item__subtitle"><a href="https://chanind.github.io/hanzi-writer/">https://chanind.github.io/hanzi-writer/</a></span>
						</div>
					</ons-list-item>
					<br><br>
					<p>The icons used are the open source icons from</p>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://www.joshmorony.com/media/2018/05/ionicons.png">
						</div>
						<div class="center">
							<span class="list-item__title">Ionicons</span><span class="list-item__subtitle"><a href="https://ionicons.com/">https://ionicons.com/</a></span>
						</div>
					</ons-list-item>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://material.io/tools/icons/static/ic_material_192px_light.svg">
						</div>
						<div class="center">
							<span class="list-item__title">Material Design Icons</span><span class="list-item__subtitle"><a href="https://material.io/tools/icons/?style=baseline">https://material.io/tools/icons/</a></span>
						</div>
					</ons-list-item>
					<ons-list-item>
						<div class="left">
							<img class="list-item__thumbnail" src="https://www.drupal.org/files/project-images/font_awesome_logo.png">
						</div>
						<div class="center">
							<span class="list-item__title">Font Awesome</span><span class="list-item__subtitle"><a href="https://fontawesome.com/icons">https://fontawesome.com/icons</a></span>
						</div>
					</ons-list-item>
					<br><br>
				</div>
			</ons-card>
			<br>
		</ons-page>
	</template>

</body>

</html>
