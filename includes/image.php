
<!--    N. Eenink, A. Salami, I. Hamoudi            -->
<!--    M. Vermeulen, D. Haverkamp & J. van Vugt    -->
<!--    HAN ICA HBO ICT - IProject, 13-06-2019      -->

<?php
header("Content-Type: image/png");
require_once "functions.php";
connectToDatabase();

if (isset($_GET['item'])){
    $item = $_GET['item'] ;
    global $pdo;
    $query = $pdo->prepare("SELECT [file] FROM TBL_Resource WHERE sort_number in (SELECT min(sort_number) FROM TBL_Resource WHERE item = ? GROUP BY item) AND item =?");
    $query->execute(array($item, $item));
    $data = $query->fetch();
    echo /*"<img src='data:image/png;base64," . base64_encode(*/$data['file']/*) . ">"*/;
}

?>