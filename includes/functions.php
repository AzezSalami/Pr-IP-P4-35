<?php
set_time_limit(0);
//error_reporting(0);
session_start();
require 'vendor/autoload.php';
connectToDatabase();
deleteNotActiveAccount();
global $lastPage;
global $places;
$places = Algolia\AlgoliaSearch\PlacesClient::create(
    'plK904BLG7JJ',
    '551154e9c4e6dfefd99359b532faaa99'
);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

global $loginMessage;
function cleanUpUserInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function connectToDatabase()
{
    $hostname = "51.38.112.111";
    $databasename = "groep35test2";
    $username = "iproject35";
    $password = "iProject35";
    global $pdo;

    try {
        $pdo = new PDO ("sqlsrv:Server=$hostname;Database=$databasename;ConnectionPooling=0", "$username", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e;
    }

    try {
        $pdo = new PDO ("sqlsrv:Server=$hostname;Database=$databasename;ConnectionPooling=0", "$username", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e;
    }
}

function loadRubrics()
{

    echo "
                            <h2>Rubrieken</h2>";

    global $pdo;
    //$rubric = 0;
    $rubric = (isset($_GET['rubric']) && (($rubric = cleanUpUserInput($_GET['rubric'])) != "") != 0 ? $rubric : $rubric = -1);
    if ($rubric != -1) {
        $mainRubricQuery = $pdo->prepare("select * from TBL_Rubric where rubric = ?");
        $mainRubricQuery->execute(array($rubric));
        $mainRubric = $mainRubricQuery->fetch()['super'];
        echo "<button
        onclick=\"document.getElementById('rubricFilter').value = " . $mainRubric . "; document.getElementById('searchbutton').click();\"
        type=\"button\" class=\"btn  rubricButton btn-sidenav font-weight-bold\">Eén omhoog</button><br><br>";

    }

    $subRubricQuery = $pdo->prepare("select * from TBL_Rubric where super = ?");
    $subRubricQuery->execute(array($rubric));

    while ($subRubric = $subRubricQuery->fetch()) {
        echo "<button
        onclick=\"document.getElementById('rubricFilter').value = " . $subRubric['rubric'] . "; document.getElementById('searchbutton').click();\"
        type=\"button\" class=\"btn  rubricButton btn-sidenav\">" . $subRubric['name'] . "</button>";
    }
}

function search($amount = 0, $promoted_only = false)
{
    global $pdo;

    try {
        $query = "";
        if (isset($_GET['rubric']) && ($rubric = cleanUpUserInput($_GET['rubric'])) != "") {
            $query .= "
                    WITH subRubrics AS
                    (
                        SELECT rubric, name, super, sort_number
                        FROM TBL_Rubric
                        WHERE super = " . $rubric . "
                        UNION ALL
                        SELECT R.rubric, R.name, R.super, R.sort_number
                        FROM TBL_Rubric R
                        INNER JOIN subRubrics S ON
                            S.rubric = R.super
                    )";
        }
        $query .= "SELECT A.auction, name, description, price_start, amount, [file] FROM TBL_Auction A
                INNER JOIN TBL_Item I
                    on A.item = I.item
                LEFT JOIN (SELECT auction, max(amount) AS amount FROM TBL_Bid WHERE [user] is not null group by auction) as B
                ON A.auction = B.auction
                LEFT JOIN (SELECT item, [file] FROM TBL_Resource WHERE sort_number IN (SELECT min(sort_number) FROM TBL_Resource GROUP BY item)) as R on I.item = R.item
                WHERE " . (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] ? "is_closed != 1" : "is_closed = 0") . " AND ";
        if (isset($_GET['rubric']) && ($rubric = cleanUpUserInput($_GET['rubric'])) != "") {
            $query .= "I.item in (SELECT item from TBL_Item_In_Rubric WHERE rubric in (
                    SELECT rubric
                    FROM subRubrics) OR rubric = " . $rubric . ") AND ";
        }
        if (isset($_GET['minPrice']) && ($minPrice = cleanUpUserInput($_GET['minPrice'])) != "" && is_numeric($minPrice) && ((float)$minPrice) >= 0) {
            $query .= "(amount > $minPrice OR price_start > $minPrice) AND ";
        }
        if (isset($_GET['maxPrice']) && ($maxPrice = cleanUpUserInput($_GET['maxPrice'])) != "" && is_numeric($maxPrice) && ((float)$maxPrice) >= 0) {
            $query .= "((amount < $maxPrice OR amount is null) AND price_start < $maxPrice) AND ";
        }
        if (isset($_SESSION['username']) && isset($_GET['maxDistance']) && ($maxDistance = cleanUpUserInput($_GET['maxDistance'])) != "" && is_numeric($maxDistance) && ((float)$maxDistance) >= 0) {
            $maxDistance *= 1000;
            $query .= "$maxDistance >= geolocation.STDistance((select geolocation from TBL_User where [user] = '" . $_SESSION['username'] . "')) AND ";
        }
        $query .= ($promoted_only ? "is_promoted = 1 AND " : "");

        $searchArray = explode(" ", (isset($_GET['search']) ? cleanUpUserInput($_GET['search']) : ""));
        $filters = array();

        foreach ($searchArray as $key => $word) {
            $query .= "CONCAT(name, ' ', description) LIKE ?";
            if ($key < count($searchArray) - 1) {
                $query .= " AND ";
            }
            $filters[] = "%$word%";
        }
        $query .= " ORDER BY moment_end DESC
                    OFFSET " . ($amount > 0 ? $amount * ((isset($_GET['page']) && ($page = cleanUpUserInput($_GET['page'])) > 1 ? $page : 1) - 1) : "0") . " ROWS";
        $query .= ($amount > 0 ? " FETCH FIRST $amount ROWS ONLY" : "");
        //echo $query;
        $searchStatement = $pdo->prepare($query);
        $searchStatement->execute($filters);
        echo "<div class='row my-2'>";
        $amountOfAuctions = 0;
        $searchResults = $searchStatement->fetchAll();
        foreach ($searchResults as $auction) {
            $amountOfAuctions++;
            echo "<div class='auction-article-" . ($promoted_only ? "large" : "small") . " white col-lg m-2'>
                    <div class='row mx-1 mt-3'>
                        <div class='col'>
										<div><strong>€" . ($auction['amount'] > $auction['price_start'] ? $auction['amount'] : $auction['price_start']) . "</strong></div>
										<div><strong>" . $auction['name'] . "</strong></div>		
						</div>					
                    </div>
					<div class='imageContainer row text-center'>
                        <div>" . "<img class='mx-auto my-2' src='data:image/png;base64," . base64_encode($auction['file']) . "'
                                                 alt='Afbeelding van veiling'>" .
                "</div>
					</div>
					<div class='row mx-2 mb-3'>
					    <div class='font-weight-bold mb-2'> Beschrijving:</div>
						<div class=' article-description'>" . $auction['description'] . "</div>
						<div class='col text-right'>
                            <a href='veilingen_details.php?auction=" . $auction['auction'] . "'>
                                <button class='btn mt-2'>Details</button>
                            </a>
						</div>
					</div>
				</div>";


        }
        if ($amountOfAuctions < $amount) {
            global $lastPage;
            $lastPage = true;
        }
        echo "</div>";

    } catch (PDOException $e) {
        echo $e;
    }
}

