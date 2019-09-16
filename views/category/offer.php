<header>
    <?php require_once './views/layout/navbar.php' ?>
</header>

<?php require_once './views/layout/categories_list.php' ?>

<main class="all-products">
    <div class="main-container min-container">
        <h2>Offers</h2>

       <?php
            $products = $productsByOffer;
            if ($products->num_rows == 0):
                require_once './views/layout/empty.php'
        ?>
            <?php else: ?>
            <div class="products">
                <?php
                        while($product = $productsByOffer->fetch_assoc()):
                            ?>
                            <?php include './views/layout/product.php'?>
                <?php
                        endwhile;
                endif;
            ?>
        </div><!--products-->
    </div><!--main-container-->
</main>

<?php require_once './views/layout/footer.php'; ?>