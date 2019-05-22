<!DOCTYPE html>
<html lang="en">
	<head>
        <?php include 'includes/head.html'; ?>
		<link rel="stylesheet" href="CSS/contact.css" type="text/css">
	</head>
	<body>

        <?php
            require "includes/header.php";
        ?>

		<main>
			<div class="row">
				<div class="col-lg-2">
				</div>
				<div class="col-lg-8 contact-form">
					<div class="container my-5">
						<div class="contact-image">
							<img src="images/logo-rond.png" alt="rocket_contact"/>
						</div>
						<form method="post">
							<h3 class="contact-title">Stuur ons een bericht</h3>

							<div class="form-group">
								<input type="text" name="txtName" class="form-control" placeholder="Uw naam *"
								       value=""/>
							</div>
							<div class="form-group">
								<input type="text" name="txtEmail" class="form-control" placeholder="Uw email *"
								       value=""/>
							</div>
							<div class="form-group">
								<input type="text" name="txtPhone" class="form-control"
								       placeholder="Uw telefoonnummer *" value=""/>
							</div>
							<div class="form-group">
                        <textarea name="txtMsg" class="form-control contact-text"
                                  placeholder="Uw bericht *"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="btnSubmit" class="btn"
								       value="Verzend bericht"/>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-2">
				</div>
			</div>
		</main>

        <?php
            include_once "includes/footer.php";
        ?>

	</body>
</html>