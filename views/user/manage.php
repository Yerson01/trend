<header class="manage drop-animation">
    <?php require_once './views/layout/navbar.php' ?>
</header>

<div class="manage-container container">
    <aside class="options">
        <h4>Manage</h4>
        <ul class="options-links">
            <li><a class="option-link" href="#">Categories</a></li>
            <li><a class="option-link" href="#">Products</a></li>
            <li><a class="option-link" href="#">Orders</a></li>
        </ul>
    </aside>
    <main class="options-details">
        <section class="manage-categories">
            <h4>Categories</h4>
            <div class="d-flex align-items-start">
                <div class="add-category-form">
                    <p>Here you can add a new category</p>
                    <form action="<?=BASE_URL?>category/create" method="POST" enctype="multipart/form-data" class="add-item">
                        <input type="text" name="name" id="" placeholder="Category name">
                        <div class="d-flex justify-content-between">
                            <div class="image-field">
                                <label for="image" class="btn bg-green white choose">
                                    <i class="far fa-image"></i> Add Image
                                </label>
                                <input type="file" name="image" id="image">
                            </div>
                            <input type="submit" name="submit" value="Add" >
                        </div>
                    </form>
                </div>
                <ul class="categories">
                    <?php
                    $category = new CategoryController();
                    $allCategories = $category->showAll();
                    while ($cat = $allCategories->fetch_assoc()): ?>
                        <li>
                            <a class="category d-flex align-items-center">
                                <img src="<?=BASE_URL?>src/img/categories/<?=$cat['_image']?>" alt="<?=$cat['_name']?>">
                                <p><?=$cat['_name']?></p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <!--Show error message-->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert error float">
                        <?=$_SESSION['error']?>
                    </div>
                    <?php Utils::deleteSession('error') ?>
                <?php elseif (isset($_SESSION['success'])): ?>
                    <div class="alert success float">
                        <?=$_SESSION['success']?>
                        <?php Utils::deleteSession('success') ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <!--manage-categories-->

        <section class="manage-products">
            <h4>Manage Products</h4>
        </section>
        <section class="manage-orders">
            <h4>Manage Orders</h4>
        </section>
    </main>
</div>