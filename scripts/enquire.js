/**
 * Author: Sophie Nadine Jacobs (104520476)
 * Target: enquire.html
 * Purpose: This file is for adding form validation to enquire.html
 * Created: 12/5/2023
 * Last updated: 21/5/2023
 * Credits: COS10011 Lab 5,6 (Learning Materials on Canvas)
 */

"use strict";

function validate() {
    //error message variable initialization
    var errMsg = "";

    //whether or not the form can be submitted
    var result = true;

    //values for passing to sessionStorage
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var email = document.getElementById("email").value;
    var preferredContact = getCheckedRadio("preferredContact");
    var phoneNumber = document.getElementById("phoneNumber").value;
    var streetAddress = document.getElementById("streetAddress").value;
    var town = document.getElementById("town").value;    

    //declaring variables for values that need to be checked
    var state = document.getElementById("state").value;
    var postCode = document.getElementById("postCode").value;
    var product = document.getElementById("product").value;
    var qty = document.getElementById("qty").value;
    var grpClasses = document.getElementsByName("groupClasses[]");
    var classCount = 0;

    //retrieving user's selected product value
    var selectedProduct = document.getElementById("productToBuy").value;

    var debug = true;
    if(!debug) {
        //state and postcode validation
        if(state == "VIC" && (postCode[0] != "3" && postCode[0] != "8")) {
            errMsg += "The selected state '" + state + "' must have a postcode that starts with 3 or 8.\n";
        }
        if(state == "NSW" && (postCode[0] != "1" && postCode[0] != "2")) {
            errMsg += "The selected state '" + state + "' must have a postcode that starts with 1 or 2.\n";
        }
        if(state == "QLD" && (postCode[0] != "4" && postCode[0] != "9")) {
            errMsg += "The selected state '" + state + "' must have a postcode that starts with 4 or 9.\n";
        }
        if((state == "NT" && postCode[0] != "0") || (state == "ACT" && postCode[0] != "0")) {
            errMsg += "The selected state '" + state + "' must have a postcode that starts with 0.\n";
        }
        if(state == "WA" && postCode[0] != "6") {
            errMsg += "The selected state '" + state + "' must have a postcode that starts with 6.\n";
        }
        if(state == "SA" && postCode[0] != "5") {
            errMsg += "The selected state '" + state + "' must have a postcode that starts with 5.\n";
        }
        if(state == "TAS" && postCode[0] != "7") {
            errMsg += "The selected state '" + state + "' must have a postcode that starts with 7.\n";
        }

        //quantity validation
        if(isNaN(qty)) {
            errMsg += "The quantity for a " + product + " membership must be a positive integer.\n";
        }
        else if(parseInt(qty) <= 0) {
            errMsg += "The quantity for a " + product + " membership must be a positive integer.\n";
        }

        //basic: class selection validation
        for(var i = 0; i<grpClasses.length; i++) {
            if(grpClasses[i].checked) {
                classCount++;
            }
            if(classCount > 3) {
                errMsg += "There is a maximum of 3 group classes for a basic membership.";
                break;
            }
        }

        if(errMsg != "") {
            result = false;
            alert(errMsg);
        }
    }
    
    if(result) {
        var customerDetails = {
            fname: fname,
            lname: lname,
            email: email,
            phoneNumber: phoneNumber,
            preferredContact: preferredContact,
            streetAddress: streetAddress,
            town: town,
            state: state,
            postCode: postCode
        };
        var orderDetails = {
            
        };
    }

    if(result && selectedProduct == "Basic") {
        orderDetails = {
            product: selectedProduct,
            membershipLength: getCheckedRadio("membershipLength"),
            qty: qty,
            clubLoc: document.getElementById("clubLoc").value,
            saunaSteamAccess: getCheckedRadio("saunaSteamAccess"),
            grpClasses: getCheckedCheckbox("groupClasses[]")
        };
    }
    else if(result && selectedProduct == "Premium") {
        orderDetails = {
            product: selectedProduct,
            membershipLength: getCheckedRadio("membershipLength"),
            qty: qty,
            personalTraining: getCheckedRadio("personalTraining"),
            guestPasses: getCheckedRadio("guestPasses"),
            merchandise: getCheckedCheckbox("merchandise[]"),
            nutritionalCoaching: getCheckedRadio("nutritionalCoaching")
        };
    }
    else if(result && selectedProduct == "Elite") {
        orderDetails = {
            product: selectedProduct,
            membershipLength: getCheckedRadio("membershipLength"),
            qty: qty,
            personalTraining: getCheckedRadio("personalTraining"),
            guestPasses: getCheckedRadio("guestPasses"),
            merchandise: getCheckedCheckbox("merchandise[]"),
            bodyCompositionAnalysis: getCheckedRadio("bodyCompositionAnalysis")
        };
    }

    if(result) {
        storeOrder(customerDetails, orderDetails);
    }

    return result;
}

