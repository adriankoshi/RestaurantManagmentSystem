<?php
include 'connection/db.php';

class User {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function register($fullname, $email, $username, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (fullname, email, username, password, role) VALUES (?, ?, ?, ?, 'user')");
        $stmt->bind_param("ssss", $fullname, $email, $username, $hashed_password);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password, $role);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['role'] = $role;
                $stmt->close();
                return true;
            }
        }
        $stmt->close();
        return false;
    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function __destruct() {
        $this->db->close();
    }
}
?>
