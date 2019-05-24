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
				<div class="col-lg-1">
				</div>
				<div class="col-lg-10">
					<div class="container">
                        <?php search(2, true); ?>
                        <?php search(4); ?>
					</div>
				</div>
				<div class="col-lg-1">
				</div>
			</div>

</main>
<?php
include_once "includes/footer.php";
?>
</body>
</html>