<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
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