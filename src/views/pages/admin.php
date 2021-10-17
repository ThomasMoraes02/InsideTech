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
                                <label for="cpf">CPF</label>
                                <input type="text" name="cpf_admin" id="cpf" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" name="telefone_admin" id="telefone" class="form-control"
                                    required>
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
                            <button type="submit" style="background: #0052cc;" class="bnt btn-lg btn-success">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-bordered table-hover text-center table-list">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col" class="text-center"><i class="fas fa-trash-alt"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($admins): ?>
                            <?php foreach($admins as $admin): ?>
                        <tr>
                            <th scope="row"><?php echo $admin['id_admin'] ?></th>
                            <td><?php echo $admin['name'] ?></td>
                            <td><?php echo $admin['email'] ?></td>
                            <form method="POST" action="<?= BASE_URL ?>/adm-deletar">
                                <td class="text-center">
                                    <button class="btn-admin"><i class="fas fa-trash-alt" style="color: #0052cc;"></i></button>
                                </td>
                                <input id="id" type="hidden" name="adm_id" value="<?php echo $admin['id_admin'] ?>">
                            </form>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?php unset($_SESSION['message']); ?>
<?php unset($_SESSION['type']); ?>