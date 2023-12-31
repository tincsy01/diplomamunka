<?php

require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if (isset($_GET['id'])) {
    $tour_id = $_GET['id'];
    $sql = "SELECT a.attraction_id, a.longitude, a.lattitude, t.date, a.name FROM attractions a 
                        INNER JOIN tour_attraction ta ON a.attraction_id = ta.attraction_id INNER JOIN tours t ON t.tour_id = ta.tour_id
                        WHERE ta.tour_id = :tour_id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':tour_id', $tour_id);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response = array();

    if ($results) {
        $response['success'] = true;
        $response['attractions'] = $results;
    } else {
        $response['success'] = false;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Missing tour ID']);
}



