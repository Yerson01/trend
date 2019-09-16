<?php
require_once './models/Category.php';

class CategoryController {
    public function index() {

    }

    public function show() {
        if (isset($_GET['id']) && $_GET['id'] !== '') {
            //obtener la categoria
            $categoryId = $_GET['id'];
            $category = new Category();
            $category->setId($categoryId);
            $selectedCategory = $category->getOne();

            //obtener los productos
            $product = new Product();
            $product->setCategoryId($categoryId);
            $productsByCategory = $product->getByCategory();

            require_once './views/category/show.php';
        } else {
            Utils::redirectTo('product/index');
        }
    }

    public function offer() {

        //obtener los productos
        $product = new Product();
        $productsByOffer = $product->getAllByOffer();

        require_once './views/category/offer.php';
    }

    public function create() {
        if (isset($_POST['submit'])) {
            $categoryName = !empty($_POST['name']) ? Utils::sanitizeField($_POST['name']) : false;
            $image = isset($_FILES['image']) ? $_FILES['image'] : false;
            if ($categoryName && $image) {
                $imgName = $image['name'];
                $imgType =  $image['type'];
                $imgLocation = $image['tmp_name'];

                //verificar que la imagen sea valida
                if ($imgType == 'image/svg+xml' || $imgType == 'image/jpg' || $imgType == 'image/jpeg' || $imgType == 'image/png') {

                    //crear nueva instancia de categoria
                    $category = new Category();
                    $category->setName($categoryName);
                    $category->setImage($imgName);
                    $inserted = $category->insertDB();
                    if ($inserted) {
                        //Guardar la imagen en un directorio
                        Utils::saveImg($imgName, $imgLocation, 'categories');

                        //Mostrar mensaje de success y redirigir
                        $_SESSION['success'] = 'Category has been successfully introduced!';
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
                $_SESSION['error'] = 'Both fields are required!';
                Utils::redirectTo('user/manage');
            }
        //si no existe post redirigir
        } else {
            Utils::redirectTo();
        }
    }
}