function storeOrder(customer, order) {
    //storing customer details in the sessionStorage
    sessionStorage.fname = customer.fname;
    sessionStorage.lname = customer.lname;
    sessionStorage.email = customer.email;
    sessionStorage.phoneNumber = customer.phoneNumber;
    sessionStorage.preferredContact = customer.preferredContact;
    sessionStorage.streetAddress = customer.streetAddress;
    sessionStorage.town = customer.town;
    sessionStorage.state = customer.state;
    sessionStorage.postCode = customer.postCode;

    //storing general order details in the sessionStorage
    sessionStorage.product = order.product;
    sessionStorage.membershipLength = order.membershipLength;
    sessionStorage.qty = order.qty;

    //storing specific order details in the sessionStorage
    if(order.product == "Basic") {
        sessionStorage.clubLoc = order.clubLoc;
        sessionStorage.saunaSteamAccess = order.saunaSteamAccess;
        sessionStorage.grpClasses = order.grpClasses;
    }
    else if(order.product == "Premium") {
        sessionStorage.personalTraining = order.personalTraining;
        sessionStorage.guestPasses = order.guestPasses;
        sessionStorage.merchandise = order.merchandise;
        sessionStorage.nutritionalCoaching = order.nutritionalCoaching;
    }
    else if(order.product == "Elite") {
        sessionStorage.personalTraining = order.personalTraining;
        sessionStorage.guestPasses = order.guestPasses;
        sessionStorage.merchandise = order.merchandise;
        sessionStorage.bodyCompositionAnalysis = order.bodyCompositionAnalysis;
    }
}

function getCheckedRadio(radioName) {
    var radioBtns = document.getElementsByName(radioName);

    for(var i = 0; i < radioBtns.length; i++) {
        if(radioBtns[i].checked) {
            return radioBtns[i].value;
        }
    }
}

function getCheckedCheckbox(checkboxName) {
    var checkboxes = document.getElementsByName(checkboxName);
    var checkedVal = [];

    for(var i = 0; i < checkboxes.length; i++) {
        if(checkboxes[i].checked) {
            checkedVal.push(checkboxes[i].value);
        }
    }

    return checkedVal;
}

