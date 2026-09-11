<?php

if (!isset($pagina)) exit;

// Receber os dados do formulário
$id = $_POST['id'] ?? NULL;
$descricao = $_POST['descricao'] ?? NULL;
$ativo = $_POST['ativo'] ?? "S";

$nomeBanner = NULL;


// ================================
// UPLOAD DA IMAGEM
// ================================

if (
    isset($_FILES['banner']) &&
    $_FILES['banner']['error'] === UPLOAD_ERR_OK
) {

    $arquivo = $_FILES['banner'];

    // Verificar extensão
    $extensao = strtolower(
        pathinfo($arquivo['name'], PATHINFO_EXTENSION)
    );

    $extensoesPermitidas = ['jpg', 'jpeg', 'png'];

    if (!in_array($extensao, $extensoesPermitidas)) {
        die("Formato de imagem não permitido.");
    }

    // Criar nome único
    $nomeBanner = uniqid() . "." . $extensao;

    // Caminho correto para a pasta arquivos
    $pasta = __DIR__ . "/../../arquivos/";

    // Verificar se a pasta existe
    if (!is_dir($pasta)) {
        die("A pasta de imagens não existe.");
    }

    // Fazer upload
    if (!move_uploaded_file(
        $arquivo['tmp_name'],
        $pasta . $nomeBanner
    )) {
        die("Não foi possível salvar a imagem.");
    }
}


// ================================
// NOVO CADASTRO
// ================================

if (empty($id)) {

    $sql = "INSERT INTO banner
            (descricao, banner, ativo)
            VALUES
            (:descricao, :banner, :ativo)";

    $consulta = $pdo->prepare($sql);

    $consulta->bindParam(":descricao", $descricao);
    $consulta->bindParam(":banner", $nomeBanner);
    $consulta->bindParam(":ativo", $ativo);

    $consulta->execute();


// ================================
// ATUALIZAÇÃO
// ================================

} else {

    if (!empty($nomeBanner)) {

        $sql = "UPDATE banner SET
                descricao = :descricao,
                banner = :banner,
                ativo = :ativo
                WHERE id = :id";

        $consulta = $pdo->prepare($sql);

        $consulta->bindParam(":banner", $nomeBanner);

    } else {

        $sql = "UPDATE banner SET
                descricao = :descricao,
                ativo = :ativo
                WHERE id = :id";

        $consulta = $pdo->prepare($sql);
    }

    $consulta->bindParam(":descricao", $descricao);
    $consulta->bindParam(":ativo", $ativo);
    $consulta->bindParam(":id", $id);

    $consulta->execute();
}


// Voltar para a listagem
header("Location: /desafio_burnes/admin/listar/banner");
exit;