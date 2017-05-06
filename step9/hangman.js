/**
 * Created by jaiwant on 4/11/2017.
 */

function randomWord() {
    var words = ["moon","home","mega","blue","send","frog","book","hair","late",
        "club","bold","lion","sand","pong","army","baby","baby","bank","bird","bomb","book",
        "boss","bowl","cave","desk","drum","dung","ears","eyes","film","fire","foot","fork",
        "game","gate","girl","hose","junk","maze","meat","milk","mist","nail","navy","ring",
        "rock","roof","room","rope","salt","ship","shop","star","worm","zone","cloud",
        "water","chair","cords","final","uncle","tight","hydro","evily","gamer","juice",
        "table","media","world","magic","crust","toast","adult","album","apple",
        "bible","bible","brain","chair","chief","child","clock","clown","comet","cycle",
        "dress","drill","drink","earth","fruit","horse","knife","mouth","onion","pants",
        "plane","radar","rifle","robot","shoes","slave","snail","solid","spice","spoon",
        "sword","table","teeth","tiger","torch","train","water","woman","money","zebra",
        "pencil","school","hammer","window","banana","softly","bottle","tomato","prison",
        "loudly","guitar","soccer","racket","flying","smooth","purple","hunter","forest",
        "banana","bottle","bridge","button","carpet","carrot","chisel","church","church",
        "circle","circus","circus","coffee","eraser","family","finger","flower","fungus",
        "garden","gloves","grapes","guitar","hammer","insect","liquid","magnet","meteor",
        "needle","pebble","pepper","pillow","planet","pocket","potato","prison","record",
        "rocket","saddle","school","shower","sphere","spiral","square","toilet","tongue",
        "tunnel","vacuum","weapon","window","sausage","blubber","network","walking","musical",
        "penguin","teacher","website","awesome","attatch","zooming","falling","moniter",
        "captain","bonding","shaving","desktop","flipper","monster","comment","element",
        "airport","balloon","bathtub","compass","crystal","diamond","feather","freeway",
        "highway","kitchen","library","monster","perfume","printer","pyramid","rainbow",
        "stomach","torpedo","vampire","vulture"];

    return words[Math.floor(Math.random() * words.length)];
}

function hangman(){
    str = "<form>";
    str += "<center><img src='hangman/hm0.png' id='imgU'></center>";
    word = randomWord();
    length = word.length;
    console.log(word);
    str += "<p id='space'>"
    for(i=0;i<length;i++){
        str += "_ ";
    }
    str += "</p>";
    str += "<p> Letter: <input type='text' id='letter'> </p>";
    str += "<center><input type='button' id='guess' value='Guess!' onclick='guess(word)'>&nbsp;<input type='button' id='new' value='New Game'> </center>";
    str += "</form>";
    document.getElementById("play-area").innerHTML=str;
}

function guess(guessWord) {
    guessLetter = document.getElementById('letter').value;
    if(isLetter(guessLetter)){
        if(guessWord.indexOf(guessLetter) > -1){

            //document.getElementById('space').innerHTML;
        }
    }
    document.getElementById('imgU').src = "hangman/hm1.png";
}

function isLetter(str) {
    return str.length === 1 && str.match(/[a-z]/i);
}