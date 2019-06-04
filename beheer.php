<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.html'; ?>
    <link rel="stylesheet" href="CSS/beheer.css" type="text/css">
</head>
<body>

<?php
require "includes/header.php";
?>

<main>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 admin-page">
            <div class="classic-tabs mx-2">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link  active show" id="profile-tab-classic-shadow" data-toggle="tab"
                           href="#profile-classic-shadow"
                           role="tab">Rubrieken bewerken</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="follow-tab-classic-shadow" data-toggle="tab"
                           href="#follow-classic-shadow"
                           role="tab">Gebruiker blokkeren</a>
                    </li>
                </ul>

                <div class="tab-content card">
                    <div class="adminContainer tab-pane fade active show container admin-tab table-responsive" id="profile-classic-shadow"
                         role="tabpanel">
                        <table class="table table-bordered table-sm col-lg-auto">
                            <thead>
                            <tr>
                                <th scope="col" class="fit"></th>
                                <th scope="col" class="fit">#</th>
                                <th scope="col">Rubrieknaam</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row" class="fit"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td class="fit">1</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fit"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td class="fit">2</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fit"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td class="fit">3</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fit"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td class="fit">4</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fit"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td class="fit">5</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fit"></th>
                                <td class="inputRubric"><input type="number" name="addRubricNumber" placeholder="Positie rubriek">
                                </td>
                                <td class="inputRubric"><input type="text" name="addRubricName" placeholder="Naam rubriek"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-lg-10 admin-buttons text-center">
                            <input type="submit" class="btn mb-1 red" value="Verwijderen" name="removeRubric">
                            <input type="submit" class="btn mb-1" value="Aanpassen" name="changeRubric">
                            <input type="submit" class="btn mb-1" value="Uitfaseren" name="depracateRubric">
                            <input type="submit" class="btn mb-1" value="Toepassen" name="confirmChangesRubric">
                        </div>
                    </div>
                    <div class="tab-pane fade admin-tab text-center " id="follow-classic-shadow" role="tabpanel">
                        <form action="includes/functions.php">
                            <input type="text" name="blockUsername" placeholder="Gebruikersnaam">
                            <input type="submit" class="btn" name="blockUser" value="Blokkeren">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-2">
    </div>
</main>
<div class="fixed-bottom">
    <?php
    include_once "includes/footer.php";
    ?>
</div>
</body>
</html>