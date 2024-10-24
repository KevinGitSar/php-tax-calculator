<?php include 'includes/header.php' ?>
  <h1 class="text-center">Cart Calculator</h1>

  <table class="mx-auto">
      <tr>
          <th>Item</th>
          <th>Price</th>
          <th>Qty.</th>
          <th>Discount</th>
          <th></th>
      </tr>

      <tr>
        <td>
          <input type="text" class="border-2 border-black rounded invalid:border-red-500" />
        </td>
        <td>
          <div class="price-input-wrapper">
            <span class="prefix">$</span>
            <input type="number" class="price-input border-2 border-black rounded invalid:border-red-500 w-16 text-center pl-1" min="0" value="0.00" />
          </div>
        </td>
        <td>
          <div class="qty-input-wrapper">
            <span class="prefix">x</span>
            <input type="number" class="qty-input border-2 border-black rounded invalid:border-red-500 w-12 text-center " min="1" value="1" />
          </div>
        </td>
        <td>
          <div class="discount-input-wrapper">
            <input type="number" class="discount-input border-2 border-black rounded invalid:border-red-500 w-20 text-center" min="0" max="100" value="0.00" />
            <span class="suffix">%</span>
          </div>
        </td>
        <td>
          <div>
            <button class="border-2 border-black rounded w-10 text-center">Add</button>
          </div>
        </td>
      </tr>
  </table>
<?php include 'includes/footer.php' ?>