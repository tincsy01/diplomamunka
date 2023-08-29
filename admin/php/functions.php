<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start();
require_once 'config.php';
require_once 'db_config.php';
require_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../vendor/phpmailer/phpmailer/src/SMTP.php';
$pdo = connectDatabase($dsn, $pdoOptions);

/**
 * "Atiranyitas masik oldalra"
 *
 * @param string $url
 */
function redirection($url)
{
    header("Location:$url");
    exit();
}

/**
 * Kod letrehozo fuggveny
 *
 * @param $length
 * @return string
 */
function createCode($length)
{
    $down = 48;
    $up = 57;
    $i = 0;
    $code = "";

    $div = mt_rand(3, 9);

    while ($i < $length) {
        if ($i % $div == 0)
            $character = strtoupper(chr(mt_rand($down, $up)));
        else
            $character = chr(mt_rand($down, $up));
        $code .= $character;
        $i++;
    }
    return $code;
}

/**
 * Function tries to send email with activation code
 * Regisztraciohoz
 *
 * @param $email
 * @param $code
 * @return bool
 */
function sendData($email, $code)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'em.stud.vts.su.ac.rs';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'em';                     //SMTP username
        $mail->Password   = 'h3waxBgfAQHM6dk';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


        //Recipients
        $mail->setFrom('kriszta@em.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($_POST['email'], 'User');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional



        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Activation';
        $mail->Body    = "\n\n to activate your account click on the link: " . SITE . "active.php?code=$code";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
        return true;

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
function sendRequestWorker($email, $code){
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'em.stud.vts.su.ac.rs';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'em';                     //SMTP username
        $mail->Password   = 'h3waxBgfAQHM6dk';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


        //Recipients
        $mail->setFrom('kriszta@em.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($_POST['email'], 'User');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional

        $activationLink = REQUESTLINK . "worker_registration.php?code=$code";

// HTML version of the email
        $mail->isHTML(true);
        $mail->Subject = 'Request to work';

// HTML body with an image and some styling
        $mail->Body = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <img src='../../../assets/logo-black.png' alt='Logo'>
        <h1>Welcome in Our Team</h1>
        <p>To Registration, <a class='button' href='$activationLink'>click here</a>.</p>
    </div>
</body>
</html>
";

// Plain text version of the email (for non-HTML mail clients)
        $mail->AltBody = "To activate your account, visit the following link: $activationLink";

// Send the email
        $mail->send();

        echo 'Message has been sent';
        return true;

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
/**
 * @param $email
 * @return bool
 */
function existsEmail($email): bool
{
    global $pdo;

    $sql = "SELECT user_id FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $row_count = $stmt->rowCount();

    if ($row_count > 0) {
        return true;
    } else {
        return false;
    }
}
/**
 * @param $username
 * @param $email
 * @return bool
 */
function existsUser($username, $email): bool
{
    global $pdo;

    $sql = "SELECT user_id FROM users WHERE username = :username OR email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $row_count = $stmt->rowCount();

    if ($row_count > 0) {
        return true;
    } else {
        return false;
    }
}