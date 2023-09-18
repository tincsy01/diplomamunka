<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
//require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

try {
    $sql = "SELECT image, city_name, city_id FROM cities";
    $stmt = $pdo->query($sql);
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($cities) > 0) {
        header('Content-Type: application/json');
        echo json_encode($cities);
    } else {
        echo json_encode([]);
    }
} catch (PDOException $e) {
    echo "Hiba történt a városok lekérdezése során: " . $e->getMessage();
}
