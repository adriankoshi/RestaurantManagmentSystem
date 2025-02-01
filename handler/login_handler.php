<?php
require_once '../classes/UserAuth.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
        exit;
    }

    $auth = new UserAuth();
    $loginResult = $auth->login($username, $password);

    if ($loginResult === "admin") {
        $_SESSION['role'] = "admin"; 
        echo json_encode(['status' => 'success', 'redirect' => 'admin_dashboard.php']);
    } elseif ($loginResult === "success") {
        echo json_encode(['status' => 'success', 'redirect' => 'index.php']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $loginResult]);
    }
}
?>
