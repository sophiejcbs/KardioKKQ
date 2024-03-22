<?php 
    session_start(); //start session
    /*
    if(!isset($_SESSION["fname"])) { //check if session var exists
        header("location: enquire.php");
    }
    */
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF‐8"/>
    <meta name="description" content="Fitness Club Membership Order Receipt"/>
    <meta name="keywords" content="receipt"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>Receipt | Kardio Kings & Queens</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.png"> <!--https://www.flaticon.com/free-icons/muscle: Muscle icons created by Dragon Icons - Flaticon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <link href = "styles/style.css" rel = "stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 995px)" href="styles/responsive.css">
    
    <script src="scripts/menu.js"></script>
</head>
<body>
<?php
    include "includes/header.inc";
?>
<?php
    $custDetails = array(
        "fname" => "First Name",
        "lname" => "Last Name",
        "email" => "Email",
        "phoneNumber" => "Phone Number",
        "preferredContact" => "Preferred Contact",
        "streetAddress" => "Street Address",
        "town" => "Town",
        "state" => "State",
        "postCode" => "Post Code",
    );

    $basicOrder = array(
        "product" => "Product",
        "qty" => "Quantity",
        "membershipLength" => "Membership Length",
        "clubLoc" => "Club Location",
        "saunaSteamAccess" => "Sauna Steam Access",
        "grpClasses" => "Group Classes",
    );

    $premiumOrder = array(
        "product" => "Product",
        "qty" => "Quantity",
        "membershipLength" => "Membership Length",
        "personalTrainingPrem" => "Personal Training",
        "guestPassesPrem" => "Guest Passes",
        "merchandisePrem" => "Merchandise",
        "nutritionalCoaching" => "Nutritional Coaching",
    );

    $eliteOrder = array(
        "product" => "Product",
        "qty" => "Quantity",
        "membershipLength" => "Membership Length",
        "personalTrainingElite" => "Personal Training",
        "guestPassesElite" => "Guest Passes",
        "merchandiseElite" => "Merchandise",
        "bodyCompositionAnalysis" => "Body Composition Analysis",
    );

    $ccDetails = array(
        "ccType" => "Credit Card Type",
        "ccName" => "Credit Card Name",
        "ccNum" => "Credit Card Number",
        "expDate" => "Expiration Date",
        "cvv" => "CVV"
    );

    $basicPrice = 120;
    $premiumPrice = 200;
    $elitePrice = 280;
    $saunaSteamPrice = 20;
    $personalTrainingPremPrice = 40;
    $personalTrainingElitePrice = 50;
    $guestPassPremPrice = 300;
    $guestPassElitePrice = 200;

    $kkqMerch = array(
        "KKQ gym shorts" => 25,
        "KKQ water bottles" => 20,
        "KKQ protein shakers" => 20,
        "KKQ jump ropes" => 20,
        "KKQ resistance bands" => 30,
        "KKQ protein powder" => 35
    );

    $cardioSC = array(
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
    );

    $cycleDanceMB = array(
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
    );
