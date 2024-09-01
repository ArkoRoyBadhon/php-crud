<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_index = $_POST['product_index'];

    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_index])) {
        unset($_SESSION['cart'][$product_index]);

        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    header('Location: ../cart.php');
    exit();
}
?>