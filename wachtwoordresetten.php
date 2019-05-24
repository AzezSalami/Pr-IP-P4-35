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

</head>
<body>

<?php
require "includes/header.php";
?>

<main>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="text-dark">
                <h1>Wachtwoord resetten</h1>
                <p>Vul hieronder het nieuwe wachtwoord in en klik op Verzenden.</p>
                <?php

                if (isset($_POST['submit'])) {

                    $email = $_GET['email'];
                    $verificationweb = $_GET['verification'];

                    global $pdo;
                    $query = $pdo->prepare("select verification_code from TBL_User where email = '$email' AND DATEDIFF(second, GETDATE(), verification_code_valid_until) > 0");
                    $query->execute();
                    $data = $query->fetch();
                    $verificationdb = $data[0];

                    if ($_POST['password1'] == $_POST['password2']) {
                        if($verificationweb == $verificationdb) {
                            $password = $_POST['password1'];

                            if (isPasswordGood($password)) {


                                $password = hash('sha1', $_POST['password1']);


                                global $pdo;
                                $query = $pdo->prepare("update TBL_User set password = '$password', verification_code = null, verification_code_valid_until = null
                        where email = '$email'");
                                $query->execute();

                                echo '<p style="color: green">Je wachtwoord is succesvol veranderd!</p>';
                            }
                        } else {
                            echo '<p style="color: red">Deze link is niet meer geldig</p>';
                        }
                    } else {
                        echo '<p style="color: red">Wachtwoorden komen niet overeen, probeer het alstublieft nog een keer.</p>';
                    }
                }
                ?>
            </div>
            <form class="w-25" method="post" action="">
                <div class="form-label-group">
                    <input type="password" class="form-control" name="password1" id="exampleInputPassword1"
                           placeholder="Wachtwoord">
                    <label for="exampleInputPassword1">Wachtwoord</label>
                </div>
                <div class="form-label-group">
                    <input type="password" class="form-control" name="password2" id="exampleInputPassword2"
                           placeholder="Bevestig wachtwoord">
                    <label for="exampleInputPassword2">Bevestig wachtwoord</label>
                </div>
                <button type="submit" name="submit" class="btn">Verzenden</button>
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