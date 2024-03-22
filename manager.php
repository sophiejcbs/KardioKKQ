<!-- Description: manager.php page to view a variety of reports based on data in orders table -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<?php
    session_start(); //start session
    if(!isset($_SESSION["validUser"])) { //check if session var exists
        header("location: manager_home.php");
    }
    else if($_SESSION["validUser"] != true) {
        header("location: manager_home.php");
    }
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF‐8"/>
    <meta name="description" content="Fitness Club Membership Order Receipt"/>
    <meta name="keywords" content="manager"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>Manager | Kardio Kings & Queens</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.png"> <!--https://www.flaticon.com/free-icons/muscle: Muscle icons created by Dragon Icons - Flaticon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <link href = "styles/style.css" rel = "stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 995px)" href="styles/responsive.css">
    
    <script src="scripts/manager.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>
<?php
    function sanitise_input($data) {
        $data = trim($data); //remove leading/trailing space <script src="scripts/menu.js"></script>
        $data = stripslashes($data); //remove backslash in front of quote
        $data = htmlspecialchars($data); //convert html control char like < to HTML code &lt;
        return $data;
    }
?>
<?php
    include "includes/header.inc";
?>
<?php
    require_once("settings.php"); //connection info

    $conn = @mysqli_connect($host,
            $user,
            $pwd,
            $sql_db
    );
