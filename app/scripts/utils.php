<script>
  $(document).ready(function(){
      // Format inputs with class 'price-input' or 'discount-input' to 2 decimal places after leaving input field.
    $('.price-input, .discount-input').on('blur', function() {
      let value = parseFloat($(this).val()).toFixed(2);
      $(this).val(isNaN(value) ? '0.00' : value);  // If value is invalid, set it to 0.00
    });
    
      // Ensure qty-input only accepts whole numbers on blur event
    $('.qty-input').on('blur', function() {
      let value = Math.floor($(this).val());  // Convert to whole number
      $(this).val(isNaN(value) || value < 1 ? '1' : value);  // If value is invalid or less than 1, default to 1
    });

    // Function to update final total
    function updateFinalTotal() {
      const subtotal = parseFloat($('#subtotal').text()) || 0;
      const taxAmount = parseFloat($('#taxAmount').text()) || 0;

      // Calculate final total
      const finalTotal = (subtotal + taxAmount).toFixed(2);
      console.log("Final total is: ", finalTotal);
      $('#finalTotal').text(finalTotal);
    }

    // Function to update tax and total amount
    function updateTaxAmount() {
      const subtotal = parseFloat($('#subtotal').text()) || 0;
      const taxRate = parseFloat($('#tax').val()) || 0;

      // Calculate tax amount
      const taxAmount = (subtotal * (taxRate / 100)).toFixed(2);
      $('#taxAmount').text(taxAmount);

      
      updateFinalTotal();
    }

    // Update tax amount when tax input changes
    $('#tax').on('input', updateTaxAmount);


    // Trigger updateTaxAmount once on page load
    updateTaxAmount();

    // AJAX form submission
    $('#cartForm').on('submit', function(event) {
        event.preventDefault(); // Prevent page reload

        // Collect form data
        const formData = {
            prodItem: $('#prodItem').val(),
            prodPrice: $('#prodPrice').val(),
            prodQty: $('#prodQty').val(),
            prodDiscount: $('#prodDiscount').val()
        };

        // Send form data to calculator.php via AJAX
        $.ajax({
            url: 'controller/calculator.php',
            type: 'POST',
            data: formData,
            dataType: 'json', // Expect JSON response
            success: function(response) {
              console.log(response);
                $('#cartList').empty(); // Clear existing list

                response.cartArray.forEach(function(item, key) {
                    $('#cartList').append(
                        `<li class="flex justify-between"><p>${item.productName} - $${parseFloat(item.productPrice).toFixed(2)} x ${item.productQuantity} ${item.productDiscount}% off</p><button class="border-2 border-black rounded px-2 text-center remove-btn" data="${key}">Remove</button></li>`
                    );
                });

                // Update total cost
                $('#subtotal').text(response.cartSubtotal);
                updateTaxAmount(); // Call function to update tax amount based on new subtotal
                updateFinalTotal();
            },
            error: function(jqXHR, textStatus, errorThrown, response) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    });

    $('#cartList').on('click', '.remove-btn', function() {
      console.log('Removed-item clicked!');
      const itemKey = $(this).val(); // The index of the item to remove

      $.ajax({
          url: 'controller/remove_item.php',
          type: 'POST',
          data: { itemKey: itemKey },
          dataType: 'json',
          success: function(response) {
              $('#cartList').empty(); // Clear the existing cart list

              // Re-populate cart items
              response.cartArray.forEach(function(item, index) {
                  $('#cartList').append(
                      `<li class="flex justify-between">
                          <p>${item.productName} - $${parseFloat(item.productPrice).toFixed(2)} x ${item.productQuantity} ${item.productDiscount}% off</p>
                          <button class="border-2 border-black rounded px-2 text-center remove-btn" value="${index}">Remove</button>
                      </li>`
                  );
              });

              // Update the subtotal
              $('#subtotal').text(response.cartSubtotal);
              updateTaxAmount(); // Re-calculate new amounts and totals
              updateFinalTotal();
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.error('Error:', textStatus, errorThrown);
          }
      });
    });





  });
</script>