function login()
{
    global $loginMessage;
    if (isset($_POST['login'])) {
        global $pdo;
        $username = cleanUpUserInput(strtolower($_POST['username']));
        $password = cleanUpUserInput($_POST['password']);

        $canLogin = true;
        if ($username == "" || $password == "") {
            $loginMessage = "Vul een gebruikersnaam en een wachtwoord in<br><br>";
            $canLogin = false;
        }

        $sql = "SELECT [user],password, is_verified, is_admin,  is_blocked, is_seller FROM TBL_User WHERE [user]=:user and password = :password";
        $login_query = $pdo->prepare($sql);
        $login_query->execute(array(':user' => $username, ':password' => hash('sha1', $password)));
        $result = $login_query->fetch();

        if ($result['is_blocked'] == 1) {
            $loginMessage = "Uw account is geblokkeerd<br>";
            $canLogin = false;
        }
        if ($result['is_verified'] == 0) {
            $loginMessage = "Verifieer uw account eerst<br>";
            $canLogin = false;
        }

        if ($result['user'] != $username) {
            $loginMessage = "Wachtwoord of gebruikersnaam incorrect<br>";
            $canLogin = false;
        }
        if ($canLogin) {
            $_SESSION["username"] = $username;
            $_SESSION['is_admin'] = (int)$result['is_admin'];
            $_SESSION['is_seller'] = (int)$result['is_seller'];

        }
    }
}

