<header class="home" id="home">
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
                    <a href="<?=BASE_URL?>/category/offer" class="to-login btn border-secondary border-radius white">
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
        <a href="#main" class="down-arrow">
            <img src="<?=BASE_URL?>src/img/svg/arrow.svg" alt="Arrow">
        </a>
    </div>
</header>

<main id="main">
    <div class="main-container min-container">
        <h2>Latest Products</h2>
        <div class="products">
            <?php
                $products = Utils::showLimitProducts(9);
                while($product = $products->fetch_assoc()):
            ?>
                    <?php include './views/layout/product.php'?>
            <?php endwhile; ?>
        </div><!--products-->
    </div><!--main-container-->
</main>

<?php require_once './views/layout/banner.php' ?>
<?php require_once './views/layout/choose_us.php' ?>
<?php require_once './views/layout/discount.php' ?>
<?php require_once './views/layout/footer.php'; ?>










