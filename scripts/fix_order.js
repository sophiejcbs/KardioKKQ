/**
 * Author: Sophie Nadine Jacobs (104520476)
 * Target: payment.html, product.html
 * Purpose: This file is for creating a timer on the Payment page, displaying products dynamically in the Product page, and pre-loading the Credit Card Name in the Payment form
 * Created: 16/5/2023
 * Last updated: 21/5/2023
 * Credits: COS10011 Lab 5,6 + L5,L6,L7 (Learning Materials on Canvas)
 * 
 * "use strict";

function changeProd() {
    document.getElementById("product").textContent = "";
}

function init() {
    changeProd();

    document.getElementById("product").textContent = sessionStorage.product;

    var changeBasic = document.getElementById("changeBasic");
    var changePrem = document.getElementById("changePrem");
    var changeElite = document.getElementById("changeElite");

    changeBasic.onclick = changeProd;
    changePrem.onclick = changeProd;
    changeElite.onclick = changeProd;
}

window.onload = init();

function changeProd() {
    document.getElementById("product").value = "";
}

function init() {
    var changeBasic = document.getElementById("changeBasic");
    var changePrem = document.getElementById("changePrem");
    var changeElite = document.getElementById("changeElite");

    if(changeBasic!=null) {
        changeBasic.onclick = changeProd;
    }
    if(changePrem!=null) {
        changePrem.onclick = changeProd;
    }
    if(changeElite!=null) {
        changeElite.onclick = changeProd;
    }
}

window.onload = init();
 */
"use strict";

function init() {
    var form = document.getElementById("fixOrderForm");
    var prod = document.getElementById("product");

    if(document.getElementById("changeBasic") != null) {
        document.getElementById("changeBasic").onclick = function() {
            prod.value = "";
            form.submit();
        };
    }
    if(document.getElementById("changePrem") != null) {
        document.getElementById("changePrem").onclick = function() {
            prod.value = "";
            form.submit();
        };
    }
    if(document.getElementById("changeElite") != null) {
        document.getElementById("changeElite").onclick = function() {
            prod.value = "";
            form.submit();
        };
    }
}

window.onload = init;