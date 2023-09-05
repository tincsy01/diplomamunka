<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
try {
    $pdo = connectDatabase($dsn, $pdoOptions);

    $sql = "SELECT city_id, city_name FROM cities ORDER BY city_name";
    $query = $pdo->query($sql);

    $cities = $query->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($cities);
} catch (PDOException $e) {
    // Hiba esetén JSON hibaüzenet küldése
    echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
}