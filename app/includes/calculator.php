<?php
session_start();
include 'product_class.php';

// Initialize or retrieve cart array from session
if (!isset($_SESSION['cartArray'])) {
    $_SESSION['cartArray'] = [];
} else {
    $cartArray = $_SESSION['cartArray']; // Get the cart from session
}


$prodItem = isset($_POST['prodItem']) ? $_POST['prodItem'] : '';
$prodPrice = isset($_POST['prodPrice']) ? floatval($_POST['prodPrice']) : 0.0;
$prodQty = isset($_POST['prodQty']) ? intval($_POST['prodQty']) : 1;
$prodDiscount = isset($_POST['prodDiscount']) ? floatval($_POST['prodDiscount']) : 0.0;

// Validate that item name is provided
if (!empty($prodItem)) {
    // Create product and add it to the session cart array
    $newProduct = new Product($prodItem, $prodPrice, $prodQty, $prodDiscount);
    $_SESSION['cartArray'][] = $newProduct->toArray();

    
    
    $total = 0.00;
    foreach ($_SESSION['cartArray'] as $item):
      $total += ($item['productPrice'] - ($item['productPrice'] * ($item['productDiscount'] / 100 ))) * $item['productQuantity'];
    endforeach;
    
    $_SESSION['cartTotal'] = number_format($total, 2);
}

// Return the cart array as a JSON response
header('Content-Type: application/json');
echo json_encode([
    'cartArray' => $_SESSION['cartArray'],
    'cartTotal' => $_SESSION['cartTotal']
]);
