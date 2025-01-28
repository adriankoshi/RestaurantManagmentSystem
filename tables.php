<?php
require_once 'includes/header.php';
require_once 'classes/Tables.php';

if($_SESSION['role'] !== 4){
    session_destroy();
    header('Location: login.php');
    exit();
}

$tables = new Tables();
$allTables = $tables->getFloors();
$getTables = $tables->getTables();

?>

<div class="tables" style="width: 100%!important;">
    <div class="tables-head">
        <ul>
            <li class="tab active" data-tab="outdoor"><a href="tables.php?ID=1">Tables</a></li>
            <li class="tab" data-tab="terrace"><a href="tables.php?ID=2">Floors</a></li>
        </ul>
    </div>
    <div class="tables-body">

        <div class="tab-content" id="outdoor">

            <div class="container">

                <button id="addTableButton" class="btn-submit">Add New Table</button>
                <h2>Table List</h2>
                <table id="tablesTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Table Name</th>
                            <th>Table Floor</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($getTables)) {
                            foreach ($getTables as $table) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($table['table_id']); ?></td>
                                    <td><?php echo htmlspecialchars($table['table_name']); ?></td>
                                    <td><?php echo htmlspecialchars($table['tf_name']); ?></td>
                                    <td><button class="btn-submit btn-update-table" data-id="<?php echo $table['table_id']; ?>">Update</button></td>
                                    <td><button class="btn-submit btn-delete-table" data-id="<?php echo $table['table_id']; ?>">Delete</button></td>
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
        <div class="tab-content" id="terrace" style="display: none">

            <div class="container">

                <button id="addFloorButton" class="btn-submit">Add New Floor</button>
                <h2>Floors List</h2>
                <table id="floorsTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Floor</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($allTables)) {
                            foreach ($allTables as $table) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($table['tf_id']); ?></td>
                                    <td><?php echo htmlspecialchars($table['tf_name']); ?></td>
                                    <td><button class="btn-submit btn-update" data-id="<?php echo $table['tf_id']; ?>">Update</button></td>
                                    <td><button class="btn-submit btn-delete" data-id="<?php echo $table['tf_id']; ?>">Delete</button></td>
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


<div id="addFloorModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="modalTitle">Add New Floor</h2>
        <form id="addFloorForm">
            <input type="hidden" id="floor_id" name="floor_id">
            <label for="floor_name">Floor Name:</label>
            <input type="text" id="floor_name" name="floor_name" required>
            <br><br>
            <button type="submit" class="btn-submit" id="submitBtn">Add Floor</button>
        </form>
    </div>
</div>

<div id="addTableModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="modalTitle">Add New Table</h2>
        <form id="addTableForm">
            <input type="hidden" id="table_id" name="table_id">
            <label for="table_name">Table Name:</label>
            <input type="text" id="table_name" name="table_name" required>
            <br><br>
            <label for="table_name">Table Floor:</label>
            <select name="table_floor" id="table_floor">
                <option value=""></option>

                <?php if (!empty($allTables)) {
                    foreach ($allTables as $table) { ?>
                        <option value="<?php echo htmlspecialchars($table['tf_id']); ?>"><?php echo htmlspecialchars($table['tf_name']); ?></option>
                    <?php }
                } else { ?>
                    <option colspan="3">No data available</td>
                    <?php } ?>
            </select>
            <br><br>
            <button type="submit" class="btn-submit" id="submitBtnTables">Add Table</button>
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
            $("#floor_id").val('');
            $("#floor_name").val('');
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

            let floorId = $("#floor_id").val();
            let floorName = $("#floor_name").val();

            let url = floorId ? "handler/floors_handler.php?action=update" : "handler/floors_handler.php?action=add";

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    floor_id: floorId,
                    floor_name: floorName
                },
                success: function(response) {
                    alert(response);
                    $("#addFloorModal").hide();
                    window.location.href = 'tables.php?ID=2'
                },
                error: function() {
                    alert("Error processing the request.");
                }
            });
        });

        $(document).on("click", ".btn-update", function() {
            let floorId = $(this).data("id");

            $.ajax({
                url: "handler/floors_handler.php?action=get",
                method: "GET",
                data: {
                    id: floorId
                },
                success: function(response) {
                    let floor = JSON.parse(response);
                    if (floor) {
                        $("#floor_id").val(floor.tf_id);
                        $("#floor_name").val(floor.tf_name);
                        $("#modalTitle").text("Update Floor");
                        $("#submitBtn").text("Update Floor");
                        $("#addFloorModal").show();
                    } else {
                        alert("Floor not found.");
                    }
                },
                error: function() {
                    alert("Error fetching floor details.");
                }
            });
        });

        $(document).on("click", ".btn-delete", function() {
            let floorId = $(this).data("id");

            if (confirm("Are you sure you want to delete this floor?")) {
                $.ajax({
                    url: "handler/floors_handler.php?action=delete",
                    method: "POST",
                    data: {
                        floor_id: floorId
                    },
                    success: function(response) {
                        alert(response);
                        window.location.href = 'tables.php?ID=2'
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

// Open the modal when "Add New Table" button is clicked
$("#addTableButton").click(function() {
    $("#addTableModal").show();
    $("#modalTitle").text("Add New Table");
    $("#submitBtnTables").text("Add Table");
    $("#table_id").val('');  // Clear hidden input for new table
    $("#table_name").val('');  // Clear input fields
    $("#table_floor").val('');  // Clear the select option
});

// Close the modal when the "x" (close) button is clicked
$(".close-btn").click(function() {
    $("#addTableModal").hide();
});

// Close the modal if clicked outside of the modal content
$(window).click(function(event) {
    if (event.target === document.getElementById("addTableModal")) {
        $("#addTableModal").hide();
    }
});

// Handle form submission for adding or updating a table
$("#addTableForm").submit(function(e) {
    e.preventDefault();

    let tableId = $("#table_id").val();
    let tableName = $("#table_name").val();
    let tableFloor = $("#table_floor").val();

    let url = tableId ? "handler/tables_handler.php?action=update" : "handler/tables_handler.php?action=add";

    $.ajax({
        url: url,
        method: "POST",
        data: {
            table_id: tableId,
            table_name: tableName,
            table_floor: tableFloor
        },
        success: function(response) {
            alert(response);
            $("#addTableModal").hide();
            window.location.href = 'tables.php?ID=1'
        },
        error: function() {
            alert("Error processing the request.");
        }
    });
});

// Handle Update button click (for existing tables)
$(document).on("click", ".btn-update-table", function() {
    let tableId = $(this).data("id");

    $.ajax({
        url: "handler/tables_handler.php?action=get",
        method: "GET",
        data: { id: tableId },
        success: function(response) {
            let table = JSON.parse(response);
            if (table) {
                $("#table_id").val(table.table_id);
                $("#table_name").val(table.table_name);
                $("#table_floor").val(table.table_floor);
                $("#modalTitle").text("Update Table");
                $("#submitBtnTables").text("Update Table");
                $("#addTableModal").show();
            } else {
                alert("Table not found.");
            }
        },
        error: function() {
            alert("Error fetching table details.");
        }
    });
});

// Handle Delete button click (for tables)
$(document).on("click", ".btn-delete-table", function() {
    let tableId = $(this).data("id");

    if (confirm("Are you sure you want to delete this table?")) {
        $.ajax({
            url: "handler/tables_handler.php?action=delete",
            method: "POST",
            data: { table_id: tableId },
            success: function(response) {
                alert(response);
                window.location.href = 'tables.php?ID=1'
            },
            error: function() {
                alert("Error deleting table.");
            }
        });
    }
});

});

</script>

<?php
require_once 'includes/footer.php';
?>