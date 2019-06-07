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
    <link rel="stylesheet" href="CSS/general.css" type="text/css">
    <link rel="stylesheet" href="CSS/hulp.css" type="text/css">


</head>
<body>

<?php
require "includes/header.php";
?>

<main>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
                            <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1"
                               aria-selected="true">
                                <i class="mdi mdi-help-circle"></i> Registreren
                            </a>
                            <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2"
                               aria-selected="false">
                                <i class="mdi mdi-account"></i> Inloggen
                            </a>
                            <a href="#tab3" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab3"
                               aria-selected="false">
                                <i class="mdi mdi-account-settings"></i> Bieden
                            </a>
                            <a href="#tab4" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab4"
                               aria-selected="false">
                                <i class="mdi mdi-account-settings"></i> Verkopen
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 pb-5 mb-3">
                        <div class="tab-content" id="faq-tab-content">
                            <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="accordion" id="accordion-tab-1">
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-1-heading-1">
                                            <h5>
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-1-content-1" aria-expanded="false"
                                                        aria-controls="accordion-tab-1-content-1">Hoe kan ik een account
                                                    aanmaken?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="accordion-tab-1-content-1"
                                             aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
                                            <div class="card-body">
                                                <p>Als je je op onze website begeeft kan je op elke pagina in de rechter
                                                    hoek aan de bovenkant van het scherm een blauwe knop zien waarop
                                                    'Aanmelden' staat. Nadat je hier op hebt geklikt kun je een keuze
                                                    maken om in te loggen op een bestaand account of jezelf te
                                                    registreren.
                                                    Als je op registreren klikt wordt er een pop-up weergeven waar je
                                                    een nieuw account kunt maken. Nadat je alle stappen inclusief de
                                                    verificatie hebt voltooid zal het registratieproces voltooid zijn en
                                                    kan je gebruik maken van het nieuw gecreëerde account.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-1-heading-2">
                                            <h5>
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-1-content-2" aria-expanded="false"
                                                        aria-controls="accordion-tab-1-content-2">Ik krijg geen
                                                    verificatiemail, wat nu?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-1-content-2"
                                             aria-labelledby="accordion-tab-1-heading-2" data-parent="#accordion-tab-1">
                                            <div class="card-body">
                                                <p>Soms kan het zijn dat er iets is misgegaan tijdens het verzenden van
                                                    de verificatiemail. Hieronder verschillende acties die je zelf kunt
                                                    ondernemen om dit op te lossen.<br><br>
                                                    - Kies voor 'Nieuwe verificatiecode?' op het inlogvenster. Na het
                                                    invullen van de email die je tijdens het registratieproces hebt
                                                    gebruiker wordt een nieuwe verificatiecode naar jouw inbox
                                                    verzonden.<br>
                                                    - Check de 'Spam' folder op je email. Soms kan het zijn dat de email
                                                    daar is beland en daarom niet wordt weergeven in jouw normale inbox.<br><br>
                                                    Als geen van de bovenstaande acties het probleem oplossen, aarzel
                                                    dan
                                                    niet om contant op te nemen met ons personeel. Dit kan op de
                                                    contactpagina.
                                                </p>
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
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-2-content-1" aria-expanded="false"
                                                        aria-controls="accordion-tab-2-content-1">Hoe kan ik inloggen?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="accordion-tab-2-content-1"
                                             aria-labelledby="accordion-tab-2-heading-1" data-parent="#accordion-tab-2">
                                            <div class="card-body">
                                                <p>Als je je op onze website begeeft kan je op elke pagina in de rechter
                                                    hoek aan de bovenkant van het scherm een blauwe knop zien waarop
                                                    'Aanmelden' staat. Nadat je hier op hebt geklikt kun je een keuze
                                                    maken om in te loggen op een bestaand account of jezelf te
                                                    registreren,
                                                    kies voor 'Inloggen'. Nu je hierop hebt geklikt zal een pop-up
                                                    worden
                                                    weergeven waar je jouw gebruikersnaam en wachtwoord kunt invullen,
                                                    klik hierna op de knop waar 'Inloggen' op staat.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-2-heading-2">
                                            <h5>
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-2-content-2" aria-expanded="false"
                                                        aria-controls="accordion-tab-2-content-2">Het lukt mij niet in
                                                    te loggen, wat nu?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-2-content-2"
                                             aria-labelledby="accordion-tab-2-heading-2" data-parent="#accordion-tab-2">
                                            <div class="card-body">
                                                <p>Probeer de volgende dingen:<br>
                                                    - Controleer of je gebruikersnaam correct is (Deze is niet
                                                    hoofdletter
                                                    gevoelig.).<br>
                                                    - Controleer of je je gebruikersnaam en wachtwoord goed hebt
                                                    ingevuld.<br>
                                                    - Controleer of je het verificatieproces volledig hebt doorlopen.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-2-heading-3">
                                            <h5>
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-2-content-3" aria-expanded="false"
                                                        aria-controls="accordion-tab-2-content-3">Ik ben mijn wachtwoord
                                                    vergeten, wat nu?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-2-content-3"
                                             aria-labelledby="accordion-tab-2-heading-3" data-parent="#accordion-tab-2">
                                            <div class="card-body">
                                                <p>Als je je wachtwoord vergeten bent, klik dan in het inlogvenster op
                                                    “wachtwoord resetten”.
                                                    Je zal dan een mail ontvangen met daarin een link om je wachtwoord
                                                    opnieuw in te stellen.</p>
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
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-3-content-1" aria-expanded="false"
                                                        aria-controls="accordion-tab-3-content-1">Hoe kan ik een bod
                                                    plaatsen op een rubriek?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="accordion-tab-3-content-1"
                                             aria-labelledby="accordion-tab-3-heading-1" data-parent="#accordion-tab-3">
                                            <div class="card-body">
                                                <p> Binnen de veiling staat een drietal knoppen. Wanneer je een bod wilt
                                                    plaatsen klik je op een van de bedragen. Mits er niet een andere
                                                    gebruiker je voor is gegaan wordt je bord geplaatst.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-3-heading-2">
                                            <h5>
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-3-content-2" aria-expanded="false"
                                                        aria-controls="accordion-tab-3-content-2">Ik kan geen bod doen
                                                    op een rubriek, hoe kan dit?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-3-content-2"
                                             aria-labelledby="accordion-tab-3-heading-2" data-parent="#accordion-tab-3">
                                            <div class="card-body">
                                                <p>Dit kan aan de volgende oorzaken liggen:<br>
                                                    - De veiling is verlopen.<br>
                                                    - Je internetverbinding was slecht op moment van bieden.<br>
                                                    - Je bent niet ingelogd als verkoper of gebruiker.<br>
                                                    &emsp;o Weet je niet hoe je moet inloggen ? --> Kijk dan bij het
                                                    kopje
                                                    inloggen.<br>
                                                    &emsp;o Weet je niet hoe je moet registreren? --> Kijk dan bij het
                                                    kopje
                                                    registreren.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4">
                                <div class="accordion" id="accordion-tab-4">
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-4-heading-1">
                                            <h5>
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-4-content-1" aria-expanded="false"
                                                        aria-controls="accordion-tab-4-content-1">Hoe kan ik verkoper
                                                    worden?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="accordion-tab-4-content-1"
                                             aria-labelledby="accordion-tab-4-heading-1" data-parent="#accordion-tab-4">
                                            <div class="card-body">
                                                <p>Om verkoper te worden moet je eerst een account hebben op de website.<br>
                                                    Hierna kun je vervolgens verkoper worden door op de accountknop te
                                                    klikken (de blauwe knop rechtsboven met je gebruikersnaam).
                                                    Wanneer je hier op hebt geklikt krijg je de optie nieuwe veiling.
                                                    Bij het klikken op deze optie kom je op de pagina waar je verkoper
                                                    kunt worden.<br>
                                                    Hier vul je vervolgens je IBAN. Hierna kom je op een pagina waar je
                                                    een verificatiecode moet invullen. Deze heb je ontvangen via een
                                                    transactie. <br>
                                                    Wanneer je een geldige verificatiecode hebt ingegeven
                                                    kun je veilingen plaatsen op de veilingsite.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-4-heading-2">
                                            <h5>
                                                <button class="btn btn-hulp" type="button" data-toggle="collapse"
                                                        data-target="#accordion-tab-4-content-2" aria-expanded="false"
                                                        aria-controls="accordion-tab-4-content-2">Hoe plaats ik een
                                                    veiling?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-4-content-2"
                                             aria-labelledby="accordion-tab-4-heading-2" data-parent="#accordion-tab-4">
                                            <div class="card-body">
                                                <p>Om een veiling te plaatsen moet je verkoper zijn. Weet je niet hoe
                                                    dit moet? Kijk dan even in het kopje 'Hoe kan ik een verkoper
                                                    worden?'<br>
                                                    Wanneer je een verkoper bent kun je op de accountknop klikken en het
                                                    kopje 'Nieuwe veiling' aanklikken. <br>
                                                    Op deze pagina kun je een nieuwe veiling aanmaken. De volgende
                                                    velden
                                                    moeten worden ingevuld: <br><br>
                                                    <strong>- Titel</strong><br>
                                                    &emsp;o Hier vul je de titel van de veiling in<br>
                                                    <strong>- Start prijs</strong><br>
                                                    &emsp;o Hier vul je het bedrag in waar de veiling mee moet
                                                    beginnen<br>
                                                    <strong>- Locatie</strong><br>
                                                    &emsp;o Hier vul je de locatie in waar het product zich bevindt<br>
                                                    <strong>- Verzendmethode</strong><br>
                                                    &emsp;o Hier geef je aan of het product wordt verzonden of moet
                                                    worden opgehaald<br>
                                                    <strong>- Looptijd</strong><br>
                                                    &emsp;o Hier geef je aan hoe lang de veiling op de veilingsite moet
                                                    blijven staan<br>
                                                    <strong>- Rubriek</strong><br>
                                                    &emsp;o Hier geef je aan in welke (sub)rubriek de veiling moet
                                                    worden geplaatst<br>
                                                    <strong>- Beschrijving</strong><br>
                                                    &emsp;o Hier vul je de beschrijving van de veiling in<br>
                                                    <strong>- Wil je deze veiling promoten?</strong><br>
                                                    &emsp;o Hier geef je aan of je de veiling wilt promoten (bovenaan
                                                    alle veilingen plaatsen)<br>
                                                    <strong>- Kies bestand</strong><br>
                                                    &emsp;o Hier moet je een foto van het te verkopen product
                                                    uploaden<br><br>
                                                    Wanneer je dit allemaal hebt ingegeven en je op de knop 'Maak
                                                    veiling aan' hebt geklikt wordt de veiling geplaatst.
                                                </p>
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
<div class="fixed-bottom">
    <?php
    include_once "includes/footer.php";
    ?>
</div>
</body>
</html>