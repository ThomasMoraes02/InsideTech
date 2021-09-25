<section class="admin-home">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form class="form-admin" method="POST" action="<?= BASE_URL ?>/adm-cadastrar">
                    <div class="login-card card">
                        <div class="card-header">
                            <span class="title-login">Cadastrar Administrador</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome_admin" id="nome" class="form-control"
                                    placeholder="Digite seu nome completo" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email_admin" id="email" class="form-control"
                                    placeholder="Digite seu e-mail" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" name="senha_admin" id="senha" class="form-control"
                                    placeholder="Defina uma senha" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span></span>
                            <?php if(isset($_SESSION['message']) && isset($_SESSION['type'])): ?>
                            <span class="lead text-danger"><?= $_SESSION['message'] ?></span>
                            <?php endif ?>
                            <button type="submit" class="bnt btn-lg btn-success">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($admins): ?>
                            <?php foreach($admins as $admin): ?>
                        <tr>
                            <th scope="row"><?php echo $admin['id_admin'] ?></th>
                            <td><?php echo $admin['nome_admin'] ?></td>
                            <td><?php echo $admin['email_admin'] ?></td>
                            <td> Deletar </td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>