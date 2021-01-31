var keys = {
  37: "left",
  38: "up",
  39: "right",
  40: "down",
  65: "a",
  66: "b",
};

var code = [
  "up",
  "up",
  "down",
  "down",
  "left",
  "right",
  "left",
  "right",
  "b",
  "a",
];

var pos = 0;

function abcd() {
  console.log("nnekenf");
  document.addEventListener("keydown", function (e) {
    var key = keys[e.keyCode];
    var reqKey = code[pos];
    console.log("ja");
    if (key == reqKey) {
      pos++;
      if (pos == code.length) {
        easteregg();
        pos = 0;
      }
    } else {
      pos = 0;
    }
  });
}

function easteregg() {
  alert("ja manne");
}
