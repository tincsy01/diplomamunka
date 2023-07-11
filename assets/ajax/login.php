<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT user_id, password, permission FROM users WHERE username = :username AND permission = 2 AND active = 1";
$query = $pdo->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();

$data = [];
if ($query->rowCount() > 0) {
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $data['user_id'] = (int)$row['user_id'];
        $registeredPassword = $row['password'];
        $data['permission'] = $row['permission'];
    }

    if (!password_verify($password, $registeredPassword)) {
        $data = [];
    }
    redirection('../../views_website/index.php');
    $response = array('success' => true, 'message' => 'Logged in');
    echo json_encode($response);
} elseif ($query->rowCount() < 0) {
    $sql = "SELECT org_id, password, permission FROM organizations WHERE username = :username AND permission = 3 AND active = 1";
    $query = $pdo->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $data['user_id'] = (int)$row['org_id'];
        $registeredPassword = $row['password'];
        $data['permission'] = $row['permission'];
    }

    if (!password_verify($password, $registeredPassword)) {
        $data = [];
    }
    redirection('../../views_website/index.php');
    $response = array('success' => true, 'message' => 'Logged in');
    echo json_encode($response);
} else {
    $response = array('success' => true, 'message' => 'Your username or password is incorrect.');
    echo json_encode($response);
}

