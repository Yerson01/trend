
<header>
    <?php require_once './views/layout/navbar.php' ?>
</header>


<?php require_once './views/layout/categories_list.php' ?>

<main class="all-products">
    <div class="main-container min-container">
        <h2>All Products</h2>
        <div class="products">
            <?php
            $products = Utils::showProducts();
            while($product = $products->fetch_assoc()):
                ?>
               <?php include './views/layout/product.php'?>
            <?php endwhile; ?>
        </div><!--products-->
    </div><!--main-container-->
</main>

<?php require_once './views/layout/footer.php'; ?>