<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf‐8"/>
    <meta name="description" content="Fitness Club Membership Enquiry"/>
    <meta name="keywords" content="home, fitness, membership"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>Home | Kardio Kings & Queens</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.png"> <!--ttps://www.flaticon.com/free-icons/muscle: Muscle icons created by Dragon Icons - Flaticon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href = "styles/style.css" rel = "stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 995px)" href="styles/responsive.css">
    <script src="scripts/menu.js"></script>
</head>
<body id = "homeBody">
<?php
    include "includes/header.inc";
?>
    <article>
        <section id = "ctaLabelContainer">
            <p id = "ctaLabel">Fitness excellence guaranteed</p>
        </section>
        <h1 id = "slogan1">Sweat today,</h1>
        <h1 id = "slogan2">Shine tomorrow</h1>
        <p id = "desc">Invest in your health and well-being with a membership that gives you access to state-of-the-art facilities and services.</p>
        <section id = "statAndCaptionContainer">
            <section id = "statsContainer">
                <h2 class = "stat">25+</h2>
                <h2 class = "stat">675+</h2>
                <h2 class = "stat">30+</h2>
            </section>
            <section id = "statsCaptionsContainer">
                <p id = "statCaption1">EXPERT TRAINERS</p>
                <p id = "statCaption2">MEMBERS JOINED</p>
                <p id = "statCaption3">FITNESS PROGRAMS</p>
            </section>
        </section>
        <section id = "ctaBtnContainer">
            <a href = "product.php" class = "ctaButton" id = "ctaButton2">Join Now</a>
        </section>
    </article>
<?php
    include "includes/footer.inc";
?>
</body>
</html>