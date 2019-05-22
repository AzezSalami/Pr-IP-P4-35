<?php
set_time_limit(0);
//error_reporting(0);
session_start();
connectToDatabase();

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
}

function loadRubrics()
{

    echo "<h2>Filters</h2><br>
                            <p class=\"font-weight-bold mb-0\">Rubrieken:</p>";

    global $pdo;
    //$rubric = 0;
    $mainRubricsQuery = $pdo->prepare("select * from TBL_Rubric where super = " . (isset($_GET['rubric']) && (($rubric = cleanUpUserInput($_GET['rubric'])) != "") != 0 ? $rubric : "-1"));
    $mainRubricsQuery->execute();
    while ($mainRubric = $mainRubricsQuery->fetch()) {
        echo
            "<div class=\"btn-group dropright\">
                        <button onclick=\"document.getElementById('rubricFilter').value = " . $mainRubric['rubric'] . "; document.getElementById('searchbutton').click();\" type=\"button\" class=\"btn btn-sidenav\">" . $mainRubric['name'] . "</button>
                        <button type=\"button\" class=\"btn dropdown-toggle dropdown-toggle-split toggle-sidenav\" data-toggle=\"dropdown\"
                                aria-haspopup=\"true\" aria-expanded=\"false\">
                            <!--<span class=\"sr-only\">hoofdrubriek 1</span>-->
                        </button>
                        <div class=\"dropdown-menu r-content bg-gray px-2\">
                            <div class=\"container\">
                            <div class=\"mr-1 mb-2\">";

        $subRubricsQuery = $pdo->prepare("select * from TBL_Rubric where super = " . $mainRubric['rubric']);
        $subRubricsQuery->execute();

        while ($subRubric = $subRubricsQuery->fetch()) {
            echo "<div class=\"mx-1\">
                                        <a onclick=\"document.getElementById('rubricFilter').value = " . $subRubric['rubric'] . "; document.getElementById('searchbutton').click();\" href=\"#\">" . $subRubric['name'] . "</a>
                                        <div class=\"dropdown-divider yellow\"></div></div>";
        }
        echo "</div></div></div></div>";
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
        $query .= "SELECT " . ($amount > 0 ? "TOP($amount) " : "") . "A.auction, name, description, price_start, amount, [file] FROM TBL_Auction A
                INNER JOIN TBL_Item I
                    on A.item = I.item
                LEFT JOIN (SELECT auction, max(amount) AS amount FROM TBL_Bid group by auction) as B
                ON A.auction = B.auction
                LEFT JOIN (SELECT item, [file] FROM TBL_Resource WHERE sort_number IN (SELECT min(sort_number) FROM TBL_Resource GROUP BY item)) as R on I.item = R.item
                WHERE ";
        if (isset($_GET['rubric']) && ($rubric = cleanUpUserInput($_GET['rubric'])) != "") {
            $query .= "I.item in (SELECT item from TBL_Item_In_Rubric WHERE rubric in (
                    SELECT rubric
                    FROM subRubrics) OR rubric = " . $rubric . ") AND ";
        }

        $query .= ($promoted_only ? "is_promoted = 1 AND " : "");

        $filters = array();
        $searchArray = explode(" ", (isset($_GET['search']) ? cleanUpUserInput($_GET['search']) : ""));

        foreach ($searchArray as $key => $word) {
            $query .= "name LIKE ?";
            if ($key < count($searchArray) - 1) {
                $query .= " AND ";
            }
            $filters[] = "%$word%";
        }
        $query .= " ORDER BY moment_end DESC";
        echo $query;
        $searchStatement = $pdo->prepare($query);
        $searchStatement->execute($filters);
        echo "<div class='row my-2'>";
        while ($auction = $searchStatement->fetch()) {
            echo "<div class='auction-article-" . ($promoted_only ? "large" : "small") . " white col-lg m-2'>
<div class='row mt-3'>
									<div class='col'>
										<div class='col'><strong>" . $auction['name'] . "</strong></div>
									</div>
									<div class='col text-right'>
										<div class='col'><strong>€" . ($auction['amount'] > $auction['price_start'] ? $auction['amount'] : $auction['price_start']) . "</strong></div>
									</div>
								</div>
								<div class='imageContainer row text-center'>
									<div>" . "<img class='mx-auto my-2' src='data:image/png;base64," . base64_encode($auction['file']) . "'
										     alt='Afbeelding van veiling'>" .
                "</div>
								</div>
								<div class='row mb-3'>
									<div class='col'>
										<div class='col'> Beschrijving:</div>
									</div>
									<div class='row mx-3'>
										<div class='col'> " . $auction['description'] . "</div>
									</div>
									<div class='col text-right'>
									<a href='veiling.php?id=" . $auction['auction'] . "'>
										<button class='btn'>Details</button>
									</a>
									</div>
								</div>
							</div>";


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

        if ($username == "" || $password == "") {
            $loginMessage = "Vul een gebruikersnaam en een wachtwoord in<br><br>";
        } else {
            $sql = "SELECT [user],password, is_verified  FROM TBL_User WHERE [user]=:user and password = :password";
            $login_query = $pdo->prepare($sql);
            $login_query->execute(array(':user' => $username, ':password' => hash('sha1', $password)));
            $result = $login_query->fetch();
            if ($result['is_verified'] == 0) {
                $loginMessage = "Verifieer uw account eerst<br><br>";
            } else {
                if ($result['user'] == $username) {
                    $_SESSION["username"] = $username;
                } else {
                    $loginMessage = "Wachtwoord of gebruikersnaam incorrect<br><br>";
                }
            }
        }
    }
}

