//This script handles the ajax function from the deck
var studied_all = false;
var mode = "English";
var charsize = 0;
var totalwords = 10;
var w = window.innerWidth;

if(w<800){
  charsize = 0;
}
else{
  charsize = 0;
}

localStorage.setItem("curchin", "");
function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min + 1) ) + min;
}
function jsUcfirst(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function jslower(string)
{
    return string.toLowerCase();
}
var percentage = 0;
var studytxt = "";
var curid = 0; //this keeps track of the hanzi variables
var know = false;

$( document ).ready(function() {
//hides all the card inititally


$("#instruct").html("Grab a pen and a paper. Turn up the volume.<br><br>There are "+(totalwords)+" words so write a list from 1 to "+(totalwords)+". <br><br> Listen carefully.<br><br><span style='color:red'>The words may repeat.</span>");
$("#btnstart").show();

$("#card_chin_back").hide();


var N = localStorage.cardcount;
//This code is to keep track of what is studied
var allhanziid = [];
var studiedhanziid = [];
var intersectionarray = [];
var differenceset = [];
for (var i = 0; i < N; i++) {
   allhanziid.push(i);
}

//This code is to switch the cards
function nextword(){
  $.ajax({url: "admin/vocabengine.php?deck="+localStorage.curdeck, success: function(result){
    if(percentage >= 100){
      studied_all = true;
      //alert('you have stuided all');
    }
    var obj = JSON.parse(result);
    var cardscount = obj.hanzi.length;
    allhanziid = [];
    for (var i = 0; i < cardscount; i++) {
       allhanziid.push(i);
    }
    curid = getRndInteger(0, cardscount-1);
    if(studied_all == false){
      if(studiedhanziid.includes(curid)){
        curid = getRndInteger(0, differenceset.length);
        curid = differenceset[curid];
      }
    }
    else{
      curid = getRndInteger(0, cardscount-1);
    }
    if (obj.hanzi[curid] == null){
      //alert('Problem');
      curid = 0;
    }
    var strokecode = "<div class=\"hanzi-container-large-quiz\" id=\""+obj.hanzi[curid].word+"\"></div>";
    var imgcode = "<img src=\"uploads/"+obj.hanzi[curid].img_name+"\" alt=\"\" style=\"width:100px\">";
    $(".card-meaning").html(jsUcfirst(obj.hanzi[curid].meaning));
    $(".card-stroke").html(strokecode);
    $(".card-img").html(imgcode);
    $(".card-fact").html(obj.hanzi[curid].fact);
    localStorage.setItem('firsthanzi', obj.hanzi[curid].word);

    generatequizchar(charsize);
    if (know == true){
      studiedhanziid.push(obj.hanzi[curid].word);
    }
    intersectionarray = Array.from(new Set(studiedhanziid));
    let a = new Set(allhanziid);
    let b = new Set(intersectionarray);
    let difference = new Set(
        [...a].filter(x => !b.has(x)));
    differenceset = Array.from(difference);
    percentage = (studiedhanziid.length/totalwords)*100;
    console.log(studiedhanziid);
    $(".card-pinyin").html("Word " + (studiedhanziid.length));
    console.log("Percentage completed:"+percentage);
    $("#progressbar").html("<ons-progress-bar value=\""+percentage+"\"></ons-progress-bar>");
    localStorage.setItem("curchin", obj.hanzi[curid].word);
    speakchin(localStorage.curchin);
  }});
}

function knowf(){
  know = true;
  nextword();
}


function showmark(){

  $("#btnstart").hide();
  $("#card_chin_back").html("");

  var answer = "";
  var id = 1;
  studiedhanziid.forEach(function(entry) {
      answer += id+". "+entry+"<br>";
      id++;
  });

  $("#card_chin_back").html("<div class='chinese' style='font-size:2em;'>"+answer+"</div>");
  $("#card_chin_back").show();
}

$(".btn-know").click(function() {

  if(studiedhanziid.length == totalwords-1){
    $(".btn-know").html("Finish Dictation");
  }

  if(percentage >= 99){
    showmark();
  }
  else{
    knowf();
  }

});


$(".btn-start").click(function() {
  know = true;
    $("#btnstart").hide();

    nextword();

    $("#card_chin_back").show();
});



document.body.onkeyup = function(e){

    if(e.keyCode == 81){
      if(studiedhanziid.length == totalwords-1){
        $(".btn-know").html("Finish Dictation");
      }

      if(percentage >= 99){
        showmark();
      }
      else{
        knowf();
      }


    }
}
//This code is to control by keyboard

});
