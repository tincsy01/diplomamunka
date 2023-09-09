<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

// Ellenőrizzük, hogy az attraction_id megléte
if (!isset($_GET['attraction_id'])) {
    die("Missing attraction ID");
}

$attraction_id = $_GET['attraction_id'];

// Lekérdezzük a kommenteket az adott attraction-höz
$sql = "SELECT * FROM comments WHERE attraction_id = :attraction_id";
$query = $pdo->prepare($sql);
$query->bindParam(':attraction_id', $attraction_id);
$query->execute();
$comments = $query->fetchAll(PDO::FETCH_ASSOC);

// Válasz elküldése JSON formátumban
$response = array();

if ($comments) {
    $response['success'] = true;
    $response['comments'] = $comments;
} else {
    $response['success'] = false;
    $response['message'] = "Failed to load comments.";
}

header('Content-Type: application/json');
echo json_encode($response);