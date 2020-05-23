//This is a Javascript file which contains all the writing functions for Chinese Language

//Chinese Speech
function speakchin(k) {
  speaker = "Chinese Female";
  speed = 1.00;
  responsiveVoice.speak(k, speaker, {
    rate: speed
  });
}

function speakeng(k) {
  speaker = "UK Female";
  speed = 1.00;
  responsiveVoice.speak(k, speaker, {
    rate: speed
  });
}
//This is a callback function from animatestep
function hanzidisplaysteps(item,index) {
  var size = 100;
  demoP = document.getElementById("hanzisteps");
    url = "https://dictionary.writtenchinese.com/giffile.action?&localfile=true&fileName=" + item + ".gif";
    fullurl = "<img src=\"" + url + "\" height=\""+size+"px\">"
    demoP.innerHTML += fullurl;
}


//Displaysteps using hanziwriter library
function generatechar(size) {
    var charid = 0;
    var charid2 = 0;
    var charactersize = size;
    var x = document.getElementsByClassName("hanzi-container-large");
    var idname = x[0].id;
    for (i = 0; i < x.length; i++) {
        var hanzi = x[i].id;
        var character = hanzi.split("");
        for (j = 0; j < character.length; j++) {
            var hanzidiv = "<div class=\"hanzi-container\" id=\"" + character[j] + charid + "\"></div>";
            var parent = document.getElementById(hanzi);
            parent.innerHTML += hanzidiv;
            charid++;
        }
        for (k = 0; k < character.length; k++) {
            var writer = HanziWriter.create(character[k] + charid2, character[k], {
                width: charactersize,
                height: charactersize,
                padding: 5,
                delayBetweenStrokes: 5,
                delayBetweenLoops: 500
            });
            writer.loopCharacterAnimation();
            charid2++;
        }
    }
}

function generatequizchar(size) {
    var charid = 0;
    var charid2 = 0;
    var charactersize = size;
    var x = document.getElementsByClassName("hanzi-container-large-quiz");
    var idname = x[0].id;
    for (i = 0; i < x.length; i++) {
        var hanzi = x[i].id;
        var character = hanzi.split("");
        for (j = 0; j < character.length; j++) {
            var hanzidiv = "<div class=\"hanzi-container\" id=\"" + character[j] + charid + "\"></div>";
            var parent = document.getElementById(hanzi);
            parent.innerHTML += hanzidiv;
            charid++;
        }
        for (k = 0; k < character.length; k++) {
            var writer = HanziWriter.create(character[k] + charid2, character[k], {
                width: charactersize,
                height: charactersize,
                padding: 5,
                delayBetweenStrokes: 5,
                delayBetweenLoops: 500
            });
            writer.quiz();
            charid2++;
        }
    }
}

//Hanzi animated display
//The output is linked to a div with id called 'anihanzi'
function animatestep(word) {
  var hanzi = word;
  var hanzisplit1 = hanzi.replace(/ /g, '');
  var hanzisplit = hanzisplit1.split("");
  hanzisplit.forEach(hanzidisplaysteps);
}
