<?php
require_once '../classes/UserAuth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth = new UserAuth();
    $response = $auth->login($username, $password);

    if ($response === "success") {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $response]);
    }
}
?>
