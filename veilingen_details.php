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
    <link rel="stylesheet" href="CSS/veilingen-details.css" type="text/css">

</head>
<body>

<?php
require "includes/header.php";
?>

<main>
    <div class="row">
        <div class="col-lg-2">
            <!---->
        </div>
        <div class="col-lg-8 text-dark">
            <div class="row my-3">
                <div class="col">
                    <h1 class="text-left font-weight-bold">[titel van veiling]</h1>
                </div>
                <div class="col">
                    <h1 class="text-right font-weight-bold">[prijs]</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="row foto">
                        <div class="col">

                            <div class="imageContainer row text-center">
                                <div><img class="img-fluid" src="images/android-chrome-192x192.png"
                                          alt="veiling foto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col details-product">
                            <h3>details product</h3>
                            <p>qwerty</p>
                            <p>qwerty</p>
                            <p>qwerty</p>
                            <p>qwerty</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col details-veiling">
                            <h3>details veiling</h3>
                            <p>qwerty</p>
                            <p>qwerty</p>
                            <p>qwerty</p>
                            <p>qwerty</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col details-product">
                            <h3>Beschrijving:</h3>
                            <p>qwerty</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col details-gebruiker">
                            <h3>details verkoper</h3>
                            <p>naam:</p>
                            <p>etc:</p>
                            <p>etc:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3>Bieden</h3>
                            <p class="font-weight-bold">Verhoog bod met:</p>
                            <form method="post" class="form-inline">
                                <button type="button" class="btn btn-bod">5</button>
                                <div class="space"></div>
                                <button type="button" class="btn btn-bod">10</button>
                                <div class="space"></div>
                                <button type="button" class="btn btn-bod">15</button>
                            </form>
                            <div class="my-3">
                                <p class="font-weight-bold">Hoogste bod:</p>
                                <p class="bod">Jan Piet: $123</p>
                                <p class="bod">Margo Hendriks: $123</p>
                                <p class="bod">Willem Brak: $123</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <!---->
        </div>
    </div>

</main>
<?php
include_once "includes/footer.php";
?>
</body>
</html>