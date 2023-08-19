<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$org_id = $_SESSION['user_id'];
$sql = "SELECT a.attraction_id, a.name, a.num_of_visitors, a.popular, c.category,a.lattitude, a.longitude, a.description
        FROM attractions a 
        INNER JOIN categories c ON c.category_id = a.category_id 
        WHERE a.org_id = :org_id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':org_id', $org_id, PDO::PARAM_INT);
$stmt->execute();
$attractions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return attractions as JSON
header('Content-Type: application/json');
echo json_encode($attractions);
