<!-- Description: Allow users to log in to an existing manager account -->
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
    <title>Manager Login | Kardio Kings & Queens</title>

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
        <form id = "registrationForm" class="managerForm" method='post' action='process_login.php'>
            <h1 class="queryHeader registerHeader">Manager Login</h1>
            <section class="custOrdersSect queryContainer">
                <section>
                    <section>
                        <label for="username">Username</label><br>
                        <input type="text" name="username" id="username"><br><br>
                        <p class = "wrong2" id = "errorUname"></p>
                    </section>
                    <section>
                        <label for="lname">Password</label><br>
                        <input type="text" name="userPwd" id="userPwd"><br><br>
                        <p class = "wrong2" id = "errorPwd"></p>
                    <section>
                </section>
            </section>
            <section class="queryContainer">
                <input type="submit" class="querySubmit" value="Login Now" name="submitRegistration">
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