function logout()
{
    if (isset($_GET["logout"]) && isset($_SESSION)) {
        $_SESSION = array();
        session_destroy();
        //unset($_GET);
        header("location: index.php");
    }
}

function isPasswordGood($password)
{
    $result = true;
    if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
        echo "Een wachtwoord moet uit minimaal 8 karakters bestaan<br>
                      en moet minimaal 1 letter en 1 cijfer bevatten<br>";
        $result = false;
    }
    return $result;
}

function register()
{
    if (isset($_POST['make_account'])) {
        global $pdo;
        $email = cleanUpUserInput($_POST['email']);
        $regPassword = cleanUpUserInput($_POST['reg_password']);
        $confirm_password = cleanUpUserInput($_POST['confirm_password']);
        $firstname = cleanUpUserInput($_POST['firstname']);
        $lastname = cleanUpUserInput($_POST['lastname']);
        $regUsername = cleanUpUserInput(strtolower($_POST['reg_username']));
        $address = cleanUpUserInput($_POST['address']);
        $telephone_number = cleanUpUserInput($_POST['telephone_number']);

        $is_mobile = cleanUpUserInput((isset($_POST['is_mobile'])) ? $_POST['is_mobile'] : 0);

        if (empty($email) || empty($regPassword) || empty($firstname) || empty($lastname) || empty($regUsername)) {
            echo "Velden met een * zijn verplicht";
        }


        $regQuery = $pdo->prepare("Select * from TBL_User where email = ? OR [user] = ?");
        $regQuery->execute(array($email, $regUsername));
        $canRegister = true;
        while ($row = $regQuery->fetch()) {
            if ($row['email'] == $email) {
                echo 'Dit e-mail adres is al in gebruik<br>';
                echo "<script>document.getElementById('openRegister').click();</script>";
                $canRegister = false;
            }
            if ($row['user'] == $regUsername) {
                echo 'De gebruikersnaam: ' . $regUsername . ' is al in gebruik, probeer een andere<br>';
                echo "<script>document.getElementById('openRegister').click();</script>";
                $canRegister = false;
            }
        }
        if (!isPasswordGood($regPassword)) {
            $canRegister = false;
        }

        if (strlen($telephone_number) < 10 || !preg_match("/([0-9]){10}/", $telephone_number)) {
            echo "Een telefonnummer moet uit minimaal 10 cijfers bestaan<br>";
            $canRegister = false;
        }

        if ($canRegister) {
            if ($confirm_password != $regPassword) {
                echo 'Zorg dat beide wachtwoorden hetzelfde zijn';
            } else {
                $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$()*';
                $token = str_shuffle($token);
                $token = substr($token, 0, 10);
                global $places;
                $result = $places->search($address);
                $coords = $result['hits'][0]['_geoloc'];

                $sql = "INSERT INTO TBL_User ([user],firstname,lastname,address_line_1,email,password ,verification_code, verification_code_valid_until, geolocation) values (?,?,?,?,?,?,?, GETDATE() + DAY(7), geography::Point(?, ?, 4326))";
                $query = $pdo->prepare($sql);
                $query->execute(array($regUsername, $firstname, $lastname, $address, $email, hash('sha1', $regPassword), $token, $coords['lat'], $coords['lng']));
                $phoneQuery = $pdo->prepare(" INSERT INTO TBL_Phone ([user],phone_number,is_mobile) values (?,?,?)");

                $phoneQuery->execute(array($regUsername, $telephone_number, ($is_mobile ? 1 : 0)));

                $subject = "Verifieer je e-mail!";
                $text = "
                    Beste heer of mevrouw $lastname,<br><br>
                    
                    Klik op de link hieronder om je registratie te voltooien.<br>
                    <a href='http://localhost/Pr-IP-P4-35/index.php?email=$email&token=$token'>Klik hier om je registratie te voltooien</a><br><br>
                    
                    Of plak onderstaande link in je browser:<br>
                    http://localhost/Pr-IP-P4-35/index.php?email=$email&token=$token<br><br>
                    
                    Als je geen account aan heeft gemaakt op onze website, kun je deze e-mail negeren.<br><br>
                    
                    Met vriendelijke groet,<br><br>
                    
                    Het team van Eenmaal Andermaal
                ";
                sendEmail($email, $regUsername, $subject, $text);
                echo "<p style=\"color: green;\">Er is een bevestigingsmail naar $email verstuurd,<br>klik op de bevestigingslink in de email om je registratie te voltooien .</p>";
            }
        }
        echo "<script>document.getElementById('openRegister').click();</script>";
    }
}

