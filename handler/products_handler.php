<?php
require_once '../classes/Products.php';

$products = new Products();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['action'] == 'add') {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $group_id = $_POST['group_id'];

        // Handle file upload
        $product_image = '';
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
            $upload_dir = "../assets/images/products/";
            $product_image = $upload_dir . basename($_FILES['product_image']['name']);
            move_uploaded_file($_FILES['product_image']['tmp_name'], $product_image);
        }

        if ($products->addProduct($product_name, $product_price, $product_image, $group_id)) {
            echo "New product added successfully!";
        } else {
            echo "Error adding new product.";
        }
    } elseif ($_GET['action'] == 'update') {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $group_id = $_POST['group_id'];

        // Handle file upload (optional update)
        $product_image = $_POST['current_image'];
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
            $upload_dir = "../assets/images/products/";
            $product_image = $upload_dir . basename($_FILES['product_image']['name']);
            move_uploaded_file($_FILES['product_image']['tmp_name'], $product_image);
        }

        if ($products->updateProduct($product_id, $product_name, $product_price, $product_image, $group_id)) {
            echo "Product updated successfully!";
        } else {
            echo "Error updating product.";
        }
    } elseif ($_GET['action'] == 'delete') {
        $product_id = $_POST['id'];

        if ($products->deleteProduct($product_id)) {
            echo "Product deleted successfully!";
        } else {
            echo "Error deleting product.";
        }
    }
} elseif ($_GET['action'] == 'get') {
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $product = $products->getProductById($product_id);
        echo json_encode($product);
    }
}
?>
