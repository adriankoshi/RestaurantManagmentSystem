<?php
require_once 'includes/header.php';
require_once 'classes/UserAUTH.php';

if($_SESSION['role'] !== 4){
    session_destroy();
    header('Location: login.php');
    exit();
}

$users = new UserAUTH();
$getRoles = $users->getRoles();
$getUsers = $users->getUsers();

?>

<div class="tables" style="width: 100%!important;">
    <div class="tables-head">
        <ul>
            <li class="tab active" data-tab="outdoor"><a href="users.php?ID=1">Users</a></li>
            <li class="tab" data-tab="terrace"><a href="users.php?ID=2">Roles</a></li>
        </ul>
    </div>
    <div class="tables-body">

        <div class="tab-content" id="outdoor">

            <div class="container">

            <button id="addUserButton" class="btn-submit">Add New User</button>
        <h2>User List</h2>
        <div class="table-responsive">
        <table id="usersTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($getUsers)) {
                    foreach ($getUsers as $user) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['role_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['created_by']); ?></td>
                            <td><?php echo htmlspecialchars($user['updated_by']); ?></td>
                            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                            <td><?php echo htmlspecialchars($user['updated_at']); ?></td>
                            <td><button class="btn-submit btn-update-user" data-id="<?php echo $user['id']; ?>">Update</button></td>
                            <td><button class="btn-submit btn-delete-user" data-id="<?php echo $user['id']; ?>">Delete</button></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="10">No data available</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
            </div>
            </div>
        </div>
        <div class="tab-content" id="terrace" style="display: none">

            <div class="container">

                <button id="addRoleButton" class="btn-submit">Add New Role</button>
                <h2>Role List</h2>
                <div class="table-responsive">
                <table id="floorsTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Cpdated At</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($getRoles)) {
                            foreach ($getRoles as $role) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($role['id']); ?></td>
                                    <td><?php echo htmlspecialchars($role['role_name']); ?></td>
                                    <td><?php echo htmlspecialchars($role['created_at']); ?></td>
                                    <td><?php echo htmlspecialchars($role['updated_at']); ?></td>
                                    <td><?php echo htmlspecialchars($role['created_by']); ?></td>
                                    <td><?php echo htmlspecialchars($role['updated_by']); ?></td>
                                    <td><button class="btn-submit btn-update" data-id="<?php echo $role['id']; ?>">Update</button></td>
                                    <td><button class="btn-submit btn-delete" data-id="<?php echo $role['id']; ?>">Delete</button></td>
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


<div id="addRoleModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="modalTitle">Add New Role</h2>
        <form id="addRoleForm">
            <input type="hidden" id="role_id" name="role_id">
            <label for="role_name">Role Name:</label>
            <input type="text" id="role_name" name="role_name" required>
            <br><br>
            <button type="submit" class="btn-submit" id="submitBtn">Add Role</button>
        </form>
    </div>
</div>

<div id="addUserModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="modalUserTitle">Add New User</h2>
        <form id="addUserForm">
            <input type="hidden" id="user_id" name="user_id">
            
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
            <br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <small>* Leave blank if not updating</small>
            <br><br>
            
            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="">Select a role</option>
                <?php if (!empty($getRoles)) {
                    foreach ($getRoles as $role) { ?>
                        <option value="<?php echo htmlspecialchars($role['id']); ?>">
                            <?php echo htmlspecialchars($role['role_name']); ?>
                        </option>
                    <?php }
                } else { ?>
                    <option>No roles available</option>
                <?php } ?>
            </select>
            <br><br>
            
            <button type="submit" class="btn-submit" id="submitBtnUsers">Add User</button>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#floorsTable').DataTable();
        $('#usersTable').DataTable();
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
        document.getElementById("addRoleModal").style.display = "none";
        document.getElementById("addTableModal").style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === document.getElementById("addRoleModal")) {
            document.getElementById("addRoleModal").style.display = "none";
        }
        if (event.target === document.getElementById("addTableModal")) {
            document.getElementById("addTableModal").style.display = "none";
        }
    });
</script>