?>
    <article>
        <section class = "receiptSect">
            <h1 class = "receiptTitle">Receipt</h1>
            
            <?php
                echo "<h3>Order ID: $_SESSION[order_id]</h3>";
                $formattedDateTime = date('Y-m-d H:i', strtotime($_SESSION["order_time"]));
                echo "<h3>Order Time: $formattedDateTime</h3>";
                echo "<h3>Order Status: $_SESSION[order_status]</h3>";

                echo "<h1 class = \"receiptHeader\">Customer Details</h1>";
                echo "<table class = \"receiptTable\">";
                foreach($custDetails as $id => $label) {
                    echo "<tr>
                            <td class = \"receiptLabel\">$label</td>
                            <td>$_SESSION[$id]</td>
                        </tr>";
                }
                echo "</table>";

                echo "<h1 class = \"receiptHeader\">Order Details</h1>";
                echo "<table class = \"receiptTable\">";
                echo "<tr><td class = \"receiptTableH\">Feature</td><td class = \"receiptTableH\">Selection</td><td class = \"receiptTableH\">Price (RM)</td>";
                if($_SESSION["product"] == "Basic") {
                    foreach($basicOrder as $id => $label) {
                        echo "<tr>
                                <td class = \"receiptLabel\">$label</td>";
                        if($id == "grpClasses" && $_SESSION["grpClasses"] != "") {
                            $grpClassArr = explode(",", $_SESSION["grpClasses"]);
                            echo "<td>";
                            foreach ($grpClassArr as $className) {
                                echo "$className<br>";
                            }
                            echo "</td>";
                        }
                        else {
                            echo "<td>$_SESSION[$id]</td>";
                        }
                        if($id == "membershipLength") {
                            if($_SESSION["membershipLength"] == "Monthly") {
                                $price = $basicPrice*1;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["membershipLength"] == "Quarterly") {
                                $price = $basicPrice*4;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["membershipLength"] == "Annually") {
                                $price = $basicPrice*12;
                                echo "<td>$price</td>";
                            }
                        }
                        else if($id == "saunaSteamAccess" && $_SESSION["saunaSteamAccess"] != "") {
                            if($_SESSION["saunaSteamAccess"] == "Monthly sauna and steam room access") {
                                $price = $saunaSteamPrice*1;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["saunaSteamAccess"] == "Yearly sauna and steam room access") {
                                $price = $saunaSteamPrice*12;
                                echo "<td>$price</td>";
                            }
                        }
                        else if($id == "grpClasses" && $_SESSION["grpClasses"] != "") {
                            $strPrice = "";
                            $grpClassArr = explode(",", $_SESSION["grpClasses"]);

                            foreach ($grpClassArr as $className) {
                                $className = trim($className);
                                if (in_array($className, $cardioSC)) {
                                    $strPrice .= "75<br>";
                                } 
                                if (in_array($className, $cycleDanceMB)) {
                                    $strPrice .= "50<br>";
                                }
                            }

                            echo "<td>$strPrice</td>";
                        }
                        else {
                            echo "<td>--</td>";
                        }
                        echo "</tr>";
                    }
                }
                else if($_SESSION["product"] == "Premium") {
                    foreach($premiumOrder as $id => $label) {
                        echo "<tr>
                                <td class = \"receiptLabel\">$label</td>";
                        if($id == "merchandisePrem" && $_SESSION["merchandisePrem"] != "") {
                            $merchandisePremArr = explode(",", $_SESSION["merchandisePrem"]);
                            echo "<td>";
                            foreach ($merchandisePremArr as $merch) {
                                echo "$merch<br>";
                            }
                            echo "</td>";
                        }
                        else {
                            echo "<td>$_SESSION[$id]</td>";
                        }
                        if($id == "membershipLength") {
                            if($_SESSION["membershipLength"] == "Monthly") {
                                $price = $premiumPrice*1;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["membershipLength"] == "Quarterly") {
                                $price = $premiumPrice*4;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["membershipLength"] == "Annually") {
                                $price = $premiumPrice*12;
                                echo "<td>$price</td>";
                            }
                        }
                        else if($id == "personalTrainingPrem" && $_SESSION["personalTrainingPrem"] != "None") {
                            if($_SESSION["personalTrainingPrem"] == "4 personal training sessions/month") {
                                $price = $personalTrainingPremPrice*1;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["personalTrainingPrem"] == "8 personal training sessions/month") {
                                $price = $personalTrainingPremPrice*8;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["personalTrainingPrem"] == "12 personal training sessions/month") {
                                $price = $personalTrainingPremPrice*12;
                                echo "<td>$price</td>";
                            }
                        }
                        else if($id == "guestPassesPrem" && $_SESSION["guestPassesPrem"] != "None") {
                            if($_SESSION["guestPassesPrem"] == "5 guest passes") {
                                $price = $guestPassPremPrice*1;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["guestPassesPrem"] == "10 guest passes") {
                                $price = $guestPassPremPrice*2;
                                echo "<td>$price</td>";
                            }
                        }
                        else if($id == "merchandisePrem" && $_SESSION["merchandisePrem"] != "") {
                            $strPrice = "";
                            $merchandisePremArr = explode(",", $_SESSION["merchandisePrem"]);

                            foreach ($merchandisePremArr as $merch) {
                                $merch = trim($merch);
                                if (in_array($merch, array_keys($kkqMerch))) {
                                    $strPrice .= "$kkqMerch[$merch]<br>";
                                }
                            }

                            echo "<td>$strPrice</td>";
                        }
                        else if($id == "nutritionalCoaching" && $_SESSION["nutritionalCoaching"] != "None") {
                            if($_SESSION["nutritionalCoaching"] == "1-month nutrition coaching package") {
                                $price = 20;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["nutritionalCoaching"] == "3-month nutrition coaching package") {
                                $price = 60;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["nutritionalCoaching"] == "Work directly with a registered dietician") {
                                $price = 100;
                                echo "<td>$price</td>";
                            }
                        }
                        else {
                            echo "<td>--</td>";
                        }
                        echo "</tr>";
                    }
                }
                else if($_SESSION["product"] == "Elite") {
                    foreach($eliteOrder as $id => $label) {
                        echo "<tr>
                        <td class = \"receiptLabel\">$label</td>";
                        if($id == "merchandiseElite" && $_SESSION["merchandiseElite"] != "") {
                            $merchandiseEliteArr = explode(",", $_SESSION["merchandiseElite"]);
                            echo "<td>";
                            foreach ($merchandiseEliteArr as $merch) {
                                echo "$merch<br>";
                            }
                            echo "</td>";
                        }
                        else {
                            echo "<td>$_SESSION[$id]</td>";
                        }
                        if($id == "membershipLength") {
                            if($_SESSION["membershipLength"] == "Monthly") {
                                $price = $elitePrice*1;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["membershipLength"] == "Quarterly") {
                                $price = $elitePrice*4;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["membershipLength"] == "Annually") {
                                $price = $elitePrice*12;
                                echo "<td>$price</td>";
                            }
                        }
                        else if($id == "personalTrainingElite" && $_SESSION["personalTrainingElite"] != "None") {
                            if($_SESSION["personalTrainingElite"] == "4 personal training sessions/month") {
                                $price = $personalTrainingElitePrice*1;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["personalTrainingElite"] == "8 personal training sessions/month") {
                                $price = $personalTrainingElitePrice*8;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["personalTrainingElite"] == "12 personal training sessions/month") {
                                $price = $personalTrainingElitePrice*12;
                                echo "<td>$price</td>";
                            }
                        }
                        else if($id == "guestPassesElite" && $_SESSION["guestPassesElite"] != "None") {
                            if($_SESSION["guestPassesElite"] == "5 guest passes") {
                                $price = $guestPassElitePrice*1;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["guestPassesElite"] == "10 guest passes") {
                                $price = $guestPassElitePrice*2;
                                echo "<td>$price</td>";
                            }
                        }
                        else if($id == "merchandiseElite" && $_SESSION["merchandiseElite"] != "") {
                            $strPrice = "";
                            $merchandiseEliteArr = explode(",", $_SESSION["merchandiseElite"]);

                            foreach ($merchandiseEliteArr as $merch) {
                                $merch = trim($merch);
                                if (in_array($merch, array_keys($kkqMerch))) {
                                    $strPrice .= "$kkqMerch[$merch]<br>";
                                }
                            }

                            echo "<td>$strPrice</td>";
                        }
                        else if($id == "bodyCompositionAnalysis" && $_SESSION["bodyCompositionAnalysis"] != "None") {
                            if($_SESSION["nutritionalCoaching"] == "Quarterly body composition analysis") {
                                $price = 300;
                                echo "<td>$price</td>";
                            }
                            else if($_SESSION["bodyCompositionAnalysis"] == "Yearly body composition analysis") {
                                $price = 600;
                                echo "<td>$price</td>";
                            }
                        }
                        else {
                            echo "<td>--</td>";
                        }
                        echo "</tr>";
                    }
                }
                $subtotal = intval($_SESSION["order_cost"])/$_SESSION["qty"];
                echo "<tr><td class = \"receiptCosts\" colspan=\"2\">SUBTOTAL</td><td>$subtotal</td></tr>";
                echo "<tr><td class = \"receiptCosts\" colspan=\"2\">TOTAL</td><td>$_SESSION[order_cost]</td></tr>";
                echo "</table>";

                echo "<h1 class = \"receiptHeader\">Credit Card Details</h1>";
                echo "<table class = \"receiptTable\">";
                foreach($ccDetails as $id => $label) {
                    $encryptedDetails = str_repeat("*", strlen($_SESSION[$id]));
                    echo "<tr>
                            <td class = \"receiptLabel\">$label</td>
                            <td>$encryptedDetails</td>
                        </tr>";
                }
                echo "</table>";
            ?>
        </section>
    </article>
    <br>
<?php
    include "includes/footer.inc";
    //destroy session so users cannot directly access the fix_order.php page
    session_destroy();
 ?>
</body>
</html>