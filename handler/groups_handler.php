<?php
require_once '../classes/Products.php';

$tables = new Products();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['action'] == 'add') {
        $floor_name = $_POST['group_name'];
        if ($tables->addGroup($floor_name)) {
            echo "New Group added successfully!";
        } else {
            echo "Error adding new floor.";
        }
    } elseif ($_GET['action'] == 'update') {
        $floor_id = $_POST['group_id'];
        $floor_name = $_POST['group_name'];
        if ($tables->updateGroup($floor_id, $floor_name)) {
            echo "Group updated successfully!";
        } else {
            echo "Error updating floor.";
        }
    } elseif ($_GET['action'] == 'delete') {
        $floor_id = $_POST['group_id'];
        if ($tables->deleteGroup($floor_id)) {
            echo "Group deleted successfully!";
        } else {
            echo "Error deleting floor.";
        }
    }
} elseif ($_GET['action'] == 'get') {
    if (isset($_GET['id'])) {
        $floor_id = $_GET['id'];
        $floor = $tables->getGroups();
        $found = null;

        foreach ($floor as $item) {
            if ($item['id'] == $floor_id) {
                $found = $item;
                break;
            }
        }

        echo json_encode($found);
    }
}
?>
