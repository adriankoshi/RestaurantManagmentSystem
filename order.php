<?php
require_once 'includes/header.php';
require_once 'classes/Products.php';

$tables = new Products();
$allFloors = $tables->getGroups();
$getTables = $tables->getProductsByGroup($_GET['gid']);
?>
<section class="tables-content" style="display: flex; width:100%; flex-wrap: wrap;">
    <div style="width: 65%;">
        <div class="tables" style="width: 100%;">
            <h2>Groups</h2>
            <div class="tables-body">
                <div class="tab-content">

                    <div class="row-table">
                        <?php if (!empty($allFloors)) {
                            foreach ($allFloors as $table) { ?>

                                <a class="table-link" href="order.php?id=<?php echo $_GET['id']; ?>&gid=<?php echo $table['id']; ?>">
                                    <?php echo htmlspecialchars($table['group_name']); ?>
                                </a>

                        <?php
                            }
                        } else {
                            echo "No floors found.";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="tables mt-3" style="margin-top: 10px!important; width: 100%;">
            <h2>Products</h2>
            <div class="tables-body">

                <div class="tab-content">

                    <div class="row-table">
                        <?php if (!empty($getTables)) {
                            foreach ($getTables as $table) { ?>
                                <div class="table-link product" data-name="<?php echo htmlspecialchars($table['name']); ?>"
                                    data-price="<?php echo htmlspecialchars($table['price']); ?>"
                                    style="background-image: url('assets/<?php echo ($table['image']); ?>'); 
                                    background-size: cover; background-position: center;  
                                    display: flex; align-items: center; justify-content: center; 
                                    color: white; font-weight: bold; flex-wrap: wrap!important; cursor: pointer;">
                                    <p><?php echo htmlspecialchars($table['name']); ?></p>
                                    <br />
                                    <small><?php echo htmlspecialchars($table['price']); ?> $</small>
                                </div>
                        <?php }
                        } else {
                            echo "Please Select Group";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="width: 30%;">
        <div class="tables" style="width: 100%; height:100%">
            <h2>Order</h2>
            <div class="tables-body">
                <ul id="order-list"></ul>
                <p><strong>Total:</strong> $<span id="total">0.00</span></p>
                <p><strong>Tax (18%):</strong> $<span id="tax">0.00</span></p>
                <p><strong>Grand Total:</strong> $<span id="grand-total">0.00</span></p>
                <button id="clear-all">Remove All</button>
                <button id="save-order">Save Order</button>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    let orderList = [];
    let total = 0;

    // Load the saved order from sessionStorage, if it exists
    if (sessionStorage.getItem('orderList')) {
        orderList = JSON.parse(sessionStorage.getItem('orderList'));
        updateOrderList();  // Re-render the order from storage
    }

    $(".product").click(function() {
        let name = $(this).data("name");
        let price = parseFloat($(this).data("price"));

        // Check if product already exists in orderList
        let product = orderList.find(item => item.name === name);

        if (product) {
            product.quantity += 1;
            product.totalPrice += price;
        } else {
            orderList.push({
                name: name,
                price: price,
                quantity: 1,
                totalPrice: price
            });
        }

        // Save the updated order to sessionStorage
        sessionStorage.setItem('orderList', JSON.stringify(orderList));
        updateOrderList();
    });

    function updateOrderList() {
        let orderHTML = "";
        total = 0;

        $.each(orderList, function(index, item) {
            total += item.totalPrice;
            orderHTML += `<li>
                <span>${item.name} x${item.quantity} - $${item.totalPrice.toFixed(2)}</span>
                <div class="order-buttons">
                    <button class="remove-one" data-name="${item.name}">-</button>
                    <button class="remove-all" data-name="${item.name}">X</button>
                </div>
            </li>`;
        });

        let tax = total * 0.18;
        let grandTotal = total + tax;

        $("#order-list").html(orderHTML);
        $("#total").text(total.toFixed(2));
        $("#tax").text(tax.toFixed(2));
        $("#grand-total").text(grandTotal.toFixed(2));
    }

    $(document).on("click", ".remove-one", function() {
        let name = $(this).data("name");
        let product = orderList.find(item => item.name === name);

        if (product) {
            if (product.quantity > 1) {
                product.quantity -= 1;
                product.totalPrice -= product.price;
            } else {
                orderList = orderList.filter(item => item.name !== name);
            }
        }

        // Save the updated order to sessionStorage
        sessionStorage.setItem('orderList', JSON.stringify(orderList));
        updateOrderList();
    });

    $(document).on("click", ".remove-all", function() {
        let name = $(this).data("name");
        orderList = orderList.filter(item => item.name !== name);

        // Save the updated order to sessionStorage
        sessionStorage.setItem('orderList', JSON.stringify(orderList));
        updateOrderList();
    });

    $("#clear-all").click(function() {
        orderList = [];
        sessionStorage.removeItem('orderList');  // Clear order from sessionStorage
        updateOrderList();
    });

    $("#save-order").click(function() {
        console.log({
            order: JSON.stringify(orderList),
            table_id: <?php echo $_GET['id']; ?>,
            waiter_name: '<?php echo $_SESSION['username']; ?>'
        });

        $.ajax({
            url: "handler/orders_handler.php",
            type: "POST",
            data: {
                order: JSON.stringify(orderList),
                table_id: <?php echo $_GET['id']; ?>,
                waiter_name: '<?php echo $_SESSION['username']; ?>'
            },
            success: function(response) {
                alert("Order saved successfully!");
                orderList = [];
                sessionStorage.removeItem('orderList');  // Clear order from sessionStorage after save
                updateOrderList();
            },
            error: function() {
                alert("Error saving order.");
            }
        });
    });
});


</script>
<?php
require_once 'includes/footer.php';
?>