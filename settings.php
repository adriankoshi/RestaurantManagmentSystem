<?php
require_once 'includes/header.php';
require_once 'classes/UserAUTH.php';

$users = new UserAUTH();
$getUser = $users->getUserDetailsById($_SESSION['user_id']); // This returns a single user

?>

<div class="tables" style="width: 100%!important;">
    <div class="profile-container">
        <?php if (!empty($getUser)) { ?>  
            <img src="https://via.placeholder.com/100" alt="Profile" class="profile-image">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Enter username" value="<?php echo htmlspecialchars($getUser['fullname']); ?>">
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="Enter email" value="<?php echo htmlspecialchars($getUser['email']); ?>">
            </div>
            <div class="input-group">
                <label for="role">Role</label>
                <input type="text" id="role" value="<?php echo htmlspecialchars($getUser['role_name']); ?>">
            </div>
        <?php } ?>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
