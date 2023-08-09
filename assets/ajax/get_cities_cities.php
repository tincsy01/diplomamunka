<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

//$sql = "SELECT c.city_id, c.city_name, c.image FROM cities c INNER JOIN organizations o ON c.organization_name = o.org_name WHERE o.status = 1 ";
$sql = "SELECT city_id, city_name, image FROM cities  ";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll();
$ret = [];
foreach ($result as $row) {
    $ret[] = [
        "city_id" => $row['city_id'],
        "city_name" => $row['city_name'],
        "image" => $row['image']
    ];
}
// Töröljük az adatpuffer tartalmát
ob_clean();

// Indítsuk újra az adatpuffert
ob_start();

// Állítsuk be a HTTP Content-Type fejlécét JSON formátumra
header('Content-Type: application/json');
echo json_encode($ret);