function confirm()
{
    global $pdo;
    if (isset($_GET['email']) && isset($_GET['token'])) {
        $email = cleanUpUserInput($_GET['email']);
        $token = cleanUpUserInput($_GET['token']);

        try {
            $sql = $pdo->prepare("SELECT email,verification_code ,verification_code_valid_until FROM TBL_User WHERE email=:email AND verification_code=:token AND is_verified=0 AND DATEDIFF(second, GETDATE(), verification_code_valid_until) > 0 ");
            $sql->execute(array(':email' => $email, ':token' => $token));
        } catch (PDOException $e) {
            echo $e;
        }


        $confirm = array();
        $confirm = $sql->fetch();
        if (isset($confirm['email']) && $confirm['email'] == $email) {
            try {
                $sql = $pdo->prepare("UPDATE TBL_User SET is_verified = 1, verification_code = null, verification_code_valid_until = null WHERE email=?");
                $sql->execute(array($email));
                echo '<p style="color: green;">Je account is geverifieerd, je kunt nu inloggen.</p>';
            } catch (PDOException $e) {
                echo $e;
            }
        } else {
            echo 'verificatiecode is niet geldig.';
        }
        echo "<script>document.getElementById('openLogin').click();</script>";
    }
}

function placeholderAccountData($input)
{
    $msg = "";
    global $pdo;
    $table = "TBL_User";
    if (array_key_exists("username", $_SESSION)) {

        if ($input == "phone_number") {
            $table = "TBL_Phone";
        }
        if (!empty($_SESSION["username"])) {
            $username = $_SESSION["username"];
            $sql = $pdo->prepare("SELECT * FROM $table WHERE [user]=?");
            $sql->execute(array($username));
            $msg = $sql->fetch()[$input];
        }
    }
    echo $msg;
}

