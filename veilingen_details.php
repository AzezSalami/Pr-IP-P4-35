<?php

if (isset($_GET['auction'])) {

echo '<!DOCTYPE html>
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
<body>';

require "includes/header.php";

    global $pdo;
    $auctionquery = $pdo->prepare("SELECT * FROM TBL_Auction WHERE auction = ?");
    $auctionid = $_GET['auction'];
    $auctionquery->execute(array($auctionid));
    $auctiondata = $auctionquery->fetch();

    /* all sellers are null atm, hence why sellerinfo will be empty for now */

    if ($auctiondata['is_closed'] == 1) {
        $auctionstatus = "Gesloten";
    } else {
        $auctionstatus = "Open";
    }
    $startdate = $auctiondata['moment_start'];
    $enddate = $auctiondata['moment_end'];
    $item = $auctiondata['item'];
    $seller = $auctiondata['seller'];

    $sellerQuery = $pdo->prepare("SELECT * FROM TBL_Seller WHERE user = ?");
    $sellerQuery->execute(array($seller));
    $sellerData = $sellerQuery->fetch();
    $bankNumber = $sellerData['bank_account'];
    $verificationStatus = (int)$sellerData['verification_status'];
    if ($verificationStatus == 1) {
        $verificationStatus = "Niet geverifieerd";
    } else {
        $verificationStatus = "Geverifieerd";
    }

    $itemquery = $pdo->prepare("SELECT * FROM TBL_Item WHERE item = ?");
    $itemquery->execute(array($item));
    $itemdata = $itemquery->fetch();
    $imageQuery = $pdo->prepare("SELECT [file] FROM TBL_Resource WHERE sort_number IN (SELECT min(sort_number) FROM TBL_Resource GROUP BY item) AND item = ?");
    $imageQuery->execute(array($itemdata['item']));
    $imagedata = $imageQuery->fetch()['file'];

    $itemtitle = $itemdata['name'];
    $itemdescription = $itemdata['description'];
    $itempricestart = $itemdata['price_start'];
    $itemaddress = $itemdata['address_line_1'];
    $itemshippingcost = $itemdata['shipping_cost'];
    $itemshippingmethod = $itemdata['shipping_instructions'];


    $bidquery = $pdo->prepare("SELECT top 5 * FROM TBL_Bid WHERE auction = ? order by amount DESC");
    $bidquery->execute(array($auctionid));
    $biddata = $bidquery->fetchAll();

    $highestBidQuery = $pdo->prepare("SELECT top 1 amount FROM TBL_Bid WHERE auction = ? and [user] is not null order by amount DESC");
    $highestBidQuery->execute(array($auctionid));
    $highestBidData = $highestBidQuery->fetchAll();

    if (sizeof($highestBidData) == null) {
        $itemprice = $itempricestart;
    } else {
        $itemprice = (int)$highestBidData[0][0];
    }

    if ($itemprice < 1) {
        $buttonvalue = 0.50;
    } else if ($itemprice <= 5) {
        $buttonvalue = 1;
    } else if ($itemprice <= 10) {
        $buttonvalue = 5;
    } else if ($itemprice <= 50) {
        $buttonvalue = 10;
    } else {
        $buttonvalue = 50;
    }

    if (isset($_POST['bidbutton'])) {
        $newPrice = $_POST['bidbutton'];
        $username = $_SESSION['username'];
        placeNewBid($auctionid, $newPrice, $username);
        $itemprice = $newPrice;
    }

    $emailQuery = $pdo->prepare("SELECT * FROM TBL_User WHERE [user] = ?");
    $emailQuery -> execute(array($seller));
    $emailSeller = $emailQuery->fetch()['email'];



    echo "<main>
    <div class=\"row\"> 
        <div class=\"col-lg-2\">
            <!---->
        </div>
        <div class=\"col-lg-8 text-dark veiling-details my-2 mx-3\">
            <div class=\"row my-3\">
                <div class=\"col-lg-9\">
                    <h2 class=\"text-left font-weight-bold\">$itemtitle</h2>
                </div>
                <div class=\"col-lg-3\">
                    <h1 class=\"text-right font-weight-bold\">€". ($itemprice > $itempricestart ? $itemprice : $itempricestart) . "</h1>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-lg-4 imageContainer\">    
                    <img class=\"foto mx-auto\" src=\"data:image/png;base64," . base64_encode($imagedata) . "\" alt=\"Afbeelding van veiling\">
                </div>
                <div class=\"col-line\"></div>
                <div class=\"col-lg-4 details-product\">
                    <h3>Productdetails</h3>
                    <p>Locatie van product: $itemaddress</p>
                    <p>Verzendkosten: $itemshippingcost</p>
                    <p>Verzendmethode: $itemshippingmethod</p>
                </div>
                <div class=\"col-line\"></div>
                <div class=\"col-lg details-gebruiker\">
                    <h3>Verkoperdetails</h3>
                    <p>Naam verkoper: $seller</p>
                    <p>Status verkoper: $verificationStatus</p>
                    <a href=\"mailto:$emailSeller \" target=\"_top\" class=\" btn \">Mail verkoper</a>
                </div>
            </div>
            <div class=\"dropdown-divider\"></div>  
            <div class=\"row mb-2\">
                <div class=\"col\">
                    <div class=\"details-veiling\">
                        <h3>Veilingdetails</h3>
                        <p>Status van veiling: $auctionstatus</p>
                        <p>Startdatum: $startdate</p>
                        <p>Sluitdatum: $enddate</p>
                        <p>Minimale prijs: €$itempricestart</p>            
                    </div>
                </div>
                <div class=\"col-line\"></div>
                <div class=\"col\">
                    <div class=\"beschrijving-product\">
                        <h3>Beschrijving:</h3>
                        <p>$itemdescription</p>
                    </div>
                </div>
                <div class=\"col-line\"></div>
                <div class=\"col\">
                    <div class=\"bieden mb-2\">
                        <h3>Bieden</h3>";
                        if (isset($_SESSION['username'])) {
                            echo '<p class="font-weight-bold">Mijn bod wordt:</p>
                                                <form method="post" class="form-inline">
                                                    <button name="bidbutton" type="submit" class="btn" value="' . ($buttonvalue + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . '">€' . ($buttonvalue + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . '</button>
                                                    <div class="space"></div>
                                                    <button name="bidbutton" type="submit" class="btn" value="' . ($buttonvalue * 2 + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . '">€' . ($buttonvalue * 2 + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . '</button>
                                                    <div class="space"></div>
                                                    <button name="bidbutton" type="submit" class="btn" value="' . ($buttonvalue * 3 + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . '">€' . ($buttonvalue * 3 + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . '</button>
                                                </form>
                                                <div class="my-3">
                                                    <p class="font-weight-bold">Eerdere biedingen:</p>';
                        } else {
                            echo '<p style="color: red">Je moet ingelogd zijn om te kunnen bieden.</p>';
                        }

                        $bidquery->execute(array($auctionid));

                        $html = "";

                        while ($bid = $bidquery->fetch()) {
                            if($bid['user'] == null) {
                                $html .= '<p class="bod">[Verwijderde gebruiker]: €' . $bid['amount'] . '</p>';
                            } else {
                                $html .= '<p class="bod">' . $bid['user'] . ': €' . $bid['amount'] . '</p>';
                            }
                        }

                        echo $html . '</div>' . '
                   
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <!---->
        </div>
</main>';

    include_once "includes/footer.php";

    echo '</body></html>';

}

?>