<!-- ROLES -->
<script>
    $(document).ready(function () {
    $("#addRoleButton").click(function () {
        $("#addRoleModal").show();
        $("#modalTitle").text("Add New Role");
        $("#submitBtn").text("Add Role");
        $("#role_id").val('');
        $("#role_name").val('');
    });

    $(".close-btn").click(function () {
        $("#addRoleModal").hide();
    });

    $(window).click(function (event) {
        if (event.target === document.getElementById("addRoleModal")) {
            $("#addRoleModal").hide();
        }
    });

    $("#addRoleForm").submit(function (e) {
        e.preventDefault();

        let roleId = $("#role_id").val();
        let roleName = $("#role_name").val();

        let url = roleId ? "handler/roles_handler.php?action=update" : "handler/roles_handler.php?action=add";

        $.ajax({
            url: url,
            method: "POST",
            data: {
                role_id: roleId,
                role_name: roleName
            },
            success: function (response) {
                alert(response);
                $("#addRoleModal").hide();
                window.location.href = 'users.php?ID=2';
            },
            error: function () {
                alert("Error processing the request.");
            }
        });
    });

    $(document).on("click", ".btn-update", function () {
        let roleId = $(this).data("id");

        $.ajax({
            url: "handler/roles_handler.php?action=get",
            method: "GET",
            data: {
                id: roleId
            },
            success: function (response) {
                let role = JSON.parse(response);
                if (role) {
                    $("#role_id").val(role.id);
                    $("#role_name").val(role.role_name);
                    $("#modalTitle").text("Update Role");
                    $("#submitBtn").text("Update Role");
                    $("#addRoleModal").show();
                } else {
                    alert("Role not found.");
                }
            },
            error: function () {
                alert("Error fetching role details.");
            }
        });
    });

    $(document).on("click", ".btn-delete", function () {
        let roleId = $(this).data("id");

        if (confirm("Are you sure you want to delete this role?")) {
            $.ajax({
                url: "handler/roles_handler.php?action=delete",
                method: "POST",
                data: {
                    role_id: roleId
                },
                success: function (response) {
                    alert(response);
                    window.location.href = 'users.php?ID=2';
                },
                error: function () {
                    alert("Error deleting role.");
                }
            });
        }
    });
});
</script>

<!-- USERS -->
<script>
   $(document).ready(function() {
    $("#addUserButton").click(function() {
        $("#addUserModal").show();
        $("#modalUserTitle").text("Add New User");
        $("#submitBtnUsers").text("Add User");
        $("#user_id").val(''); 
        $("#fullname").val('');
        $("#email").val('');
        $("#password").val('');
        $("#role").val(''); 
    });


    $(".close-btn").click(function() {
        $("#addUserModal").hide();
    });

    $(window).click(function(event) {
        if (event.target === document.getElementById("addUserModal")) {
            $("#addUserModal").hide();
        }
    });

    $("#addUserForm").submit(function(e) {
    e.preventDefault();

    let userId = $("#user_id").val();
    let fullname = $("#fullname").val();
    let email = $("#email").val();
    let password = $("#password").val();
    let role = $("#role").val();

    let url = userId ? "handler/users_handler.php?action=update" : "handler/users_handler.php?action=add";

    $.ajax({
        url: url,
        method: "POST",
        data: {
            user_id: userId,
            fullname: fullname,
            email: email,
            password: password,
            role: role
        },
        success: function(response) {
            alert(response);
            $("#addUserModal").hide();
            window.location.href = 'users.php?ID=1';
        },
        error: function() {
            alert("Error processing the request.");
        }
    });
});


    // Handle update button click
    $(document).on("click", ".btn-update-user", function() {
        let userId = $(this).data("id");

        $.ajax({
            url: "handler/users_handler.php?action=get",
            method: "GET",
            data: { id: userId },
            success: function(response) {
                let user = JSON.parse(response);
                if (user) {
                    $("#user_id").val(user.id);
                    $("#fullname").val(user.fullname);
                    $("#email").val(user.email);
                    $("#role").val(user.role_id);
                    $("#modalUserTitle").text("Update User");
                    $("#submitBtnUsers").text("Update User");
                    $("#addUserModal").show();
                } else {
                    alert("User not found.");
                }
            },
            error: function() {
                alert("Error fetching user details.");
            }
        });
    });

    // Handle delete button click
    $(document).on("click", ".btn-delete-user", function() {
        let userId = $(this).data("id");

        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: "handler/users_handler.php?action=delete",
                method: "POST",
                data: { user_id: userId },
                success: function(response) {
                    alert(response);
                    window.location.href = 'users.php?ID=1';
                },
                error: function() {
                    alert("Error deleting user.");
                }
            });
        }
    });
});


</script>

<?php
require_once 'includes/footer.php';
?>