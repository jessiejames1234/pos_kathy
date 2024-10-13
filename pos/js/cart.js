document.addEventListener('DOMContentLoaded', function() {

    // Function to update the total order amount
    function updateTotalAmount() {
        let total = 0;
        let hasError = false; // To track if any quantity exceeds hidden quantity
    
        // Loop through all quantity inputs and calculate the total based on quantity and hidden price
        document.querySelectorAll('.qty-input').forEach(function(inputField) {
            let productId = inputField.getAttribute('data-product-id');
            let quantity = parseInt(inputField.value);
            let price = parseFloat(document.getElementById(`hidden_price_${productId}`).value);
            let hiddenQty = parseInt(document.getElementById(`hidden_qty_${productId}`).value);
            
            // Check if quantity exceeds hidden quantity
            if (quantity > hiddenQty) {
                hasError = true; // Set error flag
                inputField.value = hiddenQty; // Set quantity to maximum available
                quantity = hiddenQty; // Update quantity for calculation
            }
            
            total += quantity * price; // Add to total
        });
    
        // Display alert if any quantity is invalid
        if (hasError) {
            alert('Some quantities cannot exceed their available stock.');
        }
    
        // Update the total order amount display
        document.getElementById('total-order-amount').textContent = `Total Order Amount: ₱${total.toFixed(2)}`;
        document.getElementById('total-order-amount-modal').value = total.toFixed(2);
    }
    
    // Handle quantity increment
    document.querySelectorAll('.inc').forEach(function(incButton) {
        incButton.addEventListener('click', function() {
            let productId = this.getAttribute('data-product-id');
            let qtyInput = document.querySelector(`input[data-product-id="${productId}"]`);
            let currentQty = parseInt(qtyInput.value);
            let hiddenQty = parseInt(document.getElementById(`hidden_qty_${productId}`).value);
    
            // Check if the current quantity plus one exceeds the hidden quantity
            if (currentQty < hiddenQty) {
                qtyInput.value = currentQty + 1;
                updateTotalAmount();
            } else {
                alert(`Cannot increase quantity beyond available stock of ${hiddenQty}.`);
            }
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
