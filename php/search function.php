<?php

include 'database_verbinding';

if(isset($_GET['searchbutton'])) {

    $zoekNaam = "%{$_GET['search']}%";

    $sql1 = "select gebruikersnaam from discussie where bericht like ?";
    $query1 = $dbo->prepare($sql1);
    $query1->execute(array($zoekNaam));

    $sql2 = "select bericht from discussie where bericht like ?";
    $query2 = $dbo->prepare($sql2);
    $query2->execute(array($zoekNaam));

    $sql3 = "select onderwerp from discussie where bericht like ?";
    $query3 = $dbo->prepare($sql3);
    $query3->execute(array($zoekNaam));

    $sql4 = "select datum from discussie where bericht like ?";
    $query4 = $dbo->prepare($sql4);
    $query4->execute(array($zoekNaam));

    $gebruikersnamen = $query1->fetchAll();
    $berichten = $query2->fetchAll();
    $onderwerpen = $query3->fetchAll();
    $datums = $query4->fetchAll();

    if (empty($berichten)) {
        echo 'Geen zoek resultaat gevonden.';
    } else {
        //zoekresultaten
    }
}

function zoekOpTags($soortZoekopdracht, $aantal = 0) {
    if (!isset($_GET['rID'])) {
        global $pdo;
        try {
            $query = "SELECT ";
            if ($aantal) {
                $query .= "top(" . $aantal . ")";
            }
            $query .= " * FROM " . $soortZoekopdracht;
            $filters = array();
            if (isset($_POST['filters'])) {
                foreach ($_POST['filters'] as $filter) {
                    $filters[] = schoonGebruikersInputOp($filter);
                }
                $queryDeelTwee = array();
                for ($i = 0; $i < count($filters); $i++) {
                    $queryDeelTwee[] = '?';
                }
                if (!empty($queryDeelTwee)) {
                    if ($soortZoekopdracht == "recepten") {
                        $query .= " WHERE recept_id IN (SELECT recept_id FROM receptFilters WHERE filter IN (" .
                            implode(', ', $queryDeelTwee) . ") GROUP BY recept_id HAVING COUNT(recept_id) = " . count($filters) . ")";
                    } else {
                        $query .= " WHERE video_id IN (SELECT video_id FROM videoFilters WHERE filter IN (" .
                            implode(', ', $queryDeelTwee) . ") GROUP BY video_id HAVING COUNT(video_id) = " . count($filters) . ")";
                    }
                }
            }
            if (isset($_POST['zoekText']) and ($zoekText = schoonGebruikersInputOp($_POST['zoekText'])) != "") {
                $zoekArray = explode(" ", $zoekText);
                if ($soortZoekopdracht == "recepten") {
                    if (isset($_POST['filters'])) {
                        $query .= " AND ";
                    } else {
                        $query .= " WHERE ";
                    }
                    foreach ($zoekArray as $key => $woord) {
                        $query .= "receptnaam LIKE ?";
                        if ($key < count($zoekArray) - 1) {
                            $query .= " AND ";
                        }
                        $filters[] = "%" . $woord . "%";
                    }
                } else {
                    if (isset($_POST['filters'])) {
                        $query .= " AND ";
                    } else {
                        $query .= " WHERE ";
                    }
                    foreach ($zoekArray as $key => $woord) {
                        $query .= "titel LIKE ?";
                        if ($key < count($zoekArray) - 1) {
                            $query .= " AND ";
                        }
                        $filters[] = "%" . $woord . "%";
                    }
                }
            }
            $zoekStatement = $pdo->prepare($query);
            $zoekStatement->execute($filters);
            if ($soortZoekopdracht == "recepten") {
                $html = "<h1>Recepten</h1><div>";
                while ($recept = $zoekStatement->fetch()) {
                    $html .=
                        "<article>
                            <a href='recepten.php?rID=" . $recept['recept_id'] . "'>" .
                        "<img src='images/recipes/afb" . $recept['recept_id'] . ".png' alt='Een afbeelding van " . $recept['receptnaam'] . "'>" .
                        "</a>
                            <h4>" . $recept['receptnaam'] . "</h4>
                         </article>";
                }
            } else {
                $html = "<div>";
                while ($video = $zoekStatement->fetch()) {
                    $html .=
                        "<article>
                            <a href='http://www.youtube.com/embed/" . $video['link'] . "' target='videoFrame'>" .
                        "<img src='" . $video['poster'] . ".jpg' alt='Een afbeelding van " . $video['titel'] . "'>" .
                        "</a>
                             <h4>" . $video['titel'] . "</h4>
                             <div>"
                        . $video['samenvatting'] .
                        "</div>
                             <span> publicatiedatum: " .
                        gmdate("d-m-Y", $video['gepubliceerd']) . "
                             </span>
                         </article>";
                }
            }
            $html .= "</div>";
            echo $html;

        } catch (PDOException $e) {
            echo "<div class='error_message'>er is iets mis gegaan bij het laden van de recepten</div>";
        }
    }
}
?>