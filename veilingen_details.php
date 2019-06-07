<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'includes/head.html';
    ?>
    <link rel="stylesheet" href="CSS/veilingen-details.css" type="text/css">
</head>
<body>
<?php
require "includes/header.php";
?>
<main>
    <?php

    if (isset($_GET['auction'])) {

        global $pdo;

        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        $auctionquery = $pdo->prepare("SELECT * FROM TBL_Auction WHERE auction = ?");
        $auctionid = $_GET['auction'];
        $auctionquery->execute(array($auctionid));
        $auctiondata = $auctionquery->fetch();

        if ($auctiondata['is_closed'] == 1) {
            $auctionstatus = "Gesloten";
        } elseif ($auctiondata['is_closed'] == 2) {
            $auctionstatus = "Geblokkeerd";
        } else {
            $auctionstatus = "Open";
        }
        $startdate = $auctiondata['moment_start'];
        $enddate = $auctiondata['moment_end'];
        $item = $auctiondata['item'];
        $seller = $auctiondata['seller'];

        $isBlockedQuery = $pdo->prepare("SELECT * FROM TBL_Auction WHERE user = ?");
        $isBlockedQuery->execute(array($seller));
        $isBlockedData = $isBlockedQuery->fetch();
        $isBlocked = (int)$isBlockedData['is_blocked'];

        if($isBlocked == 1) {
            $isBlocked = "Geblokkeerd";
        } else {
            $isBlocked = "Geverifieerd";
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


        $bidquery = $pdo->prepare("SELECT top 5 * FROM TBL_Bid, TBL_User WHERE auction = 98032 AND TBL_Bid.[user] 
= TBL_User.[user] AND TBL_User.is_blocked = 0 order by amount DESC");
        $bidquery->execute(array($auctionid));
        $biddata = $bidquery->fetchAll();


        if (isset($_POST['bidbutton'])) {
            $newPrice = $_POST['bidbutton'];
            placeNewBid($auctionid, $newPrice, $username);
            $bidquery->execute(array($auctionid));
        }

        $highestBidQuery = $pdo->prepare("SELECT top 1 amount FROM TBL_Bid WHERE auction = ? and [user] is not null order by amount DESC");
        $highestBidQuery->execute(array($auctionid));
        $highestBidData = $highestBidQuery->fetchAll();

        if (sizeof($highestBidData) == null) {
            $itemprice = $itempricestart;
        } else {
            $itemprice = (float)$highestBidData[0][0];
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


        blockAuction($auctionid);

        $emailQuery = $pdo->prepare("SELECT * FROM TBL_User WHERE [user] = ?");
        $emailQuery->execute(array($seller));
        $emailSeller = $emailQuery->fetch()['email'];

        echo "
    <div class=\"row\"> 
        <div class=\"col-lg-2\">
        </div>
        <div class=\"col-lg-8 text-dark details-auction my-2 mx-3\">
            <div class=\"row my-3\">
                <div class=\"col-lg-9\">
                    <h2>$itemtitle</h2>
                </div>
                <div class=\"col-lg-3\">
                    <h1 class='\price\'>€" . ($itemprice > $itempricestart ? $itemprice : $itempricestart) . "</h1>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-lg-4 imageContainer\">    
                    <img class=\"picture mx-auto\" src=\"data:image/png;base64," . base64_encode($imagedata) . "\" alt=\"Afbeelding van veiling\">
                </div>
                <div class=\"col-line\"></div>
                <div class=\"col-lg-4\">
                    <h3>Productdetails</h3>
                    <table class='table table-striped'>
                        <tbody>
                            <tr>
                                <th scope='row'> Locatie van product</th>
                                <td class='text-break'> $itemaddress</td>
                            </tr>
                            <tr>
                                <th scope='row'>verzendkosten </th>
                                <td> $itemshippingcost</td>
                            </tr>
                            <tr>
                                <th scope='row'> verzendmethode</th>
                                <td> $itemshippingmethod</td>
                            </tr>
                        </tbody>                       
                    </table>
                </div>
                <div class=\"col-line\"></div>
                <div class=\"col-lg\">
                    <h3>Verkoperdetails</h3>
                    <table class=\"table table-striped\">
                        <tr>
                            <th scope='row'>Naam verkoper</th>
                            <td> $seller</td>
                        </tr>
                        <tr>
                            <th scope='row'>Status verkoper</th>
                            <td> " . $isBlocked . " </td>
                        </tr>  
                    </table>
                    <a href=\"mailto:$emailSeller \" target=\"_top\" class=\" btn button - left\">Mail verkoper</a>
                </div>
            <div class=\"dropdown-divider\"></div>  
                <div class=\"col-lg mt-2\">
                        <h3>Veilingdetails</h3>
                        <table class='table table-striped'>
                            <tr>
                                <th> status van veiling</th>
                                <td> $auctionstatus</td>
                            </tr>
                            <tr>
                                <th> veiling sluit over</th>
                                <td id=\"timer\"></td>
                            </tr>
                            <tr>
                                <th>Startdatum</th>
                                <td>$startdate</td>
                            </tr>
                            <tr>    
                                <th>Sluitdatum</th>
                                <td>$enddate</td>
                            </tr>
                            <tr>    
                                <th>Minimale prijs</th>
                                <td>€$itempricestart</td>
                            </tr>
                        </table>
                                <!-- Display the countdown timer in an element -->
                                <script>
                                    // Set the date we're counting down to
                                    var countDownDate = new Date(\"$enddate\").getTime();
                                    
                                    // Update the count down every 1 second
                                    var x = setInterval(function() {
                                    
                                      // Get today's date and time
                                      var now = new Date().getTime();
                                    
                                      // Find the distance between now and the count down date
                                      var distance = countDownDate - now;
                                    
                                      // Time calculations for days, hours, minutes and seconds
                                      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    
                                      // Display the result in the element with id=\"demo\"
                                      document.getElementById(\"timer\").innerHTML = days + \"d \" + hours + \"h \"
                                      + minutes + \"m \" + seconds + \"s \";
                                    
                                      // If the count down is finished, write some text 
                                      if (distance < 0) {
                                        clearInterval(x);
                                        document.getElementById(\"timer\").innerHTML = \"Gesloten\";
                                      }
                                    }, 1000);
                                    </script>
</form>";


        echo "</div>
                </div>
                <div class=\"col-line\"></div>
                <div class=\"col-lg\">
                    <div class=\"description\">
                        <h3>Beschrijving:</h3>
                        <p>$itemdescription</p>
                    </div>
                </div>
                <div class=\"col-line\"></div>
                <div class=\"col-lg\">
                    <div class=\"bid mb-2\">
                        <h3>Bieden</h3>";

        if ($auctiondata['is_closed'] == 2) {
            echo '<p style="color:red">Deze veiling is geblokkeerd, bieden is daarom niet mogelijk.</p>';
        } else {

            if (isset($_SESSION['username'])) {
                echo "
                                                <p id='bidtext' class=\"font-weight-bold\">Mijn bod wordt:</p>
                                                <form id='bidform' method=\"post\" class=\"form-inline button-left\">
                                                    <button name=\"bidbutton\" type=\"submit\" class=\"btn\" value=\"" . ($buttonvalue + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . "\">€" . ($buttonvalue + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . "</button>
                                                    <div class=\"space\"></div>
                                                    <button name=\"bidbutton\" type=\"submit\" class=\"btn\" value=\"" . ($buttonvalue * 2 + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . "\">€" . ($buttonvalue * 2 + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . "</button>
                                                    <div class=\"space\"></div>
                                                    <button name=\"bidbutton\" type=\"submit\" class=\"btn\" value=\"" . ($buttonvalue * 3 + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . "\">€" . ($buttonvalue * 3 + ($itemprice > $itempricestart ? $itemprice : $itempricestart)) . "</button>
                                                </form>
                                                <div class=\"my-3\">
                                                    <p class=\"font-weight-bold\">Eerdere biedingen:</p>";
            } else {
                echo '<p style="color:red">Je moet ingelogd zijn om te kunnen bieden.</p>';
            }

        }


        $html = "";


        $bidquery->execute(array($auctionid));
        echo '<table class="table table-striped">';
        while ($bid = $bidquery->fetch()) {
            if ($bid['user'] == null) {
                echo '<tr><th class="text-danger">verwijderd</th><td>€' . $bid['amount'] . '</td></tr>';
            } else {
                echo '<tr><th>' . $bid['user'] . '</th><td>€' . $bid['amount'] . '</td></tr>';
            }
        }
        echo '</table>';
        if (sizeof($_SESSION) > 0) {
            if ($_SESSION['is_admin'] == 1 && $auctiondata['is_closed'] == 0) {

                echo "<form method='POST'>
            <br><button name='blockAuction' type='submit' class='btn btn-block'>Blokkeer veiling</button>
";
            }
        }
        echo $html . '</div>' . '
                   
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <!---->
        </div>
    </div>';


    }

    ?>

</main>
<?php
include_once "includes/footer.php";
?>
</body>
</html>
