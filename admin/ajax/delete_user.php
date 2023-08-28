<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
//var_dump($_POST);die();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ellenőrizd, hogy a város azonosítója meg lett adva
    if (isset($_POST["user_id"])) {
        try {
            $user_id = $_POST["user_id"];
//            var_dump($user_id);die();
            // SQL lekérdezés a város törléséhez
            $sql = "DELETE FROM users WHERE user_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $response = array("success" => true, "message" => "User deleted successfully.");
            echo json_encode($response);
        } catch (PDOException $e) {
            // Hiba esetén válasz küldése
            $response = array("success" => false, "error" => "Error deleting city: " . $e->getMessage());
            echo json_encode($response);
        }
    } else {
        // Hiányzó adatok esetén válasz küldése
        $response = array("success" => false, "error" => "Missing data.");
        echo json_encode($response);
    }
} else {
    // Nem megfelelő kérés metódus esetén válasz küldése
    $response = array("success" => false, "error" => "Invalid request method.");
    echo json_encode($response);
}