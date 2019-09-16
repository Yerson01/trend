
<header>
    <?php require_once './views/layout/navbar.php' ?>
</header>


<?php require_once './views/layout/categories_list.php' ?>

<main>
    <div class="min-container">
        <div class="product-about">
            <?php
                $product = $selectedProduct;
                if ($product == null):
                require_once './views/layout/empty.php';
            ?>
            <?php else: ?>
                <div class="product-image">
                    <div class="image-container">
                        <img src="<?=BASE_URL?>src/img/products/<?=$product->_image?>" alt="<?=$product->_name?>">
                    </div>
                </div>
                <div class="product-info">
                    <div class="info-container">
                        <h3 class="info-product-title"><?=$product->_name?></h3>
                        <p class="product-description"><?=$product->_description?></p>

                        <div class="product-shopping">
                            <p class="product-price">

                                    <?php
                                        if ($product->_offer != 'null'):
                                            $discount = ($product->_price*$product->_offer)/100;
                                    ?>
                                            <span class="line-thought margin-right">$ <?=$product->_price?> </span>
                                            $ <?=number_format(($product->_price - $discount), 2)?>  - <span class="offer"><?=$product->_offer?>% Off</span>
                                        <?php else: ?>
                                            $ <?=$product->_price?>
                                    <?php endif; ?>

                            </p>
                            <div class="shopping-info">
                                <form action="" id="shopping-form">
                                    <label for="quantity">Quantity:</label>
                                    <div>
                                        <input type="number" name="quantity" id="quantity" min="0" max="1000" value="1">
                                        <p class="remaining"><span><?=$product->_stock?></span> Left</p>
                                    </div>
                                </form>
                            </div>
                            <div class="product-actions">
                                <a href="" class="btn border-green green add-to-cart remove-from-cart" data-id="<?=$product->_id?>">

                                    <?php
                                    $user = Utils::userOrAdmin();
                                    if ($user):
                                        $newCart = Utils::showCartByUserAndProduct($user['_id'], $product->_id)->fetch_assoc();
                                        if ($newCart != null):
                                            ?>
                                            <p class="margin-0">
                                                <i class="far fa-times-circle" order-id="<?=$newCart['_id']?>"></i>
                                                <span>Remove from cart</span>
                                            </p>
                                        <?php else: ?>
                                            <p class="margin-0">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span>Add To Cart</span>
                                            </p>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p class="margin-0">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span>Add To Cart</span>
                                        </p>
                                    <?php endif; ?>
                                </a>
                                <a href="" class="btn bg-green white border-green"><i class="fas fa-dollar-sign"></i> Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div><!--product-about-->
    </div>
</main>

<?php require_once './views/layout/footer.php'; ?>
