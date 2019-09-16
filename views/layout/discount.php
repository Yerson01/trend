<section class="discount" id="discount">
    <div class="discount-container mid-container">
        <h2>Best discounts</h2>
        <p class="discount-text">Buy everything you want without worry and save your money with our discounts</p>

        <div class="product-about">
            <?php
                $product = Utils::showProductByOffer();
                if ($product == null):
                require_once './views/layout/empty.php';
            ?>
            <?php else: ?>
                <div class="product-image product-offer-img">
                    <div class="image-container discount-img-container">
                        <img src="<?=BASE_URL?>src/img/products/<?=$product->_image?>" alt="<?=$product->_name?>">
                        <?php if ($product->_offer != 'null'): ?>
                            <div class="discount-offer-tag">
                                <img src="<?=BASE_URL?>src/img/svg/offer_tag" alt="Offer">  
                                <span><?=$product->_offer?>%</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="product-info product-offer-info">
                    <div class="info-container">
                        <h3 class="info-product-title product-offer-title"><?=$product->_name?></h3>

                        <div class="product-shopping">
                            <p class="product-price product-offer-price">

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
                                    <div class="product-actions product-offer-actions">
                                        <input type="number" name="quantity" id="quantity" min="0" max="1000" value="1" class="product-offer-quantity">

                                        <a href="" class="btn border-green green add-to-cart remove-from-cart product-offer-cart" data-id="<?=$product->_id?>">

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
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div><!--product-about-->

    </div>
</section>