function updateAccountData()
{
    if (isset($_POST['reset'])) {
        $username = $_SESSION["username"];
        global $pdo;
        $cur_password = cleanUpUserInput($_POST['cur_password']);
        $resPassword = cleanUpUserInput($_POST['reset_password']);
        $resconfirm_password = cleanUpUserInput($_POST['resconfirm_password']);
        $firstname = cleanUpUserInput($_POST['firstname']);
        $lastname = cleanUpUserInput($_POST['lastname']);
        $address = cleanUpUserInput($_POST['address']);
        $telephone_number = cleanUpUserInput($_POST['telephone_number']);
        $array = array();

        $values = "";
        if (!empty($firstname)) {
            $values .= "firstname = ?";
            $array[] = $firstname;

        }
        if (!empty($lastname)) {
            if (!empty($firstname)) {
                $values .= ", ";
            }
            $values .= "lastname = ?";
            $array[] = $lastname;
        }

        if (!empty($address)) {
            if (!empty($firstname) || !empty($lastname)) {
                $values .= ", ";
            }
            $values .= "address_line_1 = ?, ";
            $array[] = $address;
            global $places;
            $result = $places->search($address);
            $coords = $result['hits'][0]['_geoloc'];
            $values .= "geolocation = geography::Point(?, ?, 4326)";
            $array[] = $coords['lat'];
            $array[] = $coords['lng'];
        }

        $password_check = false;
        if (!empty($resPassword)) {
            if (isPasswordGood($resPassword)) {
                if ($resPassword != $resconfirm_password) {
                    echo 'Zorg dat beide wachtwoorden hetzelfde zijn';

                } else {
                    try {
                        $sql = "SELECT [user],password FROM TBL_User WHERE [user]=:username and password = :password";
                        $reset_query = $pdo->prepare($sql);
                        $reset_query->execute(array(':username' => $username, ':password' => hash('sha1', $cur_password)));
                        $result = $reset_query->fetch();
                        if ($result['password'] == hash('sha1', $cur_password)) {
                            if (!empty($firstname) || !empty($lastname) || !empty($address)) {
                                $values .= ", ";
                            }
                            $values .= "password = ?";
                            $password_check = true;
                            $array[] = hash('sha1', $resPassword);
                        } else {
                            echo 'Huidige wachtwoord is incorrect';
                        }
                    } catch (PDOException $e) {
                        echo $e;
                    }
                }
            }
        }
        if (!empty($telephone_number)) {
            if (strlen($telephone_number) != 10 || !preg_match("/([0-9]){10}/", $telephone_number)) {
                echo "Een telefonnummer moet uit minimaal 10 cijfers bestaan<br>";
            } else {
                try {
                    $sql = "update TBL_Phone SET phone_number = :telephone_number WHERE [user] = :username";
                    $query = $pdo->prepare($sql);
                    $query->execute(array(':telephone_number' => $telephone_number, ':username' => $username));
                    echo '<p class="text-success">jouw gegevens zijn geüpdatet </p>';
                } catch (PDOException $e) {
                    echo $e;
                }
            }
        }
        if (!empty($firstname) || !empty($lastname) || !empty($address) || $password_check) {
            echo '<p class="text-success">jouw gegevens zijn geüpdatet</p>';
            $sql = "update TBL_User SET " . $values . " WHERE [user] = '$username'";
            $query = $pdo->prepare($sql);
            $query->execute($array);
        }
    }

}

function resetPasswordEmail()
{
    if (isset($_POST['pwdforgottensubmit'])) {
        $email = $_POST['pwdforgottenemail'];
        global $pdo;
        $query = $pdo->prepare("select count(user) from TBL_User where email = :email and is_verified = 1");
        $query->execute(array(':email' => $email));
        $data = $query->fetch();

        if ($data[0][0] == 0) {
            echo "Emailadres bestaat niet";
        } else {
            sendResetPasswordEmail($email);
            echo '<p style="color: green;">Er is een email naar je opgegeven adres gestuurd!</p>';
        }
        echo "<script>document.getElementById('openforgetpassword').click();</script>";
    }
}

function sendResetPasswordEmail($email)
{
    global $pdo;
    $query = $pdo->prepare("select * from TBL_User where email = :email");
    $query->execute(array(':email' => $email));
    $data = $query->fetch();
    $regUsername = $data['user'];
    $lastname = $data['lastname'];

    $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$()*';
    $token = str_shuffle($token);
    $token = substr($token, 0, 10);
    $query = $pdo->prepare("update TBL_User set verification_code =:token, verification_code_valid_until = GETDATE() + DAY(7) where email = :email");
    $query->execute(array(':token' => $token, ':email' => $email));

    $subject = "Wachtwoord opnieuw instellen";
    $text = "
                    Geachte heer of mevrouw $lastname,<br><br>

                    Klik op de link hieronder om je wachtwoord opnieuw in te stellen.<br>
                    <a href='http://localhost/iproject/wachtwoordresetten.php?email=$email&verification=$token'>Klik hier om je wachtwoord opnieuw in te stellen</a><br><br>

                    Of plak onderstaande link in je browser:
                    http://localhost/iproject/wachtwoordresetten.php?email=$email&verification=$token<br>
                    <br><br>

                    Als je geen account aan hebt gemaakt op onze website, kun je deze e-mail negeren.<br><br>

                    Met vriendelijke groet,<br><br>

                    Het team van Eenmaal Andermaal
                ";
    sendEmail($email, $regUsername, $subject, $text);
}

