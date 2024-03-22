<!-- Description: Allow users to register or log in as a Manager -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF‐8"/>
    <meta name="description" content="Fitness Club Membership Order Manager Registration"/>
    <meta name="keywords" content="receipt"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>Manager Registration or Login | Kardio Kings & Queens</title>

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
        <form class="managerForm" method='post' action='manager_home.php'>
        <h1 class="queryHeader registerHeader">Register or Log In</h1>
        <section class="custOrdersSect">
            <section class="queryContainer">
                <section>
                    <h1 class="receiptHeader managerHeader" id="confirmCancelHeader">Welcome to KKQ's Manager Page!</h1>
                </section>
            </section>
            <input type="hidden" name="order_id" value="$order_id">
            <input type="hidden" name="order_status" value="$order_status">
            <section class="confirmContainer">
                <input type="submit" id="confirmCancel" class="confirmCancel" value="Log In" name="login"></button>
                <input type="submit" id="confirmSubmit" class="querySubmit" value="Register Now" name="register">
            </section>
        </section>
    </form>

    </article>
    <br>
<?php
    if(isset($_POST["login"])) {
        header("location: login.php");
    }
    if(isset($_POST["register"])) {
        header("location: manager_registration.php");
    }
    include "includes/footer.inc";
    //destroy session so users cannot directly access the fix_order.php page
 ?>
</body>
</html>