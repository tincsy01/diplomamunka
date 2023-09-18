<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["cityName"]) && isset($_POST["longitude"]) && isset($_POST["lattitude"]) && isset($_FILES["image"])) {
        try {
            $city = $_POST["cityName"];
            $longitude = $_POST['longitude'];
            $lattitude = $_POST['lattitude'];
            $photo = $_FILES['image'];
            $uploadDir = 'C:/xampp/htdocs/TenderTours/assets/images/cities/';

            $imageName = $city . "_" . rand(1000, 9999) . "_" . rand(1000, 9999) . "_" . basename($photo['name']);
            $uploadPath = $uploadDir . $imageName;

            $sql = "INSERT INTO cities (city_name, longitude, lattitude, image) VALUES (:city, :longitude, :lattitude, :image)";
            if (move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':city', $city, PDO::PARAM_STR);
                $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
                $stmt->bindParam(':lattitude', $lattitude, PDO::PARAM_STR);
                $stmt->bindParam(':image', $imageName, PDO::PARAM_STR); // Csak a kép neve
                $stmt->execute();
            }

            $response = array("success" => true, "message" => "City added successfully.");
            echo json_encode($response);
        } catch (PDOException $e) {
            $response = array("success" => false, "error" => "Error adding city: " . $e->getMessage());
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