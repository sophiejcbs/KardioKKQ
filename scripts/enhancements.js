/**
 * Author: Sophie Nadine Jacobs (104520476)
 * Target: payment.html, product.html
 * Purpose: This file is for creating a timer on the Payment page, displaying products dynamically in the Product page, and pre-loading the Credit Card Name in the Payment form
 * Created: 16/5/2023
 * Last updated: 21/5/2023
 * Credits: COS10011 Lab 5,6 + L5,L6,L7 (Learning Materials on Canvas)
 */

"use strict";

function updateTimer() {
    var endDate = new Date();
    endDate.setMinutes(new Date().getMinutes() + 15);
    endDate.setSeconds(new Date().getSeconds() + 2);

    setInterval(function() {
        var currentDate = new Date().getTime();
        
        var interval = endDate.getTime() - currentDate;

        var minutes = Math.floor((interval % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((interval % (1000 * 60)) / 1000);

        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";  

        if (interval < 0) {
            clearInterval(this);
            document.getElementById("timer").innerHTML = "0m 0s";  
            alert("Your session has expired.\nPlease select a product from the Enquiry page again.");
            window.location = "index.php";
            sessionStorage.clear();
        }
    }, 1000);
}

function displayProducts() {
    var productTypeList = document.getElementsByName("membershipType");
    var productType;

    for(var i = 0; i<productTypeList.length; i++) {
        if(productTypeList[i].checked) {
            productType = productTypeList[i].value;
        }
    }

    var basicMembership = {
        img: "images/basicPlan.jpg",
        header: "Basic Membership",
        subheader: "All the Weights and Cardio you'll ever need",
        desc: "Unlock your inner potential with access to all the top-of-the-line cardio and strength equipment you'll ever need in our functional training area and turf zone, all at your club of enrollment. Push your muscles to the max with our free weights and strength training machines, and feel the burn with our wide selection of cardio equipment. And with access to our cutting-edge equipment such as TRX Suspension Training and Olympic Training Rigs, you can take your workouts to the next level. But that’s not all! We also offer a variety of KKQ virtual fitness classes and on-demand workouts ranging from HIIT, and kickboxing, all the way to Zumba, for you to try out anytime, anywhere. As if that weren’t enough, you’ll also receive guidance from our expert trainers on goal-setting to push yourself to the next level, and a free monthly physical assessment for you to track your progress. And for your convenience, enjoy access to our locker rooms, and free WiFi.",
        notice: "*These are addons not included in the base plan.",
        features: {
            commitmentLength: ["Monthly (1 month) [RM 120]","Quarterly (4 months) [RM 480]","Annually (12 months) [RM 1440]"],
            clubLoc: { 
                name: "Club locations (Pick 1)",
                options: ["1 Utama",
                "Bangsar Village",
                "Klang Parade",
                "Main Place",
                "Mid Valley",
                "NU Sentral",
                "Paradigm Mall",
                "Sunway Pyramid"
            ]
            },
            saunaSteamAccess: {
                name: "Addon Sauna & Steam Room Access*",
                options: ["Monthly access to the sauna and steam room (RM 20)","Yearly access to the sauna and steam room (RM 240)"]
            },
            grpClasses: {
                name: "Addon KKQ group fitness classes* (Pick Maximum of 3 Classes)",
                cardio: [
                    "Grit",
                    "Grit Cardio",
                    "HIIT KKQ",
                    "Warrior Workout",
                    "Kickboxing"
                  ],
                  cycle: [
                    "Freestyle Cycling",
                    "Intro RPM",
                    "Peloton",
                    "Race 30",
                    "RPM"
                  ],
                  dance: [
                    "Belly Dance",
                    "Body Jam",
                    "Zumba",
                    "Zumba Toning",
                    "U-Jam"
                  ],
                  mindBod: [
                    "Yoga",
                    "Tai Chi",
                    "Pilates",
                    "POP Pilates",
                    "Body Balance"
                  ],
                  strCond: ["Strength Training",
                  "Core and Cardio Lift",
                  "KKQ Core",
                  "Body Pump",
                  "Power"]
            }
        },
        testimonials: ["I joined Kardio Kings & Queens as a Basic member and have been impressed with their virtual classes. The physical assessment helped me set achievable goals and I'm already seeing progress in my fitness journey.", "The basic fitness membership is a game-changer! Top-notch equipment, expert trainers, and convenient amenities. Joining was the best decision!"]
    };

    var premiumMembership = {
        img: "images/premiumPlan.jpg",
        header: "Premium Membership",
        subheader: "More Facilities, More Classes - at More Locations",
        desc: "Elevate your fitness game and motivation to new heights with unlimited access to all premium amenities and our energizing KKQ fitness classes – at any club in the region. Whether you're looking to shoot some hoops with friends, take a swim, or recover in whirlpools and saunas, we’ve got you covered. Plus, get access to our exclusive KKQ fitness classes such as our heart-pumping KKQ studio and cycle classes. But don’t stop there! Bring your fitness journey along wherever you are with access to our KKQ virtual classes and on-demand workouts. And to help you achieve the most optimal results, our advanced physical assessments will help you understand where you need to improve, and our expert trainers will create a personalized workout plan tailored for you. And don’t forget that you’ll be able to enjoy exclusive discounts on personal training sessions and other add-ons to make your fitness dreams that much more achievable. So, what are you waiting for? Fight to be fit today with our premium membership.",
        notice: "The Premium plan already includes all features of the Basic plan.<br>*These are addons not included in the base plan.",
        features: {
            commitmentLength: ["Monthly (1 month) [RM 200]","Quarterly (4 months) [RM 800]","Annually (12 months) [RM 2400]"],
            personalTraining: { 
                name: 'Personal Training',
                options: [
                    "4 personal training sessions/month (RM 40)",
                    "8 personal training sessions/month (RM 80)",
                    "12 personal training sessions/month (RM 120)"
                ]
            },
            guestPasses: {
                name: "Addon Guest Passes* (discounted)",
                options: ["5 guest passes (RM 300)","10 guest passes (RM 600)"]
            },
            merchandise: {
                name: "Addon KKQ merchandise* (discounted)",
                options: [
                    "KKQ gym shorts (RM 25)",
                    "KKQ water bottles (RM 20)",
                    "KKQ protein shakers (RM 20)",
                    "KKQ jump ropes (RM 20)",
                    "KKQ resistance bands (RM 30)",
                    "KKQ supplements protein powder (RM 35)"
                ]
            },
            nutritionalCoaching: {
                name: "Addon Nutritional Coaching*",
                options: [
                    "1-month nutrition coaching package (RM 20)",
                    "3-month nutrition coaching package (RM 60)",
                    "Work directly with a registered dietician (RM 100)"
                ]
            }
        },
        testimonials: ["The premium membership changed my fitness game. Unlimited access to amenities, exclusive KKQ classes, and expert guidance transformed my workouts. Assessments and tailored plans boosted my results. Virtual classes and discounts kept me motivated. Join now and unleash your potential!", "Unbeatable value! The advanced assessments and personalized workout plan helped me achieve optimal results. Highly recommend the premium membership!"]
    };

    var eliteMembership = {
        img: "images/elitePlan.jpg",
        header: "Elite Membership",
        subheader: "Stay Fit & Feel Great - Anytime, Anywhere",
        desc: "Everything’s better when you’re with the ones that light up your life. Our elite membership provides you with everything you need to stay motivated and be the best version of yourself – access to all KKQ clubs nationwide, unlimited access to all club amenities, and exclusive access to our KKQ fitness classes and virtual classes. But that’s not all! With nutritional coaching, advanced physical assessments, and personalized workout plans, you’ll be able to perfect your workouts, and be in the best shape of your life whilst also feeling the best you can feel. But we know you can feel even better, when you’re with the ones that fill up your cup. That’s why we’re offering 2 GUEST PASSES so your friends and family can grow on this fitness adventure with you. And with unlimited access to personal training sessions, you can work with our expert trainers to perfect your workouts and push yourself past the limits. ",
        notice: "The Elite plan already includes all features of the Premium plan.<br>*These are addons not included in the base plan.",
        features: {
            commitmentLength: ["Monthly (1 month) [RM 280]","Quarterly (4 months) [RM 1120]","Annually (12 months) [RM 3360]"],
            personalTraining: { 
                name: 'Personal Training',
                options: ["8 personal training sessions/month (RM 50)","12 personal training sessions/month (RM 100)"]
            },
            guestPasses: {
                name: "Addon Guest Passes* (discounted)",
                options: ["5 guest passes (RM 200)","10 guest passes (RM 400)"]
            },
            merchandise: {
                name: "Addon KKQ merchandise* (discounted)",
                options: [
                    "KKQ gym shorts (RM 25)",
                    "KKQ water bottles (RM 20)",
                    "KKQ protein shakers (RM 20)",
                    "KKQ jump ropes (RM 20)",
                    "KKQ resistance bands (RM 30)",
                    "KKQ supplements protein powder (RM 35)"
                ]
            },
            bodyCompositionAnalysis: {
                name: "Addon Body Composition Analysis*",
                options: [
                    "Quarterly body composition analysis (RM 300)",
                    "Yearly body composition analysis (RM 600)"
                ]
            }
        },
        testimonials: ["Unleashing my potential with the elite membership was a game-changer. Nationwide access, personalized plans, and unlimited amenities fueled my fitness journey like never before!", "Experiencing fitness excellence through the elite membership exceeded my expectations. Exclusive classes, expert guidance, and sharing the journey with loved ones made it truly unforgettable."]
    };

    var membershipLengthInnerHTML = "";
    var clubLocInnerHTML = "";
    var saunaSteamInnerHTML = "";
    var personalTrainingInnerHTML = "";
    var guestPassInnerHTML = "";
    var merchInnerHTML = "";
    var nutritionalCoachingInnerHTML = "";
    var bodyCompInnerHTML = "";

    if(productType == "basic") {
        document.getElementsByClassName("membershipImg")[0].src = `${basicMembership.img}`;
        document.getElementsByClassName("membershipHeaderDesc")[0].innerHTML = `${basicMembership.header}`;
        document.getElementsByClassName("membershipSubheaderDesc")[0].innerHTML = `${basicMembership.subheader}`;
        document.getElementsByClassName("featureDesc")[0].innerHTML = `${basicMembership.desc}`;
        document.getElementsByClassName("notice")[0].innerHTML = `${basicMembership.notice}`;

        //commitment length
        for(var i = 0; i<basicMembership.features.commitmentLength.length; i++) {
            membershipLengthInnerHTML += `<li>${basicMembership.features.commitmentLength[i]}</li>`;
        }
        document.getElementsByClassName("1stFeature")[0].innerHTML = membershipLengthInnerHTML;

        //club location
        document.getElementsByClassName("featureName")[1].innerHTML = `${basicMembership.features.clubLoc.name}`;
        for(var i = 0; i<basicMembership.features.clubLoc.options.length; i++) {
            clubLocInnerHTML += `<li>${basicMembership.features.clubLoc.options[i]}</li>`;
        }
        document.getElementsByClassName("2ndFeature")[0].innerHTML = clubLocInnerHTML;

        //sauna & steam access
        document.getElementsByClassName("featureName")[2].innerHTML = `${basicMembership.features.saunaSteamAccess.name}`;
        for(var i = 0; i<basicMembership.features.saunaSteamAccess.options.length; i++) {
            saunaSteamInnerHTML += `<li>${basicMembership.features.saunaSteamAccess.options[i]}</li>`;
        }
        document.getElementsByClassName("3rdFeature")[0].innerHTML = saunaSteamInnerHTML;

        //group classes
        document.getElementsByClassName("featureName")[3].innerHTML = "Addon KKQ group fitness classes* (Pick Maximum of 3 Classes)";
        document.getElementById("classBasicFeat").style.display = "block";
        document.getElementsByClassName("membershipSubcontainer2")[0].style.display = "none";
        document.getElementById("fitnessClassesTable").innerHTML = `<thead>
                                                                    <tr>
                                                                        <th>Cardio & HIIT</th>
                                                                        <th>Cycle</th>
                                                                        <th>Dance</th>
                                                                        <th>Mind and Body</th>
                                                                        <th>Strength and Conditioning</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Grit</td>
                                                                        <td>Freestyle Cycling</td>
                                                                        <td>Belly Dance</td>
                                                                        <td>Yoga</td>
                                                                        <td>Strength Training</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Grit Cardio</td>
                                                                        <td>Intro RPM</td>
                                                                        <td>Body Jam</td>
                                                                        <td>Tai Chi</td>
                                                                        <td>Core and Cardio Lift</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>HIIT KKQ</td>
                                                                        <td>Peloton</td>
                                                                        <td>Zumba</td>
                                                                        <td>Pilates</td>
                                                                        <td>KKQ Core</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Warrior Workout</td>
                                                                        <td>Race 30</td>
                                                                        <td>Zumba Toning</td>
                                                                        <td>POP Pilates</td>
                                                                        <td>Body Pump</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Kickboxing</td>
                                                                        <td>RPM</td>
                                                                        <td>U-Jam</td>
                                                                        <td>Body Balance</td>
                                                                        <td>Power</td>
                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>RM 75 add on</th>
                                                                        <th>RM 50 add on</th>
                                                                        <th>RM 50 add on</th>
                                                                        <th>RM 50 add on</th>
                                                                        <th>RM 75 add on</th>
                                                                    </tr>
                                                                </tfoot>`;
        
        //references
        document.getElementsByClassName("references")[0].innerHTML = 'References: <a href = "https://www.24hourfitness.com/membership/membership-options/">24 Hour Fitness Memberships</a>, <a href = "https://www.24hourfitness.com/programs/classes/cardio">24 Hour Fitness Classes</a>, and <a href = "https://www.celebrityfitness.com.my/classes">Celebrity FItness Classes</a>';
        
        //testimonials
        document.getElementsByClassName("testimonial")[0].innerHTML = `${basicMembership.testimonials[0]}`;
        document.getElementsByClassName("testimonial")[1].innerHTML = `${basicMembership.testimonials[1]}`;
    }

    else if(productType == "premium") {
        document.getElementsByClassName("membershipImg")[0].src = `${premiumMembership.img}`;
        document.getElementsByClassName("membershipHeaderDesc")[0].innerHTML = `${premiumMembership.header}`;
        document.getElementsByClassName("membershipSubheaderDesc")[0].innerHTML = `${premiumMembership.subheader}`;
        document.getElementsByClassName("featureDesc")[0].innerHTML = `${premiumMembership.desc}`;
        document.getElementsByClassName("notice")[0].innerHTML = `${premiumMembership.notice}`;

        //commitment length
        for(var i = 0; i<premiumMembership.features.commitmentLength.length; i++) {
            membershipLengthInnerHTML += `<li>${premiumMembership.features.commitmentLength[i]}</li>`;
        }
        document.getElementsByClassName("1stFeature")[0].innerHTML = membershipLengthInnerHTML;

        //personal training
        document.getElementsByClassName("featureName")[1].innerHTML = `${premiumMembership.features.personalTraining.name}`;
        for(var i = 0; i<premiumMembership.features.personalTraining.options.length; i++) {
            personalTrainingInnerHTML += `<li>${premiumMembership.features.personalTraining.options[i]}</li>`;
        }
        document.getElementsByClassName("2ndFeature")[0].innerHTML = personalTrainingInnerHTML;

        //guest passes
        document.getElementsByClassName("featureName")[2].innerHTML = `${premiumMembership.features.guestPasses.name}`;
        for(var i = 0; i<premiumMembership.features.guestPasses.options.length; i++) {
            guestPassInnerHTML += `<li>${premiumMembership.features.guestPasses.options[i]}</li>`;
        }
        document.getElementsByClassName("3rdFeature")[0].innerHTML = guestPassInnerHTML;

        document.getElementById("classBasicFeat").style.display = "none";
        document.getElementsByClassName("membershipSubcontainer2")[0].style.display = "flex";

        //merchandise
        document.getElementsByClassName("featureName")[4].innerHTML = `${premiumMembership.features.merchandise.name}`;
        for(var i = 0; i<premiumMembership.features.merchandise.options.length; i++) {
            merchInnerHTML += `<li>${premiumMembership.features.merchandise.options[i]}</li>`;
        }
        document.getElementsByClassName("4thFeature")[0].innerHTML = merchInnerHTML;

        //nutritional coaching
        document.getElementsByClassName("featureName")[5].innerHTML = `${premiumMembership.features.nutritionalCoaching.name}`;
        for(var i = 0; i<premiumMembership.features.nutritionalCoaching.options.length; i++) {
            nutritionalCoachingInnerHTML += `<li>${premiumMembership.features.nutritionalCoaching.options[i]}</li>`;
        }
        document.getElementsByClassName("5thFeature")[0].innerHTML = nutritionalCoachingInnerHTML;

        //references
        document.getElementsByClassName("references")[0].innerHTML = 'References: <a href = "https://www.24hourfitness.com/membership/membership-options/">24 Hour Fitness Memberships</a>';

        //testimonials
        document.getElementsByClassName("testimonial")[0].innerHTML = `${premiumMembership.testimonials[0]}`;
        document.getElementsByClassName("testimonial")[1].innerHTML = `${premiumMembership.testimonials[1]}`;
    }

    else if(productType == "elite") {
        document.getElementsByClassName("membershipImg")[0].src = `${eliteMembership.img}`;
        document.getElementsByClassName("membershipHeaderDesc")[0].innerHTML = `${eliteMembership.header}`;
        document.getElementsByClassName("membershipSubheaderDesc")[0].innerHTML = `${eliteMembership.subheader}`;
        document.getElementsByClassName("featureDesc")[0].innerHTML = `${eliteMembership.desc}`;
        document.getElementsByClassName("notice")[0].innerHTML = `${eliteMembership.notice}`;

        //commitment length
        for(var i = 0; i<eliteMembership.features.commitmentLength.length; i++) {
            membershipLengthInnerHTML += `<li>${eliteMembership.features.commitmentLength[i]}</li>`;
        }
        document.getElementsByClassName("1stFeature")[0].innerHTML = membershipLengthInnerHTML;

        //personal training
        document.getElementsByClassName("featureName")[1].innerHTML = `${eliteMembership.features.personalTraining.name}`;
        for(var i = 0; i<eliteMembership.features.personalTraining.options.length; i++) {
            personalTrainingInnerHTML += `<li>${eliteMembership.features.personalTraining.options[i]}</li>`;
        }
        document.getElementsByClassName("2ndFeature")[0].innerHTML = personalTrainingInnerHTML;

        //guest passes
        document.getElementsByClassName("featureName")[2].innerHTML = `${eliteMembership.features.guestPasses.name}`;
        for(var i = 0; i<eliteMembership.features.guestPasses.options.length; i++) {
            guestPassInnerHTML += `<li>${eliteMembership.features.guestPasses.options[i]}</li>`;
        }
        document.getElementsByClassName("3rdFeature")[0].innerHTML = guestPassInnerHTML;

        document.getElementById("classBasicFeat").style.display = "none";
        document.getElementsByClassName("membershipSubcontainer2")[0].style.display = "flex";

        //merchandise
        document.getElementsByClassName("featureName")[4].innerHTML = `${eliteMembership.features.merchandise.name}`;
        for(var i = 0; i<eliteMembership.features.merchandise.options.length; i++) {
            merchInnerHTML += `<li>${eliteMembership.features.merchandise.options[i]}</li>`;
        }
        document.getElementsByClassName("4thFeature")[0].innerHTML = merchInnerHTML;

        //nutritional coaching
        document.getElementsByClassName("featureName")[5].innerHTML = `${eliteMembership.features.bodyCompositionAnalysis.name}`;
        for(var i = 0; i<eliteMembership.features.bodyCompositionAnalysis.options.length; i++) {
            bodyCompInnerHTML += `<li>${eliteMembership.features.bodyCompositionAnalysis.options[i]}</li>`;
        }
        document.getElementsByClassName("5thFeature")[0].innerHTML = bodyCompInnerHTML;

        //references
        document.getElementsByClassName("references")[0].innerHTML = 'References: <a href = "https://www.24hourfitness.com/membership/membership-options/">24 Hour Fitness Memberships</a>';

        //testimonials
        document.getElementsByClassName("testimonial")[0].innerHTML = `${eliteMembership.testimonials[0]}`;
        document.getElementsByClassName("testimonial")[1].innerHTML = `${eliteMembership.testimonials[1]}`;
    }
}

function init2() {
    if(document.getElementById("basicDynamic") != undefined) {
        displayProducts();

        var basicRad = document.getElementById("basicDynamic");
        var premRad = document.getElementById("premDynamic");
        var eliteRad = document.getElementById("eliteDynamic");

        basicRad.onclick = displayProducts;
        premRad.onclick = displayProducts;
        eliteRad.onclick = displayProducts;
    }
    
    if(document.getElementById("timer") != undefined) {
        updateTimer();
        if(window.location.href.includes("payment.php")) {
            if(sessionStorage.fname != "" || sessionStorage.lname != "") {
                document.getElementById("ccName").value = sessionStorage.fname + " " + sessionStorage.lname;
            }
        }
    }
    
    init();
}

window.onload = init2;