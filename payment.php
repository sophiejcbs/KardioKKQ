<!-- Description: Submit payment data to process_order for validation -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF‐8"/>
    <meta name="description" content="Fitness Club Membership Payment"/>
    <meta name="keywords" content="payment, fitness, membership"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>Payment | Kardio Kings & Queens</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.png"> <!--https://www.flaticon.com/free-icons/muscle: Muscle icons created by Dragon Icons - Flaticon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <link href = "styles/style.css" rel = "stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 995px)" href="styles/responsive.css">
    
    <script src="scripts/payment.js"></script>
    <script src="scripts/enhancements.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>
<?php
    include "includes/header.inc";
?>
    <article>
        <form id = "paymentForm" method="post" action="process_order.php" novalidate>
            <section id = "timerSect">
                <p id = "timer"></p>
            </section>
            <br>
            <section class = "confirmOrderSect">
                <section class = "contactAddrSect">
                    <h1>Contact</h1>
                    <p class = "confirmLabel">Your Name</p><p id="payment_name"></p>
                    <p class = "confirmLabel">Your Email</p><p id="payment_email"></p>
                    <p class = "confirmLabel">Your Phone Number</p><p id="payment_phoneNumber"></p>
                    <p class = "confirmLabel">Your Preferred Contact</p><p id="payment_preferredContact"></p>
    
                    <input type = "hidden" name = "fname" id = "fname"/>
                    <input type = "hidden" name = "lname" id = "lname"/>
                    <input type = "hidden" name = "email" id = "email"/>
                    <input type = "hidden" name = "phoneNumber" id = "phoneNumber"/>

                    <input type = "hidden" name = "preferredContact" id = "preferredContact"/>
                    <input type = "hidden" name = "streetAddress" id = "streetAddress"/>
                    <input type = "hidden" name = "town" id = "town"/>
                    <input type = "hidden" name = "state" id = "state"/>
                    <input type = "hidden" name = "postCode" id = "postCode"/>
                </section>
                <section class = "orderSummarySect">
                    <h1>Order Summary</h1>
    
                    <!--Dynamically Displaying Product Features-->
                    <!--Basic Features-->
                    <p id="payment_product"></p>
                    <input type = "hidden" name = "product" id = "product"/>
                    <table>
                        <tr>
                            <td id = "label_cost">Total Price</td>
                            <td id = "payment_cost"></td>
                            <input type = "hidden" name = "cost" id = "cost"/>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td id="payment_qty"></td>
                            <input type = "hidden" name = "qty" id = "qty"/>
                        </tr>
                        <tr>
                            <td id = "label_membershipLength"></td>
                            <td id="payment_membershipLength"></td>
                            <input type = "hidden" name = "membershipLength" id = "membershipLength"/>
                        </tr>
                        <!--One basic feature-->
                        <tr>
                            <td id = "label_clubLoc"></td>
                            <td id = "payment_clubLoc"></td>
                            <input type = "hidden" name = "clubLoc" id = "clubLoc"/>
                        </tr>
                        <!--Basic Features-->
                        <tr>
                            <td id = "label_saunaSteamAccess"></td>
                            <td id = "payment_saunaSteamAccess"></td>
                            <input type = "hidden" name = "saunaSteamAccess" id = "saunaSteamAccess"/>
                        </tr>
                        <tr>
                            <td id = "label_grpClasses"></td>
                            <td id = "payment_grpClasses"></td>
                            <input type = "hidden" name = "grpClasses" id = "grpClasses"/>
                        </tr>
                        <!--Premium Features-->
                        <tr>
                            <td id = "label_personalTrainingPrem"></td>
                            <td id = "payment_personalTrainingPrem"></td>
                            <input type = "hidden" name = "personalTrainingPrem" id = "personalTrainingPrem"/>
                        </tr>
                        <tr>
                            <td id = "label_guestPassesPrem"></td>
                            <td id = "payment_guestPassesPrem"></td>
                            <input type = "hidden" name = "guestPassesPrem" id = "guestPassesPrem"/>
                        </tr>
                        <tr>
                            <td id = "label_merchandisePrem"></td>
                            <td id = "payment_merchandisePrem"></td>
                            <input type = "hidden" name = "merchandisePrem" id = "merchandisePrem"/>
                        </tr>
                        <tr>
                            <td id = "label_nutritionalCoaching"></td>
                            <td id = "payment_nutritionalCoaching"></td>
                            <input type = "hidden" name = "nutritionalCoaching" id = "nutritionalCoaching"/>
                        </tr>
                        <!--Elite Features-->
                        <tr>
                            <td id = "label_personalTrainingElite"></td>
                            <td id = "payment_personalTrainingElite"></td>
                            <input type = "hidden" name = "personalTrainingElite" id = "personalTrainingElite"/>
                        </tr>
                        <tr>
                            <td id = "label_guestPassesElite"></td>
                            <td id = "payment_guestPassesElite"></td>
                            <input type = "hidden" name = "guestPassesElite" id = "guestPassesElite"/>
                        </tr>
                        <tr>
                            <td id = "label_merchandiseElite"></td>
                            <td id = "payment_merchandiseElite"></td>
                            <input type = "hidden" name = "merchandiseElite" id = "merchandiseElite"/>
                        </tr>
                        <tr>
                            <td id = "label_bodyCompositionAnalysis"></td>
                            <td id = "payment_bodyCompositionAnalysis"></td>
                            <input type = "hidden" name = "bodyCompositionAnalysis" id = "bodyCompositionAnalysis"/>
                        </tr>
                    </table>
                </section>
            </section>
            <br><br>
            <section class = "confirmOrderSect">
                <section class = "contactAddrSect">
                    <h1>Address</h1>
                    <p class = "confirmLabel">Your Street Address</p><p id="payment_streetAddress"></p>
                    <p class = "confirmLabel">Your Suburb/Town</p><p id="payment_town"></p>
                    <p class = "confirmLabel">Your State</p><p id="payment_state"></p>
                    <p class = "confirmLabel">Your Postcode</p><p id="payment_postCode"></p>
                </section>
    
                <section class = "paymentSect">
                    <h1>Payment Details</h1>
                    <p id = "paymentLabel">Credit Card Type</p>
                    
                    <section id = "ccTypeSect">
                        <section>
                            <input type="radio" name="ccType" id="visa" value="Visa"></input> <!-- -->
                            <label for="visa" class = "ccType"><img class = "ccIcon" src = "images/visa.png" alt = "Visa Credit Card Icon"><p>Visa</p></label>
                        </section>
                        
                        <section>
                            <input type="radio" name="ccType" id="mastercard" value="Mastercard">
                            <label for="mastercard" class = "ccType"><img class = "ccIcon" src = "images/mastercard.png" alt = "Mastercard Card Icon"><p>Mastercard</p></label>
                        </section>
                        
                        <section>
                            <input type="radio" name="ccType" id="amex" value="American Express">
                            <label for="amex" class = "ccType"><img class = "ccIcon" src = "images/american-express.png" alt = "American Express Credit Card Icon"><p id = "amexOpt">American Express</p></label><br>
                        </section>
                    </section>
                    
                    <label for = "ccName">Name on Credit Card</label><br>
                    <input type = "text" name = "ccName" id = "ccName" placeholder="John Doe" pattern="[a-zA-Z ]{2,40}" required><br>
    
                    <label for = "ccNum">Credit Card Number</label><br>
                    <input type = "text" name = "ccNum" id = "ccNum" placeholder="1111222233334444" pattern="\d{15,16}" required><br>
    
                    <label for="expDate">Credit Card Expiry Date</label><br>
                    <input type="text" id="expDate" name="expDate" placeholder="MM-YY" pattern="\d{2}-\d{2}" required><br>
    
                    <label for = "cvv">Card Verification Value (CVV)</label><br>
                    <input type = "text" name = "cvv" id = "cvv" placeholder="123" pattern="\d{3,4}" required><br>
                </section>
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
?>
</body>
</html>