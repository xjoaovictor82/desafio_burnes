<?php

if (!isset($pagina)) exit;

$sql = "SELECT * FROM banner ORDER BY id DESC";

$consulta = $pdo->prepare($sql);
$consulta->execute();

$banners = $consulta->fetchAll(PDO::FETCH_OBJ);
?>

<div class="card shadow">

    <div class="card-header">

        <div class="float-start">
            <h2>Lista de Banners</h2>
        </div>

        <div class="float-end">
            <a href="cadastrar/banner" class="btn btn-success">
                Novo Registro
            </a>
        </div>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Banner</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($banners as $banner): ?>

                        <tr>

                            <td><?= $banner->id ?></td>

                            <td><?= $banner->descricao ?></td>

                            <td>
                                <?= $banner->banner ?>
                            </td>

                            <td>
                                <?= $banner->ativo == "S" ? "Sim" : "Não" ?>
                            </td>

                            <td>

                                <a href="cadastrar/banner/<?= $banner->id ?>"
                                   class="btn btn-primary btn-sm">
                                    Editar
                                </a>

                                <a href="excluir/banner/<?= $banner->id ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Deseja realmente excluir este banner?')">
                                    Excluir
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>