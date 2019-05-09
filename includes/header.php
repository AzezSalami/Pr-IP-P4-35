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
							<input type="text" class="form-control" placeholder="Zoeken" name="search">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary bg-white" type="button" id="searchbutton"><i
											class="fas fa-search"></i>
								</button>
							</div>
						</div>
					</form>
				<div class="col-2 my-auto text-center">
					<button type="button" class="bg-lightblue btn mb-1" data-toggle="modal" data-target="#loginMenu"><i
								class="fas fa-user"></i><span id="aanmeldTekst"> &nbsp; Aanmelden</span>
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
                    $pages = ["Home" => "homepage.php", "Account" => "account.php", "Verkoop" => "verkoop.php", "Contact" => "contact.php"];
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

				<!-- Modal body -->
				<div class="modal-body">
					<div class="container-fluid">
						<form class="form-signin" method="POST" action="" name="inloggen">
							<div class="form-label-group">
								<input class="form-control" placeholder="gebruikersnaam" type="text"
								       name="gebruikersnaam"
								       id="gebruikersnaam"
								       maxlength="20" required>
								<label for="gebruikersnaam">Gebruikersnaam</label>
							</div>
							<div class="form-label-group">
								<input class="form-control" placeholder="wachtwoord"
								       type="password" name="wachtwoord"
								       id="wachtwoord"
								       maxlength="50" required><br>
								<label for="wachtwoord">Wachtwoord</label>
							</div>

							<div class="row">
								<div class="col">
									<input class="btn bg-lightblue" type="submit" name="next"
									       value="Inloggen">
								</div>

								<div class="col text-right">
									<button onclick="document.getElementById('loginCloseButton').click()" type="button"
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

				<!-- Modal body -->
				<div class="modal-body">
					<div class="container-fluid">
						<form class="form-signin" method="POST" action="" name="registreren">
							<div class="row">
								<div class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="voornaam" type="text"
										       name="voornaam"
										       id="voornaam" maxlength="20" required>
										<label for="voornaam">Voornaam</label>
									</div>
								</div>
								<div class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="achternaam" type="text"
										       name="achternaam"
										       id="achternaam"
										       maxlength="20" required>
										<label for="achternaam">Achternaam</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="gebruikersnaam" type="text"
										       name="reggebruikersnaam"
										       id="reggebruikersnaam"
										       maxlength="20" required>
										<label for="reggebruikersnaam">Gebruikersnaam</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div  class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="emailadres" type="email"
										       name="emailadres" id="emailadres" required>
										<label for="emailadres">Emailadres</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div  class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="adres" type="text"
										       name="adres"
										       id="adres"
										       maxlength="20" required>
										<label for="adres">Adres</label>
									</div>
								</div>
								<div  class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="postcode" type="text"
										       name="postcode"
										       id="postcode"
										       maxlength="20" required>
										<label for="postcode">Postcode</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div  class="col">
									<div class="form-label-group">
										<input class="form-control" placeholder="telefoonnummer" type="tel"
										       name="telefoonnummer" id="telefoonnummer" maxlength="10">
										<label for="telefoonnummer">Telefoonnummer</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div  class="col-lg">
									<div class="form-label-group">
										<input class="form-control" placeholder="wachtwoord" type="password"
										       name="regwachtwoord"
										       id="regwachtwoord"
										       maxlength="50" required>
										<label for="regwachtwoord">Wachtwoord</label>
									</div>
								</div>
								<div class="col-lg">
									<div class="form-label-group">
										<label class="invisible" for="bevestig_wachtwoord">bevestig wachtwoord</label>
										<input class="form-control" placeholder="bevestig wachtwoord" type="password"
										       name="bevestig_wachtwoord"
										       id="bevestig_wachtwoord"
										       maxlength="50" required><br>
										<label for="bevestig_wachtwoord">Bevestig wachtwoord</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col text-left">
									<input class="btn bg-lightblue" type="submit" name="Maak_account_aan"
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