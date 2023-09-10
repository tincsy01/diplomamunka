<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if (isset($_GET['city_id'])) {
    $city_id = $_GET['city_id'];

    // Város adatainak lekérdezése a cities táblából
    $citySql = "SELECT city_name, image, longitude, lattitude FROM cities WHERE city_id = :city_id";
    $cityQuery = $pdo->prepare($citySql);
    $cityQuery->bindValue(':city_id', $city_id);
    $cityQuery->execute();
    $cityData = $cityQuery->fetch(PDO::FETCH_ASSOC);

    if ($cityData) {
        // Turista látnivalók lekérdezése a attractions táblából
        $attractionSql = "SELECT name, image, attraction_id FROM attractions WHERE city_id = :city_id";
        $attractionQuery = $pdo->prepare($attractionSql);
        $attractionQuery->bindValue(':city_id', $city_id);
        $attractionQuery->execute();
        $attractions = $attractionQuery->fetchAll(PDO::FETCH_ASSOC);

        // Válasz összeállítása
        $response = array(
            'city_name' => $cityData['city_name'],
            'image' => $cityData['image'],
            'longitude' => $cityData['longitude'],
            'lattitude' => $cityData['lattitude'],
            'attractions' => $attractions
        );

        if (empty($attractions)) {
            // Ha nincsenek látnivalók a városban, adjunk hozzá egy üzenetet a válaszhoz
            $response['message'] = 'Nincsenek látnivalók ebben a városban.';
        }
        // JSON formátumba alakítás és válasz küldése
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo "Nincs találat a város táblában a megadott city_id-re.";
    }
} else {
    echo "Hiányzó vagy érvénytelen city_id paraméter.";
}
