<?php
require_once 'includes/header.php';
require_once 'classes/Orders.php';

if ($_SESSION['role'] !== 4) {
    session_destroy();
    header('Location: login.php');
    exit();
}

$tables = new Orders();
$getTables = $tables->getOrders();

?>

<div class="tables" style="width: 100%!important;">
    <div class="tables-body">

        <div class="tab-content" id="outdoor">

            <div class="container">
                <h2>Orders List</h2>
                <div class="table-responsive">
                <table id="tablesTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Table</th>
                            <th>Waiter</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Tax</th>
                            <th>Grand Total</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($getTables)) {
                            foreach ($getTables as $table) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($table['order_id']); ?></td>
                                    <td><?php echo htmlspecialchars($table['table_name']); ?></td>
                                    <td><?php echo htmlspecialchars($table['waiter_name']); ?></td>
                                    <td><?php echo htmlspecialchars($table['order_datetime']); ?></td>
                                    <td><?php echo htmlspecialchars($table['total']); ?></td>
                                    <td><?php echo htmlspecialchars($table['tax']); ?></td>
                                    <td><?php echo htmlspecialchars($table['grand_total']); ?></td>
                                    
                                    <td><a class="btn-submit btn-update" href="order-details.php?id=<?php echo htmlspecialchars($table['order_id']); ?>">Update</a></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
                </div>
            </div>
        </div>
        
    </div>
</div>





<script>
    $(document).ready(function() {
        $('#tablesTable').DataTable();
    });
</script>

<?php
require_once 'includes/footer.php';
?>