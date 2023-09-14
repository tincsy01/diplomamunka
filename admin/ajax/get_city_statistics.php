<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

// SQL lekérdezés az 5 leglátogatottabb város és a látogatók számának meghatározásához
$sql = "SELECT name, SUM(num_of_visitors) as num_of_visitors FROM attractions
        GROUP BY name ORDER BY num_of_visitors DESC LIMIT 5";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $attNames = array();
    $visitorCounts = array();

    foreach ($data as $row) {
        $attNames[] = $row['name'];
        $visitorCounts[] = (int)$row['num_of_visitors'];
    }

    $response = array(
        'attNames' => $attNames,
        'visitorCounts' => $visitorCounts
    );

    header('Content-Type: application/json');
    echo json_encode($response);
} catch (PDOException $e) {
    die("Hiba a városok statisztikájának lekérésekor: " . $e->getMessage());
}
