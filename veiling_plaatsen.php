<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.html'; ?>
    <link rel="stylesheet" href="CSS/veiling-maken.css" type="text/css">
</head>
<body>

<?php

require "includes/header.php";
global $pdo;

if (isset($_SESSION['username']) == 0) {

    echo '<div class="notloggedin"><br><h1>Verkoper worden</h1>
                <p>Om een verkoper te worden moet je eerst een account aanmaken, lees hierover meer op onze 
                <a href="hulp.php">hulp</a> pagina.</p><br></div>';

} else {

    $username = $_SESSION['username'];

    $userQuery = $pdo->prepare('select * from TBL_User WHERE [user] = ?');
    $userQuery->execute(array($username));
    $userData = $userQuery->fetch();

    $errMessage=sendSellerVerification($username);
    $errMessage2=checkSellerVerification($username);

    if ($_SESSION['is_seller'] == 1) {

        echo '<main>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10 my-2 ml-2 mr-1 make-auction">
            <div class="row m-3">
                <h1>Nieuwe veiling</h1>
            </div>
            <div class=" mb-2 text-danger">';
        echo createAuction();
        global $auctionCreated;
        echo '</div>
            <div class="dropdown-divider"></div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row m-3">
                    <div class="col-lg-3">
                        <div class="form-label-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="titel" ' . (!$auctionCreated && isset($_POST['name']) ? 'value=\'' . cleanUpUserInput($_POST['name']) . '\'' : "") . '>
                            <label for="name">Titel</label>
                        </div>
                        <div class="form-label-group">
                            <input type="number" class="form-control" name="price_start" id="price_start"
                                   placeholder="prijsStart"' . (!$auctionCreated && isset($_POST['price_start']) ? 'value=\'' . cleanUpUserInput($_POST['price_start']) . '\'' : "") . '>
                            <label for="price_start">Start prijs</label>
                        </div>
                        <div class="form-group">
                            <label class="d-none" for="location">Locatie</label>
                            <input class="form-control mb-3" type="text" name="location" id="location"
                                   placeholder="Locatie" ' . (!$auctionCreated && isset($_POST['location']) ? 'value=\'' . cleanUpUserInput($_POST['location']) . '\'' : "") . '>
                            <script>
                                var placesAutocomplete = places({
                                    appId: \'plK904BLG7JJ\',
                                    apiKey: \'551154e9c4e6dfefd99359b532faaa99\',
                                    container: document.querySelector(\'#location\')
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <label class="d-none" for="shipping_instructions"></label>
                            <select onchange="
                            if(this.value === \'Verzenden\'){
                            document.getElementById(\'shipping_cost\').parentNode.classList.remove(\'d-none\');
                            } else {
                            document.getElementById(\'shipping_cost\').parentNode.classList.add(\'d-none\');
                            }

                            " class="form-control" name="shipping_instructions" id="shipping_instructions" >
                                <option value="" disabled selected hidden>Verzendmethode</option>
                                <option value="Ophalen">Ophalen</option>
                                <option value="Verzenden">Verzenden</option>

                            </select>
                        </div>
                        <div class="form-label-group d-none">
                            <input type="number" class="form-control" name="shipping_cost" id="shipping_cost"
                                   placeholder="verzendkosten" ' . (!$auctionCreated && isset($_POST['shipping_cost']) ? 'value=\'' . cleanUpUserInput($_POST['shipping_cost']) . '\'' : "") . '>
                            <label for="shipping_cost">Verzendkosten</label>
                        </div>
                                                   ' . (!$auctionCreated && isset($_POST['shipping_instructions']) ? "<script>document.getElementById('shipping_instructions').value = '" . cleanUpUserInput($_POST['shipping_instructions']) . "'; document.getElementById('shipping_cost').parentNode.classList.remove('d-none');</script>" : "") . '

                        <div class="form-group">
                            <select class="form-control" name="duration" id="duration">
                                <option>Looptijd</option>
                                <option value="1">1 dag</option>
                                <option value="3">3 dagen</option>
                                <option value="5">5 dagen</option>
                                <option value="7">7 dagen</option>
                                <option value="10">10 dagen</option>
                            </select>
                            <label class="d-none" for="duration"></label>
                            ' . (!$auctionCreated && isset($_POST['duration']) ? "<script>document.getElementById('duration').value = " . cleanUpUserInput($_POST['duration']) . ";</script>" : "") . '
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <div>
                        <div class="form-group">
                            <label class="d-none" for="rubriek"></label>
                            <select class="form-control" name="rubriek" id="rubriek" onchange="showRubric(this.value, this)">
                                <option selected disabled value="">Rubriek</option>';

        $mainRubricQuery = $pdo->prepare("select DISTINCT rubric,[name] from TBL_Rubric WHERE super=-1 AND phased_out != 1");
        $mainRubricQuery->execute();
        $mainRubric = $mainRubricQuery->fetchAll();

        foreach ($mainRubric as $result) {
            echo $result["name"];
            echo '<option value="' . (int)$result["rubric"] . '" >' . $result["name"] . ' </option>';
        }
        echo '

                            </select>

                        </div>
                            <div></div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Beschrijving</span>
                            </div>
                            <label class="d-none" for="description"></label>
                            <textarea class="form-control" name="description" id="description" >' . (!$auctionCreated && isset($_POST['description']) ? cleanUpUserInput($_POST['description']) : "") . '</textarea>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <label for="is_promoted"></label>
                                    <input id="is_promoted" name="is_promoted" type="checkbox">
                                </div>
                            </div>
                            <input class="form-control" aria-label="With textarea"
                                   placeholder="Wilt u deze veiling promoten?" readonly>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image"
                                           aria-describedby="image">Kies bestand</label>
                                </div>
                            </div>
                            <img id="img-upload" alt="uw afbeelding"/>
                        </div>
                    </div>
                </div>
                <div class="row m-4 btn-makeauction">
                    <input class="btn" type="submit" value="Maak veiling aan" name="createAuction">
                </div>
            </form>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

</main>';

    } else {

        $html = '<main>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10 my-2 ml-2 mr-1 make-auction">
            <div class="row m-3">
                <h1>Verkoper worden</h1>
            </div>
            <div class=" mb-2 text-danger"><?php createAuction(); ?></div>
            <div class="dropdown-divider"></div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row m-3">
                    <div class="col-lg-3">
                        <div class="form-label-group">';

        if (canSendNewCode($username)) {

            $html .= '<p>Vul hieronder jouw IBAN in om een verificatiecode te onvangen.</p>
<p>Lees meer over het worden van een verkoper op de <a href="hulp.php" target="_blank">hulp</a> pagina.</p>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" name="bankNumber" id="price_start">
                            <label for="price_start">IBAN</label>
                            </div>'. $errMessage .'</div></div>
                <div class="row m-4 btn-makeauction">
                    <input class="btn" type="submit" value="Verzend code" name="sendVerification">';


        } else {

            $html .= '<p>Vul hieronder uw verificatiecode in:</p>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" name="vericode" id="price_start"
                                   placeholder="Verificatiecode">
                            <label for="price_start">Verificatiecode</label>
                            ' . $errMessage2 . '
                            </div></div></div>
                <div class="row m-4 btn-makeauction">
                    <input class="btn" type="submit" value="Check code" name="submitVerification">';
        }

        $html .= '</div>
            </form>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

</main>';

        echo $html;

    }
}

include_once "includes/footer.php";

?>

<script>
    function showRubric(str, element) {
        var xhttp;
        if (str === "") {
            document.getElementById("txt").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                if (this.responseText) {
                    element.parentNode.parentNode.lastElementChild.innerHTML = this.responseText;
                }
            }
        };
        xhttp.open("GET", "AJAX/rubric_dropdown.php?super=" + str, true);
        xhttp.send();
    }
</script>

</body>
</html>