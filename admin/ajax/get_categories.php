<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
$sql = "SELECT category_id, category FROM categories ORDER BY category ASC";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$ret = [];

foreach ($result as $row) {
    $ret[] = [
        "category_id" => $row['category_id'],
        "category" => $row['category']
    ];
}
header('Content-Type: application/json');
echo json_encode($ret);
