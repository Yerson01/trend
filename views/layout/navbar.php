<div class="bar drop-animation">
    <div class="bar-wrapper container">
        <div class="logo-container">
            <a href="<?=BASE_URL?>"><h3 class="logo">trend</h3></a>
        </div><!--logo-container-->

        <div class="burger-menu">
            <!-- <i class="fas fa-bars toggle-navbar"></i> -->
            <div class="icon bar toggle-navbar">
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </div>
        </div>
        <div class="slide-menu">
            <nav>
                <ul class="nav-links">
                    <li><a href="<?=BASE_URL?>product/index" class="nav-link"><i class="fas fa-shopping-bag d-md-none"></i> Products</a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-question-circle d-md-none"></i> About Us</a></li>
                    <?php if (isset($_SESSION['user'])):?>
                        <li><a href="<?=BASE_URL?>cart/index" class="nav-link"><i class="fas fa-cart-plus d-md-none"></i> Orders</a></li>
                        <li>
                            <a href="<?=BASE_URL?>user/logout" class="nav-link last d-md-none">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    <?php elseif (isset($_SESSION['admin'])): ?>
                        <li><a href="<?=BASE_URL?>user/manage" class="nav-link"><i class="fas fa-cog d-md-none"></i>Manage</a></li>
                        <li>
                            <a href="<?=BASE_URL?>user/logout" class="nav-link last d-md-none">
                            <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?=BASE_URL?>user/register" class="nav-link"><i class="fas fa-user d-md-none"></i> Get Account</a>
                        </li>
                        <li>
                            <a href="<?=BASE_URL?>user/login" class="nav-link last d-md-none">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>  
                        </li>     
                    <?php endif; ?>
                </ul>
            </nav><!--navbar-->

            <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
                <?php $username = isset($_SESSION['user']) ?  $_SESSION['user']['_username'] : $_SESSION['admin']['_username']; ?>
                <div class="toggle-user-logged">
                    <div class="cart-container">
                        <?php $user = Utils::userOrAdmin();
                        $cart = array();
                        if ($user) :
                            $cart = Utils::showCartByUser($user['_id']);
                        endif; ?>
                        <div class="cart">
                            <a href="<?=BASE_URL?>cart/index" class="cart-link">
                                <span class="d-md-none">Shopping cart</span>
                                <div class="cart-icon">
                                    <img src="<?=BASE_URL?>src/img/svg/cart-outline.svg" alt="Cart">
                                    <div class="cart-quantity">
                                        <span id="products-number"><?=($cart->fetch_assoc() != null) ? $cart->num_rows : 0?></span>
                                    </div>
                                </div>
                            </a>
                            <ul class="shopping-list-preview">
                                <?php
                                $cart = Utils::showCartByUserLimit($user['_id'], 4);
                                if ($cart->fetch_assoc() != null):
                                    ?>
                                <?php
                                foreach ($cart as $order):
                                    $newProduct = Utils::showProduct($order['_product_id'])?>
                                    <li class="preview" data-id="<?=$order['_id']?>">
                                        <a href="<?=BASE_URL?>product/show&id=<?=$newProduct->_id?>" class="preview-img">
                                            <img src="<?=BASE_URL?>src/img/products/<?=$newProduct->_image?>" alt="<?=$newProduct->_name?>">
                                        </a>

                                        <div class="preview-info">
                                            <p class="order-title"><?=$newProduct->_name?></p>
                                            <p class="order-quantity"><span><?=$order['_quantity']?></span> x</p>
                                        </div>
                                        <div class="order-total">
                                            <p>$ <?=$order['_total']?></p>
                                        </div>
                                        <div class="preview-actions">
                                            <i class="far fa-trash-alt remove-preview" data-id="<?=$order['_id']?>"></i>
                                        </div>
                                    </li>

                                <?php endforeach; ?>
                                    <div class="show-all-container">
                                        <a href="<?=BASE_URL?>cart/index" class="btn bg-third white border-third show-all">
                                            <span>Show all</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <li class="preview empty-cart">The cart is empty</li>
                            <?php endif; ?>
                            </ul><!--shopping-list-preview-->
                        </div>
                    </div>

                    <div class="log-container">
                        <p class="greeting">Hi <?=$username?>!</p>
                        <a href="<?=BASE_URL?>user/logout" class="btn border-secondary white btn-logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div><!--toggle-user-logged-->
            <?php else: ?>
                <div class="toggle-user-logged">
                    <div class="log-container">
                    <p class="join-message d-md-none">Join for more!</p>
                        <a href="<?=BASE_URL?>user/login" class="btn border-secondary white btn-login">
                            Login <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div><!--bar.container-->