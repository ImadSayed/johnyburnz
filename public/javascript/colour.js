function getRandomColor() {
    // Math.pow is slow, use constant instead.
    const color = Math.floor(Math.random() * 16777216).toString(16);
    // Avoid loops.
    return '#000000'.slice(0, -color.length) + color;
}

function changeColor() {
    let colour = getRandomColor();
    document.getElementById('bottomWhiteBar').style.fill = colour;
    document.getElementById('topWhiteBar').style.fill = colour;
    //document.getElementById('PinsLeft').style.fill = colour;
    //document.getElementById('PinsRight').style.fill = colour;
}

const startColorLoop = setInterval(function() {
    changeColor();
},400);

window.onload=startColorLoop;
