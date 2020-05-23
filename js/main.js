var is_p5_on = false;

function falsifyp5() {
  is_p5_on = false;
}

//Set all styling to material
ons.platform.select('android');

//Menu open Function
function togglemenu() {
  document.querySelector('#menu').open();
}
//Function to Switch Page
function switchpage(pagename) {

  if(is_p5_on == true){
    //alert("User comes from write");
    destroyp5();
  }

  var menu = document.getElementById('menu');
  var page = pagename + ".html";
  const navigator = document.querySelector('#navigator');
  navigator.resetToPage(page).then(menu.close.bind(menu));;

  if (pagename == "write") {
    //console.log("Turning on p5");
    is_p5_on = true;
  }
  else{
    //console.log("Turning off p5");
    is_p5_on = false;
  }

}

//Responsive Voice Functions
function speakeng(k) {
    speaker = "UK English Female";
    speed = 1.00;
    responsiveVoice.speak(k, speaker, {
        rate: speed
    });
}
