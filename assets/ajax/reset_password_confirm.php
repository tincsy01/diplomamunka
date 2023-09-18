<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newPassword']) AND isset($_POST['code'])) {
        $code = $_POST['code'];
        $newPassword = $_POST['newPassword'];

        $passwordHashed = password_hash($newPassword, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET password = :password WHERE code = :code";
        $query = $pdo->prepare($sql);
        $query->bindParam(':code', $code, PDO::PARAM_STR);
        $query->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
        $query->execute();
        $response = array('success' => true, 'message' => 'Changed password!');
        echo json_encode($response);
    }
    else{
        $response = array('success' => false, 'message' => 'Please fill all fields!');
        echo json_encode($response);
    }
}