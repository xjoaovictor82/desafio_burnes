```php
<?php
    if (!isset($pagina)) exit;

    // Verificar se está vindo um ID
    if (!empty($id)) {

        $sql = "SELECT * FROM banner
                WHERE id = :id LIMIT 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dadosBanner = $consulta->fetch(PDO::FETCH_OBJ);
    }

    $id = $dadosBanner->id ?? NULL;
    $descricao = $dadosBanner->descricao ?? NULL;
    $banner = $dadosBanner->banner ?? NULL;
    $ativo = $dadosBanner->ativo ?? "S";
?>

<div class="card shadow">

    <div class="card-header">

        <div class="float-start">
            <h2>Cadastro de Banner</h2>
        </div>

        <div class="float-end">

            <a href="cadastrar/banner" class="btn btn-success">
                Novo Registro
            </a>

            <a href="listar/banner" class="btn btn-info">
                Listar
            </a>

        </div>

    </div>

    <div class="card-body">

        <form name="formCadastro"
              method="post"
              action="salvar/banner"
              data-parsley-validate
              enctype="multipart/form-data">

            <div class="row">

                <div class="col-12 col-md-2">

                    <label for="id">ID:</label>

                    <input type="text"
                           name="id"
                           id="id"
                           class="form-control"
                           readonly
                           value="<?= $id ?>">

                </div>

                <div class="col-12 col-md-10">

                    <label for="descricao">Descrição:</label>

                    <input type="text"
                           name="descricao"
                           id="descricao"
                           class="form-control"
                           maxlength="100"
                           required
                           value="<?= $descricao ?>"
                           data-parsley-required-message="Preencha este campo">

                </div>

                <div class="col-12 col-md-8">

                    <label for="banner">Imagem do Banner:</label>

                    <input type="file"
                           name="banner"
                           id="banner"
                           class="form-control"
                           accept=".jpg,.jpeg,.png">

                </div>

                <div class="col-12 col-md-4">

                    <label for="ativo">Ativo:</label>

                    <select name="ativo"
                            id="ativo"
                            class="form-control"
                            required>

                        <option value="S">Sim</option>
                        <option value="N">Não</option>

                    </select>

                </div>

            </div>

            <br>

            <button type="submit"
                    class="btn btn-success float-end">
                Salvar Dados
            </button>

        </form>

    </div>

</div>

<script>
    $("#ativo").val("<?= $ativo ?>");
</script>
```
