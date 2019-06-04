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
                    <div class="adminContainer tab-pane fade active show container admin-tab" id="profile-classic-shadow"
                         role="tabpanel">
                        <table class="table table-bordered table-sm col-lg-auto">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">#</th>
                                <th scope="col">Rubrieknaam</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td>1</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td>2</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td>3</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td>4</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="radio" value="geselecteerd" name="geselecteerd"></th>
                                <td>5</td>
                                <td>Testrubriek</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td><input type="number" name="addRubricNumber" placeholder="Positie van rubriek">
                                </td>
                                <td><input type="text" name="addRubricName" placeholder="Naam van rubriek"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-lg-10 admin-buttons float-right">
                            <input type="submit" class="btn mb-1 red" value="Verwijderen" name="removeRubric">
                            <input type="submit" class="btn mb-1" value="Aanpassen" name="changeRubric">
                            <input type="submit" class="btn mb-1" value="Uitfaseren" name="depracateRubric">
                            <input type="submit" class="btn mb-1" value="Toepassen" name="confirmChangesRubric">
                        </div>
                    </div>
                    <div class="tab-pane fade admin-tab" id="follow-classic-shadow" role="tabpanel">
                        <form action="includes/functions.php" class="block-user">
                            <input type="text" name="blockUsername" placeholder="Gebruikersnaam">
                            <input type="submit" name="blockUser" value="Blokkeren">
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