<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.html'; ?>
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
            <div class="text-dark">
                <h1>Wachtwoord vergeten</h1>
                <p>Weet je het wachtwoord niet meer?
                    Vul hieronder je e-mailadres in.
                    We sturen dan binnen enkele minuten een e-mail waarmee een nieuw wachtwoord kan worden
                    aangemaakt.</p>
            </div>
            <form class="text-dark">
                <div class="form-label-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="e-mail">
                    <label for="exampleInputEmail1">e-mail</label>

                </div>
                <button type="submit" class="btn bg-lightblue">Versturen</button>
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