<header class="home">
    <?php require_once './views/layout/navbar.php' ?>
    <div class="landing container">
        <div class="introduction">
            <div class="intro-text">
                <h1>Stylish wherever you are</h1>
                <p>Enjoy all the offers we have for you</p>
            </div>
            <div class="cta">
                <a href="#main" class="start btn border-primary bg-primary white border-radius">Get Started</a>
                <?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])): ?>
                    <a href="<?=BASE_URL?>/user/login" class="to-login btn border-secondary border-radius white">
                        Offers <i class="fas fa-arrow-right"></i>
                    </a>
                <?php else: ?>
                    <a href="<?=BASE_URL?>/user/login" class="to-login btn border-secondary border-radius white">
                        Join <i class="fas fa-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="presentation">
            <div class="cover">
                <img src="<?=BASE_URL?>src/img/svg/cover.svg" alt="Cover">
            </div>
        </div>
    </div>
    <div class="landing-footer">
        <img src="<?=BASE_URL?>src/img/svg/vector1.svg" alt="" class="vector vector1">
        <img src="<?=BASE_URL?>src/img/svg/vector2.svg" alt="" class="vector vector2">
        <img src="<?=BASE_URL?>src/img/svg/vector3.svg" alt="" class="vector vector3">
        <a href="#main" class="down-arrow"><i class="fas fa-arrow-down"></i></a>
    </div>
</header>

<main id="main">
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

<section class="banner">
    <div class="banner-container container">
        <h2>Very confortable everywhere</h2>
        <p>Buy your clothes from the comfort of your home</p>
        <a href="#">Add To Cart</a>
    </div>
</section>

<section class="promo">
    <div class="promo-container">
            
    </div>
</section>
