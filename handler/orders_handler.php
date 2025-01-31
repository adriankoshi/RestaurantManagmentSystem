<?php
require_once '../classes/Orders.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order = new Orders();
    $order_list = json_decode($_POST['order'], true); 

    $table_id = $_POST['table_id']; 
    $waiter_name = $_POST['waiter_name'];

    if ($order->saveOrder($table_id, $waiter_name, $order_list)) {
        echo "Order saved successfully!";
    } else {
        echo "Error saving order.";
    }
}