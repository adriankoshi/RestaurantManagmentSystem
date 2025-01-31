<?php
require_once 'db.php';

class Orders {

    public function saveOrder($table_id, $customer_name, $order_list) {
        // Create the database connection
        $config = new Database();
        $conn = $config->getConnection();
        
        // Calculate totals
        $order_datetime = date("Y-m-d H:i:s");
        $total = 0;
        $tax = 0;
        $grand_total = 0;
        
        foreach ($order_list as $item) {
            $total += $item['totalPrice'];
        }
        
        $tax = $total * 0.18;
        $grand_total = $total + $tax;
    
       
        $insertOrderQuery = "INSERT INTO orders (table_id, waiter_name, order_datetime, total, tax, grand_total) 
                             VALUES ('$table_id', '$customer_name', '$order_datetime', '$total', '$tax', '$grand_total')";
        if (mysqli_query($conn, $insertOrderQuery)) {
            $order_id = mysqli_insert_id($conn);

            foreach ($order_list as $item) {
                $insertDetailQuery = "INSERT INTO order_details (order_id, product_name, quantity, unit_price, total_price) 
                                      VALUES ('$order_id', '{$item['name']}', '{$item['quantity']}', '{$item['price']}', '{$item['totalPrice']}')";
                mysqli_query($conn, $insertDetailQuery);
            }
    
            mysqli_close($conn);
    
            return true;
        } else {

            mysqli_close($conn);
            return false;
        }
    }

    public function getOrders()
    {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT o.*, t.table_name FROM orders o inner join tables t on t.table_id = o.table_id;";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $floors[] = $row;
            }
            return $floors;
        } else {
            return array();
        }
        mysqli_close($conn);
    }

    public function getOrderDetails($id)
    {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT * FROM order_details WHERE order_id = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $floors[] = $row;
            }
            return $floors;
        } else {
            return array();
        }
        mysqli_close($conn);
    }
}


?>
