<div class="content-area">
    <?php if ($this->session->flashdata("error")) : ?>
        <div class="alert alert-danger rounded-2 m-1">
            <?= $this->session->flashdata("error"); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata("warning")) : ?>
        <div class="alert alert-warning rounded-2 m-1">
            <?= $this->session->flashdata("warning"); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url("InventoryController/insertProduct"); ?>" method="post" class="form-container" enctype="multipart/form-data">

        <div class="form-group image-upload">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image">
        </div>

        <div class="form-group-row">
            <div class="form-group col-md-6">
                <label for="name">Product Category</label>
                <select id="grocery-categories" name="category" required>
                    <option selected disabled>Select Product Category:</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" required>
            </div>
        </div>

        <div class="form-group-row">
            <div class="form-group col-md-6">
                <label for="cost_price">Product Cost Price</label>
                <input type="number" name="cost_price" id="cost_price" required>
            </div>
            <div class="form-group col-md-6">
                <label for="sell_price">Product Sell Price</label>
                <input type="number" name="sell_price" id="sell_price" required>
            </div>
        </div>

        <div class="form-group-row">
            <div class="form-group col-md-6">
                <label for="base_stock">Product Base Stock</label>
                <input type="number" name="base_stock" id="base_stock" required>
            </div>
            <div class="form-group col-md-6">
                <label for="quantity">Product Quantity</label>
                <input type="number" name="quantity" id="quantity" required>
            </div>
        </div>

        <div class="form-group">
            <label for="expiry">Product Expiry</label>
            <input type="date" name="expiry" id="expiry" required>
        </div>

        <div class="form-buttons">
            <a href="<?= base_url("InventoryController"); ?>">
                <button type="button" class="btn btn-cancel">Cancel</button>
            </a>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>
</div>