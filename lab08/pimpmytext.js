// Ex 8: Unobtrusive JavaScript

// Ex 2: JavaScript alert
// Ex 3: Hello World Button
function helloAlert() {
    alert("Hello, world!");
}

// Ex 7: Font Timer
function biggerTimer(arg, ms) {
    setInterval("buttonBigger(" + arg + ")", ms);
}

// Ex 4: Bigger Pimpin'! Button
function buttonBigger(size) {
    var fontSize = $("text").style.fontSize;

    if (fontSize == "") {
        $("text").style.fontSize = 12 + "pt";
    } else {
        var fontNum = parseInt(fontSize);
        $("text").style.fontSize = (fontNum + size) + "pt";
    }
}

// Ex 5: Bling Checkbox
function checkBling() {
    var checked = $("bling").checked;    
    
    if (checked) {
        // Ex 9: More Gangsta - background image
        document.body.style.backgroundImage = "url('http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/8/hundred.jpg')";
        document.body.style.backgroundRepeat = "repeat";
        $("text").style.fontWeight = "bold";
        $("text").style.color = "green";
        $("text").style.textDecoration = "underline";
    } else {
        document.body.style.backgroundImage = "none";
        $("text").style.fontWeight = "normal";
        $("text").style.color = "black";
        $("text").style.textDecoration = "none";
    }
}

// Ex 6: Snoopify
function snoopify() {
    var text = $("text").value;

    text = text.toUpperCase();
    var textArr = text.split(".");
    $("text").value = textArr.join("-izzle.");
}

// Ex 9: More Gangsta - Pig Latin
function igpayAtinlay() {
    var text = $("text").value;
    var textArrWithNewLine = text.split("\n");
    var textArrWithSpace;

    for (i = 0; i < textArrWithNewLine.length; i++) {
        textArrWithSpace = textArrWithNewLine[i].split(" ");
        textArrWithSpace.forEach(convertWord);
        textArrWithNewLine[i] = textArrWithSpace.join(" ");
    }

    text = textArrWithNewLine.join("\n");
    $("text").value = text;
}

function convertWord(value, index, thisArg) {
    // callback function (forEach)
    var vowels = ['A', 'a', ,'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u'];
    globValue = value;

    if (globValue.charAt(globValue.length - 1) == '.') {
        while (vowels.findIndex(findVowel) == -1) {
            globValue = globValue.substring(1, globValue.length - 1) + globValue.charAt(0) + ".";
        }
        thisArg[index] = globValue.substring(0, globValue.length - 1) + "ay.";
    } else {
        while (vowels.findIndex(findVowel) == -1) {
            globValue = globValue.substring(1, globValue.length) + globValue.charAt(0)
        }
        thisArg[index] = globValue.substring(0, globValue.length) + "ay";
    }
}

function findVowel(value, index, thisArg) {
    // callback function (findIndex)
    return value == globValue.charAt(0);
}

// Ex 9: More Gangsta - Malkovitch
function malkovitch() {
    var text = $("text").value;

    var textArr = text.split(" ");
    textArr.forEach(convertWord2);
    text = textArr.join(" ");

    $("text").value = text;
}

function convertWord2(value, index, thisArg) {
    // callback function (forEach)
    if (value.length >= 5) {
        thisArg[index] = "Malkovitch";
    }
}