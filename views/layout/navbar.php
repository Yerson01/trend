<div class="bar container drop-animation">
    <div class="logo-container">
        <a href="<?=BASE_URL?>"><h3 class="logo">trend</h3></a>
    </div><!--logo-container-->
    <nav>
        <ul class="nav-links">
            <li><a href="#" class="nav-link">Products</a></li>
            <li><a href="#" class="nav-link">About Us</a></li>
            <?php if (isset($_SESSION['user'])):?>
                <li><a href="#" class="nav-link">Orders</a></li>
            <?php elseif (isset($_SESSION['admin'])): ?>
                <li><a href="<?=BASE_URL?>user/manage" class="nav-link">Manage</a></li>
            <?php else: ?>
                <li><a href="<?=BASE_URL?>user/register" class="nav-link">Get Account</a></li>
            <?php endif; ?>
        </ul>
    </nav><!--navbar-->

    <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
        <?php $username = isset($_SESSION['user']) ?  $_SESSION['user']['_username'] : $_SESSION['admin']['_username']; ?>
        <div class="toggle-user-logged">
            <div class="cart-container">
                <a href="#" class="cart">
                    <img src="<?=BASE_URL?>src/img/svg/cart.svg" alt="Cart">
                    <div class="cart-quantity">
                        <span id="products-number">2</span>
                    </div>
                </a>
            </div>

            <div class="log-container">
                <p class="greeting">Hi <?=$username?>!</p>
                <a href="<?=BASE_URL?>user/logout" class="btn border-secondary white btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div><!--cart-->
    <?php else: ?>
        <div class="toggle-user-logged">
            <div class="log-container">
                <a href="<?=BASE_URL?>user/login" class="btn border-secondary white btn-login">
                    Login <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    <?php endif; ?>
</div><!--bar.container-->