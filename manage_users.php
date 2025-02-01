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
    if (isset($_POST['edit_user'])) {
        $userId = $_POST['user_id'];
        $fullname = $_POST['fullname'] ?? ''; 
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? 'user';

        if (!empty($fullname) && !empty($email)) {
            $stmt = $conn->prepare("UPDATE users SET fullname=?, email=?, role=? WHERE id=?");
            $stmt->bind_param("sssi", $fullname, $email, $role, $userId);
            $stmt->execute();
            $stmt->close();
        }
    }

    if (isset($_POST['delete_user'])) {
        $userId = $_POST['user_id'];
        $conn->query("DELETE FROM users WHERE id = $userId");
    }
}

$users_result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'admin_sidebar.php'; ?>

<div class="admin-content">
    <h2>Manage Users</h2>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $users_result->fetch_assoc()) { ?>
                <tr>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <td><?php echo $user['id']; ?></td>
                        <td><input type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required></td>
                        <td><input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required></td>
                        <td>
                            <select name="role">
                                <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" name="edit_user" class="btn-edit">Save</button>
                            <button type="submit" name="delete_user" class="btn-delete">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
