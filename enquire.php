<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF‐8"/>
    <meta name="description" content="Fitness Club Membership Enquiry"/>
    <meta name="keywords" content="enquiry, fitness, membership"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>Enquiry | Kardio Kings & Queens</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.png"> <!--https://www.flaticon.com/free-icons/muscle: Muscle icons created by Dragon Icons - Flaticon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <link href = "styles/style.css" rel = "stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 995px)" href="styles/responsive.css">

    <script src="scripts/enquire.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>
<?php
    include "includes/header.inc";
?>
    <article class = "enquiryContainer">
        <h1 id = "formHeader">Product Enquiry Form</h1> <!--https://mercury.swin.edu.au/it000000/formtest.php-->
        <form id = "enquiryForm" method = "post" action = "payment.php" novalidate>
            <section id = "topContainer">
                <section id = "contactSect">
                    <fieldset class = "topFieldset" id = "firstFieldset">
                        <legend>Contact</legend>
                        <label for = "fname">First name</label><br>
                        <input type = "text" name = "fname" id = "fname" pattern = "[a-zA-Z]{2,25}" required>
                        <p>
                            <label for = "lname">Last name</label><br>
                            <input type = "text" name = "lname" id = "lname" pattern = "[a-zA-Z]{2,25}" required>
                        </p>
                        <p>
                            <label for = "email">Email</label><br>
                            <input type = "email" name = "email" id = "email" placeholder = "johndoe123@example.com" required>
                        </p>
                        <label for = "phoneNumber">Phone number</label><br>
                        <input type = "text" name = "phoneNumber" id = "phoneNumber" pattern = "\d{8,10}" placeholder = "0123456789" required>
                        <p>
                            <p class = "unofficialLabel">Preferred contact</p>
                            <section class = "radioAndCheck">
                                <input type = "radio" name = "preferredContact" id = "emailContact" value = "Email">
                                <label for = "emailContact">Email</label><br>
                        
                                <input type = "radio" name = "preferredContact" id = "post" value = "Post">
                                <label for = "post">Post</label><br>
                        
                                <input type = "radio" name = "preferredContact" id = "phone" value = "Phone">
                                <label for = "phone">Phone</label><br>
                            </section>
                        </p>
                    </fieldset>
                </section>
                
                
                <section id = "addressSect">
                    <fieldset class = "topFieldset" id = "secondFieldset">
                        <legend>Address</legend>
                        <label for = "streetAddress">Street address</label><br>
                        <input type = "text" name = "streetAddress" id = "streetAddress" pattern = ".{5,40}" required>
                        <p>
                            <label for = "town">Suburb/town</label><br>
                            <input type = "text" name = "town" id = "town" pattern = "[a-zA-Z ]{2,20}" required>
                        </p>
                        <p><label for = "state">State</label><br>
                            <select name = "state" id = "state" required>
                                <option value = "">Please Select</option>
                                <option value = "VIC">VIC</option>
                                <option value = "NSW">NSW</option>
                                <option value = "QLD">QLD</option>
                                <option value = "NT">NT</option>
                                <option value = "WA">WA</option>
                                <option value = "SA">SA</option>
                                <option value = "TAS">TAS</option>
                                <option value = "ACT">ACT</option>
                            </select>
                        </p>
                        <p>
                            <label for = "postCode">Postcode</label><br>
                            <input type = "text" name = "postCode" id = "postCode" pattern = "[0-9]{4,4}" required>
                        </p>
                    </fieldset>
                </section>
            </section>
            
            <section id = "enquirySect">
                <fieldset id = "enquiryFieldset">
                    <legend>Enquiry</legend>
                    <label for = "product">Product</label><br>
                        <select name = "product" id = "product" required>
                            <option value = "">Please Select</option>
                            <option value = "basic">Basic</option>
                            <option value = "premium">Premium</option>
                            <option value = "elite">Elite</option>
                        </select>
                    <p>
                        <p class = "unofficialLabel">Product features</p>
                        <section class = "radioAndCheck" id = "checkSect">
                            <section>
                                <input type = "checkbox" name = "features[]" id = "loc" value = "location" checked required>
                                <label for = "loc">Club location</label><br>
                                
                                <input type = "checkbox" name = "features[]" id = "length" value = "membership length">
                                <label for = "length">Membership commitment length</label><br>
                                
                                <input type = "checkbox" name = "features[]" id = "classes" value = "class options">
                                <label for = "classes">Class options</label><br>
                                
                                <input type = "checkbox" name = "features[]" id = "saunaSteamRoomAccess" value = "sauna & steam room access">
                                <label for = "saunaSteamRoomAccess">Sauna & steam room access</label><br>

                                <input type = "checkbox" name = "features[]" id = "personalTrainers" value = "personal trainers">
                                <label for = "personalTrainers">Personal trainers</label><br>
                            </section>
                            
                            <section>
                                <input type = "checkbox" name = "features[]" id = "trainingSessions" value = "personal training sessions">
                                <label for = "trainingSessions">Personal training sessions</label><br>

                                <input type = "checkbox" name = "features[]" id = "guestPasses" value = "guest passes">
                                <label for = "guestPasses">Guest passes</label><br>

                                <input type = "checkbox" name = "features[]" id = "discountedMerchandise" value = "discounted merchandise">
                                <label for = "discountedMerchandise">KKQ discounted merchandise</label><br>

                                <input type = "checkbox" name = "features[]" id = "nutritionalCoachingFeature" value = "nutritional coaching">
                                <label for = "nutritionalCoachingFeature">Nutritional coaching</label><br>

                                <input type = "checkbox" name = "features[]" id = "bodyCompositionAnalysis" value = "body composition analysis">
                                <label for = "bodyCompositionAnalysis">Body composition analysis</label><br>
                            </section>
                        </section>
                    </p>
                    <p><label for = "enquiryDesc">Enquiry description</label><br/>
                        <textarea name = "enquiryDesc" rows = "6" cols = "80" placeholder="Describe your product enquiry" required id = "enquiryDesc"></textarea>
                    </p>
                </fieldset>
            </section>

            <section id = "orderSect">
                <fieldset id = "orderFieldset">
                    <legend>Order</legend>
                    <label for = "productToBuy">Product</label><br>
                    <select name = "product" id = "productToBuy" required>
                        <option value = "">Please Select</option>
                        <option value = "Basic">Basic (RM 120/mth)</option>
                        <option value = "Premium">Premium (RM 200/mth)</option>
                        <option value = "Elite">Elite (RM 280/mth)</option>
                    </select>
                    <p id = "quantity">
                        <label for = "qty">Quantity</label>
                        <input type = "text" name = "qty" id = "qty" placeholder = "1" required>
                    </p>
                    <section id = "productFeaturesSect">
                        
                    </section>
                </fieldset>
            </section>

            <section id = "submitContainer"> 
                <input type = "submit" value = "Pay Now" id = "submit">
            </section>
        </form>
    </article>
    <br>
<?php
    include "includes/footer.inc";
?>
</body>
</html>