<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
$sql = "SELECT city_id, city_name, organization_name FROM cities";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$ret = []; // Új tömb a válasznak

foreach ($result as $row) {
    $ret[] = [
        "city_id" => $row['city_id'],
        "city_name" => $row['city_name'],
        "organization_name" => $row['organization_name']
    ];
}
header('Content-Type: application/json');
echo json_encode($ret);
?>