function verificatiecodeEmail()
{
    if (isset($_POST['resendCode'])) {
        $email = $_POST['resendCode_emailadres'];
        global $pdo;
        $query = $pdo->prepare("select * from TBL_User where email = :email");
        $query->execute(array(':email' => $email));
        $data = $query->fetch();
        if ($data['is_verified'] == 1) {
            echo "Emailadres is al geverifieerd";
        } else {
            if ($data['email'] == $email) {
                sendVerificatiecodeEmail($email);
                echo '<p style="color: green;">Er is een email naar je opgegeven adres gestuurd!</p>';
            } else {
                echo "Emailadres bestaat niet";
            }
        }
        echo "<script>document.getElementById('openResendCodeMenu').click();</script>";
    }
}

function sendVerificatiecodeEmail($email)
{
    global $pdo;
    $query = $pdo->prepare("select * from TBL_User where email = :email");
    $query->execute(array(':email' => $email));
    $data = $query->fetch();
    $regUsername = $data['user'];
    $lastname = $data['lastname'];

    $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$()*';
    $token = str_shuffle($token);
    $token = substr($token, 0, 10);


    $query = $pdo->prepare("update TBL_User set verification_code =:token, verification_code_valid_until = GETDATE() + DAY(7) where email = :email");
    $query->execute(array(':token' => $token, ':email' => $email));

    $subject = "Verifieer je e-mail!";
    $text = "
                    Geachte heer of mevrouw $lastname,<br><br>
                    
                    Klik op de link hieronder om je registratie te voltooien.<br>
                    <a href='http://localhost/Pr-IP-P4-35/index.php?email=$email&token=$token'>Klik hier om je registratie te voltooien</a><br><br>
                    
                    Of plak onderstaande link in je browser:<br>
                    http://localhost/Pr-IP-P4-35/index.php?email=$email&token=$token<br><br>
                    
                    Als u geen account aan heeft gemaakt op onze website, kunt u deze e-mail negeren.<br><br>
                    
                    Met vriendelijke groet,<br><br>
                    
                    Het team van Eenmaal Andermaal
                ";
    sendEmail($email, $regUsername, $subject, $text);
}

function sendEmail($email, $username, $subject, $text)
{
    require "PHPMailer/PHPMailer.php";
    require "PHPMailer/Exception.php";
    require "PHPMailer/SMTP.php";
    $mail = new PHPMailer();
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com	';
        $mail->SMTPAuth = true;
        $mail->Username = 'eenmaalandermaal35@gmail.com';
        $mail->Password = 'andermaaleenmaal35';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('eenmaalandermaal35@gmail.com');
        $mail->addAddress($email, $username);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $text;
        $mail->send();

    } catch (Exception $e) {
        echo "Er is iets misgegaan, probeer het opnieuw<br>
                              Error: {$mail->ErrorInfo}";
    }
}

function placeNewBid($auctionid, $newPrice, $username)
{
    global $pdo;

        try {
            $query = $pdo->prepare("select max(amount) as amount from TBL_Bid where auction = ? and user is not null group by auction");
            $query->execute(array($auctionid));
            $sameBids = $query->fetch();
if(empty($sameBids)){
    $sameBids = array('amount' => )
}
            if ($sameBids['amount'] < $newPrice) {
                if ($sameBids['amount'] < 1) {
                    $buttonvalue = 0.50;
                } else if ($sameBids['amount'] <= 5) {
                    $buttonvalue = 1;
                } else if ($sameBids['amount'] <= 10) {
                    $buttonvalue = 5;
                } else if ($sameBids['amount'] <= 50) {
                    $buttonvalue = 10;
                } else {
                    $buttonvalue = 50;
                }
                if($newPrice-$sameBids['amount'] == $buttonvalue || $newPrice-$sameBids['amount'] == $buttonvalue*2 || $newPrice-$sameBids['amount'] == $buttonvalue*3) {
                    $query = $pdo->prepare("insert into TBL_Bid values (?, ?, ?, getDate())");
                    $query->execute(array($auctionid, $newPrice, $username));
                } else{
                    echo "Er is iets mis gegaan, probeer het opnieuw";
                    echo $sameBids . "s<br>";echo $buttonvalue . "b<br>";
                    echo $newPrice;
                }
            }

        } catch (PDOException $e) {
            echo $e;
        }
    }

