<?php
session_start();

if (isset($_POST['itemKey']) && isset($_SESSION['cartArray'])) {
    $itemKey = $_POST['itemKey'];
    
    // Check if item key exists in cart array
    if (array_key_exists($itemKey, $_SESSION['cartArray'])) {
        // Remove the item
        unset($_SESSION['cartArray'][$itemKey]);

        // Re-index array to prevent gaps if using item index
        $_SESSION['cartArray'] = array_values($_SESSION['cartArray']);
    }

    // Recalculate subtotal
    $total = 0.00;
    foreach ($_SESSION['cartArray'] as $item) {
        $total += ($item['productPrice'] - ($item['productPrice'] * ($item['productDiscount'] / 100))) * $item['productQuantity'];
    }
    $_SESSION['cartSubtotal'] = round($total, 2);

    // Return updated cart and subtotal
    header('Content-Type: application/json');
    echo json_encode([
        'cartArray' => $_SESSION['cartArray'],
        'cartSubtotal' => $_SESSION['cartSubtotal']
    ]);
} else {
    echo json_encode(['error' => 'Item key not found or cart is empty']);
}
?>
