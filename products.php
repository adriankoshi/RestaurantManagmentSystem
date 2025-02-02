<?php
require_once 'includes/header.php';
require_once 'classes/Products.php';

if ($_SESSION['role'] !== 4) {
    session_destroy();
    header('Location: login.php');
    exit();
}

$tables = new Products();
$allGroups = $tables->getGroups();
$getTables = $tables->getProducts();

?>

<div class="tables" style="width: 100%!important;">
    <div class="tables-head">
        <ul>
            <li class="tab active" data-tab="outdoor"><a href="products.php?ID=1">Products</a></li>
            <li class="tab" data-tab="terrace"><a href="products.php?ID=2">Groups</a></li>
        </ul>
    </div>
    <div class="tables-body">

        <div class="tab-content" id="outdoor">

            <div class="container">

                <button id="addProductButton" class="btn-submit">Add New Product</button>
                <h2>Product List</h2>
                <div class="table-responsive">
                <table id="tablesTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Group</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($getTables)) {
                            foreach ($getTables as $table) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($table['id']); ?></td>
                                    <td><img src="assets/<?php echo htmlspecialchars($table['image']); ?>" alt="" style="width:80px"></td>
                                    <td><?php echo htmlspecialchars($table['name']); ?></td>
                                    <td><?php echo htmlspecialchars($table['price']); ?></td>
                                    <td><?php echo htmlspecialchars($table['group_name']); ?></td>
                                    <td><?php echo htmlspecialchars($table['created_by']); ?></td>
                                    <td><?php echo htmlspecialchars($table['updated_by']); ?></td>
                                    <td><?php echo htmlspecialchars($table['created_at']); ?></td>
                                    <td><?php echo htmlspecialchars($table['updated_at']); ?></td>
                                    <td><button class="btn-submit btn-update-product" data-id="<?php echo $table['id']; ?>">Update</button></td>
                                    <td><button class="btn-submit btn-delete-product" data-id="<?php echo $table['id']; ?>">Delete</button></td>
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
        <div class="tab-content" id="terrace" style="display: none">

            <div class="container">

                <button id="addFloorButton" class="btn-submit">Add New Group</button>
                <h2>Group List</h2>
                <div class="table-responsive">
                <table id="floorsTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Floor</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($allGroups)) {
                            foreach ($allGroups as $table) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($table['id']); ?></td>
                                    <td><?php echo htmlspecialchars($table['group_name']); ?></td>
                                    <td><?php echo htmlspecialchars($table['created_by']); ?></td>
                                    <td><?php echo htmlspecialchars($table['updated_by']); ?></td>
                                    <td><?php echo htmlspecialchars($table['created_at']); ?></td>
                                    <td><?php echo htmlspecialchars($table['updated_at']); ?></td>
                                    <td><button class="btn-submit btn-update" data-id="<?php echo $table['id']; ?>">Update</button></td>
                                    <td><button class="btn-submit btn-delete" data-id="<?php echo $table['id']; ?>">Delete</button></td>
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


<div id="addFloorModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="modalTitle">Add New Group</h2>
        <form id="addFloorForm">
            <input type="hidden" id="group_id" name="group_id">
            <label for="floor_name">Group Name:</label>
            <input type="text" id="group_name" name="group_name" required>
            <br><br>
            <button type="submit" class="btn-submit" id="submitBtn">Add Group</button>
        </form>
    </div>
</div>

<div id="addProductModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="modalTitle">Add New Product</h2>
        <form id="addProductForm">
            <input type="hidden" id="product_id" name="product_id">
            <input type="hidden" id="current_image" name="current_image">

            <img id="image_preview" src="#" alt="Product Image Preview" style="display:none; width: 100px; height: auto; margin-top: 10px;">
            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image">
            <br><br>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            <br><br>

            <label for="product_price">Product Price:</label>
            <input type="number" step="0.01" id="product_price" name="product_price" required>
            <br><br>

            <label for="group_name">Group:</label>
            <select name="group_id" id="group_id" required>
                <option value="">Select Group</option>
                <?php if (!empty($allGroups)) {
                    foreach ($allGroups as $group) { ?>
                        <option value="<?php echo htmlspecialchars($group['id']); ?>"><?php echo htmlspecialchars($group['group_name']); ?></option>
                    <?php }
                } else { ?>
                    <option value="">No groups available</option>
                <?php } ?>
            </select>
            <br><br>

            <button type="submit" class="btn-submit" id="submitBtnProducts">Add Product</button>
        </form>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#floorsTable').DataTable();
        $('#tablesTable').DataTable();
    });
