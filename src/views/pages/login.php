<?php if($header == "disabled"): ?>
<input type="hidden" id="header-disabled" value="disabled">
<?php endif; ?>

<div class="login">
    <form class="form-login" method="POST" action="<?= BASE_URL ?>/autenticacao">
        <div class="login-card card">
            <div class="card-header">
                <span class="title-login">Login</span> <br>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <span></span>
                <?php if(isset($_SESSION['message']) && isset($_SESSION['type'])): ?>
                <span class="lead text-danger"><?= $_SESSION['message'] ?></span>
                <?php endif ?>
                <button type="submit" id="btn-login-auth" class="bnt btn-lg btn-success">Entrar</button>
            </div>
            <div class="card-footer">
                
                <!-- <fb:login-button scope="public_profile,email,user_birthday,user_location" onlogin="checkLoginState();">
                </fb:login-button> -->

                <div class="fb-root">
                <div class="fb-login-button" onlogin="checkLoginState()" scope="public_profile,email,user_birthday,user_location" data-width="" data-size="large" data-button-type="continue_with"
                    data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
                </div>

                <div class="fb-root">
                    <a id="fb-logout" class="fb-logout" href="#" onclick="logout()">Logout</a>
                </div>

                <!-- <div id="fb-root"></div>
                <script async defer crossorigin="anonymous"
                    src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v12.0&appId=426169618864833&autoLogAppEvents=1"
                    nonce="wdCHhE4i"></script>
                <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with"
                    data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div> -->

            </div>
        </div>

        <div id="fb_profile">
        </div>

    </form>
</div>

<!-- <div class="container">
    <div class="col-md-12">
        <div id ="profile"></div>
    </div>
</div> -->

<?php unset($_SESSION['message']); ?>
<?php unset($_SESSION['type']); ?>