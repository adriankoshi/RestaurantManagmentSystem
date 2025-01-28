<?php
require_once 'db.php';

class Products
{
    public function getGroups()
    {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT * FROM groups";
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

    // Add a new Group
    public function addGroup($floor_name)
    {
        session_start();
        $config = new Database();
        $conn = $config->getConnection();

        $inserted_by = isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown';

        $stmt = $conn->prepare("INSERT INTO groups (group_name,created_by,updated_by) VALUES (?,?,?)");
        $stmt->bind_param("sss", $floor_name, $inserted_by, $inserted_by);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }

    // Update an existing floor
    public function updateGroup($floor_id, $floor_name)
    {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("UPDATE groups SET group_name = ? WHERE id = ?");
        $stmt->bind_param("si", $floor_name, $floor_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }

    // Delete a Group
    public function deleteGroup($floor_id)
    {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("DELETE FROM groups WHERE id = ?");
        $stmt->bind_param("i", $floor_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }

    // Get all products
    public function getProducts()
    {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT p.*, g.group_name FROM products p 
                LEFT JOIN groups g ON g.id = p.group_id";
        $result = mysqli_query($conn, $sql);

        $products = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
        }
        mysqli_close($conn);

        return $products;
    }

    // Get a product by ID
    public function getProductById($product_id)
    {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT p.*, g.group_name FROM products p 
                LEFT JOIN groups g ON g.id = p.group_id WHERE p.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        $stmt->close();
        mysqli_close($conn);

        return $product;
    }

    // Add a new product
    public function addProduct($product_name, $product_price, $product_image, $group_id)
    {
        session_start();
        $config = new Database();
        $conn = $config->getConnection();

        $inserted_by = isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown';

        $stmt = $conn->prepare("INSERT INTO products (name, price, image, group_id, created_by, updated_by) 
                            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdsiss", $product_name, $product_price, $product_image, $group_id, $inserted_by, $inserted_by);

        $success = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);

        return $success;
    }

    // Update an existing product
    public function updateProduct($product_id, $product_name, $product_price, $product_image, $group_id)
    {
        session_start();
        $config = new Database();
        $conn = $config->getConnection();

        $updated_by = isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown';

        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ?, group_id = ?, updated_by = ? WHERE id = ?");
        $stmt->bind_param("sdsisi", $product_name, $product_price, $product_image, $group_id, $updated_by, $product_id);

        $success = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);

        return $success;
    }

    // Delete a product
    public function deleteProduct($product_id)
    {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);

        $success = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);

        return $success;
    }
}
