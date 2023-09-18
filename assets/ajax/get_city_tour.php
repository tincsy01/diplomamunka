<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
//require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT city_id, city_name FROM cities";
$query = $pdo->query($sql);
$cities = $query->fetchAll();
header('Content-Type: application/json');
echo json_encode($cities);