function createAuction()
{
    if (isset($_SESSION["username"])) {
        if (isset($_POST['createAuction'])) {
            // var_dump($_POST);
            global $pdo;
            $name = cleanUpUserInput($_POST['name']);
            $description = cleanUpUserInput($_POST['description']);
            $price_start = cleanUpUserInput($_POST['price_start']);
            $shipping_instructions = (cleanUpUserInput($_POST['shipping_instructions']) == 'Verzenden' ? 'Verzenden' : 'Ophalen');
            $shipping_cost = ($shipping_instructions == "Verzenden" && !empty(cleanUpUserInput($_POST['shipping_cost'])) ? cleanUpUserInput($_POST['shipping_cost']) : 0);
            $durationOptions = array(1, 3, 5, 7, 10);
            $duration = (in_array(cleanUpUserInput($_POST['duration']), $durationOptions) ? cleanUpUserInput($_POST['duration']) : 0);
            $address = cleanUpUserInput($_POST['location']);
            $seller = $_SESSION["username"];
            $is_promoted = cleanUpUserInput((isset($_POST['is_mobile'])) ? $_POST['is_mobile'] : 0);
            $rubric_post = cleanUpUserInput($_POST['rubriek']);
            if (is_array($rubric_post)) {
                $rubric = end($rubric_post);
            } else {
                $rubric = $rubric_post;
            }

            if (getimagesize($_FILES['image']["tmp_name"]) == false || getimagesize($_FILES['image']["tmp_name"])["mime"] == "image/jpg") {
                echo "Geen geldig beeld";
            } else {
                $media_type = getimagesize($_FILES['image']["tmp_name"])["mime"];
                if (empty($name) || empty($description) || empty($shipping_instructions) || empty($address)) {
                    echo "Alle velden zijn verplicht";
                } else {
                    echo "jaa";
                    try {
                        $itemquery = $pdo->prepare("INSERT INTO TBL_Item( name, description, price_start,shipping_cost ,shipping_instructions ,address_line_1 ) VALUES(?,?,?,?,?,?)");
                        $itemquery->execute(array($name, $description, $price_start, $shipping_cost, $shipping_instructions, $address));
                    } catch (PDOException $e) {
                        echo $e;
                    }
                    $item = "";
                    try {
                        $item_select_query = $pdo->prepare("SELECT item FROM TBL_Item WHERE name = ? AND description = ? AND price_start = ? AND shipping_cost= ? AND shipping_instructions= ? AND address_line_1= ?");
                        $item_select_query->execute(array($name, $description, $price_start, $shipping_cost, $shipping_instructions, $address));
                        $item_select_result = $item_select_query->fetch();

                        $item = $item_select_result['item'];
                    } catch (PDOException $e) {
                        echo $e;
                    }
                    try {
                        $rubricquery = $pdo->prepare("INSERT INTO TBL_Item_In_Rubric( item ,rubric) VALUES(?,?)");
                        $rubricquery->execute(array($item, $rubric));
                    } catch (PDOException $e) {
                        echo $e;
                    }
                    try {
                        $auctionquery = $pdo->prepare("INSERT INTO TBL_Auction( seller, item ,moment_end , is_promoted) VALUES(:seller,:item,GETDATE() + DAY(:duration), :is_promoted)");
                        $duration = (int)$duration;
                        $auctionquery->bindParam(':duration', $duration, PDO::PARAM_INT);
                        $auctionquery->bindParam(':seller', $seller, PDO::PARAM_STR);
                        $auctionquery->bindParam(':item', $item, PDO::PARAM_INT);
                        $auctionquery->bindParam(':is_promoted', $is_promoted, PDO::PARAM_BOOL);
                        $auctionquery->execute();
                    } catch (PDOException $e) {
                        echo $e;
                    }
                    try {
                        $img = addslashes(file_get_contents($_FILES['image']["tmp_name"]));
                        //echo "<br>" . ;
                        $img = iconv(mb_detect_encoding($img), 'UTF-8//IGNORE', $img);
                        $data = base64_encode($img);

                        $blob = mb_convert_encoding(fopen($_FILES['image']["tmp_name"], 'rb'), 'UTF-16', 'UTF-8');

                        $hex = unpack("H*", file_get_contents($_FILES['image']["tmp_name"]));
                        $hex = current($hex);
                        $chars = pack("H*", $hex);
                        //echo base64_encode($chars);

                        $imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                        $imageProperties = getimageSize($_FILES['image']['tmp_name']);


                        $resourcequery = $pdo->prepare("INSERT INTO TBL_Resource(item , [file] ,media_type, sort_number) VALUES(:item, CONVERT( VARBINARY(MAX),:image) ,:media_type,0)");
                        $resourcequery->bindParam(':image', $imgData, PDO::PARAM_LOB);
                        $resourcequery->bindParam(':item', $item, PDO::PARAM_INT);
                        $resourcequery->bindParam(':media_type', $media_type, PDO::PARAM_STR);
                        $resourcequery->execute();
                    } catch (PDOException $e) {
                        echo $e;
                    }

                }
            }
        }
    } else {
        echo "Je moet ingelogd zijn";
    }
}

