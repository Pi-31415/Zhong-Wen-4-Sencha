//This script handles the ajax function from the deck
var studied_all = false;
var mode = "Chinese";
localStorage.setItem("curchin", "");
function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min + 1) ) + min;
}
function randomchineng(){
  if (mode == "English"){
    mode = "Chinese";
  }
  else if (mode == "Chinese"){
    mode = "English";
  }
  else{
    mode = "Chinese";
  }
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
$("#card_chin_front").hide();
$("#card_chin_back").hide();
$("#card_eng_back").hide();

//This will run when the flashcard loads
$("#progressbar").html("<ons-progress-bar value=\"0\"></ons-progress-bar>");
$.ajax({url: "admin/vocabengine.php?deck="+localStorage.curdeck, success: function(result){
  var obj = JSON.parse(result);
  var cardscount = obj.hanzi.length;
  localStorage.setItem("cardcount",cardscount);
  curid = getRndInteger(0, cardscount-1);
  localStorage.setItem("curchin", obj.hanzi[curid].word);
  localStorage.setItem("currentid", curid);
  var strokecode = "<div class=\"hanzi-container-large\" id=\""+obj.hanzi[curid].word+"\" onclick=\"speakchin(localStorage.curchin)\"></div>"
  var imgcode = "<img src=\"uploads/"+obj.hanzi[curid].img_name+"\" alt=\"\" style=\"width: 200px\">";
  $(".card-meaning").html(jsUcfirst(obj.hanzi[curid].meaning));
  $(".card-word").html(obj.hanzi[curid].word);
  $(".card-pinyin").html(jslower(obj.hanzi[curid].pinyin));
  $(".card-stroke").html(strokecode);
  $(".card-img").html(imgcode);
  $(".card-fact").html(obj.hanzi[curid].fact);
  generatechar(100);
  studytxt = "0 out of "+cardscount+" words studied. (" + Math.round(percentage) +"%)";
  $("#study").html(studytxt);
}});

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
    var strokecode = "<div class=\"hanzi-container-large\" id=\""+obj.hanzi[curid].word+"\" onclick=\"speakchin(localStorage.curchin)\"></div>"
    var imgcode = "<img src=\"uploads/"+obj.hanzi[curid].img_name+"\" alt=\"\" style=\"width: 200px\">";
    $(".card-meaning").html(jsUcfirst(obj.hanzi[curid].meaning));
    $(".card-word").html(obj.hanzi[curid].word);
    $(".card-pinyin").html(jslower(obj.hanzi[curid].pinyin));
    $(".card-stroke").html(strokecode);
    $(".card-img").html(imgcode);
    $(".card-fact").html(obj.hanzi[curid].fact);
    generatechar(100);
    if (know == true){
      studiedhanziid.push(curid);
    }
    intersectionarray = Array.from(new Set(studiedhanziid));
    let a = new Set(allhanziid);
    let b = new Set(intersectionarray);
    let difference = new Set(
        [...a].filter(x => !b.has(x)));
    differenceset = Array.from(difference);
    percentage = (intersectionarray.length/allhanziid.length)*100;
    //alert(percentage);
    //console.log("Percentage completed:"+percentage);
    $("#progressbar").html("<ons-progress-bar value=\""+percentage+"\"></ons-progress-bar>");
    studytxt = intersectionarray.length+" out of "+cardscount+" words studied. (" + Math.round(percentage) +"%)";
    $("#study").html(studytxt);
    localStorage.setItem("curchin", obj.hanzi[curid].word);
    localStorage.setItem("cureng", obj.hanzi[curid].meaning);
  }});
}

function dunno(){
  know = false;
  nextword();
  randomchineng()
  if(mode == "English"){
    $("#card_chin_front").hide();
    $("#card_chin_back").hide();
    $("#card_eng_back").hide();
    $("#card_eng_front").show();
    randomchineng()
  }
  else{
    $("#card_chin_front").show();
    $("#card_chin_back").hide();
    $("#card_eng_back").hide();
    $("#card_eng_front").hide();
    randomchineng()
  }
}
function flip(){
  if(mode == "English"){
    $("#card_chin_front").hide();
    $("#card_chin_back").hide();
    $("#card_eng_back").show();
    $("#card_eng_front").hide();
    randomchineng()
  }
  else{
    $("#card_chin_front").hide();
    $("#card_chin_back").show();
    $("#card_eng_back").hide();
    $("#card_eng_front").hide();
    randomchineng()
  }
  speakchin(localStorage.curchin);
}
function knowf(){
  know = true;
  nextword();
  randomchineng()
  if(mode=="English"){
    $("#card_chin_front").hide();
    $("#card_chin_back").hide();
    $("#card_eng_back").hide();
    $("#card_eng_front").show();
    randomchineng()
  }
  else{
    $("#card_chin_front").show();
    $("#card_chin_back").hide();
    $("#card_eng_back").hide();
    $("#card_eng_front").hide();
    randomchineng()
  }
}

$(".btn-know").click(function() {
    knowf();

});


$(".btn-dunnoknow" ).click(function() {
    dunno();
});

//This flips the cards
$(".btn-show").click(function() {
  flip();
});


document.body.onkeyup = function(e){
    if(e.keyCode == 32){
        flip();
    }
    if(e.keyCode == 81){
        knowf();
    }
    if(e.keyCode == 82){
        dunno();
    }
}

//This code is to control by keyboard


});
