/**
 * Author: Sophie Nadine Jacobs (104520476)
 * Target: manager.php
 * Purpose: This file is for creating a 
 * Created: 22/6/2023
 * Last updated: 28/6/2023
 * Credits: N/A
 */

"use strict";

function changeBg(event) {
    var submitButton = event.target;
    submitButton.style.backgroundColor = "#647a0a";

    sessionStorage.setItem("clickedButton", submitButton.id);
}

function retrieveClickedButton() {
    var clickedButtonId = sessionStorage.getItem("clickedButton");
  
    //check if a clicked button is stored in session storage
    if (clickedButtonId) {
      //retrieve the clicked button element by ID and set the background color
      var clickedButton = document.getElementById(clickedButtonId);
      if (clickedButton) {
        clickedButton.style.backgroundColor = "#647a0a";
      }
    }
}

function goBack() {
    window.location = window.history.back();
}

function init() {
    retrieveClickedButton();

    var submitButtons = document.querySelectorAll("input[type='submit'][name='managerQueries']");
    submitButtons.forEach(function(button) {
        button.addEventListener("click", changeBg);
    })
    window.addEventListener("unload", function(event) {
        // Check if the user is navigating away from the manager.php page
        if (!event.target.activeElement.matches("input[type='submit']") && !event.target.location.href.includes("manager.php")) {
            sessionStorage.clickedButton = "";
        }
    });

    var confirmCancel = document.getElementById("confirmCancel");

    confirmCancel.onclick = goBack;
}

window.onload = init;
