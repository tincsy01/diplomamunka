<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if (isset($_POST['complaint'])) {
    $complaintMessage = $_POST['complaint'];
    $date = date_create(); 
    $formattedDate = date_format($date, 'Y-m-d H:i:s');
    $user_id = $_SESSION['user_id'];

    $sql= "INSERT INTO complaints (complaint, date, user_id) VALUES (:complaint, :date, :user_id)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':user_id', $user_id);
    $query->bindParam(':date', $formattedDate);
    $query->bindParam(':complaint', $complaintMessage);
    $query->execute();

    $response = array('success' => true, 'message' => 'Complaint submitted successfully!');
} else {
    $response = array('success' => false, 'message' => 'Error processing complaint.');
}
header('Content-Type: application/json');
echo json_encode($response);