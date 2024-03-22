<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF-8"/>
    <meta name="description" content="Fitness Club Membership Enquiry"/>
    <meta name="keywords" content="products, features, fitness, membership"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Membership | Kardio Kings & Queens</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.png"> <!--https://www.flaticon.com/free-icons/muscle: Muscle icons created by Dragon Icons - Flaticon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <link href = "https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel = "stylesheet"/>

    <link href = "styles/style.css" rel = "stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 995px)" href="styles/responsive.css">

    <script src="scripts/enhancements.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>
<?php
    include "includes/header.inc";
?>
    <article>
        <section class = "productTypeContainer">
            <section>
                <input type="radio" name="membershipType" id="basicDynamic" value="basic" checked></input> <!-- required-->
                <label for="basicDynamic" class = "productDyn">Basic</label>
            </section>
            
            <section>
                <input type="radio" name="membershipType" id="premDynamic" value="premium">
                <label for="premDynamic" class = "productDyn">Premium</label>
            </section>
            
            <section>
                <input type="radio" name="membershipType" id="eliteDynamic" value="elite">
                <label for="eliteDynamic" class = "productDyn">Elite</label><br>
            </section>
        </section><br>
        <aside id = "testimonials">
            <h3 id = "testimonialHeader">Testimonials</h3>
            <p class = "mdi mdi-format-quote-open"></p>
            <blockquote class = "testimonial"></blockquote>
            <p class="mdi mdi-format-quote-close"></p>
            <p class = "mdi mdi-format-quote-open"></p>
            <blockquote class = "testimonial"></blockquote>
            <p class="mdi mdi-format-quote-close"></p>
        </aside>
        
        <section id = "membershipDescContainer">
            <section id = "basicMembershipDesc">
                <section class = "topDesc">
                    <img class = "membershipImg" src = ""/>
                    <section class = "descContainer">
                        <h1 class = "membershipHeaderDesc"></h1>
                        <h2 class = "membershipSubheaderDesc"></h2>
                        <p class = "featureDesc"></p>
                    </section>
                </section>

                <section class = "productHeaderContainer">
                    <h3 class = "optionalHeader">Optional membership features</h3>
                    <p class = "notice"></p>
                </section>

                <section class = "membershipSubcontainer1">
                    <section class = "featuresContainer">
                        <h4 class = "featureName">Membership Commitment Length</h4>
                        <ol class = "1stFeature"></ol>
                    </section>
                    <section class = "featuresContainer" id = "grey1">
                        <h4 class = "featureName"></h4>
                        <ul class = "2ndFeature"></ul>
                    </section>
                    <section class = "featuresContainer">
                        <h4 class = "featureName"></h4>
                        <ul class = "3rdFeature"></ul>
                    </section>
                </section>
                <section id = "classBasicFeat">
                    <h4 class = "featureName"></h4>
                    <section id = "fitnessClassesContainer">
                        <table id = "fitnessClassesTable"></table>
                    </section>
                </section>
                <section class = "membershipSubcontainer2">
                    <section class = "featuresContainer" id = "grey5">
                        <h4 class = "featureName"></h4>
                        <ul class = "4thFeature"></ul>
                    </section>
                    <section class = "featuresContainer">
                        <h4 class = "featureName"></h4>
                        <ul class = "5thFeature"></ul>
                    </section>
                </section>
                <br>
                <p class = "references"></p>
            </section>
        </section>
        <br><br>
    </article>
<?php
    include "includes/footer.inc";
?>
</body>
</html>