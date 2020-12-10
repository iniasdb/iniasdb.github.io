var board = document.querySelector('.board');
var boardWidth = 400;
var boardHeight = 400;

var squareSize = 10;
var xSize = boardWidth/squareSize;
var ySize = boardHeight/squareSize;
var amount = xSize * ySize;

var cp = document.querySelector("#color");
cp.addEventListener("input", function() {chooseColor()}, false);
var rainbow = document.querySelector("#rainbow");
rainbow.addEventListener("change", function() {chooseColor()}, false)
var erasor = document.querySelector("#erasor");
erasor.addEventListener("change", function() {chooseColor()}, false)
var clearBtn = document.querySelector("#clear");
clearBtn.addEventListener("click", function() {clear()}, false)


var color = "black";
var colorIndex = 0;
var rainbowColors = ["red", "orange", "yellow", "green", "blue", "indigo", "violet"];

//create divs
for (let i = 0; i < amount; i++) {
    var square = document.createElement('div');
    square.className = "square";
    board.appendChild(square);
}

//add listener
for (let i = 0; i < amount; i++) {
    document.querySelectorAll(".square")[i].onmouseover = function() {hovered(i)};
}

//listener function color hovered squares
function hovered(i) {
    chooseColor();
    document.querySelectorAll(".square")[i].style.backgroundColor = color;
}

function clear() {
    for (let i = 0; i < amount; i++) {
        document.querySelectorAll(".square")[i].style.backgroundColor = "white";
    }
}

//choose color
function chooseColor() {

    if (erasor.checked) {
        color = "white";
    } else {
        if (!rainbow.checked) {
            color = cp.value;
        } else {
            //rainbowcolor cycle through colors of the rainbow
            if (colorIndex < rainbowColors.length) {
                color = rainbowColors[colorIndex];
                colorIndex++;
            } else {
                colorIndex = 0;
                color = rainbowColors[colorIndex];
                colorIndex++;
            }
        }
    }
}
