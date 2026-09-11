<?php

if (!isset($pagina)) exit;

if (empty($id)) {
    header("Location: listar/banner");
    exit;
}

// Buscar o banner para descobrir o nome da imagem
$sql = "SELECT * FROM banner WHERE id = :id";

$consulta = $pdo->prepare($sql);
$consulta->bindParam(":id", $id);
$consulta->execute();

$banner = $consulta->fetch(PDO::FETCH_OBJ);

if ($banner) {

    // Excluir o registro do banco
    $sql = "DELETE FROM banner WHERE id = :id";

    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
}

// Voltar para a listagem
header("Location: listar/banner");
exit;