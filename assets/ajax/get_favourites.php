<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT f.attraction_id, a.name, a.image FROM favourites f INNER JOIN attractions a ON a.attraction_id = f.attraction_id WHERE f.user_id = :user_id";
    $result = $pdo->prepare($query);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $result->execute();

    $favorites = array();

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $favorites[] = $row;
        }
        echo json_encode(['success' => true, 'favorites' => $favorites]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
