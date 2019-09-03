
<main>
    <div class="register-container">
        <div class="hero">
            <div class="hero-text">
                <div class="logo-container">
                    <h3 class="logo">trend</h3>
                </div>
                <p>Accede para ver mas contenido</p>
            </div>
            <img src="<?=BASE_URL?>src/img/svg/vector2.svg" alt="" class="vector vector1">
        </div><!--hero-->
        <form action="" class="" id="register-form">
            <div class="fields-container">
                <div class="fields">
                    <h4><i class="far fa-user"></i> Regístrate</h4>
                    <div class="field name">
                        <i class="far fa-user"></i>
                        <input type="text" name="name" id="" placeholder="Name">
                    </div>
                    <div class="field lastname">
                        <i class="far fa-user"></i>
                        <input type="text" name="lastname" id="" placeholder="Lastname">
                    </div>
                    <div class="field email">
                        <i class="far fa-envelope"></i>
                        <input type="email" name="email" id="" placeholder="Email">
                    </div>
                    <div class="field password">
                        <i class="fas fa-unlock-alt"></i>
                        <input type="password" name="password" id="" placeholder="Password">
                    </div>
                    <!--                        <div class="field photo">-->
                    <!--                            <input type="email" name="photo" id="" placeholder="foto">-->
                    <!--                        </div>-->
                    <div class="btn-submit">
                        <button type="submit" class="bg-transparent border-radius">
                            <img src="<?=BASE_URL?>src/img/svg/right-arrow.svg" alt="">
                        </button>
                    </div>
                </div><!--fields-->
            </div><!--fields-container-->
        </form>
    </div>
</main>
