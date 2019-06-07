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
            <div class="pos-f-t">
                <div class="rubricsmobile">
                    <nav class="navbar navbar-dark bg-orange">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarToggleExternalContent"
                                aria-controls="navbarToggleExternalContent"
                                aria-expanded="true" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <p>Filters</p>
                    </nav>
                </div>
                <div class="collapse show" id="navbarToggleExternalContent">
                    <div class="desktoprubrics bg-yellow p-4">
                        <div class="container">
                            <div class="row">
                                <div class="col text-white  p-0">
                                    <h1 class="rubrics-title font-weight-bold">Filters</h1>
                                    <p>Prijs:</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 p-0 text-center">
                                    <input onchange="this.value = parseFloat(this.value).toFixed(2);"
                                           class="bg-gray text-center input-details form-control" type="number"
                                           id="amount-min"
                                           placeholder="min"
                                        <?php
                                        if (isset($_GET['minPrice']) && ($minPrice = cleanUpUserInput($_GET['minPrice'])) != "" && is_numeric($minPrice) && ((float)$minPrice) >= 0) {
                                            echo " value='$minPrice'";
                                        }
                                        ?>
                                    >
                                </div>
                                <div class="col-2 px-0 mt-2 text-center">
                                    <p class="text-white font-weight-bold">-</p>
                                </div>
                                <div class="col-5 p-0 text-center">
                                    <input onchange="this.value = parseFloat(this.value).toFixed(2);"
                                           class="bg-gray text-center input-details form-control" type="number"
                                           id="amount-max"
                                           placeholder="max" <?php
                                    if (isset($_GET['maxPrice']) && ($maxPrice = cleanUpUserInput($_GET['maxPrice'])) != "" && is_numeric($maxPrice) && ((float)$maxPrice) >= 0) {
                                        echo " value='$maxPrice'";
                                    }
                                    ?>>
                                </div>
                            </div>
                            <br>
                            <?php if (isset($_SESSION['username'])) {
                                echo "<div class=\"row\">
										<div class=\"col-11 p-0\">
											<p class=\"text-white text-left\">Maximale afstand in kilometers:</p>
											</div>
											</div>
											<div class=\"row\">
											<div class=\"col p-0\">
											    <div class=\"input-group mb-3\">
											    <input class=\"bg-gray text-center input-details-mobile form-control\" type=\"number\"
											       id=\"distance-max\"
											       placeholder=\"max\" " .
                                    ((isset($_GET['maxDistance']) && ($maxDistance = cleanUpUserInput($_GET['maxDistance'])) != "" && is_numeric($maxDistance) && ((float)$maxDistance) >= 0) ? " value='$maxDistance'" : "") . ">
                                                  <div class=\"input-group-append\">
                                                    <span class=\"input-group-text\">km</span>
                                                  </div>
                                                </div>
											</div>
									</div>
									";
                            } ?>
                            <br>
                            <button class="btn mb-1" onclick="
					                document.getElementById('minPrice').value = document.getElementById('amount-min').value;
					                document.getElementById('maxPrice').value = document.getElementById('amount-max').value;
					                document.getElementById('maxDistance').value = document.getElementById('distance-max').value;
					                document.getElementById('searchbutton').click();"
                            >Pas filters toe
                            </button>
                            <div class="dropdown-divider"></div>
                        </div>
                        <div>
                            <?php loadRubrics(); ?>
                        </div>
                    </div>
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
                        <a href="#" class="page-link" onclick="
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
