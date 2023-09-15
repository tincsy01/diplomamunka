<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if (isset($_POST['visitors'])) {
    $visitors = $_POST['visitors'];
    $attraction_id = $_SESSION['working_at'];
    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO visitors (user_id, attraction_id, num_of_visitors, date) VALUES (:user_id, :attraction_id, :num_of_visitors, :date)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
    $query->bindParam(':num_of_visitors', $visitors, PDO::PARAM_INT);
    $query->bindParam(':date', $date);
    $query->execute();

    $sql3 = "UPDATE attractions SET num_of_visitors = num_of_visitors + :num_of_visitors WHERE attraction_id = :attraction_id";
    $query = $pdo->prepare($sql3);
    $query->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
    $query->bindParam(':num_of_visitors', $visitors, PDO::PARAM_INT);
    $query->execute();

    $lastId = $pdo->lastInsertId();
    $description = isset($_POST['description']) ? $_POST['description'] : null;

    if (!empty($description)) {
        $sql2 = "UPDATE visitors SET description = :description WHERE visitor_id = :lastId";
        $query = $pdo->prepare($sql2);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':lastId', $lastId, PDO::PARAM_INT);
        $query->execute();
    }

    $response = array('success' => true, 'message' => 'Added');
    echo json_encode($response);
}
else{
    $response = array('success' => false, 'message' => 'Visitors is empty');
    echo json_encode($response);
}



