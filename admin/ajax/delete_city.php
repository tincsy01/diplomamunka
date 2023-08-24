<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ellenőrizd, hogy a város azonosítója meg lett adva
    if (isset($_POST["city_id"])) {
        try {
            $cityId = $_POST["city_id"];

            // SQL lekérdezés a város törléséhez
            $sql = "DELETE FROM cities WHERE city_id = :city_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':city_id', $cityId, PDO::PARAM_INT);
            $stmt->execute();

            $response = array("success" => true, "message" => "City deleted successfully.");
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