<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if (isset($_POST['status'], $_POST['complaint_id'])) {
    $status = $_POST['status'];
    $complaint_id = $_POST['complaint_id'];

    $sql = "UPDATE complaints SET status = :status WHERE complaint_id = :complaint_id";
    try {
        $query = $pdo->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
        $query->execute();

        $response = array("success" => true, "msg" => "Complaint successfully updated");
    } catch (PDOException $e) {
        $response = array("success" => false, "msg" => "Error: " . $e->getMessage());
    }

    $pdo = null;
} else {
    $response = array("success" => false, "msg" => "Missing POST data");
}

header("Content-Type: application/json");
echo json_encode($response);
