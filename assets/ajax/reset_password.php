<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
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
                $response = array("success" => true, "message" => "Az e-mail cím érvényes.");
                echo json_encode($response);
                $sql2 = "UPDATE users SET code = :code WHERE email = :email";
                $query = $pdo->prepare($sql2);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':code', $code, PDO::PARAM_STR);
                $query->execute();
            } else {
                $response = array("success" => false, "message" => "Nincs ilyen emailel rendelkezo felhasznalo");
                echo json_encode($response);
            }
        } else {

            $response = array("success" => false, "message" => "Hibás e-mail cím formátum.");
            echo json_encode($response);
        }
    } else {
        $response = array("success" => false, "message" => "Az 'email' mező hiányzik a kérésből.");
        echo json_encode($response);
    }
} else {
    $response = array("success" => false, "message" => "Érvénytelen kérési mód.");
    echo json_encode($response);
}

