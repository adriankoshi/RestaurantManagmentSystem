<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'classes/db.php';

$config = new Database();
$conn = $config->getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['delete_booking'])) {
        $bookingId = $_POST['booking_id'];
        $conn->query("DELETE FROM orders WHERE order_id = $bookingId");
    }
    
    if (isset($_POST['reschedule_booking'])) {
        $bookingId = $_POST['booking_id'];
        $newDate = $_POST['new_date'];
        
        $conn->query("UPDATE orders SET order_datetime='$newDate' WHERE order_id=$bookingId");
    }
}

$bookings_result = $conn->query("SELECT * FROM orders");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'admin_sidebar.php'; ?> 

<div class="admin-content">
    <h2>Manage Bookings</h2>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Table ID</th>
                <th>Waiter</th>
                <th>Order Date</th>
                <th>New Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $bookings_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $booking['order_id']; ?></td>
                    <td><?php echo $booking['table_id']; ?></td>
                    <td><?php echo $booking['waiter_name']; ?></td>
                    <td><?php echo $booking['order_datetime']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="booking_id" value="<?php echo $booking['order_id']; ?>">
                            <input type="datetime-local" name="new_date">
                    </td>
                    <td>
                            <button type="submit" name="reschedule_booking" class="btn-edit">Reschedule</button>
                            <button type="submit" name="delete_booking" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
