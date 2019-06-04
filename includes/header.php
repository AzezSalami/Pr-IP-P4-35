<?php
require_once "functions.php";
login();
?>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.16.4"></script>
<header>
    <span class="sidenavhamburger mr-2" onclick="openNav()">&#9776;</span>
    <div class="container-fluid bg-orange py-2">
        <div class="row">
            <div class="col-lg-2">
                <a href="index.php">
                    <img src="images/logo.png" class="logo my-1 mx-auto d-block" alt="logo">
                </a>
            </div>
            <form action="veilingen.php" method="get" class="col-10 col-lg-8 d-flex align-items-center mb-1 px-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Zoeken"
                           name="search" <?php echo(isset($_GET['search']) ? "value='" . $_GET['search'] . "'" : "") ?>>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary bg-white" type="submit" id="searchbutton"><i
                                    class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
	            <input type='hidden' id="rubricFilter" name='rubric'
                    <?php
                        if (isset($_GET['rubric']) && ($rubric = cleanUpUserInput($_GET['rubric'])) != "") {
                            echo " value='$rubric'";
                        }
                    ?>
	            >
	            <input type='hidden' id="minPrice" name='minPrice'
                    <?php
                        if (isset($_GET['minPrice']) && ($minPrice = cleanUpUserInput($_GET['minPrice'])) != "" && is_numeric($minPrice) && ((float)$minPrice)>=0) {
                            echo " value='$minPrice'";
                        }
                    ?>
	            >
	            <input type='hidden' id="maxPrice" name='maxPrice'
                    <?php
                        if (isset($_GET['maxPrice']) && ($maxPrice = cleanUpUserInput($_GET['maxPrice'])) != "" && is_numeric($maxPrice) && ((float)$maxPrice)>=0) {
                            echo " value='$maxPrice'";
                        }
                    ?>
	            >
	            <input type='hidden' id="pageNumber" name='page' value='0'>
            </form>
            <div class="col-2 my-auto text-center">
                <?php
                if (isset($_SESSION) && array_key_exists("username", $_SESSION)) {
                    if (!empty($_SESSION["username"])) {
                        echo '
                    <div class="accountdropdownmobile">
                        <div class="dropdown dropleft">
                            <button class="btn btn-account bg-lightblue dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </button>
                            <div class="dropdown-menu bg-lightblue">
                                <a class="dropdown-item" href="gegevens.php">Mijn gegevens</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="veiling_plaatsen.php">Nieuwe veiling</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?logout=true">Uitloggen</a>
                            </div>
                        </div>
                    </div>
                    <div class="accountdropdowndesktop">
                        <div class="dropdown">
                            <button class="btn btn-account bg-lightblue dropdown overflow-hidden" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user "></i> &nbsp;' . (isset($_SESSION["username"]) ? $_SESSION["username"] : "account") . '
                            </button>
                            
                            <div class="dropdown-menu bg-lightblue">
                                <a class="dropdown-item" href="gegevens.php">Mijn gegevens</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="veiling_plaatsen.php">Nieuwe veiling</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?logout=true">Uitloggen</a>
                            </div>
                        </div>
                    </div> 
                    ';
                    }
                } else {
                    echo '
                    <div class="accountdropdownmobile">
                       <div class="dropdown dropleft ">
                            <button class="btn btn-account bg-lightblue dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </button>
                            
                            <div class="dropdown-menu bg-lightblue">
                                <a id="openLogin" class="dropdown-item" href="#" data-toggle="modal" data-target="#loginMenu">Inloggen</a>
                                <a id="openRegister" class="dropdown-item" href="#" data-toggle="modal" data-target="#registerMenu">Registreren</a>
                            </div>
                        </div>
                    </div>
                    <div class="accountdropdowndesktop">
                        <div class="dropdown">
                            <button class="btn btn-account bg-lightblue dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> &nbsp; Aanmelden
                            </button>
                            
                            <div class="dropdown-menu bg-lightblue">
                                <a id="openLogin" class="dropdown-item" href="#" data-toggle="modal" data-target="#loginMenu">Inloggen</a>
                                <a id="openRegister" class="dropdown-item" href="#" data-toggle="modal" data-target="#registerMenu">Registreren</a>
                            </div>
                        </div>
                    </div> 
                        
                    ';
                } ?>
            </div>
        </div>
    </div>
    <nav class="bg-yellow">
        <div class="row pt-2">
            <div class="col-lg-2">
                <span class="sidenavhamburger" onclick="openNav()">&#9776;</span>
            </div>
            <div class="col-lg-8 mx-2 mt-auto">
                <ul class="nav nav-tabs nav-fill">
                    <?php
                    $pages = ["Home" => "index.php", "Veilingen" => "veilingen.php", "Over ons" => "overons.php", "Contact" => "contact.php", "Hulp" => "hulp.php"];
                    $html = "";
                    foreach ($pages as $page => $link) {
                        $html .= "<li class='nav-item'><a class='nav-link";
                        if (basename(htmlspecialchars($_SERVER["PHP_SELF"])) == basename($link)) {
                            $html .= " currentpage";
                        }
                        $html .= "' href='$link'>$page</a></li>";
                    }
                    echo $html;
                    ?>
                </ul>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </nav>

    <!-- The Modal -->
    <div class="modal fade" id="loginMenu">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark">Inloggen</h4>
                    <button id="loginCloseButton" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col text-danger"><?php global $loginMessage;
                    if ($loginMessage != "") {
                        echo $loginMessage;
                        echo "<script>document.getElementById('openLogin').click();</script>";
                    };
                    confirm(); ?></div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-signin" method="POST" name="inloggen">
                            <div class="form-label-group">

                                <input class="form-control" placeholder="gebruikersnaam" type="text"
                                       name="username"
                                       id="username"
                                       maxlength="20" required>
                                <label for="username">Gebruikersnaam</label>
                            </div>
                            <div class="form-label-group">
                                <input class="form-control" placeholder="wachtwoord"
                                       type="password" name="password"
                                       id="password"
                                       maxlength="50" required><br>
                                <label for="password">Wachtwoord</label>
                                <a href="" data-target="#resetMenu" data-toggle="modal" id="openforgetpassword"
                                   onclick="document.getElementById('loginCloseButton').click()">Wachtwoord
                                    vergeten?</a><br>

                                <a href="" data-target="#resendCodeMenu" data-toggle="modal" id="openResendCodeMenu"
                                   onclick="document.getElementById('loginCloseButton').click()">Nieuwe
                                    verificatiecode?</a>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <input class="btn bg-lightblue" type="submit" name="login"
                                           value="Inloggen">
                                </div>

                                <div class="col text-right">
                                    <button id="openRegister"
                                            onclick="document.getElementById('loginCloseButton').click()" type="button"
                                            class="btn bg-lightblue" data-toggle="modal"
                                            data-target="#registerMenu">
                                        Nieuw account
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="registerMenu">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark">Registreren</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col text-danger"><?php register(); ?></div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-signin" method="POST" name="registreren">
                            <div class="row">
                                <div class="col">
                                    <div class="form-label-group">
                                        <input class="form-control" placeholder="Voornaam" type="text"
                                               name="firstname"
                                               id="firstname" maxlength="20"
                                               pattern="[A-Za-z]{1,20}" required>
                                        <label for="firstname">Voornaam</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-label-group">
                                        <input class="form-control" placeholder="Achternaam" type="text"
                                               name="lastname"
                                               id="lastname"
                                               maxlength="20"
                                               pattern="[A-Za-z]{1,20}" required>
                                        <label for="lastname">Achternaam</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-label-group">
                                        <input class="form-control" placeholder="Gebruikersnaam" type="text"
                                               name="reg_username"
                                               id="reg_username"
                                               maxlength="20" required>
                                        <label for="reg_username">Gebruikersnaam</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-label-group">
                                        <input class="form-control" placeholder="Emailadres" type="email"
                                               name="email" id="email" required>
                                        <label for="email">Emailadres</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input class="form-control mb-3" type="text" id="address" placeholder="Adres"
                                           name="address"
                                           required>
                                    <label for="address" class="sr-only">Adres</label>
                                    <script>
                                        var placesAutocomplete = places({
                                            appId: 'plK904BLG7JJ',
                                            apiKey: '551154e9c4e6dfefd99359b532faaa99',
                                            container: document.querySelector('#address')
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg ">
                                    <div class="form-label-group mb-0">
                                        <input class="form-control" placeholder="telefoonnummer" type="number"
                                               name="telephone_number" id="telephone_number" maxlength="10" pattern="[0-9]{10}">
                                        <label for="telephone_number">Telefoonnummer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg mx-4 mt-0 mb-2">
                                    <input type="checkbox" class="form-check-input " name="is_mobile">
                                    <label class="form-check-label text-dark" for="is_mobile"><i class="fas fa-mobile-alt"></i> ?</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-label-group">
                                        <input class="form-control" placeholder="wachtwoord" type="password"
                                               name="reg_password"
                                               id="reg_password"
                                               maxlength="50" required>
                                        <label for="reg_password">Wachtwoord</label>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-label-group">
                                        <label class="invisible" for="confirm_password">bevestig wachtwoord</label>
                                        <input class="form-control" placeholder="bevestig wachtwoord" type="password"
                                               name="confirm_password"
                                               id="confirm_password"
                                               maxlength="50" required><br>
                                        <label for="confirm_password">Bevestig wachtwoord</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-left">
                                    <input class="btn bg-lightblue" type="submit" name="make_account"
                                           value="Maak account aan">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="resetMenu">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark">Wachtwoord vergeten?</h4>
                    <button id="" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">

                        <form class="form-signin" method="POST" name="reset">
                            <div class="row">
                                <div class="col">
                                    <p class="text-dark">Weet je het wachtwoord niet meer?
                                        Vul hieronder je e-mailadres in.
                                        We sturen dan binnen enkele minuten een e-mail waarmee een nieuw wachtwoord kan
                                        worden
                                        aangemaakt.</p></div>
                            </div>
                            <div class=" mb-2 text-danger"><?php resetPasswordEmail(); ?></div>
                            <div class="form-label-group">
                                <form method="post" action="">
                                    <input class="form-control" placeholder="emailadres" type="text"
                                           name="pwdforgottenemail"
                                           id="emailadres"
                                           maxlength="40" required>
                                    <label for="emailadres">Voer hier je email in</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input class="btn bg-lightblue" type="submit" name="pwdforgottensubmit"
                                           value="Verstuur">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="resendCodeMenu">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark">reset verificatiecode</h4>
                    <button id="" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-signin" method="POST" name="resendCode">
                            <div class="row">
                                <div class="col">
                                    <p class="text-dark">Weet je het wachtwoord niet meer?
                                        Vul hieronder je e-mailadres in.
                                        We sturen dan binnen enkele minuten een e-mail waarmee je accout kan
                                        verifiëren?.</p></div>
                            </div>
                            <div class=" mb-2 text-danger"><?php verificatiecodeEmail(); ?></div>
                            <div class="form-label-group">
                                <form method="post" action="">
                                    <input class="form-control" placeholder="emailadres" type="text"
                                           name="resendCode_emailadres"
                                           id="resendCode_emailadres"
                                           maxlength="40" required>
                                    <label for="resendCode_emailadres">Voer hier je email in</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input class="btn bg-lightblue" type="submit" name="resendCode"
                                           value="Verstuur">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</header>

<div id="mySidenav" class="sidenav bg-yellow">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="navigatiemobiel" href="index.php">Home</a>
    <a class="navigatiemobiel" href="veilingen.php">Veilingen</a>
    <a class="navigatiemobiel" href="overons.php">Over ons</a>
    <a class="navigatiemobiel" href="contact.php">Contact</a>
    <a class="navigatiemobiel" href="hulp.php">Hulp</a>
</div>