?>
    <article>
        <br><br>
        <form method = "post" id = "queryForm" action = "manager.php">
            
            <section class = "queryTypeContainer">
                <section>
                    <input type="submit" class = "queries" name="managerQueries" id="allOrders" value="All Orders"></input>
                </section>
                
                <section>
                    <input type="submit" class = "queries" name="managerQueries" id="custOrders" value="Orders for Customers"></input> 
                </section>
                
                <section>
                    <input type="submit" class = "queries" name="managerQueries" id="productOrders" value="Orders for Products"></input>
                </section>

                <section>
                    <input type="submit" class = "queries" name="managerQueries" id="pendingOrders" value="Pending Orders"></input>
                </section>
                <?php
                    //display log out link
                    if($_SESSION["validUser"] == true) {
                        echo "<p class = \"logOutBtn\"><a href = 'logout.php'>Log Out</a></p><br>";
                    }
                ?>
            </section><br>
            <section class = "queryTypeContainer">
                <section>
                    <input type="submit" class = "queries" name="managerQueries" id="totalCostOrders" value="Orders by Total Cost"></input>
                </section>

                <section>
                    <input type="submit" class = "queries" name="managerQueries" id="mostPopularProduct" value="Most Popular Product"></input>
                </section>

                <section>
                    <input type="submit" class = "queries" name="managerQueries" id="fulfilledOrders" value="Fulfilled Orders"></input>
                </section>

                <section>
                    <input type="submit" class = "queries" name="managerQueries" id="avgOrders" value="Average Orders"></input>
                </section>
            </section>
            <br>
        </form><br><br>

        <?php
            if(!$conn) {
                //display err msg
                echo "<p>Database connection failure</p>"; //not in production script
            }
            else {
                $sql_table = "orders";

                $sqlString = "show tables like '$sql_table'";
                $result = @mysqli_query($conn, $sqlString);

                // checks if there are any tables of this name
                if(mysqli_num_rows($result) != 0 && isset($_POST["managerQueries"])) {
                    $managerQuery = sanitise_input($_POST["managerQueries"]);

                    if($managerQuery == "All Orders") {
                        $query = "select * from $sql_table";
            
                        //execute query
                        $result = mysqli_query($conn, $query);
            
                        if(!$result) {
                            echo "<p>Something is wrong with ",	$query, "</p>";
                        } else {
                            echo "<h1 class = \"receiptHeader managerHeader\">All Orders</h1>";
                            // Display the retrieved records
                            echo "<table class = \"queryTable\">";
                            echo "<tr>\n"
                            ."<th class = \"action\" scope=\"col\"></th>\n"
                            ."<th scope=\"col\">ID</th>\n"
                            ."<th scope=\"col\">Date/Time</th>\n"
                            ."<th scope=\"col\">First Name</th>\n"
                            ."<th scope=\"col\">Last Name</th>\n"
                            ."<th scope=\"col\">Product</th>\n"
                            ."<th scope=\"col\">Length</th>\n"
                            ."<th scope=\"col\">Quantity</th>\n"
                            ."<th scope=\"col\">Optional Features</th>\n"
                            ."<th scope=\"col\">Total Cost (RM)</th>\n"
                            ."<th scope=\"col\">Order Status</th>\n"
                            ."</tr>\n";
            
                            // retrieve current record pointed by the result pointer
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<form method = \"post\" action = \"manager.php\">";
                                echo "<input type = \"hidden\" name = \"order_id\" value = \"$row[order_id]\">";
                                echo "<input type = \"hidden\" name = \"order_status\" value = \"$row[order_status]\">";
                                echo "<td class = \"action\"><input type = \"submit\" name = \"updateOrder\" class=\"updateBtn\" value = \"Update\">
                                <br><br><input type = \"submit\" name = \"cancelOrder\" class=\"updateBtn\" value = \"Cancel\"></td>";
                                echo "</form>";
                                echo "<td>" . $row["order_id"] . "</td>";
                                $formattedDateTime = date('Y-m-d H:i', strtotime($row["order_time"]));
                                echo "<td>" . $formattedDateTime . "</td>";
                                echo "<td>" . $row["fname"] . "</td>";
                                echo "<td>" . $row["lname"] . "</td>";
                                echo "<td>" . $row["product"] . "</td>";
                                echo "<td>" . $row["membershipLength"] . "</td>";
                                echo "<td>" . $row["qty"] . "</td>";
                                //concatenate the optional features the customer selected for their membership
                                $features = "";
                                if($row["product"] == "Basic") {
                                    $features =  $row["clubLoc"]."<br>".$row["saunaSteamAccess"]."<br>".$row["grpClasses"]."<br>";
                                }
                                else if($row["product"] == "Premium") {
                                    $features =  $row["personalTrainingPrem"]."<br>".$row["guestPassesPrem"]."<br>".$row["merchandisePrem"]."<br>". $row["nutritionalCoaching"]."<br>";
                                }
                                else if($row["product"] == "Elite") {
                                    $features =  $row["personalTrainingElite"]."<br>".$row["guestPassesElite"]."<br>".$row["merchandiseElite"]."<br>". $row["bodyCompositionAnalysis"]."<br>";
                                }
                                echo "<td>" . $features . "</td>";
                                echo "<td>" . $row["order_cost"] . "</td>";
                                echo "<td>" . $row["order_status"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table></form>";
                            // Frees up the memory, after using the result pointer
                            mysqli_free_result($result);
                        }
                    }
                    else if($managerQuery == "Orders for Customers") {
                        echo "<form class = \"managerForm\"method = 'post' action = 'manager.php'><h1 class = \"queryHeader\">Search Orders by Customer Name</h1>
                        <section class = \"custOrdersSect queryContainer\">
                            <section>
                                <section>
                                    <label for=\"fname\">First Name</label><br>
                                    <input type=\"text\" name=\"fname\" id=\"fname\" placeholder=\"John\"><br><br>
                                </section>
                                <section>
                                    <label for=\"lname\">Last Name</label><br>
                                    <input type=\"text\" name=\"lname\" id=\"lname\" placeholder=\"Doe\"><br><br>
                                <section>
                            </section>
                        </section>
                        <section class = \"queryContainer\"><input type = \"submit\" class = \"querySubmit\" value = \"Search\" name = \"submitCustOrder\"></input></section>
                        </section></form>";
                    }
                    else if($managerQuery == "Fulfilled Orders") {
                        echo "<form class = \"managerForm\"method = 'post' action = 'manager.php'><h1 class = \"queryHeader\">Fulfilled Orders between Two Dates</h1>
                        <section class = \"custOrdersSect queryContainer\">
                            <section>
                                <section>
                                    <label for=\"startDate\">Start Date</label><br>
                                    <input type=\"date\" name=\"startDate\" id=\"startDate\"><br><br>
                                </section>
                                <section>
                                    <label for=\"endDate\">End Date</label><br>
                                    <input type=\"date\" name=\"endDate\" id=\"endDate\"><br><br>
                                <section>
                            </section>
                        </section>
                        <section class = \"queryContainer\"><input type = \"submit\" class = \"querySubmit\" value = \"Search\" name = \"submitFulfOrder\"></input></section>
                        </section></form>";
                    }
                    else if($managerQuery == "Orders for Products") {
                        echo "<form class = \"managerForm\"method = 'post' action = 'manager.php'><h1 class = \"queryHeader\">Search Orders by Product Name</h1>
                        <section class = \"custOrdersSect\">
                            <section class = \"queryContainer\">
                                <section>
                                    <label for=\"product\">Product</label><br>
                                    <select name = \"product\" id = \"product\">
                                        <option value = \"\">Please Select</option>
                                        <option value = \"Basic\">Basic (RM 120/mth)</option>
                                        <option value = \"Premium\">Premium (RM 200/mth)</option>
                                        <option value = \"Elite\">Elite (RM 280/mth)</option>
                                    </select>
                                </section>
                            </section>
                            <section class = \"queryContainer\"><input type = \"submit\" class = \"querySubmit\" value = \"Search\" name = \"submitProdOrder\"></input></section>
                        </section>
                        </section></form>";
                    }
                    else if($managerQuery == "Pending Orders") {
                        $query = "select * from $sql_table where order_status like 'PENDING'";
            
                        //execute query
                        $result = mysqli_query($conn, $query);
            
                        if(!$result) {
                            echo "<p>Something is wrong with ",	$query, "</p>";
                        } else {
                            echo "<h1 class = \"receiptHeader managerHeader\">Pending Orders</h1>";
                            // Display the retrieved records
                            echo "<table class = \"queryTable\">";
                            echo "<tr>\n"
                            ."<th class = \"action\" scope=\"col\"></th>\n"
                            ."<th scope=\"col\">ID</th>\n"
                            ."<th scope=\"col\">Date/Time</th>\n"
                            ."<th scope=\"col\">First Name</th>\n"
                            ."<th scope=\"col\">Last Name</th>\n"
                            ."<th scope=\"col\">Product</th>\n"
                            ."<th scope=\"col\">Length</th>\n"
                            ."<th scope=\"col\">Quantity</th>\n"
                            ."<th scope=\"col\">Optional Features</th>\n"
                            ."<th scope=\"col\">Total Cost (RM)</th>\n"
                            ."<th scope=\"col\">Order Status</th>\n"
                            ."</tr>\n";
            
                            // retrieve current record pointed by the result pointer
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<form method = \"post\" action = \"manager.php\">";
                                echo "<input type = \"hidden\" name = \"order_id\" value = \"$row[order_id]\">";
                                echo "<input type = \"hidden\" name = \"order_status\" value = \"$row[order_status]\">";
                                echo "<td class = \"action\"><input type = \"submit\" name = \"updateOrder\" class=\"updateBtn\" value = \"Update\">
                                <br><br><input type = \"submit\" name = \"cancelOrder\" class=\"updateBtn\" value = \"Cancel\"></td>";
                                echo "</form>";
                                echo "<td>" . $row["order_id"] . "</td>";
                                $formattedDateTime = date('Y-m-d H:i', strtotime($row["order_time"]));
                                echo "<td>" . $formattedDateTime . "</td>";
                                echo "<td>" . $row["fname"] . "</td>";
                                echo "<td>" . $row["lname"] . "</td>";
                                echo "<td>" . $row["product"] . "</td>";
                                echo "<td>" . $row["membershipLength"] . "</td>";
                                echo "<td>" . $row["qty"] . "</td>";
                                //concatenate the optional features the customer selected for their membership
                                $features = "";
                                if($row["product"] == "Basic") {
                                    $features =  $row["clubLoc"]."<br>".$row["saunaSteamAccess"]."<br>".$row["grpClasses"]."<br>";
                                }
                                else if($row["product"] == "Premium") {
                                    $features =  $row["personalTrainingPrem"]."<br>".$row["guestPassesPrem"]."<br>".$row["merchandisePrem"]."<br>". $row["nutritionalCoaching"]."<br>";
                                }
                                else if($row["product"] == "Elite") {
                                    $features =  $row["personalTrainingElite"]."<br>".$row["guestPassesElite"]."<br>".$row["merchandiseElite"]."<br>". $row["bodyCompositionAnalysis"]."<br>";
                                }
                                echo "<td>" . $features . "</td>";
                                echo "<td>" . $row["order_cost"] . "</td>";
                                echo "<td>" . $row["order_status"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            // Frees up the memory, after using the result pointer
                            mysqli_free_result($result);
                        }
                    }
                    else if($managerQuery == "Orders by Total Cost") {
                        $query = "select * from $sql_table order by order_cost";
            
                        //execute query
                        $result = mysqli_query($conn, $query);
            
                        if(!$result) {
                            echo "<p>Something is wrong with ",	$query, "</p>";
                        } else {
                            echo "<h1 class = \"receiptHeader managerHeader\">Orders by Total Cost</h1>";
                            // Display the retrieved records
                            echo "<table class = \"queryTable\">";
                            echo "<tr>\n"
                            ."<th class = \"action\" scope=\"col\"></th>\n"
                            ."<th scope=\"col\">ID</th>\n"
                            ."<th scope=\"col\">Date/Time</th>\n"
                            ."<th scope=\"col\">First Name</th>\n"
                            ."<th scope=\"col\">Last Name</th>\n"
                            ."<th scope=\"col\">Product</th>\n"
                            ."<th scope=\"col\">Length</th>\n"
                            ."<th scope=\"col\">Quantity</th>\n"
                            ."<th scope=\"col\">Optional Features</th>\n"
                            ."<th scope=\"col\">Total Cost (RM)</th>\n"
                            ."<th scope=\"col\">Order Status</th>\n"
                            ."</tr>\n";
            
                            // retrieve current record pointed by the result pointer
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<form method = \"post\" action = \"manager.php\">";
                                echo "<input type = \"hidden\" name = \"order_id\" value = \"$row[order_id]\">";
                                echo "<input type = \"hidden\" name = \"order_status\" value = \"$row[order_status]\">";
                                echo "<td class = \"action\"><input type = \"submit\" name = \"updateOrder\" class=\"updateBtn\" value = \"Update\">
                                <br><br><input type = \"submit\" name = \"cancelOrder\" class=\"updateBtn\" value = \"Cancel\"></td>";
                                echo "</form>";
                                echo "<td>" . $row["order_id"] . "</td>";
                                $formattedDateTime = date('Y-m-d H:i', strtotime($row["order_time"]));
                                echo "<td>" . $formattedDateTime . "</td>";
                                echo "<td>" . $row["fname"] . "</td>";
                                echo "<td>" . $row["lname"] . "</td>";
                                echo "<td>" . $row["product"] . "</td>";
                                echo "<td>" . $row["membershipLength"] . "</td>";
                                echo "<td>" . $row["qty"] . "</td>";
                                //concatenate the optional features the customer selected for their membership
                                $features = "";
                                if($row["product"] == "Basic") {
                                    $features =  $row["clubLoc"]."<br>".$row["saunaSteamAccess"]."<br>".$row["grpClasses"]."<br>";
                                }
                                else if($row["product"] == "Premium") {
                                    $features =  $row["personalTrainingPrem"]."<br>".$row["guestPassesPrem"]."<br>".$row["merchandisePrem"]."<br>". $row["nutritionalCoaching"]."<br>";
                                }
                                else if($row["product"] == "Elite") {
                                    $features =  $row["personalTrainingElite"]."<br>".$row["guestPassesElite"]."<br>".$row["merchandiseElite"]."<br>". $row["bodyCompositionAnalysis"]."<br>";
                                }
                                echo "<td>" . $features . "</td>";
                                echo "<td>" . $row["order_cost"] . "</td>";
                                echo "<td>" . $row["order_status"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            // Frees up the memory, after using the result pointer
                            mysqli_free_result($result);
                        }
                    }
                    else if($managerQuery == "Most Popular Product") {
                        $query = "SELECT product, COUNT(*) AS order_count FROM $sql_table GROUP BY product ORDER BY order_count DESC LIMIT 1";
                        $result = mysqli_query($conn, $query);

                        if(!$result) {
                            echo "<p>Something is wrong with ",	$query, "</p>";
                        } else {
                            // Fetch the result row
                            $row = mysqli_fetch_assoc($result);

                            // Get the most popular product details
                            $product = $row['product'];
                            $orderCount = $row['order_count'];

                            echo "<h1 class = \"receiptHeader managerHeader\">Most Popular Product</h1>";

                            // Display the most popular product
                            echo "<section class = \"popularProd\">";
                            echo "The most popular product is: <span class = \"receiptLabel\">$product Membership</span>";
                            echo "<br>";
                            echo "Total orders for this product: <span class = \"receiptLabel\">$orderCount</span>";
                            echo "</section><br><br>";
                            
                            $query = "SELECT * from $sql_table WHERE product LIKE '$product'";
                            $result = mysqli_query($conn, $query);

                            if(!$result) {
                                echo "<p>Something is wrong with ",	$query, "</p>";
                            }
                            else {
                                echo "<table class = \"queryTable\">";
                                echo "<tr>\n"
                                ."<th class = \"action\" scope=\"col\"></th>\n"
                                ."<th scope=\"col\">ID</th>\n"
                                ."<th scope=\"col\">Date/Time</th>\n"
                                ."<th scope=\"col\">First Name</th>\n"
                                ."<th scope=\"col\">Last Name</th>\n"
                                ."<th scope=\"col\">Product</th>\n"
                                ."<th scope=\"col\">Length</th>\n"
                                ."<th scope=\"col\">Quantity</th>\n"
                                ."<th scope=\"col\">Optional Features</th>\n"
                                ."<th scope=\"col\">Total Cost (RM)</th>\n"
                                ."<th scope=\"col\">Order Status</th>\n"
                                ."</tr>\n";
                
                                // retrieve current record pointed by the result pointer
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "<form method = \"post\" action = \"manager.php\">";
                                    echo "<input type = \"hidden\" name = \"order_id\" value = \"$row[order_id]\">";
                                    echo "<input type = \"hidden\" name = \"order_status\" value = \"$row[order_status]\">";
                                    echo "<td class = \"action\"><input type = \"submit\" name = \"updateOrder\" class=\"updateBtn\" value = \"Update\">
                                    <br><br><input type = \"submit\" name = \"cancelOrder\" class=\"updateBtn\" value = \"Cancel\"></td>";
                                    echo "</form>";
                                    echo "<td>" . $row["order_id"] . "</td>";
                                    $formattedDateTime = date('Y-m-d H:i', strtotime($row["order_time"]));
                                    echo "<td>" . $formattedDateTime . "</td>";
                                    echo "<td>" . $row["fname"] . "</td>";
                                    echo "<td>" . $row["lname"] . "</td>";
                                    echo "<td>" . $row["product"] . "</td>";
                                    echo "<td>" . $row["membershipLength"] . "</td>";
                                    echo "<td>" . $row["qty"] . "</td>";
                                    //concatenate the optional features the customer selected for their membership
                                    $features = "";
                                    if($row["product"] == "Basic") {
                                        $features =  $row["clubLoc"]."<br>".$row["saunaSteamAccess"]."<br>".$row["grpClasses"]."<br>";
                                    }
                                    else if($row["product"] == "Premium") {
                                        $features =  $row["personalTrainingPrem"]."<br>".$row["guestPassesPrem"]."<br>".$row["merchandisePrem"]."<br>". $row["nutritionalCoaching"]."<br>";
                                    }
                                    else if($row["product"] == "Elite") {
                                        $features =  $row["personalTrainingElite"]."<br>".$row["guestPassesElite"]."<br>".$row["merchandiseElite"]."<br>". $row["bodyCompositionAnalysis"]."<br>";
                                    }
                                    echo "<td>" . $features . "</td>";
                                    echo "<td>" . $row["order_cost"] . "</td>";
                                    echo "<td>" . $row["order_status"] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                            
                            // Frees up the memory, after using the result pointer
                            mysqli_free_result($result);
                        }
                    }
                    else if($managerQuery == "Average Orders") {
                        $query = "SELECT AVG(order_count) AS average_orders_per_day FROM (SELECT DATE(order_time) AS order_day, COUNT(*) AS order_count FROM $sql_table GROUP BY order_day) AS daily_orders";
                        $result = mysqli_query($conn, $query);

                        if(!$result) {
                            echo "<p>Something is wrong with ",	$query, "</p>";
                        } else {
                            // Fetch the result row
                            $row = mysqli_fetch_assoc($result);

                            //get the average number of orders per day
                            $averageOrders = intval($row['average_orders_per_day']);
                            
                            echo "<h1 class = \"receiptHeader managerHeader\">Average Orders per Day</h1>";

                            echo "<section class = \"popularProd\">";
                            echo "The average number of orders per day is: <span class = \"receiptLabel\">$averageOrders</span><br>";
                            
                            $currentDate = date('Y-m-d');
                            $query = "SELECT COUNT(*) as totalOrdersToday FROM orders WHERE DATE(order_time) = '$currentDate'";    
                            $result = mysqli_query($conn, $query);

                            if(!$result) {
                                echo "<p>Something is wrong with ",	$query, "</p>";
                            }
                            else {
                                $row = mysqli_fetch_assoc($result);
                                $totalOrdersToday = $row['totalOrdersToday'];
                                echo "Number of Orders Today ($currentDate): <span class = \"receiptLabel\">$totalOrdersToday</span>";
                                echo "</section><br><br>";

                                $query = "SELECT * FROM orders WHERE DATE(order_time) = '$currentDate'";    
                                $result = mysqli_query($conn, $query);
                                if(!$result) {
                                    echo "<p>Something is wrong with ",	$query, "</p>";
                                }
                                else {
                                    echo "<table class = \"queryTable\">";
                                    echo "<tr>\n"
                                    ."<th class = \"action\" scope=\"col\"></th>\n"
                                    ."<th scope=\"col\">ID</th>\n"
                                    ."<th scope=\"col\">Date/Time</th>\n"
                                    ."<th scope=\"col\">First Name</th>\n"
                                    ."<th scope=\"col\">Last Name</th>\n"
                                    ."<th scope=\"col\">Product</th>\n"
                                    ."<th scope=\"col\">Length</th>\n"
                                    ."<th scope=\"col\">Quantity</th>\n"
                                    ."<th scope=\"col\">Optional Features</th>\n"
                                    ."<th scope=\"col\">Total Cost (RM)</th>\n"
                                    ."<th scope=\"col\">Order Status</th>\n"
                                    ."</tr>\n";
                    
                                    // retrieve current record pointed by the result pointer
                                    while ($row = mysqli_fetch_assoc($result)){
                                        echo "<tr>";
                                        echo "<form method = \"post\" action = \"manager.php\">";
                                        echo "<input type = \"hidden\" name = \"order_id\" value = \"$row[order_id]\">";
                                        echo "<input type = \"hidden\" name = \"order_status\" value = \"$row[order_status]\">";
                                        echo "<td class = \"action\"><input type = \"submit\" name = \"updateOrder\" class=\"updateBtn\" value = \"Update\">
                                        <br><br><input type = \"submit\" name = \"cancelOrder\" class=\"updateBtn\" value = \"Cancel\"></td>";
                                        echo "</form>";
                                        echo "<td>" . $row["order_id"] . "</td>";
                                        $formattedDateTime = date('Y-m-d H:i', strtotime($row["order_time"]));
                                        echo "<td>" . $formattedDateTime . "</td>";
                                        echo "<td>" . $row["fname"] . "</td>";
                                        echo "<td>" . $row["lname"] . "</td>";
                                        echo "<td>" . $row["product"] . "</td>";
                                        echo "<td>" . $row["membershipLength"] . "</td>";
                                        echo "<td>" . $row["qty"] . "</td>";
                                        //concatenate the optional features the customer selected for their membership
                                        $features = "";
                                        if($row["product"] == "Basic") {
                                            $features =  $row["clubLoc"]."<br>".$row["saunaSteamAccess"]."<br>".$row["grpClasses"]."<br>";
                                        }
                                        else if($row["product"] == "Premium") {
                                            $features =  $row["personalTrainingPrem"]."<br>".$row["guestPassesPrem"]."<br>".$row["merchandisePrem"]."<br>". $row["nutritionalCoaching"]."<br>";
                                        }
                                        else if($row["product"] == "Elite") {
                                            $features =  $row["personalTrainingElite"]."<br>".$row["guestPassesElite"]."<br>".$row["merchandiseElite"]."<br>". $row["bodyCompositionAnalysis"]."<br>";
                                        }
                                        echo "<td>" . $features . "</td>";
                                        echo "<td>" . $row["order_cost"] . "</td>";
                                        echo "<td>" . $row["order_status"] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                }
                                
                                // Frees up the memory, after using the result pointer
                                mysqli_free_result($result);
                            }
                        }
                    }
                }

                if(isset($_POST["submitCustOrder"])) {
                    if(isset($_POST["fname"]) && isset($_POST["lname"])) {
                        $fname = sanitise_input($_POST["fname"]);
                        $lname = sanitise_input($_POST["lname"]);

                        if($fname != "" && $lname != "") {
                            $query = "select * from $sql_table where fname like '$fname%' AND lname like '$lname%'";
                
                            //execute query
                            $result = mysqli_query($conn, $query);
                
                            if(!$result) {
                                echo "<p>Something is wrong with ",	$query, "</p>";
                            } else {
                                echo "<h1 class = \"receiptHeader managerHeader\">Orders for Customer '$fname $lname'</h1>";
                                // Display the retrieved records
                                echo "<table class = \"queryTable\">";
                                echo "<tr>\n"
                                ."<th class = \"action\" scope=\"col\"></th>\n"
                                ."<th scope=\"col\">ID</th>\n"
                                ."<th scope=\"col\">Date/Time</th>\n"
                                ."<th scope=\"col\">First Name</th>\n"
                                ."<th scope=\"col\">Last Name</th>\n"
                                ."<th scope=\"col\">Product</th>\n"
                                ."<th scope=\"col\">Length</th>\n"
                                ."<th scope=\"col\">Quantity</th>\n"
                                ."<th scope=\"col\">Optional Features</th>\n"
                                ."<th scope=\"col\">Total Cost (RM)</th>\n"
                                ."<th scope=\"col\">Order Status</th>\n"
                                ."</tr>\n";
                
                                // retrieve current record pointed by the result pointer
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "<form method = \"post\" action = \"manager.php\">";
                                    echo "<input type = \"hidden\" name = \"order_id\" value = \"$row[order_id]\">";
                                    echo "<input type = \"hidden\" name = \"order_status\" value = \"$row[order_status]\">";
                                    echo "<td class = \"action\"><input type = \"submit\" name = \"updateOrder\" class=\"updateBtn\" value = \"Update\">
                                    <br><br><input type = \"submit\" name = \"cancelOrder\" class=\"updateBtn\" value = \"Cancel\"></td>";
                                    echo "</form>";
                                    echo "<td>" . $row["order_id"] . "</td>";
                                    $formattedDateTime = date('Y-m-d H:i', strtotime($row["order_time"]));
                                    echo "<td>" . $formattedDateTime . "</td>";
                                    echo "<td>" . $row["fname"] . "</td>";
                                    echo "<td>" . $row["lname"] . "</td>";
                                    echo "<td>" . $row["product"] . "</td>";
                                    echo "<td>" . $row["membershipLength"] . "</td>";
                                    echo "<td>" . $row["qty"] . "</td>";
                                    //concatenate the optional features the customer selected for their membership
                                    $features = "";
                                    if($row["product"] == "Basic") {
                                        $features =  $row["clubLoc"]."<br>".$row["saunaSteamAccess"]."<br>".$row["grpClasses"]."<br>";
                                    }
                                    else if($row["product"] == "Premium") {
                                        $features =  $row["personalTrainingPrem"]."<br>".$row["guestPassesPrem"]."<br>".$row["merchandisePrem"]."<br>". $row["nutritionalCoaching"]."<br>";
                                    }
                                    else if($row["product"] == "Elite") {
                                        $features =  $row["personalTrainingElite"]."<br>".$row["guestPassesElite"]."<br>".$row["merchandiseElite"]."<br>". $row["bodyCompositionAnalysis"]."<br>";
                                    }
                                    echo "<td>" . $features . "</td>";
                                    echo "<td>" . $row["order_cost"] . "</td>";
                                    echo "<td>" . $row["order_status"] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                // Frees up the memory, after using the result pointer
                                mysqli_free_result($result);
                            }
                        }
                        else {
                            echo "<p class = \"wrong2\">Please enter a first name and last name to search for.</p>";
                        }
                    }
                    else {
                        echo "<p class = \"wrong2\">Please enter a first name and last name to search for.</p>";
                    }
                    
                }

                if(isset($_POST["submitFulfOrder"])) {
                    if(isset($_POST["startDate"]) && isset($_POST["endDate"])) {
                        $startDate = sanitise_input($_POST["startDate"]);
                        $endDate = sanitise_input($_POST["endDate"]);

                        $startDate = date('Y-m-d', strtotime($startDate));
                        $endDate = date('Y-m-d', strtotime($endDate));

                        if(($startDate != "" && $endDate != "") && ($startDate <= $endDate)) {
                            $query = "SELECT * FROM $sql_table WHERE order_status = 'FULFILLED' AND DATE(order_time) BETWEEN '$startDate' AND '$endDate'";
                
                            //execute query
                            $result = mysqli_query($conn, $query);
                
                            if(!$result) {
                                echo "<p>Something is wrong with ",	$query, "</p>";
                            } else {
                                echo "<h1 class = \"receiptHeader managerHeader\">Fulfilled Orders between $startDate and $endDate</h1>";
                                // Display the retrieved records
                                echo "<table class = \"queryTable\">";
                                echo "<tr>\n"
                                ."<th class = \"action\" scope=\"col\"></th>\n"
                                ."<th scope=\"col\">ID</th>\n"
                                ."<th scope=\"col\">Date/Time</th>\n"
                                ."<th scope=\"col\">First Name</th>\n"
                                ."<th scope=\"col\">Last Name</th>\n"
                                ."<th scope=\"col\">Product</th>\n"
                                ."<th scope=\"col\">Length</th>\n"
                                ."<th scope=\"col\">Quantity</th>\n"
                                ."<th scope=\"col\">Optional Features</th>\n"
                                ."<th scope=\"col\">Total Cost (RM)</th>\n"
                                ."<th scope=\"col\">Order Status</th>\n"
                                ."</tr>\n";
                
                                // retrieve current record pointed by the result pointer
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "<form method = \"post\" action = \"manager.php\">";
                                    echo "<input type = \"hidden\" name = \"order_id\" value = \"$row[order_id]\">";
                                    echo "<input type = \"hidden\" name = \"order_status\" value = \"$row[order_status]\">";
                                    echo "<td class = \"action\"><input type = \"submit\" name = \"updateOrder\" class=\"updateBtn\" value = \"Update\">
                                    <br><br><input type = \"submit\" name = \"cancelOrder\" class=\"updateBtn\" value = \"Cancel\"></td>";
                                    echo "</form>";
                                    echo "<td>" . $row["order_id"] . "</td>";
                                    $formattedDateTime = date('Y-m-d H:i', strtotime($row["order_time"]));
                                    echo "<td>" . $formattedDateTime . "</td>";
                                    echo "<td>" . $row["fname"] . "</td>";
                                    echo "<td>" . $row["lname"] . "</td>";
                                    echo "<td>" . $row["product"] . "</td>";
                                    echo "<td>" . $row["membershipLength"] . "</td>";
                                    echo "<td>" . $row["qty"] . "</td>";
                                    //concatenate the optional features the customer selected for their membership
                                    $features = "";
                                    if($row["product"] == "Basic") {
                                        $features =  $row["clubLoc"]."<br>".$row["saunaSteamAccess"]."<br>".$row["grpClasses"]."<br>";
                                    }
                                    else if($row["product"] == "Premium") {
                                        $features =  $row["personalTrainingPrem"]."<br>".$row["guestPassesPrem"]."<br>".$row["merchandisePrem"]."<br>". $row["nutritionalCoaching"]."<br>";
                                    }
                                    else if($row["product"] == "Elite") {
                                        $features =  $row["personalTrainingElite"]."<br>".$row["guestPassesElite"]."<br>".$row["merchandiseElite"]."<br>". $row["bodyCompositionAnalysis"]."<br>";
                                    }
                                    echo "<td>" . $features . "</td>";
                                    echo "<td>" . $row["order_cost"] . "</td>";
                                    echo "<td>" . $row["order_status"] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                // Frees up the memory, after using the result pointer
                                mysqli_free_result($result);
                            }
                        }
                        else if(!($startDate <= $endDate)) {
                            echo "<p class = \"wrong2\">Please make sure the start date is before or on the end date.</p>";
                        }
                        else {
                            echo "<p class = \"wrong2\">Please enter a start date and end date to search between.</p>";
                        }
                    }
                    else {
                        echo "<p class = \"wrong2\">>Please enter a start date and end date to search between.</p>";
                    }
                }

                if(isset($_POST["submitProdOrder"])) {
                    if(isset($_POST["product"])) {
                        $product= sanitise_input($_POST["product"]);

                        if($product != "none" && $product != "") {
                            $query = "select * from $sql_table where product like '$product%'";
                
                            //execute query
                            $result = mysqli_query($conn, $query);
                
                            if(!$result) {
                                echo "<p>Something is wrong with ",	$query, "</p>";
                            } else {
                                echo "<h1 class = \"receiptHeader managerHeader\">Orders for Product '$product'</h1>";
                                // Display the retrieved records
                                echo "<table class = \"queryTable\">";
                                echo "<tr>\n"
                                ."<th class = \"action\" scope=\"col\"></th>\n"
                                ."<th scope=\"col\">ID</th>\n"
                                ."<th scope=\"col\">Date/Time</th>\n"
                                ."<th scope=\"col\">First Name</th>\n"
                                ."<th scope=\"col\">Last Name</th>\n"
                                ."<th scope=\"col\">Product</th>\n"
                                ."<th scope=\"col\">Length</th>\n"
                                ."<th scope=\"col\">Quantity</th>\n"
                                ."<th scope=\"col\">Optional Features</th>\n"
                                ."<th scope=\"col\">Total Cost (RM)</th>\n"
                                ."<th scope=\"col\">Order Status</th>\n"
                                ."</tr>\n";
                
                                // retrieve current record pointed by the result pointer
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "<form method = \"post\" action = \"manager.php\">";
                                    echo "<input type = \"hidden\" name = \"order_id\" value = \"$row[order_id]\">";
                                    echo "<input type = \"hidden\" name = \"order_status\" value = \"$row[order_status]\">";
                                    echo "<td class = \"action\"><input type = \"submit\" name = \"updateOrder\" class=\"updateBtn\" value = \"Update\">
                                    <br><br><input type = \"submit\" name = \"cancelOrder\" class=\"updateBtn\" value = \"Cancel\"></td>";
                                    echo "</form>";
                                    echo "<td>" . $row["order_id"] . "</td>";
                                    $formattedDateTime = date('Y-m-d H:i', strtotime($row["order_time"]));
                                    echo "<td>" . $formattedDateTime . "</td>";
                                    echo "<td>" . $row["fname"] . "</td>";
                                    echo "<td>" . $row["lname"] . "</td>";
                                    echo "<td>" . $row["product"] . "</td>";
                                    echo "<td>" . $row["membershipLength"] . "</td>";
                                    echo "<td>" . $row["qty"] . "</td>";
                                    //concatenate the optional features the customer selected for their membership
                                    $features = "";
                                    if($row["product"] == "Basic") {
                                        $features =  $row["clubLoc"]."<br>".$row["saunaSteamAccess"]."<br>".$row["grpClasses"]."<br>";
                                    }
                                    else if($row["product"] == "Premium") {
                                        $features =  $row["personalTrainingPrem"]."<br>".$row["guestPassesPrem"]."<br>".$row["merchandisePrem"]."<br>". $row["nutritionalCoaching"]."<br>";
                                    }
                                    else if($row["product"] == "Elite") {
                                        $features =  $row["personalTrainingElite"]."<br>".$row["guestPassesElite"]."<br>".$row["merchandiseElite"]."<br>". $row["bodyCompositionAnalysis"]."<br>";
                                    }
                                    echo "<td>" . $features . "</td>";
                                    echo "<td>" . $row["order_cost"] . "</td>";
                                    echo "<td>" . $row["order_status"] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                // Frees up the memory, after using the result pointer
                                mysqli_free_result($result);
                            }
                        }
                        else {
                            echo "<p class = \"wrong2\">Please select a product to search for.</p>";
                        }
                    }
                    else {
                        echo "<p class = \"wrong2\">Please select a product to search for.</p>";
                    }
                }

                if(isset($_POST["updateOrder"])) {
                    if(isset($_POST["order_id"]) && isset($_POST["order_status"])) {
                        $order_id = sanitise_input($_POST["order_id"]);
                        $order_status = sanitise_input($_POST["order_status"]);

                        $selectedPending = ($order_status == "PENDING") ? "selected" : "";
                        $selectedFulf = ($order_status == "FULFILLED") ? "selected" : "";
                        $selectedPaid = ($order_status == "PAID") ? "selected" : "";
                        $selectedArch = ($order_status == "ARCHIVED") ? "selected" : "";

                        echo "<form class = \"managerForm\"method = 'post' action = 'manager.php'><h1 class = \"queryHeader\">Update Status of Order #$order_id</h1>
                        <section class = \"custOrdersSect\">
                            <section class = \"queryContainer\">
                                <section>
                                    <label for=\"order_status\">Product</label><br>
                                    <select name = \"order_status\" id = \"order_status\">
                                        <option value = \"PENDING\" $selectedPending>PENDING</option>
                                        <option value = \"FULFILLED\" $selectedFulf>FULFILLED</option>
                                        <option value = \"PAID\" $selectedPaid>PAID</option>
                                        <option value = \"ARCHIVED\" $selectedArch>ARCHIVED</option>
                                    </select>
                                </section>
                            </section>
                            <input type = \"hidden\" name = \"order_id\" value = \"$order_id\">
                            <section class = \"queryContainer\"><input type = \"submit\" class = \"querySubmit\" value = \"Update\" name = \"updateOrderInDB\"></input></section>
                        </section>
                        </section></form>";
                    }
                }

                if(isset($_POST["cancelOrder"])) {
                    if(isset($_POST["order_id"]) && isset($_POST["order_status"])) {
                        $order_id = sanitise_input($_POST["order_id"]);
                        $order_status = sanitise_input($_POST["order_status"]);

                        echo "<form class = \"managerForm\"method = 'post' action = 'manager.php'><h1 class = \"queryHeader\">Cancel Order #$order_id</h1>
                        <section class = \"custOrdersSect\">
                            <section class = \"queryContainer\">
                                <section>
                                    <h1 class = \"receiptHeader managerHeader\" id = \"confirmCancelHeader\">Are you sure you want to Cancel Order #$order_id?</h1>
                                </section>
                            </section>
                            <input type = \"hidden\" name = \"order_id\" value = \"$order_id\">
                            <input type = \"hidden\" name = \"order_status\" value = \"$order_status\">

                            <section class = \"confirmContainer\">
                                <button type=\"button\" id = \"confirmCancel\" class = \"confirmCancel\">No</button>
                                <input type = \"submit\" id = \"confirmSubmit\" class = \"querySubmit\" value = \"Yes\" name = \"cancelOrderInDB\"></input>
                            </section>
                        </section>
                        </section></form>";
                    }
                }

                if(isset($_POST["updateOrderInDB"])) {
                    if(isset($_POST["order_id"]) && isset($_POST["order_status"])) {
                        $order_id = sanitise_input($_POST["order_id"]);
                        $order_status = sanitise_input($_POST["order_status"]);

                        if($order_status != "none" && $order_status != "") {
                            $query = "update $sql_table set order_status = '$order_status' where order_id like '$order_id'";
			
                            // execute the query and store result into the result pointer
                            $result = mysqli_query($conn, $query);

                            if(!$result) {
                                echo "<p class=\"wrong2\">Something is wrong with ",	$query, "</p>";
                            }
                            else {
                                echo "<p class=\"okQuery\">Successfully Updated Order Status of Order #$order_id.</p>";
                            }  
                        }
                        else {
                            echo "<p class=\"wrong2\">Unsuccessful Update of Order Status for Order #$order_id due to Empty Status.</p>";
                        }
                    }
                }

                if(isset($_POST["cancelOrderInDB"])) {
                    if(isset($_POST["order_id"]) && isset($_POST["order_status"])) {
                        $order_id = sanitise_input($_POST["order_id"]);
                        $order_status = sanitise_input($_POST["order_status"]);

                        if($order_status == "PENDING" && $order_status != "none" && $order_status != "") {
                            $query = "delete from $sql_table where order_id like '$order_id'";
			
                            // execute the query and store result into the result pointer
                            $result = mysqli_query($conn, $query);

                            if(!$result) {
                                echo "<p class=\"wrong2\">Something is wrong with ",	$query, "</p>";
                            }
                            else {
                                echo "<p class=\"okQuery\">Successfully Deleted Order #$order_id.</p>";
                            }  
                        }
                        else {
                            echo "<p class=\"wrong2\">Unsuccessful Deletion of Order #$order_id due to Invalid Status of '$order_status'.</p>";
                        }
                    }
                    
                }
                
                //close db connection
                mysqli_close($conn);
            }
        ?>
    </article>
    <br>
<?php
    include "includes/footer.inc";
 ?>
</body>
</html>