var skyImg = 0;
var starC = new Array("#ff0", "#ccf", "#f9f", "#ff8", "#ff0");
var fnt = new Array("★", "★", "＋", "・");
var starcss = "text-shadow: 0px 0px 5px #fff;";
var ga = new Array("st1.png", "st2.png", "st3.png", "st4.png", "st5.png");
var opa = 0.9;
var move = true;
var starNo = 100;
var minSize = 1;
var maxSize = 20;
var blink = 80;

var starX = new Array(), starY = new Array();
var win_width = window.innerWidth, win_height = window.innerHeight;

function showLayer(lay) { document.getElementById(lay).style.visibility = "visible"; }
function hideLayer(lay) { document.getElementById(lay).style.visibility = "hidden"; }
function moveLayerTo(lay, x, y) {
    document.getElementById(lay).style.left = x + "px";
    document.getElementById(lay).style.top = y + "px";
    if (move) { document.getElementById(lay).style.position = "fixed"; }
    else { document.getElementById(lay).style.position = "absolute"; }
}

function star() {
    for (var s = 0; s < starNo; s++) {
        var ran = Math.random() * blink;
        if (ran < 10) {
            var timer = Math.random() * 1000;
            setTimeout("hideLayer('star" + s + "')", timer);
            setTimeout("showLayer('star" + s + "')", timer + 500);
        }
    }
    setTimeout("star()", 1000);
}

function init() {
    for (var s = 0; s < starNo; s++) {
        starX[s] = Math.floor(Math.random() * (win_width - maxSize - 5));
        starY[s] = Math.floor(Math.random() * (win_height - maxSize - 5));
        moveLayerTo("star" + s, starX[s], starY[s]);
    }
    star();
}

var starLay = '';
for (var s = 0; s < starNo; s++) {
    var size = Math.floor(Math.random() * (maxSize - minSize) + minSize);
    if (skyImg == 0) {
        // ここで z-index を設定
        starLay += '<span id="star' + s + '" style="color:' + starC[s % starC.length] + '; font-size:' + size + 'px; left:0; top:0; z-index:2;' + starcss + '">' + fnt[s % fnt.length] + '</span>';
    }
    if (skyImg == 1) {
        // ここで z-index を設定
        starLay += '<img src="' + ga[s % ga.length] + '" id="star' + s + '" style="width:' + size + 'px; left:0; top:0; z-index:2; opacity:' + opa + ';">';
    }
}
document.write(starLay);
window.onload = init;
