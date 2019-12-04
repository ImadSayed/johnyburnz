const singleClef = document.getElementById("SingleClef");
const singleNote = document.getElementById("SingleNote");
const doubleClef = document.getElementById("DoubleClef");
const strings = document.getElementsByClassName("String");
const String1 = document.getElementById("String1");
//singleClef.style.transform = "translateX(-65px)";
let verticleVariableSNY = -63.13;
let verticleVariableSCY = -63.13;
let verticleVariableDCY = -63.13;

//transform="translate(-46.44 -53.13)"
//div.style.transform = "translateY(10px)";

function Change() {
    verticleVariableSCY -= 7;
    verticleVariableSNY -= 5;
    verticleVariableDCY -= 10;
    if(verticleVariableSCY < -400) {
        verticleVariableSCY = -63.13;
    }if(verticleVariableSNY < -400) {
        verticleVariableSNY = -63.13;
    }
    if(verticleVariableDCY < -400) {
        verticleVariableDCY = -63.13;
    }
    singleClef.style.transform = "translateY("+verticleVariableSCY+"px)";
    singleNote.style.transform = "translateY("+verticleVariableSNY+"px)";
    doubleClef.style.transform = "translateY("+verticleVariableDCY+"px)";
}

document.getElementById("String1").onmouseover = function() {
    Change();
}
document.getElementById("String2").onmouseover = function() {
    Change();
}
document.getElementById("String3").onmouseover = function() {
    Change();
}
document.getElementById("String4").onmouseover = function() {
    Change();
}
document.getElementById("String5").onmouseover = function() {
    Change();
}
document.getElementById("String6").onmouseover = function() {
    Change();
}
document.getElementById("String7").onmouseover = function() {
    Change();
}
document.getElementById("String8").onmouseover = function() {
    Change();
}
document.getElementById("String9").onmouseover = function() {
    Change();
}
document.getElementById("String10").onmouseover = function() {
    Change();
}
document.getElementById("String11").onmouseover = function() {
    Change();
}
document.getElementById("String12").onmouseover = function() {
    Change();
}




//strings[0].onmouseover = console.log(verticleVariableSCX);
/*
strings[1].onmouseover = change();
strings[2].onmouseover = change();
strings[3].onmouseover = change();
strings[4].onmouseover = change();
strings[5].onmouseover = change();
strings[6].onmouseover = change();
strings[7].onmouseover = change();
strings[8].onmouseover = change();
strings[9].onmouseover = change();
strings[10].onmouseover = change();
strings[11].onmouseover = change();
*/
function cha() {
    //console.log("here");
    //console.log("SCX: "+verticleVariableSCX+", SCY: "+verticleVariableSCY);
    //verticleVariableSCX++;
    //verticleVariableSCY++;
    //console.log("SCX: "+verticleVariableSCX+", SCY: "+verticleVariableSCY);
    //x=x+1;
    console.log(verticleVariableSCX);
}

//transform="translate(-46.44 -53.13)"
