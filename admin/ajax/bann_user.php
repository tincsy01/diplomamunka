<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["userId"])) {
        try {
            $userId = $_POST["userId"];
            $sql = "UPDATE users SET active = :, longitude = :longitude, lattitude = :lattitude WHERE city_id = :city_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':updated_city_name', $updatedCityName, PDO::PARAM_STR);
            $stmt->bindParam(':longitude', $updateLongitude, PDO::PARAM_STR);
            $stmt->bindParam(':lattitude', $updateLattitude, PDO::PARAM_STR);
            $stmt->bindParam(':city_id', $cityId, PDO::PARAM_INT);
            $stmt->execute();

            $response = array("success" => true, "message" => "City updated successfully.");
            echo json_encode($response);
        } catch (PDOException $e) {
            $response = array("success" => false, "error" => "Error updating city: " . $e->getMessage());
            echo json_encode($response);
        }
    } else {
        $response = array("success" => false, "error" => "Missing data.");
        echo json_encode($response);
    }
} else {
    $response = array("success" => false, "error" => "Invalid request method.");
    echo json_encode($response);
}
?>