<?php 
  session_start();
  
  include 'view/header.php';

  $cartArray = isset($_SESSION['cartArray']) ? $_SESSION['cartArray'] : [];
  $cartSubtotal = isset($_SESSION['cartSubtotal']) ? $_SESSION['cartSubtotal'] : 0.00;
  // $taxAmount = 
  // $cartTotal = 0.00;

?>
  <form id="cartForm" action="" method="POST" role="form">
    <table class="mx-auto">
        <tr>
            <th><label for="prodItem">Item</label></th>
            <th><label for="prodPrice">Price</label></th>
            <th><label for="prodQty">Qty.</label></th>
            <th><label for="prodDiscount">Discount</label></th>
            <th></th>
        </tr>

        <tr>
          <td>
            <input type="text" name="prodItem" id="prodItem" class="border-2 border-black rounded invalid:border-red-500"  />
          </td>
          <td>
            <div class="price-input-wrapper">
              <span class="prefix">$</span>
              <input type="number" name="prodPrice" id="prodPrice" class="price-input border-2 border-black rounded invalid:border-red-500 w-16 text-center pl-1" min="0" value="0.00"  />
            </div>
          </td>
          <td>
            <div class="qty-input-wrapper">
              <span class="prefix">x</span>
              <input type="number" name="prodQty" id="prodQty" class="qty-input border-2 border-black rounded invalid:border-red-500 w-12 text-center " min="1" value="1"  />
            </div>
          </td>
          <td>
            <div class="discount-input-wrapper">
              <input type="number" name="prodDiscount" id="prodDiscount" class="discount-input border-2 border-black rounded invalid:border-red-500 w-20 text-center" min="0" max="100" value="0.00"  />
              <span class="suffix">%</span>
            </div>
          </td>
          <td>
            <div>
              <button type="submit" class="border-2 border-black rounded w-10 text-center">Add</button>
            </div>
          </td>
        </tr>
    </table>
  </form>

  <form action="clear_cart.php" method="POST">
    <button type="submit" class="border-2 border-black rounded w-20 text-center mt-4">
        Clear Cart
    </button>
  </form>

  <!-- Cart Item List -->
  <h2 class="text-center">Cart Items</h2>
  <ul id="cartList" class="w-1/4 mx-auto">
    <?php foreach ($cartArray as $item): ?>
        <li><?php echo htmlspecialchars($item['productName']) . " - $" . number_format($item['productPrice'], 2) . " x " . $item['productQuantity'] . " " . $item['productDiscount'] . "% off"; ?></li>
    <?php endforeach; ?>
  </ul>

  <!-- Separator line using Tailwind CSS -->
  <div id="separator" class="border-t border-gray-300 my-4 w-1/4 mx-auto"></div>

  <!-- Tax and total cost section -->
  <div id="totalSection" class="w-1/4 mx-auto">
      <p>Subtotal: $<span id="subtotal"><?php echo $cartSubtotal; ?></span></p>

      <div class="tax-input-wrapper">
        <span class="prefix">Tax (</span>
        <input type="number" name="tax" id="tax" class="tax-input border-2 border-black rounded invalid:border-red-500 w-14 text-center" min="0" value="13" />
        <span class="suffix">%): $<span id="taxAmount">0.00</span></span>
      </div>

      <p>Total Cost (after tax): $<span id="total">0.00</span></p>
  </div>

<?php include 'view/footer.php'; ?>