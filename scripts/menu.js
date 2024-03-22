/**
 * Author: Sophie Nadine Jacobs (104520476)
 * Target: All pages
 * Purpose: This file is for showing the currently selected page in the menu
 * Created: 19/6/2023
 * Last updated: 21/5/2023
 * Credits: N/A
 */

"use strict";

function init3() {
    var current = window.location.href;
    if(current.includes("index.php")) {
        document.getElementById("indexLink").classList.add("current");
    }
    else if(current.includes("product.php")) {
        document.getElementById("productLink").classList.add("current");
        init2();
        init();
    }
    else if(current.includes("enquire.php") || current.includes("payment.php") || current.includes("fix_order.php")){
        document.getElementById("enquireLink").classList.add("current");
        init();
        init2();
    }
    else if(current.includes("receipt.php")){
        document.getElementById("enquireLink").classList.add("current");
    }
    else if(current.includes("about.php")){
        document.getElementById("aboutLink").classList.add("current");
    }
    else if(current.includes("manager.php")){
        document.getElementById("managerLink").classList.add("current");
        init();
    }
    else if(current.includes("manager_home.php") ||current.includes("manager_registration.php") || current.includes("fix_registration.php") ||current.includes("login.php") || current.includes("fix_login.php")){
        document.getElementById("managerLink").classList.add("current");
    }
}

window.onload = init3;