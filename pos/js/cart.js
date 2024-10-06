document.addEventListener('DOMContentLoaded', function() {

    // Function to update the total order amount
    function updateTotalAmount() {
        let total = 0;
        
        // Loop through all quantity inputs and calculate the total based on quantity and hidden price
        document.querySelectorAll('.qty-input').forEach(function(inputField) {
            let productId = inputField.getAttribute('data-product-id');
            let quantity = parseInt(inputField.value);
            let price = parseFloat(document.getElementById(`hidden_price_${productId}`).value);
            
            total += quantity * price;
        });

        // Update the total order amount display
        document.getElementById('total-order-amount').textContent = `Total Order Amount: ₱${total.toFixed(2)}`;
        document.getElementById('total-order-amount-modal').value =  total.toFixed(2);

    }

    // Handle quantity increment
    document.querySelectorAll('.inc').forEach(function(incButton) {
        incButton.addEventListener('click', function() {
            let productId = this.getAttribute('data-product-id');
            let qtyInput = document.querySelector(`input[data-product-id="${productId}"]`);
            let currentQty = parseInt(qtyInput.value);
            qtyInput.value = currentQty + 1;
            updateTotalAmount();
        });
    });

    // Handle quantity decrement
    document.querySelectorAll('.dec').forEach(function(decButton) {
        decButton.addEventListener('click', function() {
            let productId = this.getAttribute('data-product-id');
            let qtyInput = document.querySelector(`input[data-product-id="${productId}"]`);
            let currentQty = parseInt(qtyInput.value);

            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
                updateTotalAmount();
            }
        });
    });

    // Handle quantity input change (keyboard input)
    document.querySelectorAll('.qty-input').forEach(function(inputField) {
        inputField.addEventListener('input', function() {
            let quantity = parseInt(this.value);

            // Ensure the input is valid (greater than or equal to 1)
            if (quantity >= 1) {
                updateTotalAmount();
            } else {
                // Reset to 1 if invalid
                this.value = 1;
                updateTotalAmount();
            }
        });
    });

});
