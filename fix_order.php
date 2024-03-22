<!-- Description: Redirected here when process_order has found errors (there are elements in errors array) -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<?php 
    session_start(); //start session
    if(!isset($_SESSION["errors"])) { //check if session var exists
        header("location: enquire.php");
    }
    $errors = $_SESSION["errors"];
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF‐8"/>
    <meta name="description" content="Fitness Club Membership Validation"/>
    <meta name="keywords" content="order,validation, fix"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>Fix Order | Kardio Kings & Queens</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.png"> <!--https://www.flaticon.com/free-icons/muscle: Muscle icons created by Dragon Icons - Flaticon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <link href = "styles/style.css" rel = "stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 995px)" href="styles/responsive.css">

    <script src="scripts/fix_order.js"></script>
    <script src="scripts/enhancements.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>
<?php
    include "includes/header.inc";
?>
<?php
    /* Using Associative Arrays to Dynamically Display Form Inputs */
    /* Name/ID => Label */
    $contactDetails = [
        "fname" => "First name",
        "lname" => "Last name",
        "email" => "Email",
        "phoneNumber" => "Phone number",
        "preferredContact" => "Preferred contact"
    ];

    $addrDetails = [
        "streetAddress" => "Street address",
        "town" => "Suburb/town",
        "state" => "State",
        "postCode" => "Postcode"
    ];

    $preferredContact = [
        "emailContact" => "Email",
        "post" => "Post",
        "phone" => "Phone",
    ];

    $states = [
        "VIC" => "VIC",
        "NSW" => "NSW",
        "QLD" => "QLD",
        "NT" => "NT",
        "WA" => "WA",
        "SA" => "SA",
        "TAS" => "TAS",
        "ACT" => "ACT"
    ];

    //general product details (required for each membership type)
    $product = [
        "Basic" => "Basic (RM 120/mth)",
        "Premium" => "Premium (RM 200/mth)",
        "Elite" => "Elite (RM 280/mth)"
    ];

    //no membership selection
    $noProd = [
        "product" => "Product",
        "qty" => "Quantity"
    ];

    //basic features
    $basic = [
        "product" => "Product",
        "qty" => "Quantity",
        "membershipLength" => "Membership Commitment Length",
        "clubLoc" => "Club Location",
        "saunaSteamAccess" => "Sauna & Steam Room Access",
        "grpClasses" => "KKQ group fitness classes"
    ];

    //premium features
    $premium = [
        "product" => "Product",
        "qty" => "Quantity",
        "membershipLength" => "Membership Commitment Length",
        "personalTrainingPrem" => "Personal Training",
        "guestPassesPrem" => "Guest Passes",
        "merchandisePrem" => "KKQ Merchandise",
        "nutritionalCoaching" => "Nutritional Coaching"
    ];

    //elite features
    $elite = [
        "product" => "Product",
        "qty" => "Quantity",
        "membershipLength" => "Membership Commitment Length",
        "personalTrainingElite" => "Personal Training",
        "guestPassesElite" => "Guest Passes",
        "merchandiseElite" => "KKQ Merchandise",
        "bodyCompositionAnalysis" => "Body Composition Analysis"
    ];


    //specific product details (features are different for each membership)
    $membershipLength = [
        "monthly" => [
            "label" => "Monthly (1 mth)",
            "value" => "Monthly"
        ],
        "quarterly" => [
            "label" => "Quarterly (4 mths)",
            "value" => "Quarterly"
        ],
        "annually" => [
            "label" => "Annually (12 mths)",
            "value" => "Annually"
        ]
    ];
    
    $clubLoc = [
        "1 Utama" => "1 Utama",
        "Bangsar Village" => "Bangsar Village",
        "Klang Parade" => "Klang Parade",
        "Main Place" => "Main Place",
        "Mid Valley" => "Mid Valley",
        "NU Sentral" => "NU Sentral",
        "Paradigm Mall" => "Paradigm Mall",
        "Sunway Pyramid" => "Sunway Pyramid"
    ];
    
    $saunaSteamAccess = [
        "monthlyAccess" => [
            "label" => "Monthly access (RM 20)",
            "value" => "Monthly sauna and steam room access"
        ],
        "yearlyAccess" => [
            "label" => "Yearly access (RM 240)",
            "value" => "Yearly sauna and steam room access"
        ],
        "noSaunaSteam" => [
            "label" => "None",
            "value" => "None"
        ]
    ];
    
    $grpClasses = [
        "Cardio (RM 75)" => [
            "grit" => "Grit",
            "gritCardio" => "Grit Cardio",
            "hiitKKQ" => "HIIT KKQ",
            "warriorWorkout" => "Warrior Workout",
            "kickboxing" => "Kickboxing"
        ],
        "Cycle (RM 50)" => [
            "freestyleCycling" => "Freestyle Cycling",
            "introRPM" => "Intro RPM",
            "peloton" => "Peloton",
            "race30" => "Race 30",
            "rpm" => "RPM"
        ],
        "Dance (RM 50)" => [
            "bellyDance" => "Belly Dance",
            "bodyJam" => "Body Jam",
            "zumba" => "Zumba",
            "zumbaToning" => "Zumba Toning",
            "uJam" => "U-Jam"
        ],
        "Mind & Body (RM 50)" => [
            "yoga" => "Yoga",
            "taiChi" => "Tai Chi",
            "pilates" => "Pilates",
            "popPilates" => "POP Pilates",
            "bodyBalance" => "Body Balance"
        ],
        "S & C (RM 75)" => [
            "strengthTraining" => "Strength Training",
            "coreAndCardioLift" => "Core and Cardio Lift",
            "kkqCore" => "KKQ Core",
            "bodyPump" => "Body Pump",
            "power" => "Power"
        ]
    ];

    //premium features
    $personalTrainingPrem = [
        "4sessions" => [
            "label" => "4 sessions/mth (RM 40)",
            "value" => "4 personal training sessions/month"
        ],
        "8sessions" => [
            "label" => "8 sessions/mth (RM 80)",
            "value" => "8 personal training sessions/month"
        ],
        "12sessions" => [
            "label" => "12 sessions/mth (RM 120)",
            "value" => "12 personal training sessions/month"
        ],
        "noPersonalTraining" => [
            "label" => "None",
            "value" => "None"
        ]
    ];
    
    $guestPassesPrem = [
        "5Passes" => [
            "label" => "5 guest passes (RM 300)",
            "value" => "5 guest passes"
        ],
        "10Passes" => [
            "label" => "10 guest passes (RM 600)",
            "value" => "10 guest passes"
        ],
        "noGuestPass" => [
            "label" => "None",
            "value" => "None"
        ]
    ];
    
    $merchandisePrem = [
        "gymShorts" => [
            "label" => "KKQ gym shorts (RM 25)",
            "value" => "KKQ gym shorts"
        ],
        "waterBottles" => [
            "label" => "KKQ water bottles (RM 20)",
            "value" => "KKQ water bottles"
        ],
        "proteinShakers" => [
            "label" => "KKQ protein shakers (RM 20)",
            "value" => "KKQ protein shakers"
        ],
        "jumpRopes" => [
            "label" => "KKQ jump ropes (RM 20)",
            "value" => "KKQ jump ropes"
        ],
        "resistanceBands" => [
            "label" => "KKQ resistance bands (RM 30)",
            "value" => "KKQ resistance bands"
        ],
        "proteinPowder" => [
            "label" => "KKQ protein powder (RM 35)",
            "value" => "KKQ protein powder"
        ]
    ];
    
    $nutritionalCoaching = [
        "oneMonthPackage" => [
            "label" => "1-month package (RM 20)",
            "value" => "1-month nutrition coaching package"
        ],
        "threeMonthPackage" => [
            "label" => "3-month package (RM 60)",
            "value" => "3-month nutrition coaching package"
        ],
        "dieticianWork" => [
            "label" => "Work directly with a dietician (RM 100)",
            "value" => "Work directly with a registered dietician"
        ],
        "nonutritionalCoaching" => [
            "label" => "None",
            "value" => "None"
        ]
    ];
    

    //elite features
    $personalTrainingElite = [
        "8sessions" => [
            "label" => "8 sessions/mth (RM 50)",
            "value" => "8 personal training sessions/month"
        ],
        "12sessions" => [
            "label" => "12 sessions/mth (RM 100)",
            "value" => "12 personal training sessions/month"
        ],
        "noPersonalTraining" => [
            "label" => "None",
            "value" => "None"
        ]
    ];
    
    $guestPassesElite = [
        "5Passes" => [
            "label" => "5 guest passes (RM 300)",
            "value" => "5 guest passes"
        ],
        "10Passes" => [
            "label" => "10 guest passes (RM 600)",
            "value" => "10 guest passes"
        ],
        "noGuestPass" => [
            "label" => "None",
            "value" => "None"
        ]
    ];
    
    $merchandiseElite = [
        "gymShorts" => [
            "label" => "KKQ gym shorts (RM 25)",
            "value" => "KKQ gym shorts"
        ],
        "waterBottles" => [
            "label" => "KKQ water bottles (RM 20)",
            "value" => "KKQ water bottles"
        ],
        "proteinShakers" => [
            "label" => "KKQ protein shakers (RM 20)",
            "value" => "KKQ protein shakers"
        ],
        "jumpRopes" => [
            "label" => "KKQ jump ropes (RM 20)",
            "value" => "KKQ jump ropes"
        ],
        "resistanceBands" => [
            "label" => "KKQ resistance bands (RM 30)",
            "value" => "KKQ resistance bands"
        ],
        "proteinPowder" => [
            "label" => "KKQ protein powder (RM 35)",
            "value" => "KKQ protein powder"
        ]
    ];
    
    $bodyCompositionAnalysis = [
        "quarterlyAnalysis" => [
            "label" => "Quarterly analysis (RM 300)",
            "value" => "Quarterly body composition analysis"
        ],
        "yearlyAnalysis" => [
            "label" => "Yearly analysis (RM 600)",
            "value" => "Yearly body composition analysis"
        ],
        "noBodyCompositionAnalysis" => [
            "label" => "None",
            "value" => "None"
        ]
    ];
    //https://mercury.swin.edu.au/it000000/formtest.php process_order.php
