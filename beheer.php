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


		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	</head>
	<body class="bg-gray">

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

<?php
//    if(isset($_POST['blockUser'])){
//        if(isset($_POST['blockUsername'])) {
//            $username = cleanUpUserInput($_POST['blockUsername']);
//            $sql = $pdo->prepare("UPDATE TBL_User SET is_Blocked WHERE user = ?");
//            $sql->execute(array($username));
//            $sql->fetch();
//            echo " Gebruiker $username is nu geblokkeerd.";
//        }
//        else{
//
//            echo 'Voer eerst een gebruikersnaam in.';
//        }
//    }
//?>

