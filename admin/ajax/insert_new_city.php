<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ellenőrizd, hogy az adatok megfelelően érkeztek-e
    if (isset($_POST["cityName"]) && isset($_POST["longitude"]) && isset($_POST["lattitude"]) && isset($_POST["image"])) {
        try {
            $photo = $_FILES['image'];
            $uploadDir = '/assets/images/cities/'; // Feltöltött képek mappája
            $uploadPath = $uploadDir . basename($photo['name']); // Útvonal a feltöltött képhez

            // Prepare és Execute adatainak bekötése
            $stmt = $pdo->prepare("INSERT INTO cities (city_name, longitude, lattitude, image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_POST["cityName"], $_POST["longitude"], $_POST["lattitude"], $_POST["image"]]);



            $response = array("success" => true, "message" => "City added successfully.");
            echo json_encode($response);
        } catch (PDOException $e) {
            // Hiba esetén válasz küldése
            $response = array("success" => false, "error" => "Error adding city: " . $e->getMessage());
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