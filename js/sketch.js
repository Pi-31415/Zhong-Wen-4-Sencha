function setup() {
    var wid = displayWidth;
    var hid = displayHeight;
    createCanvas(wid, hid);
    strokeWeight(5);
    stroke(0);
}

function touchMoved() {
    line(mouseX, mouseY, pmouseX, pmouseY);
    return false;

}

function clearscreen() {
    clear();
    return false;
}
