<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT category_id, category FROM categories ORDER BY category ASC";
$query = $pdo->query($sql);
$categories = $query->fetchAll();
header('Content-Type: application/json');
echo json_encode($categories);