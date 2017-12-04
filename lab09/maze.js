/* CSE326 : Web Application Development
 * Lab 10 - Maze Assignment
 * 
 */
"use strict";
var loser = null;  // whether the user has hit a wall

window.onload = function() {
    $("start").observe("click", startClick);
};

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
    var boundaries = $$(".boundary");
    for (var i = 0; i < boundaries.length; i++) {
        boundaries[i].addClassName("youlose");
    }
    $("status").innerHTML = "You lose! :(";
    $("maze").stopObserving();
    $("end").stopObserving();
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
    var boundaries = $$(".boundary");
    for (var i = 0; i < boundaries.length; i++) {
        boundaries[i].observe("mouseover", overBoundary);
        boundaries[i].removeClassName("youlose");
    }
    $("maze").observe("mouseleave", overBody);
    $("end").observe("mouseover", overEnd);
    $("status").innerHTML = "Start!";
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
    var boundaries = $$(".boundary");
    for (var i = 0; i < boundaries.length; i++) {
        boundaries[i].stopObserving();
    }
    $("maze").stopObserving();
    $("status").innerHTML = "You win! :)";
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
    var boundaries = $$(".boundary");
    for (var i = 0; i < boundaries.length; i++) {
        boundaries[i].addClassName("youlose");
        boundaries[i].stopObserving();
    }
    $("end").stopObserving();
    $("status").innerHTML = "You lose! :(";
}