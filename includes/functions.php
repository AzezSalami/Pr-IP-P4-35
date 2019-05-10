<?php
//error_reporting(0);
session_start();
connectToDatabase();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function cleanUpUserInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function connectToDatabase()
{
    $hostnaam = "51.38.112.111";
    $databasenaam = "groep35";
    $gebruikersnaam = "iproject35";
    $wachtwoord = "iProject35";
    global $pdo;

    try {
        $pdo = new PDO ("sqlsrv:Server=$hostnaam;Database=$databasenaam;ConnectionPooling=0", "$gebruikersnaam", "$wachtwoord");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    } catch (PDOException $e) {
    }
}

function search()
{

}

function login()
{

    if (isset($_POST['login'])) {
        global $pdo;
        $username = cleanUpUserInput($_POST['username']);
        $password = cleanUpUserInput($_POST['password']);

        if ($username == "" || $password == "") {
            echo "Please check your inputs!<br><br>";
            echo "<script>document.getElementById('openLoginButton').click();</script>";
        } else {
            $sql = "SELECT [user],password, is_verified  FROM TBL_User WHERE [user]=:user and password = :password";
            $login_query = $pdo->prepare($sql);
            $login_query->execute(array(':user' => $username, ':password' => $password));
            //$results = ;
            //print_r($login_query->fetch());
            if ($login_query->fetch()['user'] == $username) {
                echo "You have been logged in<br><br>";
            } else {
                echo "Please check your inputs!<br><br>";
                echo "<script>document.getElementById('openLoginButton').click();</script>";
            }
        }
    }
}

function register()
{
    if (isset($_POST['make_account'])) {
        global $pdo;
        $email = cleanUpUserInput($_POST['email']);
        $reg_password = cleanUpUserInput($_POST['reg_password']);
        $confirm_password = cleanUpUserInput($_POST['confirm_password']);
        $firstname = cleanUpUserInput($_POST['firstname']);
        $lastname = cleanUpUserInput($_POST['lastname']);
        $reg_username = cleanUpUserInput(strtolower($_POST['reg_username']));
        $address = cleanUpUserInput($_POST['address']);
        $telephone_number = cleanUpUserInput($_POST['telephone_number']);


        if (empty(trim($email)) || empty(trim($reg_password)) || empty(trim($firstname)) || empty(trim($lastname)) || empty(trim($reg_username))) {
            echo "The fields with an asterisk are mandatory.";
        }

        $maginlogen = "Select * from TBL_User where email = ?";
        $regquery = $pdo->prepare($maginlogen);
        $regquery->execute(array($email));


        if ($regquery->fetch()['email'] == $email) {
            echo 'this email is already used';
            echo "<script>document.getElementById('openRegister').click();</script>";

        } else {
            $maginlogen = "Select * from TBL_User where [user] = ?";
            $regquery = $pdo->prepare($maginlogen);
            $regquery->execute(array($reg_username));

            if ($regquery->fetch()['user'] == $reg_username) {
                echo 'username: ' . $reg_username . ' is already exist.. please choose another one ';
                echo "<script>document.getElementById('openRegister').click();</script>";
            } else {
                if ($confirm_password <> $reg_password) {
                    echo 'Make sure the passwords match.';
                    echo "<script>document.getElementById('openRegister').click();</script>";
                }
                $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
                $token = str_shuffle($token);
                $token = substr($token, 0, 10);

                $sql = "INSERT INTO TBL_User ([user],firstname,lastname,address_line_1,email,password ,verification_code) values (?,?,?,?,?,?,?); INSERT INTO TBL_Phone ([user],phone_number) values (?,?);";
                $query = $pdo->prepare($sql);
                $query->execute(array($reg_username, $firstname, $lastname, $address, $email, hash('sha1', $reg_password), $token, $reg_username, $telephone_number));
//                echo 'You are registered. You can now log in';

                require "PHPMailer/PHPMailer.php";
                require "PHPMailer/Exception.php";
                require "PHPMailer/SMTP.php";

                $mail = new PHPMailer();
                try {
//                    $mail->SMTPDebug = 2;                                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Set mailer to use SMTP
                    $mail->Host       = 'smtp.gmail.com	';                      // Specify main and backup SMTP servers
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'eenmaalandermaal35@gmail.com';          // SMTP username
                    $mail->Password   = 'andermaaleenmaal35';                    // SMTP password
                    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                    $mail->Port       = 587;                                    // TCP port to connect to

                    $mail->setFrom('eenmaalandermaal35@gmail.com');
                    $mail->addAddress($email, $reg_username);
                    $mail->Subject = "Please verify email!";
                    $mail->isHTML(true);
                    $mail->Body = "
                    Please click on the link below:<br><br>
                    
                    <a href='includes/confirm.php?email=$email&token=$token'>Click Here</a>
                ";
                    $mail->send();

                    echo 'Message has been sent. Please verify your account';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            echo "<script>document.getElementById('openRegister').click();</script>";
        }
    }
}

function confirm()
{
    global $pdo;
    if (!isset($_GET['email']) || !isset($_GET['token'])) {
        echo "<script>document.getElementById('openRegister').click();</script>";
    } else {

        $email = $pdo->cleanUpUserInput($_GET['email']);
        $token = $pdo->cleanUpUserInput($_GET['token']);

        $sql = $pdo->query("SELECT email,verification_code FROM TBL_User WHERE email='$email' AND verification_code='$token' AND is_verified=0");

        if ($sql->fetch()['email'] == $email) {
            $pdo->query("UPDATE TBL_User SET is_verified = 1, token='' WHERE email='$email'");
            echo 'Your email has been verified! You can log in now!';
        } else
            echo "<script>document.getElementById('openRegister').click();</script>";
    }
}
?>