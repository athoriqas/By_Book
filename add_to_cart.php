<?php
session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Get data from POST request
$id = $_POST['id'];
$title = $_POST['title'];
$price = floatval($_POST['price']);

// Check if item already exists in the cart
$found = false;
foreach ($cart as &$item) {
    if ($item['id'] === $id) {
        $item['quantity']++;
        $item['total'] = $item['quantity'] * $item['price'];
        $found = true;
        break;
    }
}

if (!$found) {
    $cart[] = [
        'id' => $id,
        'title' => $title,
        'price' => $price,
        'quantity' => 1,
        'total' => $price
    ];
}

// Save cart in session
$_SESSION['cart'] = $cart;

// Return cart data as JSON
header('Content-Type: application/json');
echo json_encode(['cart' => $cart]);
?>
