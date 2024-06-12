<div class="main-container">
    <div class="products-container">
        <div class="search-bar">
            <input type="text" id="search-product" placeholder="Search product by name/code">
        </div>
        <div class="product-buttons">
            <button class="product-button" data-category="all">All Products</button>
            <?php foreach ($categories as $category) : ?>
                <button class="product-button" data-category="<?= $category['prod_category']; ?>"><?= $category['prod_category']; ?></button>
            <?php endforeach; ?>
        </div>
        <div class="product-display">
            <?php foreach ($products as $product) : ?>
                <div class="product-item" data-price="<?= $product['prod_sell_price']; ?>" data-category="<?= $product['prod_category']; ?>">
                <img src="<?php if ($product["prod_image"] == NULL) : ?>
                    <?= base_url("assets/images/default-product.png") ?>
                <?php else : ?>
                     <?= base_url("uploads/products/") . $product['prod_image'] ?>
                <?php endif; ?>" alt="<?= $product["prod_name"]; ?>">
                    <div class="name-tag"><?= $product["prod_name"]; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

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

       
        <a href="<?= base_url("PosController/get_receipt"); ?>" target="blank">Get receipt</a></div>
    
    </div>
</div>

<script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/pos.js");?>"></script>
<script src="<?php echo base_url("assets/js/payment.js");?>"></script>
<script src="<?php echo base_url("assets/js/pos-display.js");?>"></script>
<script src="<?php echo base_url("assets/js/checkout.js");?>"></script>
<script src="https://cdn.jsdelivr.net/npm/dom-to-image@2.6.0/dist/dom-to-image.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


