<!-- Description: Redirected here when process_registration has found errors (there are elements in errors array) -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<?php 
    session_start(); //start session
    if(!isset($_SESSION["errors_registration"])) { //check if session var exists
        header("location: manager_registration.php");
    }
    $errors_registration = $_SESSION["errors_registration"];
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF‐8"/>
    <meta name="description" content="Fitness Club Membership Order Manager Registration"/>
    <meta name="keywords" content="receipt"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>Manager Registration | Kardio Kings & Queens</title>

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
    <article>
        <form id = "registrationForm" class="managerForm" method='post' action='process_registration.php'>
            <h1 class="queryHeader registerHeader">Manager Registration</h1>
            <section class="custOrdersSect queryContainer">
                <section>
                    <section>
                        <?php
                            $username = $_SESSION["username"];

                            $errorCls = "";
                            if(isset($errors_registration["username"])) {
                                $errorCls = "error";
                            }

                            echo "<label for=\"username\">Username</label><br>
                            <input type=\"text\" class = \"$errorCls\" name=\"username\" id=\"username\" value = \"$username\"><br><br>";

                            if(isset($errors_registration["username"])) {
                                echo "<p class = \"wrong\" id = \"errorPwd\">$errors_registration[username]</p><br>";
                            }
                            else {
                                echo "<br>";
                            }
                        ?>
                    </section>
                    <section>
                        <?php
                            $userPwd = $_SESSION["userPwd"];

                            $errorCls = "";
                            if(isset($errors_registration["userPwd"])) {
                                $errorCls = "error";
                            }

                            echo "<label for=\"lname\">Password</label><br>
                            <input type=\"text\" name=\"userPwd\" id=\"userPwd\" value = \"$userPwd\" class = \"$errorCls\"><br><br>";

                            if(isset($errors_registration["userPwd"])) {
                                echo "<p class = \"wrong\" id = \"errorPwd\">$errors_registration[userPwd]</p>";
                            }
                        ?>
                    <section>
                </section>
            </section>
            <section class="queryContainer">
                <input type="submit" class="querySubmit" value="Register Now" name="submitRegistration">
            </section>
        </form>
    </article>
    <br>
<?php
    include "includes/footer.inc";
    //destroy session so users cannot directly access the fix_order.php page
 ?>
</body>
</html>