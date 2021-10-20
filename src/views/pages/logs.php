<section>
    <div class="container">
        <div class="col-md-12">
            <table id="table-logs"
                class="table-pagination table table-striped table-bordered table-hover text-center table-list">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($logs): ?>
                    <?php foreach($logs as $log): ?>
                    <tr>
                        <td><?= $log['id_log'] ?></td>
                        <?php $name_admin = explode(" ", $log['name_admin']) ?>
                        <td><?= $name_admin[0] ?></td>
                        <td><?= json_decode($log['message_log'],true) ?></td>
                        <td><?= empty($log['name_user']) ? $log['fk_id_user'] : $log['name_user'] ?></td>
                        <td><?= $log['type_log'] ?></td>
                        <td><?= date("H:i:s - d/m/Y", strtotime($log['timestamp_create_log'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <td>Nenhum Log encontrado</td>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>