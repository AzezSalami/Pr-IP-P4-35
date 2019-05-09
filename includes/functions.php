<?php
    //error_reporting(0);
    session_start();
    connectToDatabase();

    function cleanUpUserInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    function connectToDatabase() {
        $hostnaam = "51.38.112.111";
        $databasenaam = "themasite";
        $gebruikersnaam = "sa";
        $wachtwoord = "Hoi123!!";
        global $pdo;

        try {
            $pdo = new PDO ("sqlsrv:Server=$hostnaam;Database=$databasenaam;ConnectionPooling=0", "$gebruikersnaam", "$wachtwoord");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        } catch (PDOException $e) {
        }
    }

    function search(){

    }


?>