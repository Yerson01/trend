<header>
    <?php require_once './views/layout/navbar.php' ?>
</header>

<main>
    <div class="shopping-details mid-container">
        <h2>Shopping cart</h2>
        <div class="shopping-container">

            <?php
                $userId = isset($_SESSION['user']) ? $_SESSION['user']['_id'] : $_SESSION['admin']['_id'];
                $cart = Utils::showCartByUser($userId);
                if ($cart->fetch_assoc() != null):
            ?>

                    <ul class="shopping-list shopping-list-details">
                        <?php
                            foreach ($cart as $order):
                                $newProduct = Utils::showProduct($order['_product_id'])?>

                                    <li class="order">
                                        <div class="order-img">
                                            <a href="<?=BASE_URL?>product/show&id=<?=$newProduct->_id?>">
                                                <img src="<?=BASE_URL?>src/img/products/<?=$newProduct->_image?>" alt="<?=$newProduct->_name?>">
                                            </a>
                                        </div>
                                        <div class="order-info">
                                            <p class="order-title"><?=$newProduct->_name?></p>

                                            <?php $price = number_format($order['_total']/ $order['_quantity'], 2) ?>
                                            <p class="order-price"><i class="fas fa-dollar-sign"></i> <?=$price?></p>
                                            <p class="order-quantity">Quantity: <span><?=$order['_quantity']?></span></p>
                                        </div>
                                        <div class="order-total">
                                            <p><span>Total:</span> <?=$order['_total']?></p>
                                        </div>
                                        <div class="order-actions">
                                            <a href="">
                                                <i class="far fa-trash-alt delete-order" data-id="<?=$order['_id']?>"></i>
                                            </a>
                                        </div>
                                    </li>

                        <?php endforeach; ?>
                    </ul><!--shopping-list-->

                    <?php
                        $sum = Utils::showTotalCart($userId);
                        $sum = $sum->fetch_assoc();
                    ?>
                    <div class="total-cart">
                        <div class="order-pay">
                            <p>Total in cart (<span class="total-articles"><?=$cart->num_rows?></span> articles)
                                <span class="total-sum">$
                                    <span><?=$sum['totalSum']?></span>
                                </span>
                            </p>
                            <button class="btn bg-green white btn-pay border-green" id="pay-all">
                                Pagar todo
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div><!--total-cart-->
            <?php else:
               require_once './views/layout/empty.php';
             endif; ?>
        </div>
    </div>
</main>

<?php require_once './views/layout/footer.php'; ?>
