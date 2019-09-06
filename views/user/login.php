<main class="login">
    <div class="login-container">
        <div class="hero">
            <div class="hero-text">
                <div class="logo-container">
                    <h3 class="logo">trend</h3>
                </div>
                <p>Inicia sesion para ver mas contenido</p>
                <div class="have-account">
                    <p><span>Aún no tienes una cuenta?</span>
                        <a href="<?=BASE_URL?>/user/register">Regístrate</a>
                        | <a href="<?=BASE_URL?>">Omitir por ahora</a>
                    </p>
                </div>
            </div>
            <img src="<?=BASE_URL?>src/img/svg/vector2.svg" alt="" class="vector vector1">
        </div><!--hero-->
        <form action="<?=BASE_URL?>/user/authenticate" method="POST" id="login-form">
            <div class="fields-container">
                <div class="fields">
                    <h4><i class="far fa-user"></i> Iniciar Sesión</h4>
                    <div class="field email">
                        <i class="far fa-envelope"></i>
                        <input type="email" name="email" id="" placeholder="Email">
                    </div>
                    <div class="field password">
                        <i class="fas fa-unlock-alt"></i>
                        <input type="password" name="password" id="" placeholder="Password">
                    </div>
                    <div class="btn-submit">
                        <button type="submit" class="bg-transparent border-radius">
                            <img src="<?=BASE_URL?>src/img/svg/right-arrow.svg" alt="">
                        </button>
                    </div>

                    <!--mostrar error si existe-->
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
                </div><!--fields-->
            </div><!--fields-container-->
        </form>
    </div>
</main>