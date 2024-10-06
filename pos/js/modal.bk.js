document.addEventListener('DOMContentLoaded', function() {
    const totalOrderAmountModal = document.getElementById('total-order-amount-modal');
    const paymentAmountInput = document.getElementById('payment-amount');
    const changeAmountInput = document.getElementById('change-amount');
    const proceedPaymentBtn = document.getElementById('proceed-payment-btn');
    const spinner = document.getElementById('payment-loading-spinner');
    let totalOrderAmount = 0; // Will hold the fetched total order amount

    // Fetch total order amount when modal is shown
    const paymentModal = document.getElementById('paymentModal');
    paymentModal.addEventListener('show.bs.modal', function() {
        // Fetch total amount via AJAX
        fetch('../Actions/fetch-total-order.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    totalOrderAmount = parseFloat(data.total);

                    // Update the modal with the fetched total amount
                    totalOrderAmountModal.value = `₱${totalOrderAmount.toFixed(2)}`;
                } else {
                    console.error('Error fetching total order amount:', data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching total order amount:', error);
            });
    });

    // Handle payment amount input change
    paymentAmountInput.addEventListener('input', function() {
        const paymentAmount = parseFloat(paymentAmountInput.value);
        if (!isNaN(paymentAmount) && paymentAmount >= totalOrderAmount) {
            const change = paymentAmount - totalOrderAmount;
            changeAmountInput.value = `₱${change.toFixed(2)}`;
        } else {
            changeAmountInput.value = '₱0.00';
        }
    });

    // Handle Proceed Payment button click
    proceedPaymentBtn.addEventListener('click', function() {
        const paymentAmount = parseFloat(paymentAmountInput.value);
        if (!isNaN(paymentAmount) && paymentAmount >= totalOrderAmount) {
            proceedPaymentBtn.disabled = true;
            spinner.classList.remove('d-none'); // Show spinner

            proceedPayment(totalOrderAmount, paymentAmount);
        } else {
            alert('Payment amount is less than the total amount.');
        }
    });

    // AJAX to process the payment and update order status
    function proceedPayment(total, payment) {
        fetch('../Actions/process-payment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `order_id=${sessionStorage.getItem('order_id')}&total=${total}&payment=${payment}`
        })
        .then(response => response.json())
        .then(data => {
            proceedPaymentBtn.disabled = false;
            spinner.classList.add('d-none'); // Hide spinner

            if (data.success) {
                const bootstrapModal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
                bootstrapModal.hide();

                showSuccessPopup('Payment successful! Your order is complete.');

                sessionStorage.removeItem('order_id');
                document.querySelectorAll('.product-list').forEach(function(productElement) {
                    productElement.remove();
                });
                document.getElementById('total-order-amount').textContent = `Total Order Amount: ₱0.00`;

                updateProductCount();
            } else {
                alert('Payment failed: ' + data.message);
            }
            
        })
        .catch(error => {
            proceedPaymentBtn.disabled = false;
            spinner.classList.add('d-none');
            console.error('Payment error:', error);
            //alert('Error processing payment.');
        });
    }

    // Show success popup without redirection
    function showSuccessPopup(message) {
        const successModalHtml = `
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ${message}
                  </div>
                  <div class="modal-footer">
                    <button id="success-modal-ok-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                  </div>
                </div>
              </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', successModalHtml);
        const successModal = new bootstrap.Modal(document.getElementById('successModal'), { backdrop: 'static' });
        successModal.show();

        // Add event listener for the OK button
        document.getElementById('success-modal-ok-btn').addEventListener('click', function() {
            // Reload the page when OK button is clicked
            window.location.reload();
        });
    }
});
