<form action="<?= base_url("InventoryController/updateProduct/").$product[0]["id"]; ?>" method="post" enctype="multipart/form-data">

    <div>
        <label for="image">Product Image</label>
        <input type="file" name="image" id="image">
        <p>Current Image:<?php if ($product[0]["prod_image"] != NULL) : ?>
            <img src="<?= base_url("uploads/products/") . $product[0]["prod_image"]; ?>" alt="product.png">
        <?php else : ?>
            <img src="<?= base_url("assets/images/default-product.png"); ?>" alt="product.png">
        <?php endif; ?>
        </p>
    </div>

    <div>
        <label for="category">Product Category</label>
        <select id="grocery-categories" name="category" required>
            <?php
            $categories = ["Fruits & Vegetables", "Dairy & Eggs", "Meat & Poultry", "Bakery", "Beverages", "Snacks", "Frozen Foods", "Canned & Packaged Foods", "Personal Care", "Household Supplies"];
            foreach ($categories as $category) {
                $selected = ($product[0]['prod_category'] == $category) ? 'selected' : '';
                echo "<option value='$category' $selected>$category</option>";
            }
            ?>
        </select>
    </div>

    <div>
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" value="<?= $product[0]['prod_name']; ?>" required>
    </div>

    <div>
        <label for="cost_price">Product Cost Price</label>
        <input type="number" name="cost_price" id="cost_price" step="any" value="<?= $product[0]['prod_cost_price']; ?>" required>
    </div>

    <div>
        <label for="sell_price">Product Sell Price</label>
        <input type="number" name="sell_price" id="sell_price" step="any" value="<?= $product[0]['prod_sell_price']; ?>" required>
    </div>

    <div>
        <label for="base_stock">Product Base Stock</label>
        <input type="number" name="base_stock" id="base_stock" value="<?= $product[0]['prod_base_stock']; ?>" required>
    </div>

    <div>
        <label for="quantity">Product Quantity</label>
        <input type="number" name="quantity" id="quantity" value="<?= $product[0]['prod_quantity']; ?>" required>
    </div>

    <div>
        <label for="expiry">Product Expiry</label>
        <input type="date" name="expiry" id="expiry" value="<?= $product[0]['prod_expiry']; ?>" required>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>