?>
    <article>
        <form id = "fixOrderForm" method="post" action="process_order.php" novalidate>
            <section id = "timerSect">
                <p id = "timer"></p>
            </section>
            <br>
            <section id = "fix" class = "confirmOrderSect">
                <section class = "contactAddrSect" id = "fixContact">
                    <h1>Contact</h1>
                    <?php
                        foreach($contactDetails as $name_id => $label) {
                            $value = $_SESSION[$name_id];
                            echo "<label for = \"$name_id\">$label</label><br>";

                            //set error as the class name to provide a red outline if there is an error for the particular input
                            $errorCls = (isset($errors[$name_id])) ? "error" : "";

                            //specific condition when it's a radio input
                            if($name_id == "preferredContact") {
                                //dynamically display the radio options and whether it's checked
                                echo "<section class = \"radioAndCheck $errorCls\">";
                                foreach($preferredContact as $id => $radioVal) {
                                    //session value and radio value matching = true -> set str as checked. false -> set as empty string
                                    $checked = ($value === "$radioVal") ? "checked" : ""; 

                                    echo "<input type = \"radio\" name = \"preferredContact\" id = \"$id\" value = \"$radioVal\" $checked>
                                    <label for = \"$id\">$radioVal</label><br>";
                                }
                                echo "</section>";
                            }

                            else {
                                //dynamically setting the placeholder value
                                $placeholder = ($name_id === "email") ? "johndoe123@example.com" : (($name_id === "phoneNumber") ? "0123456789" : "");                                

                                //dynamically display text input with red outline if there's an error, and no outline if no error
                                echo "<input type = \"text\" name = \"$name_id\" id = \"$name_id\" value = \"$value\" class = \"$errorCls\" placeholder = \"$placeholder\">";
                            }
                            
                            //check whether there are any errors, display if there are, else add space
                            if(isset($errors[$name_id])) {
                                echo "<p class = \"wrong\">$errors[$name_id]</p><br>";
                            }
                            else {
                                echo "<br>";
                            }
                        }
                    ?>
                </section>
                <section class = "contactAddrSect">
                    <h1>Address</h1>
                    <?php
                        foreach($addrDetails as $name_id => $label) {
                            $value = $_SESSION[$name_id];
                            echo "<label for = \"$name_id\">$label</label><br>";

                            //set error as the class name to provide a red outline if there is an error for the particular input
                            $errorCls = (isset($errors[$name_id])) ? "error" : "";

                            if($name_id == "state") {
                                echo "<select name = \"state\" id = \"state\" class = \"$errorCls\">
                                    <option value = \"\">Please Select</option>";
                                foreach($states as $stateVal => $stateLabel) {
                                    $selected = ($value === $stateVal) ? "selected" : "";
                                    echo "<option value=\"$stateVal\" $selected>$stateLabel</option>";
                                }
                                echo "</select>";
                            }
                            else {
                                //dynamically display text input with red outline if there's an error, and no outline if no error
                                echo "<input type = \"text\" name = \"$name_id\" id = \"$name_id\" value = \"$value\" class = \"$errorCls\">";
                            }
                            
                            if(isset($errors[$name_id])) {
                                echo "<p class = \"wrong\">$errors[$name_id]</p><br>";
                            }
                            else {
                                echo "<br>";
                            }
                        }
                    ?>
                </section>
                <br><br>
            </section>
            <br><br>
            <section id = "fix2" class = "orderSummarySect">
                <h1>Order Summary</h1>
                
                <?php
                    function generateSelect($id, $value, $errorCls, $array) {
                        echo "<select name = \"$id\" id = \"$id\" class = \"$errorCls\">
                            <option value = \"\">Please Select</option>";
                        foreach($array as $arrayVal => $arrayLabel) {
                            $selected = ($value === $arrayVal) ? "selected" : "";
                            echo "<option value=\"$arrayVal\" $selected>$arrayLabel</option>";
                        }
                        echo "</select>";
                    }

                    function generateRadio($name, $value, $errorCls, $array) {
                        echo "<section class = \"radioAndCheck $errorCls\">";
                        foreach($array as $id => $radioOpt) {
                            //session value and radio value matching = true -> set str as checked. false -> set as empty string
                            $checked = ($value == $radioOpt["value"]) ? "checked" : "";

                            echo "<input type = \"radio\" name = \"$name\" id = \"$id\" value = \"$radioOpt[value]\" $checked>
                            <label for = \"$id\">$radioOpt[label]</label><br>";
                        }
                        echo "</section>";
                    }

                    function generateCheckbox($id, $value, $errorCls, $array) {
                        echo "<section class = \"grpClass $errorCls\">";
                        foreach($array as $classLabel => $checkboxes) {
                            echo "<section class = 'classType'><p class=\"unofficialLabel\">$classLabel</p>";
                            foreach($checkboxes as $checkId => $checkLabel) {
                                $checked = (strpos($value, $checkLabel) !== false) ? "checked" : "";
                                echo "<input type=\"checkbox\" name=\"$id\" id=\"$checkId\" value=\"$checkLabel\" $checked>
                                <label for=\"$checkId\">$checkLabel</label>";
                            }
                            echo "</section>";
                        }
                        echo "</section>";
                    }

                    function generateCheckbox2($name, $value, $errorCls, $array) {
                        echo "<section class = \"radioAndCheck $errorCls\">";
                        foreach($array as $id => $checkOpt) {
                            //session value and checkbox value matching = true -> set str as checked. false -> set as empty string
                            $checked = (strpos($value, $checkOpt["value"]) !== false) ? "checked" : "";
                            echo "<input type = \"checkbox\" name = \"$name\" id = \"$id\" value = \"$checkOpt[value]\" $checked>
                            <label for = \"$id\">$checkOpt[label]</label><br>";
                        }
                        echo "</section>";
                    }

                    if($_SESSION["product"] == "") {
                        echo "<p class = \"wrong\">*Please select a product, then submit the form to see the optional features you can select.*</p><br>";
                        foreach($noProd as $name_id => $label) {
                            $value = $_SESSION["$name_id"];
                            echo "<label for = \"$name_id\">$label</label><br>";
    
                            //set error as the class name to provide a red outline if there is an error for the particular input
                            $errorCls = (isset($errors[$name_id])) ? "error" : "";
    
                            if($name_id == "product") {
                                generateSelect($name_id, $value, $errorCls, $$name_id);
                            }
                            else if($name_id == "qty") {
                                //dynamically display text input with red outline if there's an error, and no outline if no error
                                echo "<input type = \"text\" name = \"$name_id\" id = \"$name_id\" value = \"$value\" class = \"$errorCls\">";
                            }
                            if(isset($errors[$name_id])) {
                                echo "<p class = \"wrong\">$errors[$name_id]</p><br>";
                            }
                            else {
                                echo "<br>";
                            }
                        }
                    }
                    if($_SESSION["product"] != "" && $_SESSION["product"] == "Basic") {
                        foreach($basic as $name_id => $label) {
                            $value = $_SESSION["$name_id"];
                            echo "<label for = \"$name_id\">$label</label><br>";
    
                            //set error as the class name to provide a red outline if there is an error for the particular input
                            $errorCls = (isset($errors[$name_id])) ? "error" : "";
    
                            if($name_id == "product") {
                                echo "<input type = \"hidden\" name = \"product\" id = \"product\" value = \"$_SESSION[product]\"/>";

                                echo "<section class = \"changeProdSect\" id = \"basicBtn\"><p class = \"confirmLabel\">Basic Membership (RM 120/mth)</p>
                                <input type = \"button\" name = \"changeProd1\" value = \"Change Product\" class = \"changeProd\" id = \"changeBasic\">
                                </section>";

                                echo "";
                                if($errorCls == "") {
                                    echo "<br>";
                                }
                            }
                            else if($name_id == "clubLoc") {
                                generateSelect($name_id, $value, $errorCls, $$name_id);
                                if($errorCls == "") {
                                    echo "<br>";
                                }
                            }
                            else if($name_id == "membershipLength" || $name_id == "saunaSteamAccess") {
                                generateRadio($name_id, $value, $errorCls, $$name_id);
                            }
                            else if($name_id == "grpClasses") {
                                $name =  $name_id."[]";
                                generateCheckbox($name, $value, $errorCls, $$name_id);
                            }
                            else if($name_id == "qty") {
                                $placeholder = "1";
                                echo "<input type = \"text\" name = \"$name_id\" id = \"$name_id\" value = \"$value\" class = \"$errorCls\" placeholder = \"$placeholder\">";
                                if($errorCls == "") {
                                    echo "<br>";
                                }
                            }
                            if(isset($errors[$name_id])) {
                                echo "<p class = \"wrong\">$errors[$name_id]</p><br>";
                            }
                            else {
                                echo "<br>";
                            }
                        }
                    }
                    if($_SESSION["product"] != "" && $_SESSION["product"] == "Premium") {
                        foreach($premium as $name_id => $label) {
                            $value = $_SESSION["$name_id"];
                            echo "<label for = \"$name_id\">$label</label><br>";
    
                            //set error as the class name to provide a red outline if there is an error for the particular input
                            $errorCls = (isset($errors[$name_id])) ? "error" : "";
    
                            if($name_id == "product") {
                                echo "<input type = \"hidden\" name = \"product\" id = \"product\" value = \"$_SESSION[product]\"/>";

                                echo "<section class = \"changeProdSect\"><p class = \"confirmLabel\">Premium Membership (RM 200/mth)</p>
                                <input type = \"button\"  name = \"changeProd2\" value = \"Change Product\" class = \"changeProd\" id = \"changePrem\">
                                </section>";

                                echo "";
                                if($errorCls == "") {
                                    echo "<br>";
                                }
                            }
                            else if($name_id == "membershipLength" || $name_id == "personalTrainingPrem" || $name_id == "guestPassesPrem" || $name_id == "nutritionalCoaching") {
                                generateRadio($name_id, $value, $errorCls, $$name_id);
                            }
                            else if($name_id == "merchandisePrem") {
                                $name =  $name_id."[]";
                                generateCheckbox2($name, $value, $errorCls, $$name_id);
                            }
                            else if($name_id == "qty") {
                                $placeholder = "1";
                                echo "<input type = \"text\" name = \"$name_id\" id = \"$name_id\" value = \"$value\" class = \"$errorCls\" placeholder = \"$placeholder\">";
                                if($errorCls == "") {
                                    echo "<br>";
                                }
                            }
                            if(isset($errors[$name_id])) {
                                echo "<p class = \"wrong\">$errors[$name_id]</p><br>";
                            }
                            else {
                                echo "<br>";
                            }
                        }
                    }
                    else if($_SESSION["product"] != "" && $_SESSION["product"] == "Elite") {
                        foreach($elite as $name_id => $label) {
                            $value = $_SESSION["$name_id"];
                            echo "<label for = \"$name_id\">$label</label><br>";
    
                            //set error as the class name to provide a red outline if there is an error for the particular input
                            $errorCls = (isset($errors[$name_id])) ? "error" : "";
    
                            if($name_id == "product") {
                                echo "<input type = \"hidden\" name = \"product\" id = \"product\" value = \"$_SESSION[product]\"/>";

                                echo "<section class = \"changeProdSect\" id = \"eliteBtn\"><p class = \"confirmLabel\">Elite Membership (RM 280/mth)</p>
                                <input type = \"button\" name = \"changeProd3\" value = \"Change Product\" class = \"changeProd\" id = \"changeElite\">
                                </section>";

                                if($errorCls == "") {
                                    echo "<br>";
                                }
                            }
                            else if($name_id == "membershipLength" || $name_id == "personalTrainingElite" || $name_id == "guestPassesElite" || $name_id == "bodyCompositionAnalysis") {
                                generateRadio($name_id, $value, $errorCls, $$name_id);
                            }
                            else if($name_id == "merchandiseElite") {
                                $name =  $name_id."[]";
                                generateCheckbox2($name, $value, $errorCls, $$name_id);
                            }
                            else if($name_id == "qty") {
                                //dynamically display text input with red outline if there's an error, and no outline if no error
                                $placeholder = "1";
                                echo "<input type = \"text\" name = \"$name_id\" id = \"$name_id\" value = \"$value\" class = \"$errorCls\" placeholder = \"$placeholder\">";
                                if($errorCls == "") {
                                    echo "<br>";
                                }
                            }
                            if(isset($errors[$name_id])) {
                                echo "<p class = \"wrong\">$errors[$name_id]</p><br>";
                            }
                            else {
                                echo "<br>";
                            }
                        }
                    }
                ?>
            </section>
            </section>
            <br><br>
            <section id = "fix3" class = "paymentSect">
                <h1>Payment Details</h1>
                <p id = "paymentLabel">Credit Card Type</p>

                <?php
                    $errorCls = "";
                    if(isset($errors["ccType"])) {
                        $errorCls = "error";
                    }
                    echo "<section id=\"ccTypeSect\" class = \"$errorCls\">
                    <br>
                        <section>
                            <input type=\"radio\" name=\"ccType\" id=\"visa\" value=\"Visa\"></input>
                            <label for=\"visa\" class=\"ccType\" id = \"visaFix\"><img class=\"ccIcon\" src=\"images/visa.png\" alt=\"Visa Credit Card Icon\"><p>Visa</p></label>
                        </section>
                    
                        <section>
                            <input type=\"radio\" name=\"ccType\" id=\"mastercard\" value=\"Mastercard\">
                            <label for=\"mastercard\" class=\"ccType\"><img class=\"ccIcon\" src=\"images/mastercard.png\" alt=\"Mastercard Card Icon\"><p>Mastercard</p></label>
                        </section>
                    
                        <section>
                            <input type=\"radio\" name=\"ccType\" id=\"amex\" value=\"American Express\">
                            <label for=\"amex\" class=\"ccType\"><img class=\"ccIcon\" src=\"images/american-express.png\" alt=\"American Express Credit Card Icon\"><p id=\"amexOpt\">American Express</p></label><br>
                        </section>
                    </section>";

                    if(isset($errors["ccType"])) {
                        echo "<p class = \"wrong\">$errors[ccType]</p><br>";
                    }
                    else {
                        echo "<br>";
                    }

                    $errorCls = "";
                    if(isset($errors["ccName"])) {
                        $errorCls = "error";
                    }
                    echo "<label for=\"ccName\">Name on Credit Card</label><br>
                    <input type=\"text\" name=\"ccName\" id=\"ccName\" placeholder=\"John Doe\" class = \"$errorCls\"><br>";

                    if(isset($errors["ccName"])) {
                        echo "<p class = \"wrong\">$errors[ccName]</p><br>";
                    }
                    else {
                        echo "<br>";
                    }

                    $errorCls = "";
                    if(isset($errors["ccNum"])) {
                        $errorCls = "error";
                    }
                    echo "<label for=\"ccNum\">Credit Card Number</label><br>
                    <input type=\"text\" name=\"ccNum\" id=\"ccNum\" placeholder=\"1111222233334444\" class = \"$errorCls\"><br>";

                    if(isset($errors["ccNum"])) {
                        echo "<p class = \"wrong\">$errors[ccNum]</p><br>";
                    }
                    else {
                        echo "<br>";
                    }

                    $errorCls = "";
                    if(isset($errors["expDate"])) {
                        $errorCls = "error";
                    }

                    echo "<label for=\"expDate\">Credit Card Expiry Date</label><br>
                    <input type=\"text\" id=\"expDate\" name=\"expDate\" placeholder=\"MM-YY\" class = \"$errorCls\"><br>";

                    if(isset($errors["expDate"])) {
                        echo "<p class = \"wrong\">$errors[expDate]</p><br>";
                    }
                    else {
                        echo "<br>";
                    }

                    $errorCls = "";
                    if(isset($errors["cvv"])) {
                        $errorCls = "error";
                    }

                    echo "<label for=\"cvv\">Card Verification Value (CVV)</label><br>
                    <input type=\"text\" name=\"cvv\" id=\"cvv\" placeholder=\"123\" class = \"$errorCls\"><br>";

                    if(isset($errors["cvv"])) {
                        echo "<p class = \"wrong\">$errors[cvv]</p><br>";
                    }
                    else {
                        echo "<br>";
                    }
                ?>
            </section>

            <section id = "checkoutSect">
                <button type="button" id = "cancelBtn">Cancel Order</button>
                <input type = "submit" value = "Check Out" id = "checkOut">
            </section>
        </form>
    </article>
    <br>
<?php
    include "includes/footer.inc";
    //destroy session so users cannot directly access the fix_order.php page
    session_destroy();
 ?>
</body>
</html>