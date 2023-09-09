<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
header('Content-Type: application/json');
$code = $_GET['code'];
if (!empty($code)){
    $sql = "UPDATE users SET active='1', code='', reg_expire=''
            WHERE  code = :code AND reg_expire>now()";
    $query = $pdo->prepare($sql);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->execute();
    $count = $query->fetchAll();
    $query = $pdo->prepare($sql);
    if ($count > 0) {
        $response = array('success' => true, 'message' => 'Your account is activated. You can log in now.');
        echo json_encode($response);
    }
    else{
        $response = array('success' => true, 'message' => 'The registration email has expired');
        echo json_encode($response);
    }
}
else{
    $response = array('success' => true, 'message' => 'The code is empty.');
    echo json_encode($response);
}
