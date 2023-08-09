<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$city_id = $_GET['city_id'];

$sql = "SELECT attraction_id, name FROM attractions WHERE city_id = :city_id";
$query = $pdo->prepare($sql);
$query->execute(array(':city_id' => $city_id));
$attractions = $query->fetchAll();

header('Content-Type: application/json');
echo json_encode($attractions);