function updateFeatures() {
    var productDropdown = document.getElementById("productToBuy");
    var selectedProduct = document.getElementById("productToBuy").value;
    var featuresSect = document.getElementById("productFeaturesSect");
    var quantityInput = document.getElementById("quantity");
    var selected = false;

    if(selectedProduct == "Basic") {
        featuresSect.innerHTML = `<p>
                                    <p class = "unofficialLabel">Membership Commitment Length</p>
                                    <section class = "radioAndCheck">
                                        <input type = "radio" name = "membershipLength" id = "monthly" value = "Monthly">
                                        <label for = "monthly">Monthly (1 mth)</label><br>
                                        <input type = "radio" name = "membershipLength" id = "quarterly" value = "Quarterly">
                                        <label for = "quarterly">Quarterly (4 mths)</label><br>
                                        <input type = "radio" name = "membershipLength" id = "annually" value = "Annually">
                                        <label for = "annually">Annually (12 mths)</label><br>
                                    </section>
                                </p>
                                <p>
                                    <p class = "unofficialLabel">Club Location</p>
                                    <section class = "radioAndCheck">
                                        <select name = "clubLoc" id = "clubLoc">
                                            <option value = "">Please Select</option>
                                            <option value="1 Utama">1 Utama</option>
                                            <option value="Bangsar Village">Bangsar Village</option>
                                            <option value="Klang Parade">Klang Parade</option>
                                            <option value="Main Place">Main Place</option>
                                            <option value="Mid Valley">Mid Valley</option>
                                            <option value="NU Sentral">NU Sentral</option>
                                            <option value="Paradigm Mall">Paradigm Mall</option>
                                            <option value="Sunway Pyramid">Sunway Pyramid</option>
                                        </select>
                                    </section>
                                </p>
                                <p>
                                    <p class = "unofficialLabel">Sauna & Steam Room Access</p>
                                    <section class = "radioAndCheck">
                                        <input type="radio" name="saunaSteamAccess" id="monthlyAccess" value="Monthly sauna and steam room access">
                                        <label for="monthlyAccess">Monthly access (RM 20)</label><br>

                                        <input type="radio" name="saunaSteamAccess" id="yearlyAccess" value="Yearly sauna and steam room access">
                                        <label for="yearlyAccess">Yearly access (RM 240)</label><br>

                                        <input type="radio" name="saunaSteamAccess" id="noSaunaSteam" value="None">
                                        <label for="noSaunaSteam">None</label><br><br>
                                    </section>
                                </p>
                                <p class = "fitClassLabel">KKQ group fitness classes</p>
                                <section class = "grpClass">
                                    <section>
                                        <p class="unofficialLabel">Cardio (RM 75)</p>
                                        <input type="checkbox" name="groupClasses[]" id="grit" value="Grit">
                                        <label for="grit">Grit</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="gritCardio" value="Grit Cardio">
                                        <label for="gritCardio">Grit Cardio</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="hiitKKQ" value="HIIT KKQ">
                                        <label for="hiitKKQ">HIIT KKQ</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="warriorWorkout" value="Warrior Workout">
                                        <label for="warriorWorkout">Warrior Workout</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="kickboxing" value="Kickboxing">
                                        <label for="kickboxing">Kickboxing</label><br>
                                    </section>
                                    
                                    <section>
                                        <p class="unofficialLabel">Cycle (RM 50)</p>
                                        <input type="checkbox" name="groupClasses[]" id="freestyleCycling" value="Freestyle Cycling">
                                        <label for="freestyleCycling">Freestyle Cycling</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="introRPM" value="Intro RPM">
                                        <label for="introRPM">Intro RPM</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="peloton" value="Peloton">
                                        <label for="peloton">Peloton</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="race30" value="Race 30">
                                        <label for="race30">Race 30</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="rpm" value="RPM">
                                        <label for="rpm">RPM</label><br>
                                    </section>
                                    
                                    <section>
                                        <p class="unofficialLabel">Dance (RM 50)</p>
                                        <input type="checkbox" name="groupClasses[]" id="bellyDance" value="Belly Dance">
                                        <label for="bellyDance">Belly Dance</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="bodyJam" value="Body Jam">
                                        <label for="bodyJam">Body Jam</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="zumba" value="Zumba">
                                        <label for="zumba">Zumba</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="zumbaToning" value="Zumba Toning">
                                        <label for="zumbaToning">Zumba Toning</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="uJam" value="U-Jam">
                                        <label for="uJam">U-Jam</label><br>
                                    </section>
                                    
                                    <section>
                                        <p class="unofficialLabel">Mind & Body (RM 50)</p>
                                        <input type="checkbox" name="groupClasses[]" id="yoga" value="Yoga">
                                        <label for="yoga">Yoga</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="taiChi" value="Tai Chi">
                                        <label for="taiChi">Tai Chi</label><br>

                                        <input type="checkbox" name="groupClasses[]" id="pilates" value="Pilates">
                                        <label for="pilates">Pilates</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="popPilates" value="POP Pilates">
                                        <label for="popPilates">POP Pilates</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="bodyBalance" value="Body Balance">
                                        <label for="bodyBalance">Body Balance</label><br>
                                    </section>
                                    
                                    <section>
                                        <p class="unofficialLabel">S & C (RM 75)</p>
                                        <input type="checkbox" name="groupClasses[]" id="strengthTraining" value="Strength Training">
                                        <label for="strengthTraining">Strength Training</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="coreAndCardioLift" value="Core and Cardio Lift">
                                        <label for="coreAndCardioLift">Core and Cardio Lift</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="kkqCore" value="KKQ Core">
                                        <label for="kkqCore">KKQ Core</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="bodyPump" value="Body Pump">
                                        <label for="bodyPump">Body Pump</label><br>
                                    
                                        <input type="checkbox" name="groupClasses[]" id="power" value="Power">
                                        <label for="power">Power</label><br>
                                    </section>
                                </section>`;
                                selected = true;
    }
    else if(selectedProduct == "Premium") {
        featuresSect.innerHTML = `<p>
                                    <p class = "unofficialLabel">Membership Commitment Length</p>
                                    <section class = "radioAndCheck">
                                        <input type = "radio" name = "membershipLength" id = "monthly" value = "Monthly">
                                        <label for = "monthly">Monthly (1 mth)</label><br>
                                        <input type = "radio" name = "membershipLength" id = "quarterly" value = "Quarterly">
                                        <label for = "quarterly">Quarterly (4 mths)</label><br>
                                        <input type = "radio" name = "membershipLength" id = "annually" value = "Annually">
                                        <label for = "annually">Annually (12 mths)</label><br>
                                    </section>
                                </p>
                                <p>
                                    <p class="unofficialLabel">Personal Training</p>
                                    <input type="radio" name="personalTraining" id="4sessions" value="4 personal training sessions/month">
                                    <label for="4sessions">4 sessions/mth (RM 40)</label><br>

                                    <input type="radio" name="personalTraining" id="8sessions" value="8 personal training sessions/month">
                                    <label for="8sessions">8 sessions/mth (RM 80)</label><br>

                                    <input type="radio" name="personalTraining" id="12sessions" value="12 personal training sessions/month">
                                    <label for="12sessions">12 sessions/mth (RM 120)</label><br>

                                    <input type="radio" name="personalTraining" id="noPersonalTraining" value="None">
                                    <label for="noPersonalTraining">None</label><br>
                                <p>
                                    <p class="unofficialLabel">Guest Passes</p>
                                    <input type="radio" name="guestPasses" id="5Passes" value="5 guest passes">
                                    <label for="5Passes">5 guest passes (RM 300)</label><br>

                                    <input type="radio" name="guestPasses" id="10Passes" value="10 guest passes">
                                    <label for="10Passes">10 guest passes (RM 600)</label><br>

                                    <input type="radio" name="guestPasses" id="noGuestPass" value="None">
                                    <label for="noGuestPass">None</label><br>
                                </p>
                                <p>
                                    <p class="unofficialLabel">KKQ Merchandise</p>
                                    <input type="checkbox" name="merchandise[]" id="gymShorts" value="KKQ gym shorts">
                                    <label for="gymShorts">KKQ gym shorts (RM 25)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="waterBottles" value="KKQ water bottles">
                                    <label for="waterBottles">KKQ water bottles (RM 20)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="proteinShakers" value="KKQ protein shakers">
                                    <label for="proteinShakers">KKQ protein shakers (RM 20)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="jumpRopes" value="KKQ jump ropes">
                                    <label for="jumpRopes">KKQ jump ropes (RM 20)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="resistanceBands" value="KKQ resistance bands">
                                    <label for="resistanceBands">KKQ resistance bands (RM 30)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="proteinPowder" value="KKQ protein powder">
                                    <label for="proteinPowder">KKQ protein powder (RM 35)</label><br>
                                </p>
                                <p>
                                    <p class="unofficialLabel">Nutritional Coaching</p>
                                    <input type="radio" name="nutritionalCoaching" id="oneMonthPackage" value="1-month nutrition coaching package">
                                    <label for="oneMonthPackage">1-month package (RM 20)</label><br>

                                    <input type="radio" name="nutritionalCoaching" id="threeMonthPackage" value="3-month nutrition coaching package">
                                    <label for="threeMonthPackage">3-month package (RM 60)</label><br>

                                    <input type="radio" name="nutritionalCoaching" id="dieticianWork" value="Work directly with a registered dietician">
                                    <label for="dieticianWork">Work directly with a dietician (RM 100)</label><br>

                                    <input type="radio" name="nutritionalCoaching" id="nonutritionalCoaching" value="None">
                                    <label for="nonutritionalCoaching">None</label><br>
                                </p>`;
                                selected = true;
    }
    else if(selectedProduct == "Elite") {
        featuresSect.innerHTML = `<p>
                                    <p class = "unofficialLabel">Membership Commitment Length</p>
                                    <section class = "radioAndCheck">
                                        <input type = "radio" name = "membershipLength" id = "monthly" value = "Monthly">
                                        <label for = "monthly">Monthly (1 mth)</label><br>
                                        <input type = "radio" name = "membershipLength" id = "quarterly" value = "Quarterly">
                                        <label for = "quarterly">Quarterly (4 mths)</label><br>
                                        <input type = "radio" name = "membershipLength" id = "annually" value = "Annually">
                                        <label for = "annually">Annually (12 mths)</label><br>
                                    </section>
                                </p>
                                <p>
                                    <p class="unofficialLabel">Personal Training</p>

                                    <input type="radio" name="personalTraining" id="8sessions" value="8 personal training sessions/month">
                                    <label for="8sessions">8 sessions/mth (RM 50)</label><br>

                                    <input type="radio" name="personalTraining" id="12sessions" value="12 personal training sessions/month">
                                    <label for="12sessions">12 sessions/mth (RM 100)</label><br>

                                    <input type="radio" name="personalTraining" id="noPersonalTraining" value="None">
                                    <label for="noPersonalTraining">None</label><br>
                                </p>
                                <p>
                                    <p class="unofficialLabel">Guest Passes</p>
                                    <input type="radio" name="guestPasses" id="5Passes" value="5 guest passes">
                                    <label for="5Passes">5 guest passes (RM 300)</label><br>

                                    <input type="radio" name="guestPasses" id="10Passes" value="10 guest passes">
                                    <label for="10Passes">10 guest passes (RM 600)</label><br>

                                    <input type="radio" name="guestPasses" id="noGuestPass" value="None">
                                    <label for="noGuestPass">None</label><br>
                                </p>
                                <p>
                                    <p class="unofficialLabel">KKQ Merchandise</p>
                                    <input type="checkbox" name="merchandise[]" id="gymShorts" value="KKQ gym shorts">
                                    <label for="gymShorts">KKQ gym shorts (RM 25)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="waterBottles" value="KKQ water bottles">
                                    <label for="waterBottles">KKQ water bottles (RM 20)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="proteinShakers" value="KKQ protein shakers">
                                    <label for="proteinShakers">KKQ protein shakers (RM 20)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="jumpRopes" value="KKQ jump ropes">
                                    <label for="jumpRopes">KKQ jump ropes (RM 20)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="resistanceBands" value="KKQ resistance bands">
                                    <label for="resistanceBands">KKQ resistance bands (RM 30)</label><br>

                                    <input type="checkbox" name="merchandise[]" id="proteinPowder" value="KKQ protein powder">
                                    <label for="proteinPowder">KKQ protein powder (RM 35)</label><br>
                                </p>
                                <p>
                                    <p class="unofficialLabel">Body Composition Analysis</p>
                                    <input type="radio" name="bodyCompositionAnalysis" id="quarterlyAnalysis" value="Quarterly body composition analysis">
                                    <label for="quarterlyAnalysis">Quarterly analysis (RM 300)</label><br>

                                    <input type="radio" name="bodyCompositionAnalysis" id="yearlyAnalysis" value="Yearly body composition analysis">
                                    <label for="yearlyAnalysis">Yearly analysis (RM 600)</label><br>

                                    <input type="radio" name="bodyCompositionAnalysis" id="noBodyCompositionAnalysis" value="None">
                                    <label for="noBodyCompositionAnalysis">None</label><br>
                                </p>`;
                                selected = true;
    }
    else {
        featuresSect.innerHTML = ``;
        quantityInput.style.display = "none";
        productDropdown.style.marginBottom = "2rem";
    }

    if(selected) {
        quantityInput.style.display = "block";
        productDropdown.style.marginBottom = "0rem";
    }
}

