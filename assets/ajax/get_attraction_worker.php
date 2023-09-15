<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT attraction_id, name FROM attractions ORDER BY name ASC";
$query = $pdo->query($sql);
$attractions = $query->fetchAll(PDO::FETCH_ASSOC);

$response = array('success' => true, 'attractions' => $attractions);
echo json_encode($response);