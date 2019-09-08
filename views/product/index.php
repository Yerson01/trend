<header class="productss">
    <?php require_once './views/layout/navbar.php' ?>
</header>

<div class="products-categories-container container">
    <h5>Categories</h5>
    <ul class="categories-links">
        <?php
        $allCategories = Utils::showCategories();
        while ($cat = $allCategories->fetch_assoc()):
            ?>
            <a href="#" class="category-link">
                <span><?=$cat['_name']?></span>
            </a>
        <?php endwhile; ?>
    </ul>
</div>

<main>
    <div class="main-container min-container">
        <h2>Latest Products</h2>
        <!--            <a href="" class="arrow-right border-radius position-fixed right">-->
        <!--                Ver todos-->
        <!--                <img src="./img/svg/right-arrow.svg" alt="">-->
        <!--            </a>-->
        <div class="products">
            <?php
            $products = Utils::showLimitProducts(6);
            while($product = $products->fetch_assoc()):
                ?>
                <div class="product">
                    <div class="product-container">
                        <h3><?=$product['_name']?></h3>
                        <img src="<?=BASE_URL?>src/img/products/<?=$product['_image']?>" alt="Product" class="product-img">
                        <div class="product-footer">
                            <p class="price">$ <?=$product['_price']?></p>
                            <a href="#" class="add-cart">
                                <img src="<?=BASE_URL?>src/img/svg/cart-white.svg" alt="cart">
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div><!--products-->
    </div><!--main-container-->
</main>