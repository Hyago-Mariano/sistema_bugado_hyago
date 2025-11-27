<?php
require_once 'conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID não informado');
}

// 08 Converter para número e validar
$id = intval($_GET['id']);

if ($id <= 0) {
    die('ID inválido');
}

// 07 CORREÇÃO: Adicionar WHERE para excluir apenas o cliente específico
$sql = "DELETE FROM clientes WHERE id = $id";


if (mysqli_query($conn, $sql)) {
    
    header('Location: index.php?success=excluido');
} else {
    echo 'Erro ao excluir: ' . mysqli_error($conn);
}

exit;
?>