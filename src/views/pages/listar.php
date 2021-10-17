<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="subtitulo">Usuários</h1>
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
    <div class="tabela mb-5">
        <div class="container">
            <div class="buscar">
                <form class="form-inline form-buscar" method="POST" action="<?= BASE_URL ?>/buscar">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" name="filtro" placeholder="Filtrar Buscas...">
                    </div>
                    <button type="submit" class="btn btn-success mb-2">Buscar</button>
                </form>
            </div>
            <table class="table table-striped table-bordered table-hover table-responsive-sm table-responsive-md table-list">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">CEP</th>
                        <th scope="col" class="text-center"><i class="fas fa-trash-alt"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($users): ?>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <th scope="row"><?= $user['id_user'] ?></th>
                        <td class="link">
                            <form action="alterar" method="post">
                                <input type="hidden" name="id" value="<?= $user['id_user'] ?>">
                                <button class="btn-update"><?= $user['name'] ?></button>
                            </form>
                        </td>
                        <td><?= $user['email'] ?></td>
                        <td class="cpf"><?= $user['cpf'] ?></td>
                        <td class="telefone"><?= $user['phone'] ?></td>
                        <td class="cep"><?= $user['zipcode'] ?></td>
                        <!-- <td class="text-center"><a href="<?= BASE_URL ?>/delete/<?= $user['id_user'] ?>"><i class="fas fa-trash-alt"
                                    style="color: #27b67c;"></i></a></td> -->
                        <td class="text-center delete-ajax"><a href="#" data-id="<?= $user['id_user'] ?>"
                                data-action="delete"><i class="fas fa-trash-alt" style="color: #27b67c;"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <th>Nenhum usuário encontrado!</th>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php unset($_SESSION['message']); ?>
<?php unset($_SESSION['type']); ?>