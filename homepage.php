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
    <link rel="stylesheet" href="CSS/homepage.css" type="text/css">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="JS/pricerange.js"></script>
</head>
<body class="bg-gray">

<?php
require "includes/header.php";
?>

<main>
    <div class="row">
        <div class="col-lg-2">
            <div class="rubriekenmobile">
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
                        <div class="rubriekenmobilecontent bg-yellow p-4">
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
            <div class="desktoprubriekenmedia">
                <div class="desktoprubrieken bg-orange">
                    <h2>Filters</h2><br>
                    <form class="desktoprubriekenform" method="get" action="#">
                        <label for="hoofdrubriek1">
                            <input type="checkbox" value="hoofdrubriek1" id="hoofdrubriek1" name="hoofdrubriek1">
                            Hoofdrubriek1</label>
                        <label for="hoofdrubriek2">
                            <input type="checkbox" value="hoofdrubriek2" id="hoofdrubriek2" name="hoofdrubriek2">
                            Hoofdrubriek2</label>
                        <label for="hoofdrubriek3">
                            <input type="checkbox" value="hoofdrubriek3" id="hoofdrubriek3" name="hoofdrubriek3">
                            Hoofdrubriek3</label>
                        <label for="hoofdrubriek4">
                            <input type="checkbox" value="hoofdrubriek4" id="hoofdrubriek4" name="hoofdrubriek4">
                            Hoofdrubriek4</label>
                        <label for="hoofdrubriek5">
                            <input type="checkbox" value="hoofdrubriek5" id="hoofdrubriek5" name="hoofdrubriek5">
                            Hoofdrubriek5</label><br>
                        <input type="submit" class="bg-lightblue btn mb-1" value="Pas filters toe">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="container">
                <div class="row my-2">
                    <div class="auction-article-large white col-lg m-2">
                        <div class="row mt-3">
                            <div class="col">
                                <div class="col"><strong>[Titel]</strong></div>
                            </div>
                            <div class="col text-right">
                                <div class="col"><strong>[Prijs]</strong></div>
                            </div>
                        </div>
                        <div class="imageContainer row text-center">
                            <div>
                                <img class="mx-auto my-2" src="https://picsum.photos/id/340/1000/600"
                                     alt="EA">
                            </div>
                        </div>
                        <div class="row mb-3 auction-article-desc">
                            <div class="col">
                                <div class="col"> Beschrijving:</div>
                            </div>
                            <div class="row mx-3">
                                <div class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit. Nunc molestie
                                    massa
                                    enim,
                                    eget pretium lorem accumsan id. Sed imperdiet, eros.
                                </div>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-details">Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="auction-article-large white col-lg m-2">
                        <div class="row mt-3">
                            <div class="col">
                                <div class="col"><strong>[Titel]</strong></div>
                            </div>
                            <div class="col text-right">
                                <div class="col"><strong>[Prijs]</strong></div>
                            </div>
                        </div>
                        <div class="imageContainer row text-center">
                            <div>
                                <img class="mx-auto my-2" src="https://picsum.photos/id/350/800/600" alt="EA">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="col"> Beschrijving:</div>
                            </div>
                            <div class="row mx-3">
                                <div class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit. Nunc molestie
                                    massa
                                    enim,
                                    eget pretium lorem accumsan id. Sed imperdiet, eros.
                                </div>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-details">Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-xl">
                        <div class="row">
                            <div class="auction-article-small white col-md m-2">
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="col"><strong>[Titel]</strong></div>
                                    </div>
                                    <div class="col text-right">
                                        <div class="col"><strong>[Prijs]</strong></div>
                                    </div>
                                </div>
                                <div class="imageContainer row text-center">
                                    <div>
                                        <img class="mx-auto my-2" src="https://picsum.photos/id/360/1200/600"
                                             alt="EA">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="col"> Beschrijving:</div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit. Nunc molestie
                                            massa
                                            enim,
                                            eget pretium lorem accumsan id. Sed imperdiet, eros.
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-details">Details</button>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-article-small white col-md m-2">
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="col"><strong>[Titel]</strong></div>
                                    </div>
                                    <div class="col text-right">
                                        <div class="col"><strong>[Prijs]</strong></div>
                                    </div>
                                </div>
                                <div class="imageContainer row text-center">
                                    <div>
                                        <img class="mx-auto my-2" src="https://picsum.photos/id/370/600/400"
                                             alt="EA">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="col"> Beschrijving:</div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit. Nunc molestie
                                            massa
                                            enim,
                                            eget pretium lorem accumsan id. Sed imperdiet, eros.
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-details">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl">
                        <div class="row">
                            <div class="auction-article-small white col-md m-2">
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="col"><strong>[Titel]</strong></div>
                                    </div>
                                    <div class="col text-right">
                                        <div class="col"><strong>[Prijs]</strong></div>
                                    </div>
                                </div>
                                <div class="imageContainer row text-center">
                                    <div>
                                        <img class="mx-auto my-2" src="https://picsum.photos/id/380/800/600"
                                             alt="EA">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="col"> Beschrijving:</div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit. Nunc molestie
                                            massa
                                            enim,
                                            eget pretium lorem accumsan id. Sed imperdiet, eros.
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-details">Details</button>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-article-small white col-md m-2">
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="col"><strong>[Titel]</strong></div>
                                    </div>
                                    <div class="col text-right">
                                        <div class="col"><strong>[Prijs]</strong></div>
                                    </div>
                                </div>
                                <div class="imageContainer row text-center">
                                    <div>
                                        <img class="mx-auto my-2" src="https://picsum.photos/id/390/1000/600"
                                             alt="EA">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="col"> Beschrijving:</div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit. Nunc molestie
                                            massa
                                            enim,
                                            eget pretium lorem accumsan id. Sed imperdiet, eros.
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-details">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <!---->
        </div>
    </div>

</main>
<?php
include_once "includes/footer.php";
?>
</body>
</html>