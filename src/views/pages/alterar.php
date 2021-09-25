<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="subtitulo">Alterar Usuário</h1>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_SESSION['message']) && isset($_SESSION['type'])): ?>
                <div class="text-center alert alert-<?= $_SESSION['type'] ?>">
                    <span class="lead"><?= $_SESSION['message'] ?></span>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="formulario mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="<?= BASE_URL ?>/update">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?= $usuario['nome'] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" placeholder="email@dominio.com"
                                    name="email" value="<?= $usuario['email'] ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="<?= $usuario['cpf'] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" id="telefone" placeholder="(XX) XXXXX-XXXX"
                                    name="telefone" value="<?= $usuario['telefone'] ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" value="<?= $usuario['cep'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="logradouro">Logradouro</label>
                                <input type="text" class="form-control" id="logradouro" name="endereco" value="<?= $usuario['endereco'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="<?= $usuario['numero'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="complemento">Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" value="<?= $usuario['complemento'] ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" value="<?= $usuario['cidade'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" value="<?= $usuario['estado'] ?>">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php unset($_SESSION['message']); ?>
<?php unset($_SESSION['type']); ?>