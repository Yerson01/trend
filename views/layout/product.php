<div class="product">
    <div class="product-container">
        <a href="<?=BASE_URL?>product/show&id=<?=$product['_id']?>" class="product-link">
            <h3><?=$product['_name']?></h3>
            <div class="product-img-container">
                <img src="<?=BASE_URL?>src/img/products/<?=$product['_image']?>" alt="Product" class="product-img">
                <?php if ($product['_offer'] != 'null'): ?>
                    <div class="offer-tag">
                        <img src="<?=BASE_URL?>src/img/svg/offer_tag" alt="Offer">  
                        <span><?=$product['_offer']?>%</span>
                    </div>
                <?php endif; ?>
            </div>
        </a>
        <div class="product-footer">
            <p class="price">$ <?=$product['_price']?></p>

            <a href="#" class="add-cart add-to-cart" data-id="<?=$product['_id']?>">

                <?php 
                    $user = Utils::userOrAdmin();
                    if ($user): 
                        $newCart = Utils::showCartByUserAndProduct($user['_id'], $product['_id'])->fetch_assoc();
                            if ($newCart != null):
                    ?>
                        <i class="fas fa-check-circle toggle-icon" order-id="<?=$newCart['_id']?>"></i>
                            <?php else: ?>
                                <i class="fas fa-shopping-cart toggle-icon"></i>
                            <?php endif; ?>
                <?php else: ?>
                        <i class="fas fa-shopping-cart toggle-icon"></i>
                <?php endif; ?>

            </a>
        </div>
    </div>
</div>