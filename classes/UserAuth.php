<?php
require_once 'db.php';

class UserAuth {
    public function login($username, $password) {
        session_start();
        $config = new Database();
        $conn = $config->getConnection();
    
        $stmt = $conn->prepare("SELECT id, fullname, username, role, password FROM users WHERE username = ?");
        if (!$stmt) {
            return "Database error: " . $conn->error;
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
    
                if ($user['role'] === 'admin') {
                    return "admin";
                } else {
                    return "success";
                }
            } else {
                return "Invalid username or password.";
            }
        } else {
            return $this->registerUser($username, $password);
        }
    
        $stmt->close();
        $conn->close();
    }
    
    private function registerUser($username, $password) {
        $config = new Database();
        $conn = $config->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $fullname = !empty($username) ? $username : "New User";
        $email = $username . "@default.com";
    
    
        $role = "user";
    
        $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            return "Database error: " . $conn->error;
        }
    
        $stmt->bind_param("sssss", $fullname, $username, $email, $hashedPassword, $role);
        $status = $stmt->execute();
    
        if ($status) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            return "success";
        } else {
            return "Error registering user: " . $conn->error;
        }
    
        $stmt->close();
        $conn->close();
    }
}    
?>
