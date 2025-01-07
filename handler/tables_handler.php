<?php
require_once '../classes/Tables.php';

$tables = new Tables();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['action'] == 'add') {
        $table_name = $_POST['table_name'];
        $table_floor = $_POST['table_floor'];

        if ($tables->addTable($table_name, $table_floor)) {
            echo "New table added successfully!";
        } else {
            echo "Error adding new table.";
        }
    } elseif ($_GET['action'] == 'update') {
        $table_id = $_POST['table_id'];
        $table_name = $_POST['table_name'];
        $table_floor = $_POST['table_floor'];

        if ($tables->updateTable($table_id, $table_name, $table_floor)) {
            echo "Table updated successfully!";
        } else {
            echo "Error updating table.";
        }
    } elseif ($_GET['action'] == 'delete') {
        $table_id = $_POST['table_id'];
        if ($tables->deleteTable($table_id)) {
            echo "Table deleted successfully!";
        } else {
            echo "Error deleting table.";
        }
    }
} elseif ($_GET['action'] == 'get') {
    if (isset($_GET['id'])) {
        $table_id = $_GET['id'];
        $table = $tables->getTableById($table_id);
        echo json_encode($table);
    }
}
?>
