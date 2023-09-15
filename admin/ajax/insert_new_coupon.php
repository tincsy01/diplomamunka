<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
require_once '../php/functions.php';
require '../../../vendor/autoload.php';

use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;
$pdo = connectDatabase($dsn, $pdoOptions);

$sid = "AC4f51b3b7d2be6dbf1c4d0e898b4ae06e";
$token = "a59309f791388dd910b909c42eda5dd5";
try {
    $client = new Client($sid, $token);
} catch (ConfigurationException $e) {
}

$user_id = $_POST['userId'];
$discount = $_POST['discount'];
$phone = $_POST['phone'];
$coupon_expire = new DateTime();
$coupon_expire->add(new DateInterval('P1M'));
$coupon_expire_formatted = $coupon_expire->format('Y-m-d H:i:s');
$code = createCode(6);
$active = 1;

$sql = "INSERT INTO coupons (user_id, discount, phone, coupon_expire, active, code)
        VALUES (:user_id, :discount, :phone, :coupon_expire, :active, :code)";
$query = $pdo->prepare($sql);

$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->bindParam(':discount', $discount, PDO::PARAM_STR);
$query->bindParam(':phone', $phone, PDO::PARAM_STR);
$query->bindParam(':coupon_expire', $coupon_expire_formatted, PDO::PARAM_STR);
$query->bindParam(':active', $active, PDO::PARAM_INT);
$query->bindParam(':code', $code, PDO::PARAM_STR);
$query->execute();

$messageBody = "You have a coupon code: " . $code . " with " . $discount . "% discount";

$client->messages->create(
    '+381606561706',
    [
        'from' => '+16185529204',
        'body' => $messageBody
    ]
);
$response = array('success' => true, 'message' => 'Successfully added');
echo json_encode($response);