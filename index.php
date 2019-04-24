<?php
$hostname = "51.38.112.111";                // naam van server
$dbname = "groep35";                    // naam van database
$gebruikersnaam = "iproject35";            // gebruikersnaam
$pw = "iProject35";                     //wachtwoord

try {
    $dbh = new PDO ("sqlsrv:Server=$hostname;Database=$dbname;
                ConnectionPooling=0", "$gebruikersnaam", "$pw");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}

$query = $dbh->query('SELECT * FROM TBL_Rubriek');
while ($r = $query->fetch()) {
    echo $r['rubrieknummer '];

}


//echo '<pre>';
//print_r(PDO::getAvailableDrivers());
//echo '</pre>';
?>