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
                    <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail"
                        required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
            </div>
            <div class="card-footer">
                <span></span>
                <?php if(isset($_SESSION['message']) && isset($_SESSION['type'])): ?>
                <span class="lead text-danger"><?= $_SESSION['message'] ?></span>
                <?php endif ?>
                <button type="submit" class="bnt btn-lg btn-success">Entrar</button>
            </div>
        </div>
    </form>
</div>

<?php unset($_SESSION['message']); ?>
<?php unset($_SESSION['type']); ?>