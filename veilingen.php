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
    <script src="JS/sidenav.js"></script>
</head>
<body class="bg-gray">

<?php require_once "includes/header.php" ?>

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
                <div class="desktoprubrieken bg-yellow">
                    <?php
                    $html = "<h2>Filters</h2><br>
                            <p class=\"font-weight-bold mb-0\">Rubrieken:</p>";

                    global $pdo;
                    $query = $pdo->prepare("select * from TBL_Rubric where super is null");
                    $query->execute();
                    while ($data = $query->fetch()) {
                        $html .=
                            "<div class=\"btn-group dropright\">
                        <button type=\"button\" class=\"btn\">" . $data['name'] . "</button>
                        <button type=\"button\" class=\"btn dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\"
                                aria-haspopup=\"true\" aria-expanded=\"false\">
                            <span class=\"sr-only\">hoofdrubriek 1</span>
                        </button>
                        <div class=\"dropdown-menu r-content bg-gray px-2\">
                            <div class=\"container\">
                        <div class=\"row mr-1 mb-2\">";

                        $query2 = $pdo->prepare("select * from TBL_Rubric where super = " . $data['rubric']);
                        $query2->execute();

                        $i = 0;

                        while ($data2 = $query2->fetch()) {
                            $html .= "<div class=\"col mx-1\">
                                        <a href=\"#\">" . $data2['name'] . "</a>
                                        <div class=\"dropdown-divider yellow\"></div>";

                            $query3 = $pdo->prepare("select * from TBL_Rubric where super = " . $data2['rubric']);
                            $query3->execute();

                            while ($data3 = $query3->fetch()) {

                                $html .= "<p>" . $data3['name'] . "</p>";

                            }

                            $html .= "</div>";
                            if($i == 4) {
                                $html .= "</div><div class=\"row mr-1 mb-2\">";
                                $i = 0;
                            } else {
                                $i++;
                            }
                        }
                        $html .= "</div></div></div></div>";
                    }
                    echo $html;
                    ?>
                    <div class="dropdown-divider"></div>
                    <div class="range-filter container text-left my-2 pl-0">
                        <form method="post" action="...">
                            <p class="font-weight-bold">prijs:</p>
                            <div class="row">
                                <div class="col-lg-5 text-left">
                                    <input class="bg-gray text-center input-details" type="text" id="amount-min"
                                           placeholder="min">
                                </div>
                                <div class="col-lg-2 text-center">
                                    <label class=" text-white font-weight-bold">-</label>
                                </div>
                                <div class="col-lg-5 text-right">
                                    <input class="bg-gray text-center input-details" type="text" id="amount-max"
                                           placeholder="max">
                                </div>
                            </div>
                            <div class="my-2" id="slider-range"></div>
                        </form>
                    </div>
                    <br>
                    <input type="submit" class="bg-lightblue btn mb-1" value="Pas filters toe">
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="container">
                <?php search(); ?>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
</main>
</body>
</html>
