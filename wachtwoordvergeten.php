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
    <link rel="stylesheet" href="CSS/homepage.css" type="text/css">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="JS/pricerange.js"></script>
</head>
<body class="bg-gray">

<?php
require "includes/header.php";
?>

<main style="height: 100%">
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="text-dark">
                <h1>Wachtwoord vergeten</h1>
                <p>Weet je het wachtwoord niet meer?
                    Vul hieronder je e-mailadres in.
                    We sturen dan binnen enkele minuten een e-mail waarmee een nieuw wachtwoord kan worden
                    aangemaakt.</p>
            </div>
            <form>
                <div class="form-group">
                    <label class="text-dark font-weight-bold" for="exampleInputEmail1">E-mail adres:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="vul uw e-mail in">
                </div>
                <button type="submit" class="btn bg-lightblue">Versturen</button>
            </form>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

</main>
<div class="fixed-bottom">
    <?php
    include_once "includes/footer.php";
    ?>
</div>
</body>
</html>