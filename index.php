<?php
require_once 'conexao.php';

$sql = "SELECT * FROM clientes";
$result = mysqli_query($conn, $sql);

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Clientes</title>
</head>
<body>
  <h1>Clientes</h1>
  <a href="cadastro.php">Cadastrar novo</a>
  <table border="1" cellpadding="5" cellspacing="0">
    <tr><th>ID</th><th>Nome</th><th>CPF</th><th>Ações</th></tr>
    <?php

    if ($result) { //03 estava "results" em vez de "result"
      while ($row = mysqli_fetch_assoc($result)) { //03 estava "results" em vez de "result"
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['cpf'] . '</td>';
        echo '<td><a href="editar.php?id=' . $row['id'] . '">Editar</a> | <a href="excluir.php?id=' . $row['id'] . '">Excluir</a></td>';
        echo '</tr>';
      }
    } else {
      echo '<tr><td colspan="4">Nenhum registro encontrado</td></tr>';
    }
    ?>
  </table>
</body>

<script>
// Sistema de feedback para o usuário
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.has('success')) {
        const messages = {
            'salvo': 'Cliente cadastrado com sucesso!',
            'atualizado': 'Cliente atualizado com sucesso!',
            'excluido': 'Cliente excluído com sucesso!'
        };
        
        const message = messages[urlParams.get('success')] || 'Operação realizada com sucesso!';
        alert('' + message);
        
        // Limpar a URL para não mostrar o alerta novamente ao recarregar
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    
    if (urlParams.has('error')) {
        const errors = {
            'cpf_duplicado': 'CPF já cadastrado no sistema!',
            'erro_banco': 'Erro ao processar a solicitação!',
            'id_invalido': 'ID inválido ou não informado!'
        };
        
        const message = errors[urlParams.get('error')] || 'Ocorreu um erro na operação!';
        alert('' + message);
        
        // Limpar a URL para não mostrar o alerta novamente ao recarregar
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});
</script>

</html>
