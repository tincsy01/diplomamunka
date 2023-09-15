<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';

$pdo = connectDatabase($dsn, $pdoOptions);
//session_start();

$city_id = $_POST['city_id'];
$user_id = $_SESSION['user_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$selected_attractions = $_POST['attraction_ids'];
$datetime = date('Y-m-d H:i:s', strtotime("$date $time"));

$currentDateTime = new DateTime();
$selectedDateTime = new DateTime($datetime);

if ($selectedDateTime < $currentDateTime) {
    header('Content-Type: application/json');
    $response = array('success' => false, 'message' => 'The selected date has already passed.');
} else {
    $sql1 = "INSERT INTO tours(city_id, user_id, date) VALUES (:city_id, :user_id, :date)";
    $query1 = $pdo->prepare($sql1);
    $query1->bindParam(':city_id', $city_id);
    $query1->bindParam(':user_id', $user_id);
    $query1->bindParam(':date', $datetime);
    $query1->execute();

    $tour_id = $pdo->lastInsertId();
    foreach ($selected_attractions as $value) {
        $attraction_id = $value;

        $sql2 = "INSERT INTO tour_attraction(tour_id, attraction_id) VALUES (:tour_id, :attraction_id)";
        $query2 = $pdo->prepare($sql2);
        $query2->bindParam(':tour_id', $tour_id);
        $query2->bindParam(':attraction_id', $attraction_id);
        $query2->execute();

        $sql3 = "UPDATE attractions SET num_of_visitors = num_of_visitors + 1 WHERE attraction_id = :attraction_id";
        $query3 = $pdo->prepare($sql3);
        $query3->bindParam(':attraction_id', $attraction_id);
        $query3->execute();
    }

    $response = array('success' => true, 'message' => 'Hozzáadva sikeresen');
}

header('Content-Type: application/json');
echo json_encode($response);