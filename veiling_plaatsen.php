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
    <link rel="stylesheet" href="CSS/veiling-maken.css" type="text/css">


    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="JS/veiling_maken.js"></script>
</head>
<body>

<?php
require "includes/header.php";

/* ik ga er hier vanuit dat user al een seller is, moet nog gecontroleerd worden in een nog niet gemaakte session variabele */
/* als user nog geen seller is moet hier een 'hoe wordt je seller' pagina komen */

if(isset($_POST['auctionSubmit'])) {
    global $pdo;
    $username = $_SESSION['username'];

    $auctionTitle = $_POST['auctionName'];
    $priceStart = $_POST['priceStart'];
    $auctionShippingCosts = $_POST['auctionShippingCosts'];
    $auctionShippingMethod = $_POST['auctionShippingMethod'];
    $auctionDuration = $_POST['auctionDuration'];
    $auctionRubric = $_POST['auctionRubric'];
    $auctionDescription = $_POST['auctionDescription'];
    $auctionImage = $_POST['auctionImage'];

    $newAuctionQuery = $pdo->prepare("INSERT INTO TBL_Auction (seller, moment_start, moment_end, is_promoted, is_blocked)");
    $newAuctionQuery->execute();

}

?>

<main>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10 my-2 ml-2 mr-1 veiling-maken">
            <div class="row m-3">
                <h1>Nieuwe veiling</h1>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row m-3">
                <div class="col-lg-3">
                    <form method="POST">
                        <div class="form-label-group">
                            <input type="text" class="form-control" id="Titel" placeholder="auctionName">
                            <label for="Titel">Titel</label>
                        </div>
                        <div class="form-label-group">
                            <input type="number" class="form-control" id="prijsStart" placeholder="priceStart">
                            <label for="prijsStart">Start prijs</label>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-3" type="text" id="locatie" placeholder="Locatie"
                                   name="auctionLocation">
                            <script>
                                var placesAutocomplete = places({
                                    appId: 'plK904BLG7JJ',
                                    apiKey: '551154e9c4e6dfefd99359b532faaa99',
                                    container: document.querySelector('#locatie')
                                });
                            </script>
                        </div>
                        <div class="form-label-group">
                            <input type="number" class="form-control" id="verzendkosten" placeholder="auctionShippingCosts">
                            <label for="verzendkosten">Verzendkosten</label>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="auctionShippingMethod">
                                <option>Ophalen</option>
                                <option>Verzenden</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="auctionDuration">
                                <option>Looptijd</option>
                                <option>1 dag</option>
                                <option>3 dagen</option>
                                <option>5 dagen</option>
                                <option>7 dagen</option>
                                <option>10 dagen</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4 mb-3">
                    <form>
                        <div class="form-group">
                            <select class="form-control" name="auctionRubric">
                                <option>Rubriek</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Beschrijving</span>
                            </div>
                            <textarea class="form-control" aria-label="With textarea" name="auctionDescription"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imgInp" name="auctionImage">
                                <label class="custom-file-label" for="imgInp"
                                       aria-describedby="imgInp">Kies bestand</label>
                            </div>
                        </div>
                        <img id='img-upload'/>
                    </div>
                </div>
            </div>
            <div class="row m-4 btn-maakveiling">
                <input class="btn" type="submit" value="Maak veiling aan" name="auctionSubmit">
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

</main>

<?php
include_once "includes/footer.php";
?>

</body>
</html>