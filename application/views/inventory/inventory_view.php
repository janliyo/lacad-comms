<div class="content-area1">
    <div class="row">
        <form action="<?= base_url('InventoryController'); ?>" method="get">
            <div class="input-group mb-3 float-left">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search products" aria-label="Search products" aria-describedby="search" value="<?= set_value('search'); ?>">
                <button class="btn btn-outline-secondary float-left" type="submit" id="search">Search</button>
            </div>
        </form>

        <div class="col text-right">
            <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            <a href="<?= base_url("InventoryController/addProduct"); ?>">Add Product</a>
        </div>
    </div>

    <div class="row vh-100">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Category</th>
                        <th scope="col">Product Name <img src="<?= base_url("assets/images/updownarrows.png"); ?>" alt="arrows"></th>
                        <th scope="col">Cost Price</th>
                        <th scope="col">Selling Price</th>
                        <th scope="col">Profit</th>
                        <th scope="col">Base Stock</th>
                        <th scope="col">Quantity <img src="<?= base_url("assets/images/updownarrows.png"); ?>" alt="arrows"></th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">Availability</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    <!-- Loop through products and populate rows -->
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td>
                                <?php if ($product["prod_image"] == NULL): ?>
                                    <img src="<?= base_url("assets/images/default-product.png") ?>" alt="product.png" class="table-image">
                                <?php else : ?>
                                    <img src="<?= base_url("uploads/products/") . $product['prod_image'] ?>" alt="product.png">
                                <?php endif; ?>
                            </td>
                            <td> <?= $product["prod_category"]; ?> </td>
                            <td> <?= $product["prod_name"]; ?> </td>
                            <td> ₱ <?= $product["prod_cost_price"]; ?> </td>
                            <td> ₱ <?= $product["prod_sell_price"]; ?> </td>
                            <td> ₱ <?= $product["profit"]; ?> </td>
                            <td> <?= $product["prod_base_stock"]; ?> </td>
                            <td> <?= $product["prod_quantity"]; ?> </td>
                            <td> <?= $product["prod_expiry"]; ?> </td>
                            <td> <?= $product["category"]; ?></td>
                            <td><a href="<?= base_url("InventoryController/editProduct/") . $product["id"]; ?>">Edit</a></td>
                            <td><a href="<?= base_url("InventoryController/deleteProduct/") . $product["id"]; ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <?= $links; ?>
            </div>
        </div>
    </div>
</div>
</div>