<!DOCTYPE html>
<html lang="en">
	<head>
        <?php include 'includes/head.html'; ?>
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
                        </div>
                    </div>
                    <div class="col-lg-8">
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
                                                <p>In de rechterbovenhoek van deze site kunt u een blauwe knop zien met
                                                    de aanduiding account.
                                                    Om uzelf te registeren moet u dan op de optie registeren kiezen.
                                                    Nadat U het registratieproces
                                                    voltooid heeft en geverifieerd hebt, heeft u een geldig account.</p>
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
                                                <p>- U kunt proberen opnieuw een mail te laten sturen, klik dan op
                                                    “stuur opnieuw”<br>
                                                    - Check of u het goede e-mail adres heeft ingevoerd.<br>
                                                    - Check uw spam. De e-mail kan daar beland zijn.</p>
                                                <p><strong>Let op: </strong>Soms duur het even voordat de mail binnen
                                                    is, wacht een paar minuten.</p>
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
                                                        aria-controls="accordion-tab-2-content-1">Hoe kan ik mijzelf
                                                    inloggen?
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="accordion-tab-2-content-1"
                                             aria-labelledby="accordion-tab-2-heading-1" data-parent="#accordion-tab-2">
                                            <div class="card-body">
                                                <p>In de rechterbovenhoek van deze site kunt u een blauwe knop zien met
                                                    de aanduiding account. Om
                                                    uzelf in te loggen moet u dan de optie inloggen kiezen. Hier voert
                                                    u het tijdens het registreren
                                                    gekozen e-mail adres of gebruikersnaam en wachtwoord.</p>
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
                                                    - Controleer of uw gebruikersnaam correct is. ( dit is niet
                                                    hoofdletter gevoelig)<br>
                                                    - Controleer of uw wachtwoord goed is.<br>
                                                    - Controleer of uw account al geverifieerd is.</p>
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
                                                <p>Als u uw wachtwoord vergeten bent, klik dan in het inlogvenster op
                                                    “wachtwoord resetten”.
                                                    U zal dan een mail ontvangen met daar in een link om uw wachtwoord
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
                                                <p>Als u een rubriek bekijkt kunt u een invoer veld selecteren, waarin
                                                    je het bedrag dat je wilt bieden
                                                    invult. Om het bod definitief te maken drukt u op de knop
                                                    “bieden”.</p>
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
                                                    - Uw internetverbinding was slecht op moment van bieden.<br>
                                                    - U bent niet ingelogd als verkoper of gebruiker.<br>
                                                    o Weet u niet hoe u moet inloggen ? --> Kijk dan bij het kopje
                                                    inloggen.<br>
                                                    o Weet u niet hoe u moet registreren? --> Kijk dan bij het kopje
                                                    registreren.</p>
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