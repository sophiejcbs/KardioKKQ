/**
 * Author: Sophie Nadine Jacobs (104520476)
 * Target: payment.html
 * Purpose: This file is for displaying the Enquiry read-only information and validation for a Payment form
 * Created: 15/5/2023
 * Last updated: 21/5/2023
 * Credits: COS10011 Lab 5,6 (Learning Materials on Canvas)
 */

"use strict";

function getOrder() {
    var cost = 0;
    var basicPrice = 120;
    var premiumPrice = 200;
    var elitePrice = 280;
    var saunaSteamPrice = 20;
    var personalTrainingPrem = 40;
    var personalTrainingElite = 50;
    var guestPassPrem = 300;
    var guestPassElite = 200;

    var kkqMerch = {
        "KKQ gym shorts": 25,
        "KKQ water bottles": 20,
        "KKQ protein shakers": 20,
        "KKQ jump ropes": 20,
        "KKQ resistance bands": 30,
        "KKQ protein powder": 35
    };
    
    var cardioSC = [
        "Grit",
        "Grit Cardio",
        "HIIT KKQ",
        "Warrior Workout",
        "Kickboxing",
        "Strength Training",
        "Core and Cardio Lift",
        "KKQ Core",
        "Body Pump",
        "Power"
      ];

      var cycleDanceMB = [
        "Freestyle Cycling",
        "Intro RPM",
        "Peloton",
        "Race 30",
        "RPM",
        "Belly Dance",
        "Body Jam",
        "Zumba",
        "Zumba Toning",
        "U-Jam",
        "Yoga",
        "Tai Chi",
        "Pilates",
        "POP Pilates",
        "Body Balance"
      ];

    if(sessionStorage.fname != undefined) {
        document.getElementById("payment_name").textContent = sessionStorage.fname + " " + sessionStorage.lname;

        document.getElementById("fname").value = sessionStorage.fname;
        document.getElementById("lname").value = sessionStorage.lname;

        document.getElementById("payment_email").textContent = sessionStorage.email;
        document.getElementById("email").value = sessionStorage.email;

        document.getElementById("payment_phoneNumber").textContent = sessionStorage.phoneNumber;
        document.getElementById("phoneNumber").value = sessionStorage.phoneNumber;
        
        if(sessionStorage.preferredContact != "undefined") {
            document.getElementById("payment_preferredContact").textContent = sessionStorage.preferredContact;
            document.getElementById("preferredContact").value = sessionStorage.preferredContact;
        }

        document.getElementById("payment_streetAddress").textContent = sessionStorage.streetAddress;
        document.getElementById("streetAddress").value = sessionStorage.streetAddress;
        
        document.getElementById("payment_town").textContent = sessionStorage.town;
        document.getElementById("town").value = sessionStorage.town;
        
        document.getElementById("payment_state").textContent = sessionStorage.state;
        document.getElementById("state").value = sessionStorage.state;

        document.getElementById("payment_postCode").textContent = sessionStorage.postCode;
        document.getElementById("postCode").value = sessionStorage.postCode;
    }

    if(sessionStorage.product != undefined) {
        document.getElementById("payment_product").textContent = sessionStorage.product + " Membership";
        document.getElementById("product").value = sessionStorage.product;

        document.getElementById("payment_qty").textContent = sessionStorage.qty;
        document.getElementById("qty").value = sessionStorage.qty;

        document.getElementById("label_membershipLength").textContent = sessionStorage.membershipLength + " Commitment";
        document.getElementById("membershipLength").value = sessionStorage.membershipLength;

        var qty = sessionStorage.qty;
    }

    if(sessionStorage.product == "undefined") {
        document.getElementById("payment_product").textContent = "Unknown Membership";
        document.getElementById("product").value = "";
    }

    if(sessionStorage.membershipLength == "undefined") {
        document.getElementById("label_membershipLength").textContent = "Unknown Commitment";
        document.getElementById("membershipLength").value = "";
    }

    if(sessionStorage.product != undefined && sessionStorage.product == "Basic") {
        //membership length price
        if(sessionStorage.membershipLength == "Monthly") {
            cost += basicPrice*1;
            document.getElementById("payment_membershipLength").textContent = "RM " + basicPrice*1;
        }
        else if(sessionStorage.membershipLength == "Quarterly") {
            cost += basicPrice*4;
            document.getElementById("payment_membershipLength").textContent = "RM " + basicPrice*4;
        }
        else if(sessionStorage.membershipLength == "Annually") {
            cost += basicPrice*12;
            document.getElementById("payment_membershipLength").textContent = "RM " + basicPrice*12;
        }

        if(sessionStorage.clubLoc != "") {
            document.getElementById("label_clubLoc").textContent = "Club Location";
            document.getElementById("payment_clubLoc").textContent = sessionStorage.clubLoc;
            document.getElementById("clubLoc").value = sessionStorage.clubLoc;
        }

        if(sessionStorage.saunaSteamAccess != "None" && sessionStorage.saunaSteamAccess != "undefined") {
            document.getElementById("label_saunaSteamAccess").textContent = sessionStorage.saunaSteamAccess;
            document.getElementById("saunaSteamAccess").value = sessionStorage.saunaSteamAccess;

            //sauna & steam room access price
            if(sessionStorage.saunaSteamAccess == "Monthly sauna & steam room access") {
                cost += saunaSteamPrice*1;
                document.getElementById("payment_saunaSteamAccess").textContent = "RM " + saunaSteamPrice*1;
            }
            else if(sessionStorage.saunaSteamAccess == "Yearly sauna & steam room access") {
                cost += saunaSteamPrice*12;
                document.getElementById("payment_saunaSteamAccess").textContent = "RM " + saunaSteamPrice*12;
            }
        }

        if (sessionStorage.grpClasses != undefined) {
            document.getElementById("grpClasses").value = sessionStorage.grpClasses;
            var grpClassArr = sessionStorage.grpClasses.split(",");
            var paymentHTML = ""; //storing payment HTML separately
          
            document.getElementById("label_grpClasses").innerHTML = "";
            document.getElementById("payment_grpClasses").innerHTML = "";

            for (var i = 0; i < grpClassArr.length; i++) {
              var className = grpClassArr[i];
          
              if (i != grpClassArr.length - 1) {
                document.getElementById("label_grpClasses").innerHTML += className + "<br/>";
              } 
              else {
                document.getElementById("label_grpClasses").innerHTML += className;
              }
          
              if (cardioSC.includes(className)) {
                cost += 75;
                paymentHTML += "RM 75" + "<br/>";
              } 
              else if (cycleDanceMB.includes(className)) {
                cost += 50;
                paymentHTML += "RM 50" + "<br/>";
              }
            }
          
            document.getElementById("payment_grpClasses").innerHTML = paymentHTML;
          }
    }
    else if(sessionStorage.product != undefined && sessionStorage.product == "Premium") {
        if(sessionStorage.membershipLength == "Monthly") {
            cost += premiumPrice*1;
            document.getElementById("payment_membershipLength").textContent = "RM "+premiumPrice*1;
        }
        else if(sessionStorage.membershipLength == "Quarterly") {
            cost += premiumPrice*4;
            document.getElementById("payment_membershipLength").textContent = "RM "+premiumPrice*4;
        }
        else if(sessionStorage.membershipLength == "Annually") {
            cost += premiumPrice*12;
            document.getElementById("payment_membershipLength").textContent = "RM "+premiumPrice*12;
        }

        if(sessionStorage.personalTraining != "None" && sessionStorage.personalTraining != "undefined") {
            document.getElementById("label_personalTrainingPrem").textContent = sessionStorage.personalTraining;
            document.getElementById("personalTrainingPrem").value = sessionStorage.personalTraining;

            //personal training sessions price
            if(sessionStorage.personalTraining == "4 personal training sessions/month") {
                cost += personalTrainingPrem*1;
                document.getElementById("payment_personalTrainingPrem").textContent = "RM " + personalTrainingPrem*1;
            }
            else if(sessionStorage.personalTraining == "8 personal training sessions/month") {
                cost += personalTrainingPrem*8;
                document.getElementById("payment_personalTrainingPrem").textContent = "RM " + personalTrainingPrem*8;
            }
            else if(sessionStorage.personalTraining == "12 personal training sessions/month") {
                cost += personalTrainingPrem*12;
                document.getElementById("payment_personalTrainingPrem").textContent = "RM " + personalTrainingPrem*12;
            }
        }
        else {
            document.getElementById("personalTrainingPrem").value = sessionStorage.personalTraining;
        }

        if(sessionStorage.guestPasses != "None" && sessionStorage.guestPasses != "undefined") {
            document.getElementById("label_guestPassesPrem").textContent = sessionStorage.guestPasses;
            document.getElementById("guestPassesPrem").value = sessionStorage.guestPasses;

            if(sessionStorage.guestPasses == "5 guest passes") {
                cost += guestPassPrem*1;
                document.getElementById("payment_guestPassesPrem").textContent = "RM " + guestPassPrem*1;
            }
            else if(sessionStorage.guestPasses == "10 guest passes") {
                cost += guestPassPrem*2;
                document.getElementById("payment_guestPassesPrem").textContent = "RM " + guestPassPrem*2;
            }
        }
        else {
            document.getElementById("guestPassesPrem").value = sessionStorage.guestPasses;
        }

        if (sessionStorage.merchandise !== undefined) {
            document.getElementById("merchandisePrem").value = sessionStorage.merchandise;
            var merchArr = sessionStorage.merchandise.split(",");
            
            //clear the innerHTML of label and payment elements
            document.getElementById("label_merchandisePrem").innerHTML = "";
            document.getElementById("payment_merchandisePrem").innerHTML = "";
            
            for (var i = 0; i < merchArr.length; i++) {
              if (i != merchArr.length - 1) {
                document.getElementById("label_merchandisePrem").innerHTML += merchArr[i] + "<br/>";
              } 
              else {
                document.getElementById("label_merchandisePrem").innerHTML += merchArr[i];
              }
              
              if (merchArr[i] in kkqMerch) {
                cost += kkqMerch[merchArr[i]];
                document.getElementById("payment_merchandisePrem").innerHTML += "RM " + kkqMerch[merchArr[i]] + "<br/>";
              }
            }
        }

        if(sessionStorage.nutritionalCoaching != "None" && sessionStorage.nutritionalCoaching != "undefined") {
            document.getElementById("label_nutritionalCoaching").textContent = sessionStorage.nutritionalCoaching;
            document.getElementById("nutritionalCoaching").value = sessionStorage.nutritionalCoaching;

            if(sessionStorage.nutritionalCoaching == "1-month nutrition coaching package") {
                cost += 20;
                document.getElementById("payment_nutritionalCoaching").textContent = "RM 20";
            }
            else if(sessionStorage.nutritionalCoaching == "3-month nutrition coaching package") {
                cost += 60;
                document.getElementById("payment_nutritionalCoaching").textContent = "RM 60";
            }
            else if(sessionStorage.nutritionalCoaching == "Work directly with a registered dietician") {
                cost += 100;
                document.getElementById("payment_nutritionalCoaching").textContent = "RM 100";
            }
        }
        else {
            document.getElementById("nutritionalCoaching").value = sessionStorage.nutritionalCoaching;
        }

    }
    else if(sessionStorage.product != undefined && sessionStorage.product == "Elite") {
        if(sessionStorage.membershipLength == "Monthly") {
            cost += elitePrice*1;
            document.getElementById("payment_membershipLength").textContent = "RM "+elitePrice*1;
        }
        else if(sessionStorage.membershipLength == "Quarterly") {
            cost += elitePrice*4;
            document.getElementById("payment_membershipLength").textContent = "RM "+elitePrice*4;
        }
        else if(sessionStorage.membershipLength == "Annually") {
            cost += elitePrice*12;
            document.getElementById("payment_membershipLength").textContent = "RM "+elitePrice*12;
        }
 
        if(sessionStorage.personalTraining != "None" && sessionStorage.personalTraining != "undefined") {
            document.getElementById("label_personalTrainingElite").textContent = sessionStorage.personalTraining;
            document.getElementById("personalTrainingElite").value = sessionStorage.personalTraining;

            //personal training sessions price
            if(sessionStorage.personalTraining == "8 personal training sessions/month") {
                cost += personalTrainingElite*8;
                document.getElementById("payment_personalTrainingElite").textContent = "RM " + personalTrainingElite*8;
            }
            else if(sessionStorage.personalTraining == "12 personal training sessions/month") {
                cost += personalTrainingElite*12;
                document.getElementById("payment_personalTrainingElite").textContent = "RM " + personalTrainingElite*12;
            }
        }
        else {
            document.getElementById("personalTrainingElite").value = sessionStorage.personalTraining;
        }

        if(sessionStorage.guestPasses != "None" && sessionStorage.guestPasses != "undefined") {
            document.getElementById("label_guestPassesElite").textContent = sessionStorage.guestPasses;
            document.getElementById("guestPassesElite").value = sessionStorage.guestPasses;

            if(sessionStorage.guestPasses == "5 guest passes") {
                cost += guestPassElite*1;
                document.getElementById("payment_guestPassesElite").textContent = "RM " + guestPassElite*1;
            }
            else if(sessionStorage.guestPasses == "10 guest passes") {
                cost += guestPassElite*2;
                document.getElementById("payment_guestPassesElite").textContent = "RM " + guestPassElite*2;
            }
        }
        else {
            document.getElementById("guestPassesElite").value = sessionStorage.guestPasses;
        }

        if (sessionStorage.merchandise !== undefined) {
            document.getElementById("merchandiseElite").value = sessionStorage.merchandise;
            var merchArr = sessionStorage.merchandise.split(",");
            
            //clear the innerHTML of label and payment elements
            document.getElementById("label_merchandiseElite").innerHTML = "";
            document.getElementById("payment_merchandiseElite").innerHTML = "";
            
            for (var i = 0; i < merchArr.length; i++) {
              if (i != merchArr.length - 1) {
                document.getElementById("label_merchandiseElite").innerHTML += merchArr[i] + "<br/>";
              } 
              else {
                document.getElementById("label_merchandiseElite").innerHTML += merchArr[i];
              }
              
              if (merchArr[i] in kkqMerch) {
                cost += kkqMerch[merchArr[i]];
                document.getElementById("payment_merchandiseElite").innerHTML += "RM " + kkqMerch[merchArr[i]] + "<br/>";
              }
            }
          }
        
        if(sessionStorage.bodyCompositionAnalysis != "None" && sessionStorage.bodyCompositionAnalysis != "undefined") {
            document.getElementById("label_bodyCompositionAnalysis").textContent = sessionStorage.bodyCompositionAnalysis;
            document.getElementById("bodyCompositionAnalysis").value = sessionStorage.bodyCompositionAnalysis;

            if(sessionStorage.bodyCompositionAnalysis == "Quarterly body composition analysis") {
                cost += 300;
                document.getElementById("payment_bodyCompositionAnalysis").textContent = "RM 300";
            }
            else if(sessionStorage.bodyCompositionAnalysis == "Yearly body composition analysis") {
                cost += 600;
                document.getElementById("payment_bodyCompositionAnalysis").textContent = "RM 600";
            }
        }
        else {
            document.getElementById("bodyCompositionAnalysis").value = sessionStorage.bodyCompositionAnalysis;
        }
    }

    cost *= qty;

    document.getElementById("payment_cost").textContent = "RM " + cost;
    document.getElementById("cost").value = cost;

    if(sessionStorage.product == "undefined" || sessionStorage.qty == "" || sessionStorage.membershipLength == "") {
        document.getElementById("payment_qty").textContent = "--";
        document.getElementById("qty").value = "";

        document.getElementById("payment_cost").textContent = "--";
        document.getElementById("cost").value = "";

        document.getElementById("payment_membershipLength").textContent = "--";
    }
}

