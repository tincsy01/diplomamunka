<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if (!isset($_GET['attraction_id'])) {
    die("Missing attraction ID");
}

$attraction_id = $_GET['attraction_id'];

$sql = "SELECT c.date, c.comment, u.username, c.evaluation FROM comments c INNER JOIN users u ON c.user_id = u.user_id WHERE attraction_id = :attraction_id ORDER BY c.date ASC";
$query = $pdo->prepare($sql);
$query->bindParam(':attraction_id', $attraction_id);
$query->execute();
$comments = $query->fetchAll(PDO::FETCH_ASSOC);

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