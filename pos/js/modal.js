document.addEventListener('DOMContentLoaded', function() {
    const totalOrderAmountModal = document.getElementById('total-order-amount-modal');
    const paymentAmountInput = document.getElementById('payment-amount');
    const changeAmountInput = document.getElementById('change-amount');
    const proceedPaymentBtn = document.getElementById('proceed-payment-btn');
    const spinner = document.getElementById('payment-loading-spinner');
    
    // Assuming total order amount is already in a hidden input field or dataset
      // Log and check what the initial totalOrderAmountModal value is
     console.log('Total order amount modal value before parsing:', totalOrderAmountModal.value);

    let totalOrderAmount = parseFloat(totalOrderAmountModal.value.replace(/[^\d.-]/g, ''));
      // Log the parsed totalOrderAmount to check if it's correct
    console.log('Parsed totalOrderAmount:', totalOrderAmount);
    
    // Handle payment amount input change
    paymentAmountInput.addEventListener('input', function() {
        const totalOrderAmountModal = document.getElementById('total-order-amount-modal');
        let totalOrderAmount = parseFloat(totalOrderAmountModal.value.replace(/[^\d.-]/g, '')); 
        const paymentAmount = parseFloat(paymentAmountInput.value);

        if (!isNaN(paymentAmount) && paymentAmount >= totalOrderAmount) {
            const change = paymentAmount - totalOrderAmount;
            changeAmountInput.value = `₱${change.toFixed(2)}`;
        } else {
            changeAmountInput.value = '₱0.00';
        }
    });

    // Handle Proceed Payment button click
    proceedPaymentBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor behavior

        const paymentAmount = parseFloat(paymentAmountInput.value);
        let totalOrderAmount = parseFloat(totalOrderAmountModal.value.replace(/[^\d.-]/g, '')); 
        
        if (!isNaN(paymentAmount) && paymentAmount >= totalOrderAmount) {
            spinner.classList.remove('d-none'); // Show spinner
            
            // Submit the form to process payment
            document.getElementById('payment-form').submit(); 
        } else {
            alert('Payment amount is less than the total amount.');
        }
    });
});