function validate() {
    var errMsg = "";
    var result = true;

    var ccType = document.getElementsByName("ccType");
    var ccName = document.getElementById("ccName").value;
    var ccNum = document.getElementById("ccNum").value;
    var expDate = document.getElementById("expDate").value;
    var cvv = document.getElementById("cvv").value;

    var typeSelect = false;
    var ccTypeVal;

    var debug = true;

    if(!debug) {
        //credit card type validation (check if there is a selection)
        for(var i = 0; i<ccType.length; i++) {
            if(ccType[i].checked) {
                ccTypeVal = ccType[i].value;
                typeSelect = true;
            }
        }

        if(typeSelect == false) {
            errMsg += "Your credit card type cannot be empty.\n";
        }

        if(ccName == "") {
            errMsg += "Your credit card name cannot be empty.\n";
        }
        else if(!ccName.match(/^[a-zA-Z\s]{2,40}$/)) {
            errMsg += "Your credit card name can only have alphabets/spaces and be 40 characters and less.\n";
        }

        if(ccNum == "") {
            errMsg += "Your credit card number cannot be empty.\n";
        }
        else if(!ccNum.match(/^4\d{15}$/) && ccTypeVal == "Visa") {
            errMsg += "Your Visa card number has to have 16 digits and start with a 4.\n";
        }
        else if(!ccNum.match(/^(5[1-5])\d{14}$/) && ccTypeVal == "Mastercard") {
            errMsg += "Your Mastercard card number has to have 16 digits and start with 51-55.\n";
        }
        else if(!ccNum.match(/^(34|37)\d{13}$/) && ccTypeVal == "American Express") {
            errMsg += "Your American Express card number has to have 15 digits and start with 34 or 37.\n";
        }

        if(expDate == "") {
            errMsg += "Your credit card expiry date cannot be empty.\n";
        }
        else if(!expDate.match(/^\d{2}-\d{2}$/)) {
            errMsg += "Your expiry date needs to be digits in the MM-YY format.\n";
        }

        if(cvv == "") {
            errMsg += "Your CVV cannot be empty.\n";
        }
        else if(!cvv.match(/^\d{3,4}$/)) {
            errMsg += "Your CVV needs to be 3-4 digits long.\n";
        }

        if(errMsg != "") {
            alert(errMsg);
            result = false;
        }
    }
    
    return result;
}

function cancelOrder() {
    sessionStorage.clear();
    window.location = "index.php";
}

function init() {
    getOrder();

    var paymentForm = document.getElementById("paymentForm");
    paymentForm.onsubmit = validate;

    var cancelBtn = document.getElementById("cancelBtn");
    cancelBtn.onclick = cancelOrder;
}

window.onload = init;