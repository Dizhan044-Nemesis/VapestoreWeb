<?php
include_once('controller/ProfileController.php');
use Controller\ProfileController;

// Pastikan koneksi database sudah tersedia, jika belum buat objek koneksi
// $conn = new mysqli('localhost', 'root', '', 'vapestore'); // Sesuaikan dengan koneksi Anda

// Inisialisasi controller
$profileController = new ProfileController($conn);

// Cek apakah parameter 'action' ada di query string
$action = isset($_GET['action']) ? $_GET['action'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action == 'profile') {
        $profileController->getProfile();
    } else {
        echo json_encode(["error" => "Action not specified or invalid"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));
    if ($action == 'profile') {
        $profileController->createProfile($data);
    } else {
        echo json_encode(["error" => "Action not specified or invalid"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'));
    if ($action == 'profile') {
        $profileController->updateProfile($data);
    } else {
        echo json_encode(["error" => "Action not specified or invalid"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'));
    if ($action == 'profile') {
        $profileController->deleteProfile($data);
    } else {
        echo json_encode(["error" => "Action not specified or invalid"]);
    }
} else {
    echo json_encode(["error" => "Method not allowed"]);
}
?>
