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
                    <?php loadRubrics();?>
                    <div class="dropdown-divider"></div>
                    <div class="range-filter container text-left my-2 pl-0">
                        <form method="post" action="...">
                            <p class="font-weight-bold">prijs:</p>
                            <div class="row">
                                <div class="col-lg-5 text-left">
                                    <input class="bg-gray text-center input-details" type="number" id="amount-min"
                                           placeholder="min">
                                </div>
                                <div class="col-lg-1 text-center">
                                    <p class="text-white font-weight-bold">-</p>
                                </div>
                                <div class="col-lg-5 text-right">
                                    <input class="bg-gray text-center input-details" type="number" id="amount-max"
                                           placeholder="max">
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <input type="submit" class="btn mb-1" value="Pas filters toe">
                </div>
            </div>
        </div>
        <div class="col-lg-8 auction-page">
            <div class="container">
                <?php search(50); ?>
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