function init() {
    var enquiryForm = document.getElementById("enquiryForm");
    enquiryForm.onsubmit = validate;

    var productDropdown = document.getElementById("productToBuy");
    productDropdown.onchange = updateFeatures;

    updateFeatures();
}

window.onload = init;

/*
"<section class = \"radioAndCheck\"><input type = \"radio\" name = \"preferredContact\" id = \"emailContact\" value = \"Email\">
                                <label for = \"emailContact\">Email</label><br>
                        
                                <input type = \"radio\" name = \"preferredContact\" id = \"post\" value = \"Post\">
                                <label for = \"post\">Post</label><br>
                        
                                <input type = \"radio\" name = \"preferredContact\" id = \"phone\" value = \"Phone\">
                                <label for = \"phone\">Phone</label><br></section>"

<section class = "confirmOrderSect">
                <section class = "orderSummarySect">
                        <h1>Order Summary</h1>
        
                        <!--Dynamically Displaying Product Features-->
                        <!--Basic Features-->
                        <p id="payment_product"></p>
                        <input type = "hidden" name = "product" id = "product"/>
                        <table>
                            <tr>
                                <td id = "label_cost">Total Price</td>
                                <td id = "payment_cost"></td>
                                <input type = "hidden" name = "cost" id = "cost"/>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td id="payment_qty"></td>
                                <input type = "hidden" name = "qty" id = "qty"/>
                            </tr>
                            <!--One basic feature-->
                            <tr>
                                <td id = "label_clubLoc"></td>
                                <td id = "payment_clubLoc"></td>
                                <input type = "hidden" name = "clubLoc" id = "clubLoc"/>
                            </tr>
                            <tr>
                                <td id = "label_membershipLength"></td>
                                <td id="payment_membershipLength"></td>
                                <input type = "hidden" name = "membershipLength" id = "membershipLength"/>
                            </tr>
                            <!--Basic Features-->
                            <tr>
                                <td id = "label_saunaSteamAccess"></td>
                                <td id = "payment_saunaSteamAccess"></td>
                                <input type = "hidden" name = "saunaSteamAccess" id = "saunaSteamAccess"/>
                            </tr>
                            <tr>
                                <td id = "label_grpClasses"></td>
                                <td id = "payment_grpClasses"></td>
                                <input type = "hidden" name = "grpClasses" id = "grpClasses"/>
                            </tr>
                            <!--Premium Features-->
                            <tr>
                                <td id = "label_personalTrainingPrem"></td>
                                <td id = "payment_personalTrainingPrem"></td>
                                <input type = "hidden" name = "personalTrainingPrem" id = "personalTrainingPrem"/>
                            </tr>
                            <tr>
                                <td id = "label_guestPassesPrem"></td>
                                <td id = "payment_guestPassesPrem"></td>
                                <input type = "hidden" name = "guestPassesPrem" id = "guestPassesPrem"/>
                            </tr>
                            <tr>
                                <td id = "label_merchandisePrem"></td>
                                <td id = "payment_merchandisePrem"></td>
                                <input type = "hidden" name = "merchandisePrem" id = "merchandisePrem"/>
                            </tr>
                            <tr>
                                <td id = "label_nutritionalCoaching"></td>
                                <td id = "payment_nutritionalCoaching"></td>
                                <input type = "hidden" name = "nutritionalCoaching" id = "nutritionalCoaching"/>
                            </tr>
                            <!--Elite Features-->
                            <tr>
                                <td id = "label_personalTrainingElite"></td>
                                <td id = "payment_personalTrainingElite"></td>
                                <input type = "hidden" name = "personalTrainingElite" id = "personalTrainingElite"/>
                            </tr>
                            <tr>
                                <td id = "label_guestPassesElite"></td>
                                <td id = "payment_guestPassesElite"></td>
                                <input type = "hidden" name = "guestPassesElite" id = "guestPassesElite"/>
                            </tr>
                            <tr>
                                <td id = "label_merchandiseElite"></td>
                                <td id = "payment_merchandiseElite"></td>
                                <input type = "hidden" name = "merchandiseElite" id = "merchandiseElite"/>
                            </tr>
                            <tr>
                                <td id = "label_bodyCompositionAnalysis"></td>
                                <td id = "payment_bodyCompositionAnalysis"></td>
                                <input type = "hidden" name = "bodyCompositionAnalysis" id = "bodyCompositionAnalysis"/>
                            </tr>
                        </table>
                    </section>
                </section>
                <section class = "paymentSect">
                    <h1>Payment Details</h1>
                    <p id = "paymentLabel">Credit Card Type</p>
                    
                    <section id = "ccTypeSect">
                        <section>
                            <input type="radio" name="ccType" id="visa" value="Visa"></input> <!-- -->
                            <label for="visa" class = "ccType"><img class = "ccIcon" src = "images/visa.png" alt = "Visa Credit Card Icon"><p>Visa</p></label>
                        </section>
                        
                        <section>
                            <input type="radio" name="ccType" id="mastercard" value="Mastercard">
                            <label for="mastercard" class = "ccType"><img class = "ccIcon" src = "images/mastercard.png" alt = "Mastercard Card Icon"><p>Mastercard</p></label>
                        </section>
                        
                        <section>
                            <input type="radio" name="ccType" id="amex" value="American Express">
                            <label for="amex" class = "ccType"><img class = "ccIcon" src = "images/american-express.png" alt = "American Express Credit Card Icon"><p id = "amexOpt">American Express</p></label><br>
                        </section>
                    </section>
                    
                    <label for = "ccName">Name on Credit Card</label><br>
                    <input type = "text" name = "ccName" id = "ccName" placeholder="John Doe" pattern="[a-zA-Z ]{2,40}" required><br>
    
                    <label for = "ccNum">Credit Card Number</label><br>
                    <input type = "text" name = "ccNum" id = "ccNum" placeholder="1111222233334444" pattern="\d{15,16}" required><br>
    
                    <label for="expDate">Credit Card Expiry Date</label><br>
                    <input type="text" id="expDate" name="expDate" placeholder="MM-YY" pattern="\d{2}-\d{2}" required><br>
    
                    <label for = "cvv">Card Verification Value (CVV)</label><br>
                    <input type = "text" name = "cvv" id = "cvv" placeholder="123" pattern="\d{3,4}" required><br>
                </section>
            </section>

            <section id = "checkoutSect">
                <button type="button" id = "cancelBtn">Cancel Order</button>
                <input type = "submit" value = "Check Out" id = "checkOut">
            </section>
*/