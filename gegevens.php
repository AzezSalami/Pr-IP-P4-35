
<!--/*-->
<!--N. Eenink, A. Salami, I. Hamoudi-->
<!--M. Vermeulen, D. Haverkamp & J. van Vugt-->
<!--HAN ICA HBO ICT - IProject, 13-06-2019-->
<!--*/-->

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.html'; ?>
</head>
<body>

<?php
require "includes/header.php";
if(!isset($_SESSION['username'])){
    echo '<script>window.location.replace("index.php");</script>';
}
?>

<main>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 data-form mobile-spacing">
            <h1 class="text-dark">Mijn gegevens</h1>
            <?php
            deleteAccount();
            ?>
            <div class="row my-4">
                <div class="col text-danger"><?php updateAccountData(); ?></div>
            </div>
            <form class="text-dark" method="POST" name="reset">
                <div class="row">
                    <div class="col">
                        <label for="firstname">Voornaam</label>
                        <input class="form-control" placeholder="<?php placeholderAccountData("firstname"); ?>"
                               type="text"
                               name="firstname"
                               id="firstname" maxlength="20">
                    </div>
                    <div class="col">
                        <div class="row">
                            <label for="lastname">Achternaam</label>
                            <input class="form-control" placeholder="<?php placeholderAccountData("lastname"); ?>"
                                   type="text"
                                   name="lastname"
                                   id="lastname"
                                   maxlength="20">
                        </div>
                    </div>
                </div>
                <br>
                <div class="dropdown-divider yellow"></div>
                <div class="row">
                    <div class="col">
                        <label for="reg_username">Gebruikersnaam</label>

                        <input class="form-control mb-4" placeholder="<?php placeholderAccountData("user"); ?>"
                               type="text"
                               name="reg_username"
                               id="reg_username"
                               maxlength="20" readonly>

                        <label for="address">Adres</label>
                        <input class="form-control mb-3" type="text" id="address1" placeholder="<?php placeholderAccountData("address_line_1") ?>"
                               name="address">
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

                            <input class="form-control mb-4" placeholder="<?php placeholderAccountData("email"); ?>"
                                   type="email"
                                   name="email" id="email" readonly>


                            <label for="telephone_number">Telefoonnummer</label>
                            <input class="form-control" placeholder="<?php placeholderAccountData("phone_number"); ?>"
                                   type="text"
                                   name="telephone_number" id="telephone_number" pattern="(([\+]\d{2})|(0{2}\d{2})|(0)){1}\d{9}">

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
                               maxlength="50">

                    </div>
                    <div class="col">
                        <div class="row">
                            <label for="reset_password">Wachtwoord</label>
                            <input class="form-control" placeholder="" type="password"
                                   name="reset_password"
                                   id="reset_password"
                                   maxlength="50">
                        </div>

                        <div class="row">
                            <label for="resconfirm_password">Bevestig wachtwoord</label>
                            <input class="form-control" placeholder="" type="password"
                                   name="resconfirm_password"
                                   id="resconfirm_password"
                                   maxlength="50">
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col">
                        <a href="" data-target="#removeMenu" data-toggle="modal">Account verwijderen?</a>
                    </div>
                    <div class="col">
                        <div class="row">
                            <input class="btn" type="submit" name="reset"
                                   value="Opslaan">
                        </div>
                    </div>
                </div>
                <br>
            </form>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="removeMenu">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark">Account verwijderen</h4>
                    <button id="loginCloseButton" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">

                        <form class="form-signin" method="POST" name="remove">
                            <div class="row">
                                <div class="col">
                                    <p class="text-dark">Vul hier je wachtwoord nogmaals in om je account permanent te
                                        verwijderen.</p></div>
                            </div>
                            <div class="form-label-group">
                                <form method="post" action="">
                                    <input class="form-control" placeholder="Wachtwoord" type="password"
                                           name="removePassword"
                                           id="removePassword"
                                           maxlength="50" required>
                                    <label for="removePassword">Wachtwoord</label>
                            </div>

                            <div class="form-label-group">
                                <label class="invisible" for="bevestig_wachtwoord">Bevestig wachtwoord</label>
                                <input class="form-control" placeholder="Bevestig wachtwoord" type="password"
                                       name="remconfirm_password"
                                       id="remconfirm_password"
                                       maxlength="50" required><br>
                                <label for="remconfirm_password">Bevestig wachtwoord</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input class="btn bg-lightblue" type="submit" name="deleteaccountsubmit"
                                           value="Verwijder account">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once "includes/footer.php";
?>
</body>
</html>


