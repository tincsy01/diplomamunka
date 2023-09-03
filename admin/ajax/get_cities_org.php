<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
try {
    // Kapcsolódás az adatbázishoz
    $pdo = connectDatabase($dsn, $pdoOptions);

    // SQL lekérdezés a városok lekérdezéséhez
    $sql = "SELECT city_id, city_name FROM cities";
    $query = $pdo->query($sql);

    // Városok tömbjének létrehozása
    $cities = $query->fetchAll(PDO::FETCH_ASSOC);

    // JSON válasz küldése
    header('Content-Type: application/json');
    echo json_encode($cities);
} catch (PDOException $e) {
    // Hiba esetén JSON hibaüzenet küldése
    echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
}