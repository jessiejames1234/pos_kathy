
  <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <input type="hidden" name="order_id" value="<?php echo $_SESSION['order_id']; ?>"> 
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentModalLabel">Proceed to Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="total-order-amount-modal" class="form-label">Total Amount</label>
            <input type="text" id="total-order-amount-modal" class="form-control" readonly>
            <input type="hidden" name="total" value="" id="total-order-hidden"> <!-- Hidden field for PHP -->
          </div>
          <div class="mb-3">
            <label for="payment-amount" class="form-label">Payment Amount</label>
            <input type="number" id="payment-amount" name="payment" class="form-control" placeholder="Enter payment amount" required>
          </div>
          <div class="mb-3">
            <label for="change-amount" class="form-label">Change</label>
            <input type="text" id="change-amount" class="form-control" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="../pos/receipt/?order_id=<?php echo $_SESSION['order_id']; ?>" target="_blank" class="btn btn-primary"  id="proceed-payment-btn">
              Proceed Payment
          </a>          <!-- Spinner for loading state -->
          <div id="payment-loading-spinner" class="spinner-border text-primary d-none" role="status">
            <span class="visually-hidden">Processing...</span>
          </div>
        </div>
      </div>
    </div>
  </div> 