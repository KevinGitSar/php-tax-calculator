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
    });
</script>