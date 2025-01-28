<?php
require_once '../classes/UserAuth.php';

$roles = new UserAuth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['action'] == 'add') {
        $role_name = $_POST['role_name'];
        if ($roles->addRole($role_name)) {
            echo "New role added successfully!";
        } else {
            echo "Error adding new role.";
        }
    } elseif ($_GET['action'] == 'update') {
        $role_id = $_POST['role_id'];
        $role_name = $_POST['role_name'];
        if ($roles->updateRole($role_id, $role_name)) {
            echo "Role updated successfully!";
        } else {
            echo "Error updating role.";
        }
    } elseif ($_GET['action'] == 'delete') {
        $role_id = $_POST['role_id'];
        if ($roles->deleteRole($role_id)) {
            echo "Role deleted successfully!";
        } else {
            echo "Error deleting role.";
        }
    }
} elseif ($_GET['action'] == 'get') {
    if (isset($_GET['id'])) {
        $role_id = $_GET['id'];
        $rolesData = $roles->getRoles();
        $found = null;

        foreach ($rolesData as $item) {
            if ($item['id'] == $role_id) {
                $found = $item;
                break;
            }
        }

        echo json_encode($found);
    }
}
?>
