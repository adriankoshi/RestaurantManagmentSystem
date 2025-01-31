<?php
require_once 'includes/header.php';
require_once 'classes/Orders.php';

if ($_SESSION['role'] !== 4) {
    session_destroy();
    header('Location: login.php');
    exit();
}

$tables = new Orders();
$getTables = $tables->getOrderDetails($_GET['id']);

?>

<div class="tables" style="width: 100%!important;">
    <div class="tables-body">

        <div class="tab-content" id="outdoor">

            <div class="container">
                <h2>Orders List</h2>
                <table id="tablesTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($getTables)) {
                            foreach ($getTables as $table) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($table['order_detail_id']); ?></td>
                                    <td><?php echo htmlspecialchars($table['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($table['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($table['unit_price']); ?></td>
                                    <td><?php echo htmlspecialchars($table['total_price']); ?></td>
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





<script>
    $(document).ready(function() {
        $('#tablesTable').DataTable();
    });
</script>

<?php
require_once 'includes/footer.php';
?>