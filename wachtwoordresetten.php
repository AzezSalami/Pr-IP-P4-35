<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.html'; ?>
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