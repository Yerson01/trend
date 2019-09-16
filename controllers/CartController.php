<?php
require_once './models/Cart.php';

class CartController {
    public function index() {
        Utils::isntLogin();
        require_once './views/cart/index.php';
    }

    public function showOne() {
        if (isset($_POST) && !empty($_POST)) {
            $id = $_POST['id'];
            $cart = new Cart();
            $cart->setId($id);
            $order = $cart->getOne()->fetch_assoc();
            $product = Utils::showProduct($order['_product_id']);


            $response = array(
                "json_start" => true,
                "data" => array(
                    "id" => $order['_id'],
                    "productId" => $product->_id,
                    "name" => $product->_name,
                    "image" => $product->_image, 
                    "quantity" => $order['_quantity'],
                    "total" => $order['_total']
                ),
                "json_end" => true
            );

            echo json_encode($response);
        } else {
            Utils::redirectTo('cart/index');
        }
    }

    public function add() {
        if (isset($_POST) && !empty($_POST)) {
            $response = array();
            if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
                $productId = $_POST['id'];
                $quantity = $_POST['quantity'];
                $userId = isset($_SESSION['user']) ? $_SESSION['user']['_id'] : $_SESSION['admin']['_id'];

                //guardar los datos del producto
                $product = Utils::showProduct($productId);
                $discount = ($product->_offer != 'null') ? ($product->_price*$product->_offer)/100 : false;
                $productPrice = ($discount) ? $product->_price - $discount : $product->_price;
                $total = $productPrice * $quantity;
                $image = $product->_image;


                //validar que el producto no exista en db
                $cart = Utils::showCart();

                foreach ($cart as $product) {
                    if ($product['_product_id'] == $productId && $product['_user_id'] == $userId) {
                        $response = array(
                            "json_start" => true,
                            "delete" => $product['_id'],
                            "json_end" => true
                        );
                    }
                }

                if (count($response) == 0) {
                    $newCart = new Cart();
                    $newCart->setProductId($productId);
                    $newCart->setUserId($userId);
                    $newCart->setQuantity($quantity);
                    $newCart->setTotal($total);
                    $newCart->setImage($image);
                    $inserted = $newCart->insertDB();
                    if ($inserted->affected_rows >= 1) {
                        $response = array(
                            "json_start" => true,
                            "success" => "Product has been successfully introduced",
                            "data" => array(
                                "id" => $inserted->insert_id,
                                "productId" => $productId,
                                "userId" => $userId,
                                "total" => $total
                            ),
                            "json_end" => true
                        );
                    } else {
                        $response = array (
                            "json_start" => true,
                            "error" => 'An unexpected error ocurred',
                            "json_end" => true
                        );
                    }
                }


            //Si no existe la session user o admin
            } else {
                $response = array (
                    "json_start" => true,
                    "error" => 'You have to login to add products',
                    "json_end" => true
                );
            }

            echo json_encode($response);

        } else {
            Utils::redirectTo('cart/index');
        }
    }

    public function delete() {
        if (isset($_POST) && !empty($_POST)) {
            $response = array();
            if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
                $id = $_POST['id'];
                $newCart = new Cart();
                $newCart->setId($id);
                $deleted = $newCart->deleteFromDB();

                if ($deleted->affected_rows >= 1) {
                    $response = array(
                        "json_start" => true,
                        "info" => "Order has been successfully eliminated",
                        "id" => $id,
                        "json_end" => true
                    );
                } else {
                    $response = array (
                        "json_start" => true,
                        "error" => 'An unexpected error ocurred',
                        "json_end" => true
                    );
                }

            } else {
                $response = array (
                    "json_start" => true,
                    "error" => 'You have to login to access this feature',
                    "json_end" => true
                );
            }

            echo json_encode($response);

            //si no existe post
        } else {
            Utils::redirectTo('cart/index');
        }
    }
}