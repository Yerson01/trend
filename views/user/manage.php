<header class="manage drop-animation">
    <?php require_once './views/layout/navbar.php' ?>
</header>

<div class="manage-container container">
    <aside class="options">
        <h4>Manage</h4>
        <ul class="options-links">
            <li><a class="option-link" href="#manage-categories">Categories</a></li>
            <li><a class="option-link" href="#manage-products">Products</a></li>
            <li><a class="option-link" href="#manage-orders">Orders</a></li>
        </ul>
    </aside>
    <main class="options-details">
        <section class="manage-categories" id="manage-categories">
            <h4>Categories</h4>
            <div class="d-flex align-items-start">
                <div class="add-item-form">
                    <p>Add categories</p>
                    <form action="<?=BASE_URL?>category/create" method="POST" enctype="multipart/form-data" class="add-item">
                        <input type="text" name="name" id="" placeholder="Category name">
                        <div class="d-flex justify-content-between">
                            <div class="image-field">
                                <label for="image" class="btn bg-green white choose">
                                    <i class="far fa-image"></i> Add Image
                                </label>
                                <input type="file" name="image" id="image">
                            </div>
                            <input type="submit" name="submit" value="Add">
                        </div>
                    </form>
                </div>
                <ul class="categories">
                    <?php
                    $allCategories = Utils::showCategories();
                    while ($cat = $allCategories->fetch_assoc()): ?>
                        <li>
                            <a class="category d-flex align-items-center">
                                <img src="<?=BASE_URL?>src/img/categories/<?=$cat['_image']?>" alt="<?=$cat['_name']?>">
                                <p><?=$cat['_name']?></p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </section>
        <!--manage-categories-->

        <section class="manage-products" id="manage-products">
            <h4>Manage Products</h4>
            <div class="d-flex align-items-start">
                <div class="add-item-form">
                    <?php
                    if (isset($_GET['id']) && !empty($_GET['id'])): ?>
                        <p>Edit Product</p>
                        <?php
                            $id = $_GET['id'];
                            $urlAction = BASE_URL.'product/update';
                            $editProduct = Utils::showProduct($id);
                            $edit = true;
                        ?>
                    <?php else: ?>
                        <p>Add Products</p>
                        <?php $urlAction = BASE_URL.'product/create' ?>
                    <?php endif; ?>

                    <form action="<?=BASE_URL?>product/create" method="POST" enctype="multipart/form-data" class="add-item add-product">
                        <input type="text" name="name" id="" placeholder="Product name" value="<?=(isset($edit)) ? $editProduct->_name : ''?>">

                        <textarea name="description" id="" placeholder="Description"><?=(isset($edit)) ? $editProduct->_description : ''?></textarea>

                        <input type="text" name="price" id="" placeholder="Price" value="<?=(isset($edit)) ? $editProduct->_price : ''?>">

                        <select name="category" id="">
                            <option value="" disabled selected>-- Select category --</option>
                            <?php
                            $allCategories = Utils::showCategories();
                            while ($cat = $allCategories->fetch_assoc()): ?>
                                <option value="<?=$cat['_id']?>" <?=(isset($edit) && $cat['_id'] == $editProduct->_category_id) ? 'selected' : ''?> >
                                    <?=$cat['_name']?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                        <input type="number" name="stock" id="" placeholder="Quantity" value="<?=(isset($edit)) ? $editProduct->_stock : ''?>"  >

                        <input type="text" name="offer" id="" placeholder="Offer" value="<?=(isset($edit) && $editProduct->_offer !== 'null') ? $editProduct->_offer : ''?>">

                        <?php if (isset($edit) && $editProduct->_image): ?>
                            <div class="edit-product-img">
                                <img src="<?=BASE_URL?>src/img/products/<?=$editProduct->_image?>" alt="<?=$editProduct->_name?>">
                            </div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-between">
                            <div class="image-field">
                                <label for="product-img" class="btn bg-third white choose">
                                    <i class="far fa-image"></i> <?=(isset($edit)) ? 'Change' : 'Select'?>
                                </label>
                                <input type="file" name="image" id="product-img">
                            </div>
                            <input type="submit" name="submit" value="<?=(isset($edit)) ? 'Edit' : 'Add'?>" >
                        </div>
                    </form>
                </div>
                <ul class="products-details">
                    <?php
                    $allProducts = Utils::showProducts();
                    while ($product = $allProducts->fetch_assoc()): ?>
                        <li>
                            <a class="product-detail" href="#manage-products">
                                <span class="product-detail-img">
                                    <img src="<?=BASE_URL?>src/img/products/<?=$product['_image']?>" alt="<?=$product['_name']?>">
                                </span>
                                <p class=<?=(isset($edit) && $product['_id'] == $editProduct->_id) ? "active" : "" ?>><?=$product['_name']?></p>
                            </a>
                            <div class="card">
                                <p class="card-title"><?=$product['_name']?></p>
                                <p>Price: $ <span><?=$product['_price']?></span></p>
                                <p>Category:
                                    <?php
                                        $allCategories = Utils::showCategories();
                                        while ($cat = $allCategories->fetch_assoc()):
                                            if ($product['_category_id'] == $cat['_id']):
                                    ?>
                                               <span> <?=$cat['_name']?></span>
                                    <?php
                                            endif;
                                        endwhile;
                                    ?>
                                </p>
                                <p>Stock: <span><?=$product['_stock']?></span></p>
                                <p>Offer: <span><?=($product['_offer'] == 'null') ? 'None' : $product['_offer']?></span></p>
                                <div class="actions">
                                    <a href="<?=BASE_URL?>user/manage&id=<?=$product['_id']?>#manage-products" class="edit-product"><i class="fas fa-edit"></i></a>
                                    <a href="<?=BASE_URL?>product/delete&id=<?=$product['_id']?>" class="delete-product"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </section>
        <section class="manage-orders" id="manage-orders">
            <h4>Manage Orders</h4>
        </section>

        <!--Show error message-->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error float">
                <?=$_SESSION['error']?>
            </div>
            <?php Utils::deleteSession('error') ?>
        <?php elseif (isset($_SESSION['success'])): ?>
            <div class="alert success float">
                <?=$_SESSION['success']?>
                <?php Utils::deleteSession('success') ?>
            </div>
        <?php endif; ?>
    </main>
</div>