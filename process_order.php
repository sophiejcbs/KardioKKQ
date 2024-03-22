<!-- Description: Receive Data from payment.php and fix_order.php, identifies errors and saves in session state variables -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<?php 
    session_start(); //start session
    if(!isset($_SESSION["errors"])) { //check if session var exists
        $_SESSION["errors"] = array(); //create and set session var
    }
?>
<?php
    function sanitise_input($data) {
        $data = trim($data); //remove leading/trailing space
        $data = stripslashes($data); //remove backslash in front of quote
        $data = htmlspecialchars($data); //convert html control char like < to HTML code &lt;
        return $data;
    }
?>
<?php
    require_once("settings.php"); //connection info

    $conn = @mysqli_connect($host,
            $user,
            $pwd,
            $sql_db
    );

    if(!$conn) {
        //display err msg
        echo "<p>Database connection failure</p>"; //not in production script
    }
    else {
        //successful db connection
        $sql_table = "orders";

        //validation to check if 
        if(isset($_POST["fname"])) {
            $fname = $_POST["fname"];
        }
        else {
            //Redirect to Enquiry form and destroy session data, if process not triggered by a form submit.
            header("location: enquire.php");
            session_destroy();
        }
        
        if(isset($_POST["lname"])) {
            $lname = $_POST["lname"];
        }

        if(isset($_POST["email"])) {
            $email= $_POST["email"];
        }
    
        if(isset($_POST["phoneNumber"])) {
            $phoneNumber = $_POST["phoneNumber"];
        }
        
        if(isset($_POST["preferredContact"]) && $_POST["preferredContact"] != "undefined") {
            $preferredContact = $_POST["preferredContact"];
        }

        if(isset($_POST["streetAddress"])) {
            $streetAddress = $_POST["streetAddress"];
        }

        if(isset($_POST["town"])) {
            $town = $_POST["town"];
        }

        if(isset($_POST["state"]) && $_POST["state"] != "none") {
            $state = $_POST["state"];
        }

        if(isset($_POST["postCode"])) {
            $postCode = $_POST["postCode"];
        }

        if(isset($_POST["product"]) && $_POST["product"] != "none") {
            $product = $_POST["product"];
        }

        if(isset($_POST["membershipLength"])) {
            $membershipLength = $_POST["membershipLength"];
        }

        if(isset($_POST["qty"])) {
            $qty = $_POST["qty"];
        }

        //basic membership features (won't be set for other memberships)
        if(isset($_POST["clubLoc"])) {
            $clubLoc = $_POST["clubLoc"];
        }

        if(isset($_POST["saunaSteamAccess"])) {
            $saunaSteamAccess = $_POST["saunaSteamAccess"];
        }

        if(isset($_POST["grpClasses"])) {
            $grpClasses = $_POST["grpClasses"];
            if(is_array($grpClasses)) {
                $grpClasses = implode(", ", $grpClasses);
            }
        }

        //premium membership features 
        if(isset($_POST["personalTrainingPrem"])) {
            $personalTrainingPrem = $_POST["personalTrainingPrem"];
        }

        if(isset($_POST["guestPassesPrem"])) {
            $guestPassesPrem = $_POST["guestPassesPrem"];
        }

        if(isset($_POST["merchandisePrem"])) {
            $merchandisePrem = $_POST["merchandisePrem"];
            if(is_array($merchandisePrem)) {
                $merchandisePrem = implode(", ", $merchandisePrem);
            }
        }

        if(isset($_POST["nutritionalCoaching"])) {
            $nutritionalCoaching = $_POST["nutritionalCoaching"];
        }

        //elite membership features
        if(isset($_POST["personalTrainingElite"])) {
            $personalTrainingElite = $_POST["personalTrainingElite"];
        }

        if(isset($_POST["guestPassesElite"])) {
            $guestPassesElite = $_POST["guestPassesElite"];
        }

        if(isset($_POST["merchandiseElite"])) {
            $merchandiseElite = $_POST["merchandiseElite"];
            if(is_array($merchandiseElite)) {
                $merchandiseElite = implode(", ", $merchandiseElite);
            }
        }

        if(isset($_POST["bodyCompositionAnalysis"])) {
            $bodyCompositionAnalysis = $_POST["bodyCompositionAnalysis"];
        }

        //credit card details
        if(isset($_POST["ccType"])) {
            $ccType = $_POST["ccType"];
        }

        if(isset($_POST["ccNum"])) {
            $ccNum = $_POST["ccNum"];
        }

        if(isset($_POST["ccName"])) {
            $ccName = $_POST["ccName"];
        }

        if(isset($_POST["expDate"])) {
            $expDate = $_POST["expDate"];
        }

        if(isset($_POST["cvv"])) {
            $cvv = $_POST["cvv"];
        }
        
        /* Sanitizing payment.php Form Inputs */
        //customer details
        $fname = sanitise_input($fname);
        $lname = sanitise_input($lname);
        $email = sanitise_input($email);
        $phoneNumber = sanitise_input($phoneNumber);
        $preferredContact = sanitise_input($preferredContact);
        $streetAddress = sanitise_input($streetAddress);
        $town = sanitise_input($town);
        $state = sanitise_input($state);
        $postCode = sanitise_input($postCode);

        //general membership features
        $product = sanitise_input($product);
        $membershipLength = sanitise_input($membershipLength);
        $qty = sanitise_input($qty);

        //basic features
        $clubLoc = sanitise_input($clubLoc);
        $saunaSteamAccess = sanitise_input($saunaSteamAccess);
        $grpClasses = sanitise_input($grpClasses);

        //premium features
        $personalTrainingPrem = sanitise_input($personalTrainingPrem);
        $guestPassesPrem = sanitise_input($guestPassesPrem);
        $merchandisePrem = sanitise_input($merchandisePrem);
        $nutritionalCoaching = sanitise_input($nutritionalCoaching);

        //elite features
        $personalTrainingElite = sanitise_input($personalTrainingElite);
        $guestPassesElite = sanitise_input($guestPassesElite);
        $merchandiseElite = sanitise_input($merchandiseElite);
        $bodyCompositionAnalysis = sanitise_input($bodyCompositionAnalysis);

        //credit card details
        $ccType = sanitise_input($ccType);
        $ccNum = sanitise_input($ccNum);
        $ccName = sanitise_input($ccName);
        $expDate = sanitise_input($expDate);
        $cvv = sanitise_input($cvv);

        $errors = array();

        /* Validation of Sanitized Inputs */
        /* Using an Associative Array - Keys: The input the error is for, Value: The error message */
        //check if first name is not empty, only contains alpha letters, and is less than or equal 25 characters
        if($fname == "") {
            $errors["fname"] = "You must enter your first name.";
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $fname)) {
            $errors["fname"] = "Only alpha letters allowed in your first name.";
        }
        else if(strlen($fname) > 25) {
            $errors["fname"] = "Your first name can only be 25 characters long.";
        }
    
        //check if last name is not empty, only contains alpha letters, and is less than or equal 25 characters
        if($lname == "") {
            $errors["lname"] = "You must enter your last name.";
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $lname)) {
            $errors["lname"] = "Only alpha letters allowed in your last name.";
        }
        else if(strlen($lname) > 25) {
            $errors["lname"] = "Your last name can only be 25 characters long.";
        }
    
        //check if email is not empty and is in an email format
        if($email == "") {
            $errors["email"] = "You must enter your email.";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Your email must be in an email format.";
        }

        //check if phone number is not empty, only contains numbers, and is less than or equal to 10 numbers long
        if($phoneNumber == "") {
            $errors["phoneNumber"] = "You must enter your phone number.";
        }
        else if(!is_numeric($phoneNumber)) {
            $errors["phoneNumber"] = "Your phone number must only contain numbers.";
        }
        else if(strlen($phoneNumber) > 10) {
            $errors["phoneNumber"] = "Your phone number can only be 10 numbers long.";
        }

        //check if a radio option for preferred contact was selected
        if($preferredContact == "") {
            $errors["preferredContact"] = "You must select a preferred contact.";
        }
        
        if($streetAddress == "") {
            $errors["streetAddress"] = "You must select a street address.";
        }
        else if(strlen($streetAddress) > 40) {
            $errors["streetAddress"] = "Your street address can only be 40 characters long.";
        }
        
        if($town == "") {
            $errors["town"] = "You must enter your town.";
        }
        else if(strlen($town) > 20) {
            $errors["town"] = "Your street address can only be 20 characters long.";
        }

        //check if state was selected from dropdown
        if($state == "") {
            $errors["state"] = "You must enter your state.";
        }
    
        if($postCode == "") {
            $errors["postCode"] = "You must enter your post code.";
        }
        
        else if(!is_numeric($postCode) || strlen($postCode) != 4) {
            $errors["postCode"] = "Your postcode must be 4 digits long.";
        }

        //state & postcode validation
        else {
            if($state == "VIC" && ($postCode[0] != "3" && $postCode[0] != "8")) {
                $errors["postCode"] = "The selected state '" . $state . "' must have a postcode that starts with 3 or 8.\n";
            }
            if($state == "NSW" && ($postCode[0] != "1" && $postCode[0] != "2")) {
                $errors["postCode"] = "The selected state '" . $state . "' must have a postcode that starts with 1 or 2.\n";
            }
            if($state == "QLD" && ($postCode[0] != "4" && $postCode[0] != "9")) {
                $errors["postCode"] = "The selected state '" . $state . "' must have a postcode that starts with 4 or 9.\n";
            }
            if(($state == "NT" && $postCode[0] != "0") || ($state == "ACT" && $postCode[0] != "0")) {
                $errors["postCode"] = "The selected state '" . $state . "' must have a postcode that starts with 0.\n";
            }
            if($state == "WA" && $postCode[0] != "6") {
                $errors["postCode"] = "The selected state '" . $state . "' must have a postcode that starts with 6.\n";
            }
            if($state == "SA" && $postCode[0] != "5") {
                $errors["postCode"] = "The selected state '" . $state . "' must have a postcode that starts with 5.\n";
            }
            if($state == "TAS" && $postCode[0] != "7") {
                $errors["postCode"] = "The selected state '" . $state . "' must have a postcode that starts with 7.\n";
            }
        }
        
        if($product == "") {
            $errors["product"] = "You must select a product to purchase.";
        }

        if($membershipLength == "") {
            $errors["membershipLength"] = "You must select a membership length.";
        }

        if($qty == "") {
            $errors["qty"] = "You must enter a quantity.";
        }
        else if(!is_numeric($qty)) {
            $errors["qty"] = "Quantity must be a positive integer.";
        }
        else if(intval($qty)<=0) {
            $errors["qty"] = "Quantity must be a positive integer.";
        }

        if($product == "Basic") {
            if($clubLoc == "") {
                $errors["clubLoc"] = "You must select a club location.";
            }
    
            if($saunaSteamAccess == "") {
                $errors["saunaSteamAccess"] = "You must select your sauna and steam room access.";
            }
        }

        $classArr = explode(",", $grpClasses);
        if(count($classArr) > 3) {
            $errors["grpClasses"] = "You can only select 3 group classes.";
        }

        if($product == "Premium") {
            if($personalTrainingPrem == "") {
                $errors["personalTrainingPrem"] = "You must select a personal training option.";
            }
    
            if($guestPassesPrem == "") {
                $errors["guestPassesPrem"] = "You must select a guest pass option.";
            }
    
            if($nutritionalCoaching == "") {
                $errors["nutritionalCoaching"] = "You must select a nutritional coaching option.";
            }
        }
        
        if($product == "Elite") {
            if($personalTrainingElite == "") {
                $errors["personalTrainingElite"] = "You must select a personal training option.";
            }
    
            if($guestPassesElite == "") {
                $errors["guestPassesElite"] = "You must select a guest pass option.";
            }
    
            if($bodyCompositionAnalysis == "") {
                $errors["bodyCompositionAnalysis"] = "You must select a body composition analysis option.";
            }
        }

        //payment form validation
        if($ccType == "") {
            $errors["ccType"] = "You must select a credit card type.";
        }

        if ($ccName == "") {
            $errors["ccName"] = "You must enter your credit card name.";
        } 
        else if (!preg_match('/^[a-zA-Z\s]{2,40}$/', $ccName)) {
            $errors["ccName"] = "Your credit card name can only have alphabets/spaces and be 40 characters or less.";
        }

        if ($ccNum == "") {
            $errors["ccNum"] = "You must enter your credit card number.";
        } 
        else if (!preg_match('/^4\d{15}$/', $ccNum) && $ccTypeVal == "Visa") {
            $errors["ccNum"] = "Your Visa card number must have 16 digits and start with a 4.";
        } 
        else if (!preg_match('/^(5[1-5])\d{14}$/', $ccNum) && $ccTypeVal == "Mastercard") {
            $errors["ccNum"] = "Your Mastercard card number must have 16 digits and start with 51-55.";
        } 
        else if (!preg_match('/^(34|37)\d{13}$/', $ccNum) && $ccTypeVal == "American Express") {
            $errors["ccNum"] = "Your American Express card number must have 15 digits and start with 34 or 37.";
        }

        if ($expDate == "") {
            $errors["expDate"] = "You must enter your credit card expiry date.";
        } 
        else if (!preg_match('/^\d{2}-\d{2}$/', $expDate)) {
            $errors["expDate"] = "Your expiry date must to be digits in the MM-YY format.";
        }

        if ($cvv == "") {
            $errors["cvv"] = "You must enter your CVV.";
        } 
        else if (!preg_match('/^\d{3,4}$/', $cvv)) {
            $errors["cvv"] = "Your CVV must to be 3-4 digits long.";
        }
        
        if(count($errors) != 0) {
            //assign error messages to the session var
            $_SESSION["errors"] = $errors; 
            
            /* Store all customer details, product details, and credit card details as session variables */
            /* To pass the data to fix_order.php */
            //customer details
            $_SESSION["fname"] = $fname;
            $_SESSION["lname"] = $lname;
            $_SESSION["email"] = $email;
            $_SESSION["phoneNumber"] = $phoneNumber;
            $_SESSION["preferredContact"] = $preferredContact;
            $_SESSION["streetAddress"] = $streetAddress;
            $_SESSION["town"] = $town;
            $_SESSION["state"] = $state;
            $_SESSION["postCode"] = $postCode;

            //general membership features
            $_SESSION["product"] = $product;
            $_SESSION["membershipLength"] = $membershipLength;
            $_SESSION["qty"] = $qty;

            //basic features
            $_SESSION["clubLoc"] = $clubLoc;
            $_SESSION["saunaSteamAccess"] = $saunaSteamAccess;
            $_SESSION["grpClasses"] = $grpClasses;

            //premium features
            $_SESSION["personalTrainingPrem"] = $personalTrainingPrem;
            $_SESSION["guestPassesPrem"] = $guestPassesPrem;
            $_SESSION["merchandisePrem"] = $merchandisePrem;
            $_SESSION["nutritionalCoaching"] = $nutritionalCoaching;

            //elite features
            $_SESSION["personalTrainingElite"] = $personalTrainingElite;
            $_SESSION["guestPassesElite"] = $guestPassesElite;
            $_SESSION["merchandiseElite"] = $merchandiseElite;
            $_SESSION["bodyCompositionAnalysis"] = $bodyCompositionAnalysis;

            //credit card details
            $_SESSION["ccType"] = $ccType;
            $_SESSION["ccNum"] = $ccNum;
            $_SESSION["ccName"] = $ccName;
            $_SESSION["expDate"] = $expDate;
            $_SESSION["cvv"] = $cvv;

            /*
            foreach($errors as $err) {
                echo $err;
            }
            */

            //redirect to fix_order.php to display errors
            header("location: fix_order.php"); 
        }
        else { //start adding record to db if no errors in input formats
            $fields = "order_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            fname VARCHAR(25) NOT NULL,
    	    lname VARCHAR(25) NOT NULL,
    	    email VARCHAR(40) NOT NULL,
            phoneNumber VARCHAR(10) NOT NULL,
            preferredContact VARCHAR(25) NOT NULL,
            streetAddress VARCHAR(40) NOT NULL,
            town VARCHAR(20) NOT NULL,
            state VARCHAR(25) NOT NULL,
            postCode VARCHAR(4) NOT NULL,
            product VARCHAR(25) NOT NULL,
            membershipLength VARCHAR(25) NOT NULL,
            qty INT(10) NOT NULL,
            clubLoc VARCHAR(40),
            saunaSteamAccess VARCHAR(40),
            grpClasses VARCHAR(250),
            personalTrainingPrem VARCHAR(100),
            guestPassesPrem VARCHAR(40),
            merchandisePrem VARCHAR(250),
            nutritionalCoaching VARCHAR(100),
            personalTrainingElite VARCHAR(100),
            guestPassesElite VARCHAR(40),
            merchandiseElite VARCHAR(250),
            bodyCompositionAnalysis VARCHAR(100),
            ccType VARCHAR(25) NOT NULL,
            ccName VARCHAR(40) NOT NULL,
            ccNum BIGINT(40) NOT NULL,
            expDate VARCHAR(25) NOT NULL,
            cvv INT(10) NOT NULL,
    	    order_cost FLOAT(40)  NOT NULL,
            order_time TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    	    order_status VARCHAR(40) DEFAULT 'PENDING'";
            $sqlString = "CREATE TABLE IF NOT EXISTS $sql_table ($fields);"; 
            
            $result = @mysqli_query($conn, $sqlString);

            if(!$result) { //check if table was created
                echo "<p class=\"wrong\">Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ." </p>"; //Would not show in a production script
            }
            else {
                //display operation successful msg for successful
                echo "<p class=\"ok\">Table $sql_table created successfully / already existed.</p>";
            }

            //calculate total cost of order
            $order_cost = 0;

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


            if($product == "Basic") {
                // Membership length price
                if($membershipLength == "Monthly") {
                    $order_cost += $basicPrice * 1;
                }
                else if($membershipLength == "Quarterly") {
                    $order_cost += $basicPrice * 4;
                }
                else if($membershipLength == "Annually") {
                    $order_cost += $basicPrice * 12;
                }
                
                if($saunaSteamAccess != "None") {
                    // Sauna & steam room access price
                    if($saunaSteamAccess == "Monthly sauna and steam room access") {
                        $order_cost += $saunaSteamPrice * 1;
                    }
                    else if($saunaSteamAccess == "Yearly sauna and steam room access") {
                        $order_cost += $saunaSteamPrice * 12;
                    }
                }
            
                //check if any grpClasses were selected
                if($grpClasses != "") {
                    // Set group classes in session
                    $grpClassArr = explode(",", $grpClasses);

                    foreach ($grpClassArr as $className) {
                        $className = sanitise_input($className);
                        if (in_array($className, $cardioSC)) {
                            $order_cost += 75;
                        } 
                        if (in_array($className, $cycleDanceMB)) {
                            $order_cost += 50;
                        }
                    }
                }
            }
            else if($product == "Premium") {
                if($membershipLength == "Monthly") {
                    $order_cost += $premiumPrice * 1;
                }
                else if($membershipLength == "Quarterly") {
                    $order_cost += $premiumPrice * 4;
                }
                else if($membershipLength == "Annually") {
                    $order_cost += $premiumPrice * 12;
                }
            
                if($personalTrainingPrem != "None") {
                    // personal training sessions price
                    if($personalTrainingPrem == "4 personal training sessions/month") {
                        $order_cost += $personalTrainingPremPrice * 1;
                    }
                    else if($personalTrainingPrem == "8 personal training sessions/month") {
                        $order_cost += $personalTrainingPremPrice * 8;
                    }
                    else if($personalTrainingPrem == "12 personal training sessions/month") {
                        $order_cost += $personalTrainingPremPrice * 12;
                    }
                }
            
                if($guestPassesPrem != "None") {
                    if($guestPassesPrem == "5 guest passes") {
                        $order_cost += $guestPassPremPrice * 1;
                    }
                    else if($guestPassesPrem == "10 guest passes") {
                        $order_cost += $guestPassPremPrice * 2;
                    }
                }
            
                if(isset($merchandisePrem)) {
                    $merchArr = explode(",", $merchandisePrem);
            
                    foreach ($merchArr as $merch) {
                        $merch = sanitise_input($merch);
                        if (in_array($merch, array_keys($kkqMerch))) {
                            $order_cost += $kkqMerch[$merch];
                        }
                    }
                }
            
                if($nutritionalCoaching != "None") {
                    if($nutritionalCoaching == "1-month nutrition coaching package") {
                        $order_cost += 20;
                    }
                    else if($nutritionalCoaching == "3-month nutrition coaching package") {
                        $order_cost += 60;
                    }
                    else if($nutritionalCoaching == "Work directly with a registered dietician") {
                        $order_cost += 100;
                    }
                }
            }
            else if($product == "Elite") {
                if($membershipLength == "Monthly") {
                    $order_cost += $elitePrice * 1;
                }
                else if($membershipLength == "Quarterly") {
                    $order_cost += $elitePrice * 4;
                }
                else if($membershipLength == "Annually") {
                    $order_cost += $elitePrice * 12;
                }
                
                if($personalTrainingElite != "None") {
                    // personal training sessions price
                    if($personalTrainingElite == "8 personal training sessions/month") {
                        $order_cost += $personalTrainingElitePrice * 8;
                    }
                    else if($personalTrainingElite == "12 personal training sessions/month") {
                        $order_cost += $personalTrainingElitePrice * 12;
                    }
                }
                
                if($guestPassesElite != "None") {
                    if($guestPassesElite == "5 guest passes") {
                        $order_cost += $guestPassElitePrice * 1;
                    }
                    else if($guestPassesElite == "10 guest passes") {
                        $order_cost += $guestPassElitePrice * 2;
                    }
                }
                
                if(isset($merchandiseElite)) {
                    $merchArr = explode(",", $merchandiseElite);
                
                    foreach ($merchArr as $merch) {
                        $merch = sanitise_input($merch);
                        if (array_key_exists($merch, $kkqMerch)) {
                            $order_cost += $kkqMerch[$merch];
                        }
                    }
                }
                
                if($bodyCompositionAnalysis != "None") {
                    if($bodyCompositionAnalysis == "Quarterly body composition analysis") {
                        $order_cost += 300;
                    }
                    else if($bodyCompositionAnalysis == "Yearly body composition analysis") {
                        $order_cost += 600;
                    }
                }                
            }

            $order_cost *= $qty;

            //set up command to add or query data from table
            $query = "INSERT INTO $sql_table (fname, lname, email, phoneNumber, preferredContact, streetAddress, town, state, postCode, product, membershipLength, qty, clubLoc, saunaSteamAccess, grpClasses, personalTrainingPrem, guestPassesPrem, merchandisePrem, nutritionalCoaching, personalTrainingElite, guestPassesElite, merchandiseElite, bodyCompositionAnalysis, ccType, ccName, ccNum, expDate, cvv, order_cost) 
            VALUES ('$fname', '$lname', '$email', '$phoneNumber', '$preferredContact', '$streetAddress', '$town', '$state', '$postCode', '$product', '$membershipLength', $qty, '$clubLoc', '$saunaSteamAccess', '$grpClasses', '$personalTrainingPrem', '$guestPassesPrem', '$merchandisePrem', '$nutritionalCoaching', '$personalTrainingElite', '$guestPassesElite', '$merchandiseElite', '$bodyCompositionAnalysis', '$ccType', '$ccName', $ccNum, '$expDate', $cvv, $order_cost)";

            //execute query
            $result = mysqli_query($conn, $query);

            //check for successful execution
            if(!$result) {
                //not shown in production script
                echo "<p class = \"wrong\">Something is wrong with ", $query, "</p>";
            }
            else {
                $order_id = mysqli_insert_id($conn);

                $query = "select * from $sql_table where order_id like '$order_id'";

                $result = mysqli_query($conn, $query);

                $_SESSION["order_id"] = $order_id;
                while ($row = mysqli_fetch_assoc($result)){
                    $_SESSION["order_id"] = $row["order_id"];
                    $_SESSION["fname"] = $row["fname"];
                    $_SESSION["lname"] = $row["lname"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["phoneNumber"] = $row["phoneNumber"];
                    $_SESSION["preferredContact"] = $row["preferredContact"];
                    $_SESSION["streetAddress"] = $row["streetAddress"];
                    $_SESSION["town"] = $row["town"];
                    $_SESSION["state"] = $row["state"];
                    $_SESSION["postCode"] = $row["postCode"];
                    $_SESSION["product"] = $row["product"];
                    $_SESSION["membershipLength"] = $row["membershipLength"];
                    $_SESSION["qty"] = $row["qty"];
                    $_SESSION["clubLoc"] = $row["clubLoc"];
                    $_SESSION["saunaSteamAccess"] = $row["saunaSteamAccess"];
                    $_SESSION["grpClasses"] = $row["grpClasses"];
                    $_SESSION["personalTrainingPrem"] = $row["personalTrainingPrem"];
                    $_SESSION["guestPassesPrem"] = $row["guestPassesPrem"];
                    $_SESSION["merchandisePrem"] = $row["merchandisePrem"];
                    $_SESSION["nutritionalCoaching"] = $row["nutritionalCoaching"];
                    $_SESSION["personalTrainingElite"] = $row["personalTrainingElite"];
                    $_SESSION["guestPassesElite"] = $row["guestPassesElite"];
                    $_SESSION["merchandiseElite"] = $row["merchandiseElite"];
                    $_SESSION["bodyCompositionAnalysis"] = $row["bodyCompositionAnalysis"];
                    $_SESSION["ccType"] = $row["ccType"];
                    $_SESSION["ccName"] = $row["ccName"];
                    $_SESSION["ccNum"] = $row["ccNum"];
                    $_SESSION["expDate"] = $row["expDate"];
                    $_SESSION["cvv"] = $row["cvv"];
                    $_SESSION["order_cost"] = $row["order_cost"];
                    $_SESSION["order_time"] = $row["order_time"];
                    $_SESSION["order_status"] = $row["order_status"];
                }
                
                //redirect to receipt page
                header("location: receipt.php");
            } //if successful query operation
        }
        //close db connection
        mysqli_close($conn);
    } //if successful db connection
?>