function deleteNotActiveAccount()
{
    global $pdo;
    $sql = $pdo->prepare("DELETE FROM TBL_User WHERE DATEDIFF(second, GETDATE(), verification_code_valid_until) <= 0 AND is_verified = 0");
    $sql->execute();
}

function sendSellerVerification($username)
{

    //supposedly a banktransaction should occur here which includes the code in its description

    if (isset($_POST['sendVerification'])) {

        global $pdo;

        $bankNumber = $_POST['bankNumber'];

        $newSellerQuery = $pdo->prepare('INSERT INTO TBL_Seller ([user], bank_account, verification_status) VALUES (?, ?, 0)');
        $newSellerQuery->execute(array($username, $bankNumber));

        $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$()*';
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);

        $verificationQuery = $pdo->prepare('UPDATE TBL_Seller SET verification_code = ?,
verification_code_valid_until = GETDATE() + MONTH(1) WHERE [user] = ?');
        $verificationQuery->execute(array($token, $username));
    }
}

function checkSellerVerification($username)
{

    if (isset($_POST['submitVerification'])) {

        global $pdo;

        $submittedCode = $_POST['vericode'];

        $checkCodeQuery = $pdo->prepare('SELECT * FROM TBL_Seller WHERE [user] = ? AND verification_code_valid_until > GETDATE()');
        $checkCodeQuery->execute(array($username));
        $checkCodeData = $checkCodeQuery->fetchAll();

        if (sizeof($checkCodeData) == 0) {

            echo 'verificatiecode is niet meer geldig';

        } else {

            $checkCodeQuery->execute(array($username));
            $checkCodeData = $checkCodeQuery->fetch();
            $verificationCode = $checkCodeData['verification_code'];

            if ($submittedCode == $verificationCode) {

                $setSellerQuery = $pdo->prepare('UPDATE TBL_User SET is_seller = 1 WHERE [user] = ?');
                $setSellerQuery->execute(array($username));
                $setVerifiedQuery = $pdo->prepare('UPDATE TBL_Seller SET verification_status = 1 WHERE [user] = ?');
                $setVerifiedQuery->execute(array($username));

                $_SESSION['is_seller'] = 1;

            } else {

                echo 'code is fout';

            }

        }

    }

}

function canSendNewCode($username)
{

    global $pdo;

    $isSellerQuery = $pdo->prepare('SELECT * FROM TBL_Seller WHERE [user] = ?');
    $isSellerQuery->execute(array($username));
    $isSellerData = $isSellerQuery->fetchAll();

    if (sizeof($isSellerData) == 0) {

        /* if the user isnt a seller yet, he should always be able to request a code */
        return true;

    } else {

        $beenSentQuery = $pdo->prepare('SELECT * FROM TBL_Seller WHERE [user] = ? AND verification_status = 0
                                                  AND verification_code_valid_until < GETDATE()');
        $beenSentQuery->execute(array($username));
        $beenSentData = $beenSentQuery->fetchAll();

        if (sizeof($beenSentData) == 1) {

            /* the code has expired, user should request a new code */
            return true;
        } else {
            return false;
        }
    }
}

?>