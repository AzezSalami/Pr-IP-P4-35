<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EenmaalAndermaal</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
          crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="JS/sidenavscript.js"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#FFAD4F">
    <meta name="msapplication-TileColor" content="#FFAD4F">
    <meta name="theme-color" content="#FFAD4F">
    <!-- Chrome, Firefox OS and Opera colored tabs-->
    <meta name="theme-color" content="#FFAD4F">

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#FFAD4F">

    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#FFAD4F">
    <meta name="apple-mobile-web-app-status-bar-style" content="#FFAD4F">
    <link rel="stylesheet" href="CSS/general.css" type="text/css">
    <link rel="stylesheet" href="CSS/overons.css" type="text/css">


</head>
<body>

<?php
require "includes/header.php";
?>

<main>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 aboutus-page">
            <div class="container">
                <div class="aboutus-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg">
                                <div class="aboutus">
                                    <h2 class="aboutus-title">Over ons</h2>
                                    <p class="aboutus-text">Eenmaal Andermaal is een veilingsite waar de gebruikers
                                        gebruikte
                                        producten kunnen veilen. De verkoper kan met de spullen die ze niet meer
                                        gebruiken een
                                        ander blij maken en zelf er iets aan verdienen.</p>
                                    <p class="aboutus-text">Ook kunnen de gebruikers bij Eenmaal Andermaal betrouwbaar,
                                        snel
                                        en makkelijk op producten bieden.</p>
                                    <a class="btn" href="contact.php">Stuur ons een bericht</a>
                                </div>
                            </div>
                            <div class="col-line">
                            </div>
                            <div class="col-lg">
                                <div class="feature">
                                    <div class="feature-box">
                                        <div class="clearfix">
                                            <div class="feature-content">
                                                <h4>Betrouwbaar</h4>
                                                <p>Kopers en verkopers kunnen elkaar na een koop of verkoop
                                                    beoordelen. Dit zorgt er voor dat een nieuwe koper of verkoper
                                                    snel kan zien of de andere gebruiker betrouwbaar is of niet</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature-box">
                                        <div class="clearfix">
                                            <div class="feature-content">
                                                <h4>Snel</h4>
                                                <p>Door Eenmaal Andermaal te gebruiker kan een gebruiker snel een
                                                    product verkopen. De gebruiker geeft zelf een periode aan waarin
                                                    andere gebruikers kunnen bieden. Na deze periode is de veiling
                                                    dan afgelopen.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature-box">
                                        <div class="clearfix">
                                            <div class="feature-content">
                                                <h4>Makkelijk</h4>
                                                <p>Eenmaal Andermaal is makkelijk in gebruik. De interface van de
                                                    website is simpel en de gebruiker kan bij problemen op de hulp
                                                    pagina terecht.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</main>
<?php
include_once "includes/footer.php";
?>
</body>
</html>