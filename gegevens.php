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
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.16.4"></script>
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

<main>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <h1 class="text-dark">Mijn gegevens</h1>
            <form class="text-dark" method="POST" name="reset">
                <div class="row">
                    <div class="col">
                        <label for="firstname">Voornaam</label>
                        <input class="form-control" placeholder="
                        <?php placeholderAccountData("firstname"); ?>" type="text"
                               name="firstname"
                               id="firstname" maxlength="20" required>
                    </div>
                    <div class="col">
                        <div class="row">
                            <label for="lastname">Achternaam</label>
                            <input class="form-control" placeholder="
                           <?php placeholderAccountData("lastname"); ?>" type="text"
                                   name="lastname"
                                   id="lastname"
                                   maxlength="20" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="dropdown-divider yellow"></div>
                <div class="row">
                    <div class="col">
                        <label for="reg_username">Gebruikersnaam</label>

                        <input class="form-control" placeholder="<?php placeholderAccountData("user"); ?>" type="text"
                               name="reg_username"
                               id="reg_username"
                               maxlength="20" readonly>

                        <label for="address" class="">Adres</label>
                        <input class="form-control mb-3" type="text" id="address1" placeholder="Adres"
                               name="address"
                               required>
                        <script>
                            var placesAutocomplete = places({
                                appId: 'plK904BLG7JJ',
                                apiKey: '551154e9c4e6dfefd99359b532faaa99',
                                container: document.querySelector('#address1')
                            });
                        </script>


                    </div>
                    <div class="col">
                        <div class="row">
                            <label for="email">Emailadres</label>

                            <input class="form-control" placeholder="<?php placeholderAccountData("email"); ?>"
                                   type="email"
                                   name="email" id="email" readonly>


                            <label for="telephone_number">Telefoonnummer</label>
                            <input class="form-control" placeholder="" type="tel"
                                   name="telephone_number" id="telephone_number" maxlength="10">

                        </div>
                    </div>
                </div>
                <br>
                <div class="dropdown-divider yellow"></div>
                <div class="row">
                    <div class="col">
                        <label for="cur_password">Huidige wachtwoord</label>
                        <input class="form-control" placeholder="" type="password"
                               name="cur_password"
                               id="cur_password"
                               maxlength="50" required>

                    </div>
                    <div class="col">
                        <div class="row">
                            <label for="reg_password">Wachtwoord</label>
                            <input class="form-control" placeholder="" type="password"
                                   name="reg_password"
                                   id="reg_password"
                                   maxlength="50" required>
                        </div>

                        <div class="row">
                            <label for="confirm_password">Bevestig wachtwoord</label>
                            <input class="form-control" placeholder="" type="password"
                                   name="confirm_password"
                                   id="confirm_password"
                                   maxlength="50" required>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col">
                        <input class="btn bg-lightblue" type="submit" name="make_account"
                               value="opslaan">
                    </div>
                    <div class="col">
                        <div class="row">
                            <input class="btn bg-lightblue" type="submit" name="delete_account"
                                   value="verwijder">
                        </div>
                    </div>
                </div>
                <br>
            </form>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

</main>

<?php
include_once "includes/footer.php";
?>
</body>
</html>

