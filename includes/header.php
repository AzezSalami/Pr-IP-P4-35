<?php
require_once "functions.php";
?>

<header>
	<span class="sidenavhamburger mr-2" onclick="openNav()">&#9776;</span>
	<div class="container-fluid bg-orange py-2">
		<div class="row">
			<div class="col-lg-2">
				<a href="homepage.php">
					<img src="images/logo.png" class="logo my-1 mx-auto d-block" alt="logo">
				</a>
			</div>
					<form method="get" class="col-10 col-lg-8 d-flex align-items-center mb-1 px-2">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="zoeken" name="search">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary bg-white" type="button" id="searchbutton"><i
											class="fas fa-search"></i>
								</button>
							</div>
						</div>
					</form>
				<div class="col-2 my-auto text-center">
					<button id="openLoginButton" type="button" class="bg-lightblue btn mb-1" data-toggle="modal" data-target="#loginMenu"><i
								class="fas fa-user"></i><span id="aanmeldTekst"> &nbsp; aanmelden</span>
					</button>
				</div>
		</div>
	</div>
	<nav class="bg-yellow">
		<div class="row">
			<div class="col-lg-2">
				<span class="sidenavhamburger" onclick="openNav()">&#9776;</span>
			</div>
			<div class="col-lg-8 mx-2 mt-auto">
				<ul class="nav nav-tabs nav-fill">
                    <?php
                    $pages = ["home" => "homepage.php", "Account" => "account.php", "Verkoop" => "verkoop.php", "Contact" => "contact.php"];
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
					<h4 class="modal-title text-dark">inloggen</h4>
					<button id="loginCloseButton" type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
                <div class="col text-danger" ><?php login(); ?></div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="container-fluid">
						<form class="form-signin" method="POST">
							<div class="form-label-group">

								<input class="form-control" placeholder="gebruikersnaam" type="text"
								       name="username"
								       id="username"
								       maxlength="20" required>
								<label for="username">gebruikersnaam</label>
							</div>
							<div class="form-label-group">
								<input class="form-control" placeholder="wachtwoord"
								       type="password" name="password"
								       id="password"
								       maxlength="50" required><br>
								<label for="password">wachtwoord</label>
							</div>

							<div class="row">
								<div class="col">
									<input class="btn bg-lightblue" type="submit" name="login"
									       value="inloggen">
								</div>

								<div class="col text-right">
									<button id="openRegister" onclick="document.getElementById('loginCloseButton').click()" type="button"
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
					<h4 class="modal-title text-dark">registreren</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
                <div class="col text-danger" ><?php register(); ?></div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="container-fluid">
						<form class="form-signin" method="POST" action="" name="registreren">
							<div class="row">
								<div class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="voornaam" type="text"
										       name="firstname"
										       id="firstname" maxlength="20" required>
										<label for="firstname">voornaam</label>
									</div>
								</div>
								<div class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="achternaam" type="text"
										       name="lastname"
										       id="lastname"
										       maxlength="20" required>
										<label for="lastname">achternaam</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="gebruikersnaam" type="text"
										       name="reg_username"
										       id="reg_username"
										       maxlength="20" required>
										<label for="reg_username">gebruikersnaam</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div  class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="emailadres" type="email"
										       name="email" id="email" required>
										<label for="email">emailadres</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div  class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="adres" type="text"
										       name="address"
										       id="address"
										       maxlength="20" required>
										<label for="address">adres</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div  class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="telefoonnummer" type="tel"
										       name="telephone_number" id="telephone_number" maxlength="10">
										<label for="telephone_number">telefoonnummer</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div  class="col-lg">
									<div class="form-label-group">
										<input class="form-control" placeholder="wachtwoord" type="password"
										       name="reg_password"
										       id="reg_password"
										       maxlength="50" required>
										<label for="reg_password">wachtwoord</label>
									</div>
								</div>
								<div class="col-lg">
									<div class="form-label-group">
										<label class="invisible" for="bevestig_wachtwoord">bevestig wachtwoord</label>
										<input class="form-control" placeholder="bevestig wachtwoord" type="password"
										       name="confirm_password"
										       id="confirm_password"
										       maxlength="50" required><br>
										<label for="confirm_password">bevestig wachtwoord</label>
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
</header>

<div id="mySidenav" class="sidenav bg-yellow">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="hoofdrubriek" href="#">Home</a>
    <a class="hoofdrubriek" href="#">Account</a>
    <a class="hoofdrubriek" href="#">Verkoop</a>
    <a class="hoofdrubriek" href="#">Contact</a>
</div>