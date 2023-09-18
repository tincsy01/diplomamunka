<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
//require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$attraction_id = $_SESSION['working_at'];
$sql = "SELECT * FROM complaints  WHERE attraction_id = :attraction_id ORDER BY date DESC";
$query = $pdo->prepare($sql);
$query->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
$query->execute();
$complaints = $query->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');

echo json_encode($complaints);