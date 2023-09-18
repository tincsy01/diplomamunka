<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
//require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$attraction_id = $_GET['attraction_id'];
$sql = "SELECT name, attraction_id, popular, image, longitude, lattitude, description, address FROM attractions WHERE attraction_id = :attraction_id";
$query = $pdo->prepare($sql);
$query->bindValue(':attraction_id', $attraction_id);
$query->execute();
$attractionData = $query->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($attractionData);
?>
