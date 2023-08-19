<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$attractionId = $_POST["attraction_id"];

// Készítsd elő a lekérdezést az attrakció törléséhez
$sql = "DELETE FROM attractions WHERE attraction_id = $attractionId";

if ($pdo->query($sql) === TRUE) {
    $response = array("success" => true, "msg" => "Az attrakció sikeresen törölve.");
} else {
    $response = array("success" => false, "msg" => "Hiba történt az attrakció törlése során: " . $pdo->error);
}

// Bezárjuk az adatbázis kapcsolatot
$pdo->close();

// Válasz elkészítése és visszaküldése JSON formátumban
header("Content-Type: application/json");
echo json_encode($response);