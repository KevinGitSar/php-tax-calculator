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

                response.cartArray.forEach(function(item) {
                    $('#cartList').append(
                        `<li>${item.productName} - $${parseFloat(item.productPrice).toFixed(2)} x ${item.productQuantity} ${item.productDiscount}% off</li>`
                    );
                });

                // Update total cost
                $('#totalCost').text(response.cartTotal);
            },
            error: function(jqXHR, textStatus, errorThrown, response) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    });



  });
</script>