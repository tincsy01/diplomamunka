<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);
//var_dump($_POST); die();
if (isset($_POST['complaint'])) {
    $complaintMessage = $_POST['complaint'];
    $date = date_create(); 
    $formattedDate = date_format($date, 'Y-m-d H:i:s');
    $user_id = $_SESSION['user_id'];
    $attraction_id = $_SESSION['working_at'];
    $status = $_POST['status'];

    $sql= "INSERT INTO complaints (complaint, date, user_id, attraction_id, status) VALUES (:complaint, :date, :user_id, :attraction_id, :status)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':user_id', $user_id);
    $query->bindParam(':attraction_id', $attraction_id);
    $query->bindParam(':date', $formattedDate);
    $query->bindParam(':complaint', $complaintMessage);
    $query->bindParam(':status', $status);
    $query->execute();

    $response = array('success' => true, 'message' => 'Complaint submitted successfully!');
} else {
    $response = array('success' => false, 'message' => 'Error processing complaint.');
}
header('Content-Type: application/json');
echo json_encode($response);