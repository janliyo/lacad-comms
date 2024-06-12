<div class ="content-area">
<div class="container">
    <h1>Checkout</h1>
    <div class="checkout-container">
      <div class="transaction-id">
        Transaction ID: #XXXXXX
      </div>
      <ul class="item-list">
        <!-- Repeat for more items -->
      </ul>
      <div class="total">
        <span>Total:</span>
        <span>₱ 0.00</span>
      </div>
      <a href="<?php echo base_url("PosController/checkout"); ?>">
        <button class="proceed-to-payment">Proceed to Payment</button>
      </a>
    </div>
  </div>

</div>

<script src="<?php echo base_url("assets/js/checkout.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/pos.js"); ?>"></script>
