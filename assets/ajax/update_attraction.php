<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attractionId = $_POST["attraction_id"];
    $attractionName = $_POST["name"];
    $category = $_POST["category"];
    $longitude = $_POST["longitude"];
    $lattitude = $_POST["lattitude"];
    // $address = $_POST["address"];
    $description = $_POST["description"];

    $sql = "UPDATE attractions SET name = '$attractionName', category_id = '$category', longitude = '$longitude', lattitude = '$lattitude', description = '$description' WHERE attraction_id = $attractionId";

    if ($pdo->query($sql) === TRUE) {
        $response = array("success" => true, "msg" => "Az attrakció sikeresen frissítve.");
    } else {
        $response = array("success" => false, "msg" => "Hiba történt az attrakció frissítése során: " . $pdo->error);
    }
    $pdo->close();
    header("Content-Type: application/json");
    echo json_encode($response);
}