</script>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("ID");

    const activeTabId = id === "2" ? "terrace" : "outdoor";

    const tabs = document.querySelectorAll(".tab");
    const tabContents = document.querySelectorAll(".tab-content");

    tabs.forEach((tab) => {
        const tabTarget = tab.getAttribute("data-tab");

        if (tabTarget === activeTabId) {
            tab.classList.add("active");
        } else {
            tab.classList.remove("active");
        }
    });

    tabContents.forEach((content) => {
        if (content.id === activeTabId) {
            content.style.display = "block";
        } else {
            content.style.display = "none";
        }
    });
</script>

<script>
    document.querySelectorAll(".reservations-head .tab").forEach((tab) => {
        tab.addEventListener("click", function() {
            const parent = this.closest(".reservations");

            parent.querySelectorAll(".tab").forEach((item) => item.classList.remove("active"));

            this.classList.add("active");

            parent.querySelectorAll(".tab-content").forEach((content) => (content.style.display = "none"));

            const targetContent = parent.querySelector(`#${this.getAttribute("data-tab")}`);
            if (targetContent) {
                targetContent.style.display = "block";
            }
        });
    });

    document.querySelectorAll(".tables-head .tab").forEach((tab) => {
        tab.addEventListener("click", function() {
            const parent = this.closest(".tables");

            parent.querySelectorAll(".tab").forEach((item) => item.classList.remove("active"));

            this.classList.add("active");

            parent.querySelectorAll(".tab-content").forEach((content) => (content.style.display = "none"));

            const targetContent = parent.querySelector(`#${this.getAttribute("data-tab")}`);
            if (targetContent) {
                targetContent.style.display = "block";
            }
        });
    });

    document.querySelector("#addTableButton").addEventListener("click", function() {
        document.getElementById("addTableModal").style.display = "block";
    });

    document.querySelector(".close-btn").addEventListener("click", function() {
        document.getElementById("addFloorModal").style.display = "none";
        document.getElementById("addTableModal").style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === document.getElementById("addFloorModal")) {
            document.getElementById("addFloorModal").style.display = "none";
        }
        if (event.target === document.getElementById("addTableModal")) {
            document.getElementById("addTableModal").style.display = "none";
        }
    });
</script>

<!-- FLOORS -->
<script>
    $(document).ready(function() {

        $("#addFloorButton").click(function() {
            $("#addFloorModal").show();
            $("#modalTitle").text("Add New Floor");
            $("#submitBtn").text("Add Floor");
            $("#group_id").val('');
            $("#group_name").val('');
        });

        $(".close-btn").click(function() {
            $("#addFloorModal").hide();
        });

        $(window).click(function(event) {
            if (event.target === document.getElementById("addFloorModal")) {
                $("#addFloorModal").hide();
            }
        });

        $("#addFloorForm").submit(function(e) {
            e.preventDefault();

            let groupId = $("#group_id").val();
            let groupName = $("#group_name").val();

            let url = groupId ? "handler/groups_handler.php?action=update" : "handler/groups_handler.php?action=add";

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    group_id: groupId,
                    group_name: groupName
                },
                success: function(response) {
                    alert(response);
                    $("#addFloorModal").hide();
                    window.location.href = 'products.php?ID=2'
                },
                error: function() {
                    alert("Error processing the request.");
                }
            });
        });

        $(document).on("click", ".btn-update", function() {
            let groupId = $(this).data("id");

            $.ajax({
                url: "handler/groups_handler.php?action=get",
                method: "GET",
                data: {
                    id: groupId
                },
                success: function(response) {
                    console.log("Response from server: ", response); // Debugging
                    let floor = JSON.parse(response);
                    if (floor) {
                        $("#group_id").val(floor.id);
                        $("#group_name").val(floor.group_name);
                        $("#modalTitle").text("Update Group");
                        $("#submitBtn").text("Update Group");
                        $("#addFloorModal").show(); // This should show the modal
                    } else {
                        alert("Group not found.");
                    }
                },
                error: function() {
                    alert("Error fetching group details.");
                }
            });
        });


        $(document).on("click", ".btn-delete", function() {
            let groupId = $(this).data("id");

            if (confirm("Are you sure you want to delete this Group?")) {
                $.ajax({
                    url: "handler/groups_handler.php?action=delete",
                    method: "POST",
                    data: {
                        group_id: groupId
                    },
                    success: function(response) {
                        alert(response);
                        window.location.href = 'products.php?ID=2'
                    },
                    error: function() {
                        alert("Error deleting floor.");
                    }
                });
            }
        });
    });