if (isset($_GET["logout"]) && isset($_SESSION)) {
    $_SESSION = array();
    session_destroy();
    unset($_GET);
    header("location: " . htmlspecialchars($_SERVER['PHP_SELF']));
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

        if (strlen($telephone_number) < 10 || !preg_match("#[0-9]+#", $telephone_number)) {
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

                $valid_until_date = date('Y-m-d H:i:s');

                $sql = "INSERT INTO TBL_User ([user],firstname,lastname,address_line_1,email,password ,verification_code , verification_code_valid_until) values (?,?,?,?,?,?,?,?)";
                $query = $pdo->prepare($sql);
                $query->execute(array($regUsername, $firstname, $lastname, $address, $email, hash('sha1', $regPassword), $token, $valid_until_date));
                $phoneQuery = $pdo->prepare(" INSERT INTO TBL_Phone ([user],phone_number,is_mobile) values (?,?,?)");

                $phoneQuery->execute(array($regUsername, $telephone_number, ($is_mobile ? 1 : 0)));

                $subject = "Verifieer uw e-mail!";
                $text = "
                    Geachte heer of mevrouw $lastname,<br><br>
                    
                    Klik op de link hieronder om uw registratie te voltooien.<br>
                    <a href='http://localhost/Pr-IP-P4-35/index.php?email=$email&token=$token'>Klik hier om uw registratie te voltooien</a><br><br>
                    
                    Of plak onderstaande link in uw browser:<br>
                    http://localhost/Pr-IP-P4-35/index.php?email=$email&token=$token<br><br>
                    
                    Als u geen account aan heeft gemaakt op onze website, kunt u deze e-mail negeren.<br><br>
                    
                    Met vriendelijke groet,<br><br>
                    
                    Het team van Eenmaal Andermaal
                ";
                sendEmail($email, $regUsername, $subject, $text);
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

        $sql = $pdo->prepare("SELECT email,verification_code ,verification_code_valid_until FROM TBL_User WHERE email=:email AND verification_code=:token AND is_verified=0");
        $sql->execute(array(':email' => $email, ':token' => $token));
        $confirm = $sql->fetch();

        $valid_until_date = $confirm['verification_code_valid_until'];
        $dateNow = date('Y-m-d H:i:s');

        $diff = abs(strtotime($dateNow) - strtotime($valid_until_date));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));


        if ($confirm['email'] == $email) {
            if ($days > 7) {
                echo 'verificatiecode is niet geldig.';
            } else {
                $sql = $pdo->prepare("UPDATE TBL_User SET is_verified = 1, verification_code ='' WHERE email=?");
                $sql->execute(array($email));
                echo 'Uw account is geverifieerd, u kunt nu inloggen.';
            }
        } else
            echo "Er is iets misgegaan, probeer het opnieuw";
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

        $values = "";
        if (!empty($firstname)) {
            $values .= "firstname = '$firstname'";

        }
        if (!empty($lastname)) {
            if (!empty($firstname)) {
                $values .= ", ";
            }
            $values .= "lastname = '$lastname'";
        }

        if (!empty($address)) {
            if (!empty($firstname) || !empty($lastname)) {
                $values .= ", ";
            }
            $values .= "address_line_1 = '$address'";
        }

        $password_check = false;
        if (!empty($resPassword)) {
            if (isPasswordGood($resPassword)) {
                if ($resPassword != $resconfirm_password) {
                    echo 'Zorg dat beide wachtwoorden hetzelfde zijn';

                } else {
                    $sql = "SELECT [user],password FROM TBL_User WHERE [user]=:username and password = :password";
                    $reset_query = $pdo->prepare($sql);
                    $reset_query->execute(array(':username' => $username, ':password' => hash('sha1', $cur_password)));
                    $result = $reset_query->fetch();
                    if ($result['password'] == hash('sha1', $cur_password)) {
                        if (!empty($firstname) || !empty($lastname) || !empty($address)) {
                            $values .= ", ";
                        }
                        $values .= "password = '" . hash('sha1', $resPassword) . "'";
                        $password_check = true;
                    } else {
                        echo 'Huidige wachtwoord is incorrect';
                    }
                }
            }
        }
        if (!empty($telephone_number)) {
            echo '<p class="text-success">jouw gegevens zijn geüpdatet </p>';
            $sql = "update TBL_Phone SET phone_number = :telephone_number WHERE [user] = :username";
            $query = $pdo->prepare($sql);
            $query->execute(array(':telephone_number' => $telephone_number, ':username' => $username));
        }
        if (!empty($firstname) || !empty($lastname) || !empty($address) || $password_check) {
            echo '<p class="text-success">jouw gegevens zijn geüpdatet</p>';
            $sql = "update TBL_User SET " . $values . " WHERE [user] = '$username'";
            $query = $pdo->prepare($sql);
            $query->execute(array());
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
            echo '<p style="color: green;">Er is een email naar uw opgegeven adres gestuurd!</p>';
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
    $query = $pdo->prepare("update TBL_User set verification_code =:token where email = :email");
    $query->execute(array(':token' => $token, ':email' => $email));

    $subject = "Wachtwoord opnieuw instellen";
    $text ="
                    Geachte heer of mevrouw $lastname,<br><br>

                    Klik op de link hieronder om uw wachtwoord opnieuw in te stellen.<br>
                    <a href='http://localhost/iproject/wachtwoordresetten.php?email=$email&verification=$token'>Klik hier om uw wachtwoord opnieuw in te stellen</a><br><br>

                    Of plak onderstaande link in uw browser:
                    http://localhost/iproject/wachtwoordresetten.php?email=$email&verification=$token<br>
                    <br><br>

                    Als u geen account aan heeft gemaakt op onze website, kunt u deze e-mail negeren.<br><br>

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
        $query = $pdo->prepare("select count(user) from TBL_User where email = :email");
        $query->execute(array(':email' => $email));
        $data = $query->fetch();

        if ($data[0][0] == 0) {
            echo "Emailadres bestaat niet";
        } else {
            sendVerificatiecodeEmail($email);
            echo '<p style="color: green;">Er is een email naar uw opgegeven adres gestuurd!</p>';
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

    $valid_until_date = date('Y-m-d H:i:s');

    $query = $pdo->prepare("update TBL_User set verification_code =:token ,verification_code_valid_until =:verification_code_valid_until where email = :email");
    $query->execute(array(':token' => $token, ':verification_code_valid_until' => $valid_until_date, ':email' => $email));

    $subject ="Verifieer uw e-mail!";
    $text ="
                    Geachte heer of mevrouw $lastname,<br><br>
                    
                    Klik op de link hieronder om uw registratie te voltooien.<br>
                    <a href='http://localhost/Pr-IP-P4-35/index.php?email=$email&token=$token'>Klik hier om uw registratie te voltooien</a><br><br>
                    
                    Of plak onderstaande link in uw browser:<br>
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

?>