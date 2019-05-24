<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.html'; ?>
    <link rel="stylesheet" href="CSS/veilingen.css" type="text/css">
</head>
<body>

<?php require_once "includes/header.php" ?>

<main>
    <div class="row">
        <div class="col-lg-2">
            <div class="rubricsmobile">
                <div class="pos-f-t">
                    <nav class="navbar navbar-dark bg-orange">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <p>Filters</p>
                    </nav>
                    <div class="collapse" id="navbarToggleExternalContent">
                        <div class="rubricsmobilecontent bg-yellow p-4">
                            <div class="container">
                                <div class="row">
                                    <p class="text-white font-weight-bold">Prijs:</p>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <input class="bg-gray text-center input-details-mobile" type="number"
                                               placeholder="min">
                                    </div>
                                    <div class="col-2">
                                        <p class="text-white font-weight-bold">-</p>
                                    </div>
                                    <div class="col-5">
                                        <input class="bg-gray text-center input-details-mobile" type="number"
                                               placeholder="min">
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="submit" class="btn mb-1" value="Pas filters toe">
                                </div>

                                <div class="dropdown-divider"></div>
                            </div>
                            <h4 class="text-white">Rubrieken</h4>
                            <a href="#">Hoofdrubriek1</a>
                            <a href="#">Hoofdrubriek2</a>
                            <a href="#">Hoofdrubriek3</a>
                            <a href="#">Hoofdrubriek4</a>
                            <a href="#">Hoofdrubriek5</a>
                            <a href="#">Hoofdrubriek6</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="desktoprubricsmedia">
                <div class="desktoprubrics bg-yellow">
	                <h2>Filters</h2><br>
	                <div class="range-filter container text-left my-2 pl-0">
		                <form action="#">
			                <p class="font-weight-bold">prijs:</p>
			                <div class="row">
				                <div class="col-lg-5 text-left">
					                <input class="bg-gray text-center input-details" type="number" id="amount-min"
					                       placeholder="min" <?php
                                        if (isset($_GET['minPrice']) && ($minPrice = cleanUpUserInput($_GET['minPrice'])) != "" && is_numeric($minPrice)) {
                                            echo " value='$minPrice'";
                                        }
                                    ?>>
				                </div>
				                <div class="col-lg-1 text-center">
					                <p class="text-white font-weight-bold">-</p>
				                </div>
				                <div class="col-lg-5 text-right">
					                <input class="bg-gray text-center input-details" type="number" id="amount-max"
					                       placeholder="max" <?php
                                        if (isset($_GET['maxPrice']) && ($maxPrice = cleanUpUserInput($_GET['maxPrice'])) != "" && is_numeric($maxPrice)) {
                                            echo " value='$maxPrice'";
                                        }
                                    ?>>
				                </div>
			                </div>
			                <br>

		                </form>
		                <button class="btn mb-1" onclick="
					                document.getElementById('minPrice').value = document.getElementById('amount-min').value;
					                document.getElementById('maxPrice').value = document.getElementById('amount-max').value;
					                document.getElementById('searchbutton').click();"
		                >Pas filters toe</button>
	                </div>
	                <div class="dropdown-divider"></div>
	                <?php loadRubrics(); ?>

                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-10 auction-page">
            <div class="container">
                <?php search(8); ?>
            </div>

        </div>
        <div class="col">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($_GET["page"] <= 1) echo "disabled"; ?>">
                        <a href="#" class="page-link" onclick="
                                document.getElementById('pageNumber').value = '<?php echo($_GET["page"] - 1); ?>';
                                document.getElementById('searchbutton').click();">
                            Vorige</a>
                    </li>
                    <li class="page-item <?php global $lastPage;
                    if ($lastPage) echo "disabled"; ?>">
                        <a href="#"  class="page-link" onclick="
                                document.getElementById('pageNumber').value = '<?php echo((isset($_GET['page']) && ($page = cleanUpUserInput($_GET['page'])) > 1 ? $page : 1) + 1); ?>';
                                document.getElementById('searchbutton').click();">
                            Volgende
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</main>
<?php
include_once "includes/footer.php";
?>
</body>
</html>
