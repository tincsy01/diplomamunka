<?php
//session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orgId = $_SESSION['user_id'];
    $attractionName = $_POST['attraction'];
    $category = $_POST['category'];
    $longitude = $_POST['longitude'];
    $lattitude = $_POST['lattitude'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $photo = $_FILES['photo']; // Fájlfeltöltés adatai

    // TODO: Ezen a ponton végezz ellenőrzéseket és validációkat az adatokon

    // SQL utasítások paraméterekkel
    $sql1 = "SELECT city_id FROM organizations WHERE org_id = :org_id";
    $sql2 = "INSERT INTO attractions (name, lattitude, longitude, category_id, org_id, city_id, description, address, image) 
             VALUES (:name, :lattitude, :longitude, :category_id, :org_id, :city_id, :description, :address, :image)";

    try {
        // Először lekérdezzük a city_id-t az adatbázisból
        $stmt = $pdo->prepare($sql1);
        $stmt->bindParam(':org_id', $orgId, PDO::PARAM_INT); // $orgId-t be kell állítani valahonnan
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Ha sikeres a lekérdezés, folytatjuk a beszúrást
        if ($result) {
            $cityId = $result['city_id'];

            // Képfeltöltés kezelése
            $uploadDir = '../images/attractions/'; // Feltöltött képek mappája
            $uploadPath = $uploadDir . basename($photo['name']); // Útvonal a feltöltött képhez

            // Képfeltöltés és adatbázisba mentés
            if (move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                $stmt = $pdo->prepare($sql2);
                $stmt->bindParam(':name', $attractionName, PDO::PARAM_STR);
                $stmt->bindParam(':lattitude', $lattitude, PDO::PARAM_STR);
                $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
                $stmt->bindParam(':category_id', $category, PDO::PARAM_INT);
                $stmt->bindParam(':org_id', $orgId, PDO::PARAM_INT); // $orgId-t be kell állítani valahonnan
                $stmt->bindParam(':city_id', $cityId, PDO::PARAM_INT);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                $stmt->bindParam(':image', $uploadPath, PDO::PARAM_STR);
                $stmt->execute();

                echo 'Success'; // Visszajelzés a kliensnek
            } else {
                echo 'Error uploading image';
            }
        } else {
            echo 'Invalid organization ID';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request';
}
