<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>Product id</th>
            <th>Product description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Image</th>
            <th>Product Category</th>
            <th>Date</th>
            <th>
                <a href="index.php?pg=product-new">
                    <button class="btn btn-sm btn-primary"><i class=" fa fa-plus"></i> Add New</button>
                </a>
            </th>
        </tr>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= esc($product['product_id']) ?></td>
                    <td>
                        <a href="index.php?pg=product-single&id=<?= $product['id'] ?>">
                            <?= esc($product['product_description']) ?>
                        </a>
                    </td>
                    <td><?= esc($product['qty']) ?></td>
                    <td>&#x20A6;<?= esc(number_format($product['amount'])) ?></td>
                    <td>
                        <img src="<?= crop($product['image'], 300) ?>" style="width:100%; max-width: 50px;">
                    </td>
                    <td><?= esc($product['product_category']) ?></td>
                    <td><?= get_date($product['date']) ?></td>
                    <td>
                        <a href="index.php?pg=product-edit&id=<?= $product['id'] ?>">
                            <button class="btn btn-sm btn-success">Edit</button>
                        </a>
                        <a href="index.php?pg=product-delete&id=<?= $product['id'] ?>">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <?php
    // $pager->display();
    ?>
</div>
