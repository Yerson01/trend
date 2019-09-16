<div class="products-categories-container container">
    <h5>Categories</h5>
    <ul class="categories-links">
        <a href="<?=BASE_URL?>product/index" class="category-link">
            <span>All</span>
        </a>
        <?php
        $allCategories = Utils::showCategories();
        while ($cat = $allCategories->fetch_assoc()):
            ?>
            <a href="<?=BASE_URL?>category/show&id=<?=$cat['_id']?>" class="category-link">
                <span class=<?=(isset($_GET['id']) && $_GET['id'] == $cat['_id']) ? "active" : ''?>><?=$cat['_name']?></span>
            </a>
        <?php endwhile; ?>
        <a href="<?=BASE_URL?>category/offer" class="category-link">
            <span>Offers</span>
        </a>
    </ul>
</div>