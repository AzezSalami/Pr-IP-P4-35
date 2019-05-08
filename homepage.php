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
</head>
<body class="bg-gray">
<?php
require "includes/header.php";
?>

<div id="mySidenav" class="sidenav bg-yellow">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="hoofdrubriek" href="#">Hoofdrubriek1</a>
    &nbsp;<a class="subrubriek" href="#">Subrubriek1</a>
    &nbsp;<a class="subrubriek" href="#">Subrubriek2</a>
    <a class="hoofdrubriek" href="#">Hoofdrubriek2</a>
    &nbsp;<a class="subrubriek" href="#">Subrubriek1</a>
    &nbsp;<a class="subrubriek" href="#">Subrubriek2</a>
    <a class="hoofdrubriek" href="#">Hoofdrubriek3</a>
    &nbsp;<a class="subrubriek" href="#">Subrubriek1</a>
    &nbsp;<a class="subrubriek" href="#">Subrubriek2</a>
    <a class="hoofdrubriek" href="#">Hoofdrubriek4</a>
    &nbsp;<a class="subrubriek" href="#">Subrubriek1</a>
    &nbsp;<a class="subrubriek" href="#">Subrubriek2</a>
</div>

<main>
    <div class="row">
                    <div class="col-lg-2">
                        <span class="sidenavhamburger" onclick="openNav()">&#9776;</span>
        <!--                <div class="mainrubriekenboom">-->
        <!--                    <form name="mainrubriekenform" action="" method="GET">-->
        <!--                        <div class="custom-control custom-checkbox mb-3">-->
        <!--                            <input type="checkbox" class="custom-control-input" id="rubriek1" name="rubriek1">-->
        <!--                            <label class="custom-control-label" for="rubriek1">Rubriek1</label><br>-->
        <!--                            <input type="checkbox" class="custom-control-input" id="rubriek2" name="rubriek2">-->
        <!--                            <label class="custom-control-label" for="rubriek1">Rubriek2</label><br>-->
        <!--                            <input type="checkbox" class="custom-control-input" id="rubriek3" name="rubriek3">-->
        <!--                            <label class="custom-control-label" for="rubriek3">Rubriek3</label><br>-->
        <!--                            <input type="checkbox" class="custom-control-input" id="rubriek4" name="rubriek4">-->
        <!--                            <label class="custom-control-label" for="rubriek1">Rubriek4</label><br>-->
        <!--                        </div>-->
        <!--                    </form>-->
        <!--                </div>-->
                    </div>

        <div class="col-lg-8">
            <div class="container">
                <div class="row my-2">
                    <div class="auction-article-large white col-lg mx-2">
                        <div class="row mt-3">
                            <div class="col">
                                <dt class="col"> [Titel]</dt>
                            </div>
                            <div class="col text-right">
                                <dt class="col"> [Prijs]</dt>
                            </div>
                        </div>
                        <div class="row text-center">
                            <img class="mx-auto my-2" src="https://picsum.photos/id/340/1000/600" alt="EA">
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <dt class="col text-left"> Beschrijving:</dt>
                            </div>
                            <div class="row mx-3">
                                <dd class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc molestie
                                    massa
                                    enim,
                                    eget pretium lorem accumsan id. Sed imperdiet, eros.
                                </dd>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-details">Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="auction-article-large white col-lg mx-2">
                        <div class="row mt-3">
                            <div class="col">
                                <dt class="col"> [Titel]</dt>
                            </div>
                            <div class="col text-right">
                                <dt class="col"> [Prijs]</dt>
                            </div>
                        </div>
                        <div class="row text-center">
                            <img class="mx-auto my-2" src="https://picsum.photos/id/350/600/600" alt="EA">
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <dt class="col text-left"> Beschrijving:</dt>
                            </div>
                            <div class="row mx-3">
                                <dd class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc molestie
                                    massa
                                    enim,
                                    eget pretium lorem accumsan id. Sed imperdiet, eros.
                                </dd>
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
                            <div class="auction-article-small white col-md mx-2">
                                <div class="row mt-3">
                                    <div class="col">
                                        <dt class="col"> [Titel]</dt>
                                    </div>
                                    <div class="col text-right">
                                        <dt class="col"> [Prijs]</dt>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <img class="mx-auto my-2" src="https://picsum.photos/id/390/600/600" alt="EA">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <dt class="col"> Beschrijving:</dt>
                                    </div>
                                    <div class="row mx-3">
                                        <dd class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                                            molestie
                                            massa
                                            enim,
                                            eget pretium lorem accumsan id. Sed imperdiet, eros.
                                        </dd>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-details">Details</button>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-article-small white col-md mx-2">
                                <div class="row mt-3">
                                    <div class="col">
                                        <dt class="col"> [Titel]</dt>
                                    </div>
                                    <div class="col text-right">
                                        <dt class="col"> [Prijs]</dt>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <img class="mx-auto my-2" src="https://picsum.photos/id/390/600/600" alt="EA">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <dt class="col"> Beschrijving:</dt>
                                    </div>
                                    <div class="row mx-3">
                                        <dd class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                                            molestie
                                            massa
                                            enim,
                                            eget pretium lorem accumsan id. Sed imperdiet, eros.
                                        </dd>
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
                            <div class="auction-article-small white col-md mx-2">
                                <div class="row mt-3">
                                    <div class="col">
                                        <dt class="col"> [Titel]</dt>
                                    </div>
                                    <div class="col text-right">
                                        <dt class="col"> [Prijs]</dt>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <img class="mx-auto my-2" src="https://picsum.photos/id/390/600/600" alt="EA">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <dt class="col"> Beschrijving:</dt>
                                    </div>
                                    <div class="row mx-3">
                                        <dd class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                                            molestie
                                            massa
                                            enim,
                                            eget pretium lorem accumsan id. Sed imperdiet, eros.
                                        </dd>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-details">Details</button>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-article-small white col-md mx-2">
                                <div class="row mt-3">
                                    <div class="col">
                                        <dt class="col"> [Titel]</dt>
                                    </div>
                                    <div class="col text-right">
                                        <dt class="col"> [Prijs]</dt>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <img class="mx-auto my-2" src="https://picsum.photos/id/390/600/600" alt="EA">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <dt class="col"> Beschrijving:</dt>
                                    </div>
                                    <div class="row mx-3">
                                        <dd class="col"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                                            molestie
                                            massa
                                            enim,
                                            eget pretium lorem accumsan id. Sed imperdiet, eros.
                                        </dd>
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
<main>
    <div class="row">
        <div class="col-lg-2">

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
                                <img class="mx-auto my-2" src="https://picsum.photos/id/350/600/600" alt="EA">
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
                                        <img class="mx-auto my-2" src="https://picsum.photos/id/360/600/600"
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
                                        <img class="mx-auto my-2" src="https://picsum.photos/id/370/600/600"
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
                                        <img class="mx-auto my-2" src="https://picsum.photos/id/380/600/600"
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
                                        <img class="mx-auto my-2" src="https://picsum.photos/id/390/600/600"
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
</body>
</html>