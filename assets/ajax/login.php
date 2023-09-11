<?php
// session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT user_id, password, permission, working_at FROM users WHERE username = :username AND (active = 1 OR active = 4)";

$query = $pdo->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();

$data = [];
if ($query->rowCount() > 0) {
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $data['user_id'] = (int)$row['user_id'];
        $registeredPassword = $row['password'];
        $data['permission'] = $row['permission'];
        if ($data['permission'] == 2) {
            // Ellenőrizd, hogy a megadott jelszó megegyezik-e a tárolt hashelt jelszóval
            if (password_verify($password, $registeredPassword)) {
                $_SESSION['permission'] = $row['permission'];
                $_SESSION['user_id'] = (int)$row['user_id'];
                // További műveletek...
                $response = array('success' => true, 'message' => 'Logged in', 'url' => 'views_website/index.php');
                echo json_encode($response);
                exit;
            }
        }
        if ($data['permission'] == 4) {
            // Ellenőrizd, hogy a megadott jelszó megegyezik-e a tárolt hashelt jelszóval
            if (password_verify($password, $registeredPassword)) {
                $_SESSION['permission'] = $row['permission'];
                $_SESSION['user_id'] = (int)$row['user_id'];
                $_SESSION['working_at'] = (int)$row['working_at'];

                $response = array('success' => true, 'message' => 'Logged in', 'url' => 'views_mobile/worker_index.php');
                echo json_encode($response);
                exit;
            }
        }
        if ($data['permission'] == 1) {
            // Ellenőrizd, hogy a megadott jelszó megegyezik-e a tárolt hashelt jelszóval
            if (password_verify($password, $registeredPassword)) {
                $_SESSION['permission'] = $row['permission'];
                $_SESSION['user_id'] = (int)$row['user_id'];
                $_SESSION['working_at'] = (int)$row['working_at'];

                $response = array('success' => true, 'message' => 'Logged in', 'url' => 'admin/index.php');
                echo json_encode($response);
                exit;
            }
        }
    }
}
$sql = "SELECT org_id, password, permission FROM organizations WHERE username = :username AND active = 1";
$query = $pdo->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();

if ($query->rowCount() > 0) {
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $data['user_id'] = (int)$row['org_id'];
        $registeredPassword = $row['password'];
        $data['permission'] = $row['permission'];
        if ($data['permission'] == 3) {
            // Ellenőrizd, hogy a megadott jelszó megegyezik-e a tárolt hashelt jelszóval
            if (password_verify($password, $registeredPassword)) {
                $_SESSION['permission'] = $row['permission'];
                $_SESSION['user_id'] = (int)$row['org_id'];
                // További műveletek...
                $response = array('success' => true, 'message' => 'Logged in', 'url' => 'views_website/index.php');
                echo json_encode($response);
                exit;
            }
        }
    }
}

// Ha nem található a felhasználó vagy a jelszó nem egyezik meg
$response = array('success' => false, 'message' => 'Invalid username or password.');
echo json_encode($response);


