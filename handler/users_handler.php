<?php
require_once '../classes/UserAuth.php';

$users = new UserAuth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['action'] == 'add') {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role_id = $_POST['role'];

        if ($users->addUser($fullname, $email, $password, $role_id)) {
            echo "New user added successfully!";
        } else {
            echo "Error adding new user.";
        }
    } elseif ($_GET['action'] == 'update') {
        $user_id = $_POST['user_id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = !empty($_POST['password']) ? md5($_POST['password']) : null;
        $role_id = $_POST['role'];

        if ($users->updateUser($user_id, $fullname, $email, $password, $role_id)) {
            echo "User updated successfully!";
        } else {
            echo "Error updating user.";
        }
    } elseif ($_GET['action'] == 'delete') {
        $user_id = $_POST['user_id'];
        if ($users->deleteUser($user_id)) {
            echo "User deleted successfully!";
        } else {
            echo "Error deleting user.";
        }
    }
} elseif ($_GET['action'] == 'get') {
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
        $user = $users->getUserById($user_id);
        echo json_encode($user);
    }
}
?>
