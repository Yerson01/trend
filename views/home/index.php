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
        <h2>Some Products</h2>
        <!--            <a href="" class="arrow-right border-radius position-fixed right">-->
        <!--                Ver todos-->
        <!--                <img src="./img/svg/right-arrow.svg" alt="">-->
        <!--            </a>-->
        <div class="products">
            <div class="product">
                <div class="product-container">
                    <h3>Cory T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="product-container">
                    <h3>Adidas T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="product-container">
                    <h3>Cory T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="product-container">
                    <h3>Cory T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="product-container">
                    <h3>Cory T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="product-container">
                    <h3>Cory T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="product-container">
                    <h3>Cory T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="product-container">
                    <h3>Cory T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="product-container">
                    <h3>Cory T-shirt</h3>
                    <img src="src/img/r.png" alt="Product">
                    <div class="product-footer">
                        <p class="price">$ 9.99</p>
                        <a href="#" class="add-cart">
                            <img src="src/img/svg/cart.svg" alt="cart">
                        </a>
                    </div>
                </div>
            </div>
        </div><!--products-->
    </div><!--main-container-->
</main>

<section class="banner">
    <div class="banner-container container">
        <h2>Very confortable everywhere</h2>
        <p>Enjoy all offers we have for you</p>
        <a href="#">Add To Cart</a>
    </div>
</section>

<section class="promo">
    <div class="promo-container">
            
    </div>
</section>
