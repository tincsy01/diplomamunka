<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$response = array('success' => false, 'message' => 'Error processing coupon code.');

if (isset($_POST['code'])) {
    $couponCode = $_POST['code'];

    $sql1 = "SELECT code FROM coupons WHERE code = '$couponCode' AND active = 1 AND coupon_expire >= NOW()";
    $result = $pdo->query($sql1);

    if ($result->rowCount() > 0) {
        $sql2 = "UPDATE coupons SET active = 0 WHERE code = '$couponCode'";
        $pdo->query($sql2);
        $response = array('success' => true, 'message' => 'Coupon code is valid.');
    } else {
        $response = array('success' => false, 'message' => 'Invalid coupon code.');
    }
}

echo json_encode($response);