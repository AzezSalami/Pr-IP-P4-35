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
global $pdo;

if (isset($_POST['sendVerification'])) {

    $username = $_SESSION['username'];

    $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$()*';
    $token = str_shuffle($token);
    $token = substr($token, 0, 10);

    $verificationQuery = $pdo->prepare('UPDATE TBL_User SET verification_code = ? WHERE [user] = ?');
    $verificationQuery->execute(array($token, $username));

    //send verificationcode to submitted email

}

if (isset($_POST['submitVerification'])) {

    $username = $_SESSION['username'];
    $submittedCode = $_POST['vericode'];

    $checkCodeQuery = $pdo->prepare('SELECT * FROM TBL_User WHERE [user] = ?');
    $checkCodeQuery->execute(array($username));
    $checkCodeData = $checkCodeQuery->fetch();
    $verificationCode = $checkCodeData['verification_code'];

    if($submittedCode == $verificationCode) {

        $setSellerQuery = $pdo->prepare('UPDATE TBL_User SET is_seller = 1 WHERE [user] = ?');
        $setSellerQuery->execute(array($username));

    } else {
        //foutmelding
    }

}

if (sizeof($_SESSION) == 0) {

    echo 'faka neef doe ff inloggen anders kan je geen veiling plaatsen je weet toch broski';
    echo 'aka een guide on how to become seller yadig';

} else {

    $username = $_SESSION['username'];

    $userQuery = $pdo->prepare('select * from TBL_User WHERE [user] = ?');
    $userQuery->execute(array($username));
    $userData = $userQuery->fetch();
    $is_seller = $userData['is_seller'];

    if ($is_seller == 1) {

        echo '<main>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10 my-2 ml-2 mr-1 make-auction">
            <div class="row m-3">
                <h1>Nieuwe veiling</h1>
            </div>
            <div class=" mb-2 text-danger"><?php createAuction(); ?></div>
            <div class="dropdown-divider"></div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row m-3">
                    <div class="col-lg-3">
                        <div class="form-label-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="titel">
                            <label for="name">Titel</label>
                        </div>
                        <div class="form-label-group">
                            <input type="number" class="form-control" name="price_start" id="price_start"
                                   placeholder="prijsStart">
                            <label for="price_start">Start prijs</label>
                        </div>
                        <div class="form-group">
                            <label class="d-none" for="location">Locatie</label>
                            <input class="form-control mb-3" type="text" name="location" id="location"
                                   placeholder="Locatie">
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

                            " class="form-control" name="shipping_instructions" id="shipping_instructions">
                                <option value="Ophalen">Ophalen</option>
                                <option value="Verzenden">Verzenden</option>
                            </select>
                        </div>
                        <div class="form-label-group d-none">
                            <input type="number" class="form-control" name="shipping_cost" id="shipping_cost"
                                   placeholder="verzendkosten">
                            <label for="shipping_cost">Verzendkosten</label>
                        </div>
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
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <div class="form-group">
                            <label class="d-none" for="rubriek"></label>
                            <select class="form-control" name="rubriek" id="rubriek" onchange="showRubriek(this.value)">
                                <option selected disabled>Rubriek</option>
                                <?php
                                $mainRubricQuery = $pdo->prepare("select DISTINCT [name] from TBL_Rubric WHERE super=-1");
                                $mainRubricQuery->execute();
                                $mainRubric = $mainRubricQuery->fetchAll();

                                foreach ($mainRubric as $result) {
                                    echo $result[\'name\'];
                                    echo "<option value=\'" . $result[\'rubric\'] . "\'>" . $result[\'name\'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Beschrijving</span>
                            </div>
                            <label class="d-none" for="description"></label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox">
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
                            <img id=\'img-upload\'/>
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

        $verification_sent = strlen($userData['verification_code']);

        if ($verification_sent == 0) {

            echo '<main>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10 my-2 ml-2 mr-1 make-auction">
            <div class="row m-3">
                <h1>Wordt verkoper</h1>
            </div>
            <div class=" mb-2 text-danger"><?php createAuction(); ?></div>
            <div class="dropdown-divider"></div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row m-3">
                    <div class="col-lg-3">
                        <div class="form-label-group">
                            <p>joejoe kijk hier toelichting van deze pagina</p>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" name="email" id="price_start"
                                   value="' . $userData['email'] . '">
                            <label for="price_start">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row m-4 btn-makeauction">
                    <input class="btn" type="submit" value="Verzend code" name="sendVerification">
                </div>
            </form>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

</main>';
        } else {

            echo '<main>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10 my-2 ml-2 mr-1 make-auction">
            <div class="row m-3">
                <h1>Wordt verkoper</h1>
            </div>
            <div class=" mb-2 text-danger"><?php createAuction(); ?></div>
            <div class="dropdown-divider"></div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row m-3">
                    <div class="col-lg-3">
                        <div class="form-label-group">
                            <p>Vul hieronder uw verificatiecode in:</p>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" name="vericode" id="price_start"
                                   value="Verificatiecode">
                            <label for="price_start">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row m-4 btn-makeauction">
                    <input class="btn" type="submit" value="Verzend" name="submitVerification">
                </div>
            </form>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

</main>';

        }

    }
}

include_once "includes/footer.php";

?>

</body>
</html>