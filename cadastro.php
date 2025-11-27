<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];  //04 nn havia ";" no final

    // Verificar se o CPF já existe
    $sql_check = "SELECT id FROM clientes WHERE cpf = '$cpf'";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        header('Location: index.php?error=cpf_duplicado');
        exit;
    } else {
        $sql = "INSERT INTO clientes (nome, cpf) VALUES ('$nome', '$cpf')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?success=salvo');
            exit;
        } else {
            header('Location: index.php?error=erro_banco');
            exit;
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cadastro</title>
</head>
<body>
  <h1>Cadastrar Cliente</h1>
  <form method="post">
    <label>Nome:<br><input type="text" name="nome" required></label><br><br>
    <label>CPF:<br><input type="text" name="cpf" required></label><br><br>
    <button type="submit">Salvar</button>
  </form>

  <p><a href="index.php">Voltar</a></p> <!-- 05 não havi o ".php" assim nn redirecinando para a pagina -->
</body>
</html>