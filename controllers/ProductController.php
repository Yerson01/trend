<?php

class ProductController {
    public function index() {
        require_once './views/product/index.php';
    }

    public function show() {
        if (isset($_GET['id']) && $_GET['id'] !== '') {
            $productId = $_GET['id'];
            $newProduct = new Product();
            $newProduct->setId($productId);
            $selectedProduct = $newProduct->getOne();

            require_once './views/product/show.php';
        } else {
            Utils::redirectTo('product/index');
        }


    }

    public function create() {
        if (isset($_POST['submit'])) {
            $productName = !empty($_POST['name']) ? Utils::sanitizeField($_POST['name']) : false;
            $description = !empty($_POST['description']) ? Utils::sanitizeField($_POST['description']) : false;
            $price = !empty($_POST['price']) ? $_POST['price'] : false;
            $categoryId = !empty($_POST['category']) ? $_POST['category'] : false;
            $stock = !empty($_POST['stock']) ? $_POST['stock'] : false;
            $offer = !empty($_POST['offer']) ? $_POST['offer'] : 'null';
            $image = isset($_FILES['image']) ? $_FILES['image'] : false;
            if ($productName && $description && $price && $stock && $image) {
                $imgName = $image['name'];
                $imgType =  $image['type'];
                $imgLocation = $image['tmp_name'];

                //verificar que la imagen sea valida
                if ($imgType == 'image/svg+xml' || $imgType == 'image/jpg' || $imgType == 'image/jpeg' || $imgType == 'image/png') {

                    //crear nueva instancia de categoria
                    $product = new Product();
                    $product->setName($productName);
                    $product->setDescription($description);
                    $product->setPrice($price);
                    $product->setStock($stock);
                    $product->setCategoryId($categoryId);
                    $product->setOffer($offer);
                    $product->setImage($imgName);
                    $inserted = $product->insertDB();
                    if ($inserted) {
                        //Guardar la imagen en un directorio
                        Utils::saveImg($imgName, $imgLocation, 'products');

                        //Mostrar mensaje de success y redirigir
                        $_SESSION['success'] = 'Product has been successfully introduced!';
                        Utils::redirectTo('user/manage');

                        //Si hubo error al insertar
                    } else {
                        $_SESSION['error'] = 'An unexpected error occurred';
                        Utils::redirectTo('user/manage');
                    }
                    //si la imagen no tiene un formato correcto
                } else {
                    $_SESSION['error'] = 'Enter a valid image!';
                    Utils::redirectTo('user/manage');
                }
                //si los campo estan vacios redirigir
            } else {
                $_SESSION['error'] = 'All fields are required!';
                Utils::redirectTo('user/manage');
            }
            //si no existe post redirigir
        } else {
            Utils::redirectTo();
        }
    }

    public function delete() {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $product = new Product();
            $product->setId($_GET['id']);
            $idDeleted = $product->deleteFromDB();
            if ($idDeleted) {
                $_SESSION['success'] = 'The product has been removed';
            } else {
                $_SESSION['error'] = "Error trying to remove product";
            }
            Utils::redirectTo('user/manage');
        } else {
            Utils::redirectTo('user/manage');
        }
    }

    public function update() {
        if (isset($_POST['submit'])) {
            $id = !empty($_POST['id']) ? $_POST['id'] : false;
            $productName = !empty($_POST['name']) ? Utils::sanitizeField($_POST['name']) : false;
            $description = !empty($_POST['description']) ? Utils::sanitizeField($_POST['description']) : false;
            $price = !empty($_POST['price']) ? $_POST['price'] : false;
            $categoryId = !empty($_POST['category']) ? $_POST['category'] : false;
            $stock = !empty($_POST['stock']) ? $_POST['stock'] : false;
            $offer = !empty($_POST['offer']) ? $_POST['offer'] : 'null';

            //verificar si la imagen ha sido cambiada
            $dbImage = Utils::showProduct($id)->_image;
            $changedImage = isset($_FILES['image']) ? $_FILES['image'] : false;
            $newImage = ($changedImage['name'] == $dbImage) ? $changedImage['name'] : ($changedImage['name'] == '') ? $dbImage :  $changedImage['name'];

            if ($productName && $description && $price && $stock && $changedImage) {
                $imgName = $newImage;
                $imgType =  $changedImage['type'];
                $imgLocation = $changedImage['tmp_name'];

                //verificar que la imagen sea valida
                if ($imgType == 'image/svg+xml' || $imgType == 'image/jpg' || $imgType == 'image/jpeg' || $imgType == 'image/png' || $dbImage) {

                    //crear nueva instancia de categoria
                    $product = new Product();
                    $product->setId($id);
                    $product->setName($productName);
                    $product->setDescription($description);
                    $product->setPrice($price);
                    $product->setStock($stock);
                    $product->setCategoryId($categoryId);
                    $product->setOffer($offer);
                    $product->setImage($imgName);

                    $updated = $product->updateOne();
                    if ($updated) {

                        if ($dbImage !== $imgName)  {
                            //Guardar la imagen en un directorio
                            Utils::saveImg($imgName, $imgLocation, 'products');
                        }

                        //Mostrar mensaje de success y redirigir
                        $_SESSION['success'] = 'Product has been successfully edited!';
                        Utils::redirectTo('user/manage');

                        //Si hubo error al insertar
                    } else {
                        $_SESSION['error'] = 'An unexpected error occurred';
                        Utils::redirectTo('user/manage');
                    }
                    //si la imagen no tiene un formato correcto
                } else {
                    $_SESSION['error'] = 'Enter a valid image!';
                    Utils::redirectTo('user/manage');
                }
                //si los campo estan vacios redirigir
            } else {
                $_SESSION['error'] = 'All fields are required!';
                Utils::redirectTo('user/manage');
            }
            //si no existe post redirigir
        } else {
            Utils::redirectTo();
        }
    }
}