</script>

<!-- TABLE -->
<script>
    $(document).ready(function() {
        // Open the modal for adding a new product
        $("#addProductButton").click(function() {
            $("#addProductModal").show();
            $("#modalTitle").text("Add New Product");
            $("#submitBtnProducts").text("Add Product");
            $("#product_id").val(''); // Clear hidden input for new product
            $("#product_image").val(''); // Clear file input
            $("#product_name").val(''); // Clear text fields
            $("#product_price").val('');
            $("#group_id").val(''); // Clear select dropdown
        });

        $(".close-btn").click(function() {
            $("#addProductModal").hide();
        });

        $(window).click(function(event) {
            if (event.target === document.getElementById("addProductModal")) {
                $("#addProductModal").hide();
            }
        });

        $("#addProductForm").submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let productId = $("#product_id").val();
            let url = productId ? "handler/products_handler.php?action=update" : "handler/products_handler.php?action=add";

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                processData: false, // Important for file uploads
                contentType: false, // Important for file uploads
                success: function(response) {
                    alert(response);
                    $("#addProductModal").hide();
                    window.location.href = 'products.php?ID=1';
                },
                error: function() {
                    alert("Error processing the request.");
                },
            });
        });

        $(document).on("click", ".btn-update-product", function() {
            let productId = $(this).data("id");

            $.ajax({
                url: "handler/products_handler.php?action=get",
                method: "GET",
                data: {
                    id: productId
                },
                success: function(response) {
                    let product = JSON.parse(response);
                    if (product) {
                        $("#product_id").val(product.id);
                        $("#product_name").val(product.name);
                        $("#product_price").val(product.price);
                        $("#group_id").val(product.group_id);
                        $("#current_image").val(product.image); // Set current image in the hidden field

                        if (product.image) {
                            $("#image_preview").attr("src", "path_to_images/" + product.image).show();
                        } else {
                            $("#image_preview").hide();
                        }

                        $("#modalTitle").text("Update Product");
                        $("#submitBtnProducts").text("Update Product");
                        $("#addProductModal").show();
                    } else {
                        alert("Product not found.");
                    }
                },
                error: function() {
                    alert("Error fetching product details.");
                },
            });
        });


        // Listen for file input changes to update the preview dynamically
        $("#product_image").change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#image_preview").attr("src", e.target.result).show();
            };
            reader.readAsDataURL(this.files[0]);
        });


        // Handle Delete button click (for products)
        $(document).on("click", ".btn-delete-product", function() {
            let productId = $(this).data("id");

            if (confirm("Are you sure you want to delete this product?")) {
                $.ajax({
                    url: "handler/products_handler.php?action=delete",
                    method: "POST",
                    data: {
                        id: productId
                    },
                    success: function(response) {
                        alert(response);
                        window.location.href = 'products.php?ID=1';
                    },
                    error: function() {
                        alert("Error deleting product.");
                    },
                });
            }
        });
    });
</script>

<?php
require_once 'includes/footer.php';
?>