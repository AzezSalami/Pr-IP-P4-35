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

    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body class="bg-gray">

<?php
require "includes/header.php";
?>

<main>
    <div class="row navrow">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
                            <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1"
                               aria-selected="true">
                                <i class="mdi mdi-help-circle"></i> Onderwerp 1
                            </a>
                            <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2"
                               aria-selected="false">
                                <i class="mdi mdi-account"></i> Onderwerp 2
                            </a>
                            <a href="#tab3" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab3"
                               aria-selected="false">
                                <i class="mdi mdi-account-settings"></i> Onderwerp 3
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content" id="faq-tab-content">
                            <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="accordion" id="accordion-tab-1">
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-1-heading-1">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-1-content-1" aria-expanded="false"
                                                        aria-controls="accordion-tab-1-content-1">Vraag 1
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="accordion-tab-1-content-1"
                                             aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
                                            <div class="card-body">
                                                <p>Antwoord 1</p>
                                                <p><strong>Toelichting: </strong>Voorbeeld</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-1-heading-2">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-1-content-2" aria-expanded="false"
                                                        aria-controls="accordion-tab-1-content-2">Vraag 2
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-1-content-2"
                                             aria-labelledby="accordion-tab-1-heading-2" data-parent="#accordion-tab-1">
                                            <div class="card-body">
                                                <p>Antwoord 2</p>
                                                <p><strong>Toelichting 2: </strong>Voorbeeld</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <div class="accordion" id="accordion-tab-2">
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-2-heading-1">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-2-content-1" aria-expanded="false"
                                                        aria-controls="accordion-tab-2-content-1">Vraag 1
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="accordion-tab-2-content-1"
                                             aria-labelledby="accordion-tab-2-heading-1" data-parent="#accordion-tab-2">
                                            <div class="card-body">
                                                <p>Antwoord 1</p>
                                                <p><strong>Toelichting 1: </strong>Voorbeeld</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-2-heading-2">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-2-content-2" aria-expanded="false"
                                                        aria-controls="accordion-tab-2-content-2">Vraag 2
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-2-content-2"
                                             aria-labelledby="accordion-tab-2-heading-2" data-parent="#accordion-tab-2">
                                            <div class="card-body">
                                                <p>Antwoord 2</p>
                                                <p><strong>Toelichting 2: </strong>Voorbeeld</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
                                <div class="accordion" id="accordion-tab-3">
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-3-heading-1">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-3-content-1" aria-expanded="false"
                                                        aria-controls="accordion-tab-3-content-1">Vraag 1
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="accordion-tab-3-content-1"
                                             aria-labelledby="accordion-tab-3-heading-1" data-parent="#accordion-tab-3">
                                            <div class="card-body">
                                                <p>Antwoord 1</p>
                                                <p><strong>Toelichting 1: </strong>Voorbeeld</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-3-heading-2">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-3-content-2" aria-expanded="false"
                                                        aria-controls="accordion-tab-3-content-2">Vraag 2
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-3-content-2"
                                             aria-labelledby="accordion-tab-3-heading-2" data-parent="#accordion-tab-3">
                                            <div class="card-body">
                                                <p>Antwoord 2</p>
                                                <p><strong>Toelichting 2: </strong>Voorbeeld</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</main>
<?php
include_once "includes/footer.php";
?>
</body>
</html>