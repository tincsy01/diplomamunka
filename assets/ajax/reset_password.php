<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
//require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);


// Ellenőrizzük, hogy a POST kérés érkezett-e
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"])) {

        $email = $_POST["email"];
        $code = createCode(20);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT email FROM users WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();
            $row_count = $query->rowCount();

            if ($row_count > 0) {
                sendResetPassword($email, $code);
                $response = array("success" => true, "message" => "The email address is valid.");
                echo json_encode($response);
                $sql2 = "UPDATE users SET code = :code WHERE email = :email";
                $query = $pdo->prepare($sql2);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':code', $code, PDO::PARAM_STR);
                $query->execute();
            } else {
                $response = array("success" => false, "message" => "There is no user with this email");
                echo json_encode($response);
            }
        } else {

            $response = array("success" => false, "message" => "Incorrect email address format.");
            echo json_encode($response);
        }
    } else {
        $response = array("success" => false, "message" => "The 'email' field is missing from the request.");
        echo json_encode($response);
    }
} else {
    $response = array("success" => false, "message" => "Invalid request method.");
    echo json_encode($response);
}

