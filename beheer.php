<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'includes/head.html'; ?>
		<link rel="stylesheet" href="CSS/beheer.css" type="text/css">
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
					Klik op de knop hieronder om alle data die in de SQL map van de server staat te importeren.
					<a href="conversion.php"><button>Importeer data</button></a>
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