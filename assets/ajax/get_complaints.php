<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT * FROM complaints  ";
$query = $pdo->prepare($sql);
$query->execute();
$complaints = $query->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');

echo json_encode($complaints);