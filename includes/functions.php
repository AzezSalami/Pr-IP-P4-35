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
        $databasenaam = "groep35";
        $gebruikersnaam = "iproject35";
        $wachtwoord = "iProject35";
        global $pdo;

        try {
            $pdo = new PDO ("sqlsrv:Server=$hostnaam;Database=$databasenaam;ConnectionPooling=0", "$gebruikersnaam", "$wachtwoord");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function search() {
        global $pdo;

        try {
            $query = "SELECT A.auction, name, description, price_start, amount, [file] FROM TBL_Auction A
    INNER JOIN TBL_Item I
        on A.item = I.item
    LEFT JOIN (SELECT auction, max(amount) AS amount FROM TBL_Bid group by auction) as B
    ON A.auction = B.auction
    LEFT JOIN (SELECT item, [file] FROM TBL_Resource WHERE sort_number IN (SELECT min(sort_number) FROM TBL_Resource GROUP BY item)) as R on I.item = R.item
WHERE ";
            $filters = array();
            $searchArray = explode(" ", (isset($_GET['search']) ? cleanUpUserInput($_GET['search']) : ""));

            foreach ($searchArray as $key => $word) {
                $query .= "name LIKE ?";
                if ($key < count($searchArray) - 1) {
                    $query .= " AND ";
                }
                $filters[] = "%$word%";
            }
            $searchStatement = $pdo->prepare($query);
            $searchStatement->execute($filters);
            $html = "<div class='row my-2'>";
            while ($recept = $searchStatement->fetch()) {
                $html .= "<div class='auction-article-small white col-lg m-2'>
<div class='row mt-3'>
									<div class='col'>
										<div class='col'><strong>" . $recept['name'] . "</strong></div>
									</div>
									<div class='col text-right'>
										<div class='col'><strong>" . ($recept['amount'] > $recept['price_start'] ? $recept['amount'] : $recept['price_start']) . "</strong></div>
									</div>
								</div>
								<div class='imageContainer row text-center'>
									<div>" . "<img class='mx-auto my-2' src='data:image/bmp;base64," . $recept['file'] . "'
										     alt='Afbeelding van veiling'>" .
                    "</div>
								</div>
								<div class='row mb-3'>
									<div class='col'>
										<div class='col'> Beschrijving:</div>
									</div>
									<div class='row mx-3'>
										<div class='col'> " . $recept['description'] . "</div>
									</div>
									<div class='col text-right'>
									<a href='veiling.php?id=" . $recept['auction'] . "'>
										<button class='btn btn-details'>Details</button>
									</a>
									</div>
								</div>
							</div>";


            }

            $html .= "</div>";
            echo $html;

        } catch (PDOException $e) {
            echo $e;
        }

    }


?>