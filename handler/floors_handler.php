<?php
require_once '../classes/Tables.php';

$tables = new Tables();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['action'] == 'add') {
        $floor_name = $_POST['floor_name'];
        if ($tables->addFloor($floor_name)) {
            echo "New floor added successfully!";
        } else {
            echo "Error adding new floor.";
        }
    } elseif ($_GET['action'] == 'update') {
        $floor_id = $_POST['floor_id'];
        $floor_name = $_POST['floor_name'];
        if ($tables->updateFloor($floor_id, $floor_name)) {
            echo "Floor updated successfully!";
        } else {
            echo "Error updating floor.";
        }
    } elseif ($_GET['action'] == 'delete') {
        $floor_id = $_POST['floor_id'];
        if ($tables->deleteFloor($floor_id)) {
            echo "Floor deleted successfully!";
        } else {
            echo "Error deleting floor.";
        }
    }
} elseif ($_GET['action'] == 'get') {
    if (isset($_GET['id'])) {
        $floor_id = $_GET['id'];
        $floor = $tables->getFloors();
        $found = null;

        foreach ($floor as $item) {
            if ($item['tf_id'] == $floor_id) {
                $found = $item;
                break;
            }
        }

        echo json_encode($found);
    }
}
?>
