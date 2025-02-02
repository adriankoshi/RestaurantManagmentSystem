<?php
require_once 'db.php';

class UserAuth {
    public function login($username, $password) {
        session_start();
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("SELECT u.id, u.fullname, r.role_name, u.role_id, u.email, u.created_at, u.updated_at, u.created_at, u.created_by, u.updated_by, u.password FROM users u inner join roles r on r.id = u.role_id WHERE u.fullname = ? and u.password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['fullname'];
                $_SESSION['role'] = $user['role_id'];

                return true;
            
        } else {
            return "Username or password wrong.";
        }

        $stmt->close();
        mysqli_close($conn);
    }

    public function getUsers() {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT u.id, u.fullname, r.role_name, u.email, u.created_at, u.updated_at, u.created_at, u.created_by, u.updated_by FROM users u inner join roles r on r.id = u.role_id;";
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

    public function getUserById($user_id) {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $table = $result->fetch_assoc();

        $stmt->close();
        mysqli_close($conn);

        return $table;
    }

    public function addUser($fullname, $email, $password, $role_id) {
        session_start();
        $config = new Database();
        $conn = $config->getConnection();

        // Correct way to access $_SESSION
        $inserted_by = isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown';

        $stmt = $conn->prepare(
            "INSERT INTO users (fullname, email, username, password, role_id, created_by, updated_by) 
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssiss", $fullname, $email, $fullname, $password, $role_id, $inserted_by, $inserted_by);

        $status = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);

        return $status;
    }

    // Update user method
    public function updateUser($user_id, $fullname, $email, $password, $role_id) {
        session_start();
        $config = new Database();
        $conn = $config->getConnection();

        $updated_by = $_SESSION['username'];

        $sql = "UPDATE users SET fullname = ?, email = ?, username = ?, role_id = ?, updated_by = ?";

        if ($password) {
            $sql .= ", password = ?";
        }

        $sql .= " WHERE id = ?";

        $stmt = $conn->prepare($sql);

        if ($password) {
            $stmt->bind_param("ssssssi", $fullname, $email, $username, $role_id, $updated_by, $password, $user_id);
        } else {
            $stmt->bind_param("sssssi", $fullname, $email, $username, $role_id, $updated_by, $user_id);
        }

        $status = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);

        return $status;
    }

    // Delete user method
    public function deleteUser($user_id) {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);

        $status = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);

        return $status;
    }

    public function getRoles() {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT * FROM roles";
        $result = mysqli_query($conn, $sql);

        $roles = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $roles[] = $row;
            }
        }
        mysqli_close($conn);
        return $roles;
    }

    public function addRole($role_name) {
        session_start(); // Ensure the session is started
    $config = new Database();
    $conn = $config->getConnection();

    // Correct way to access $_SESSION
    $inserted_by = isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown';
    
        $stmt = $conn->prepare(
            "INSERT INTO roles (role_name, created_by, updated_by) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $role_name, $inserted_by, $inserted_by);
    
        $status = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);
    
        return $status;
    }
    
    public function updateRole($role_id, $role_name) {
        $config = new Database();
        $conn = $config->getConnection();
    
        $updated_by = $_SESSION['username'];
    
        $stmt = $conn->prepare(
            "UPDATE roles SET role_name = ?, updated_at = CURRENT_TIMESTAMP, updated_by = ? WHERE id = ?"
        );
        $stmt->bind_param("ssi", $role_name, $updated_by, $role_id);
    
        $status = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);
    
        return $status;
    }
    

    public function deleteRole($role_id) {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("DELETE FROM roles WHERE id = ?");
        $stmt->bind_param("i", $role_id);

        $status = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);

        return $status;
    }
}

?>
