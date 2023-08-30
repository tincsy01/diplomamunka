<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

// Számoljuk ki a 3 hónappal ezelőtti dátumot
$threeMonthsAgo = date('Y-m-d', strtotime('-3 months'));

$sql = "SELECT u.name, u.user_id, u.phone, u.email, COUNT(t.user_id) AS tours
        FROM users u
        LEFT JOIN tours t ON u.user_id = t.user_id AND t.date >= :threeMonthsAgo
        GROUP BY u.user_id, u.name, u.email, u.phone";
$query = $pdo->prepare($sql);
$query->bindParam(':threeMonthsAgo', $threeMonthsAgo, PDO::PARAM_STR);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$ret = []; // Új tömb a válasznak
foreach ($result as $row) {
    $ret[] = [
        'user_id' => $row['user_id'],
        'name' => $row['name'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'tours' => $row['tours']
    ];
}
header('Content-Type: application/json');
echo json_encode($ret);