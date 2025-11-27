<?php
require_once 'conexao.php';

if (!isset($_GET['id'])) {
    header('Location: index.php?error=id_invalido');
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header('Location: index.php?error=id_invalido');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];

    // Verificar se o CPF já existe em outro cliente
    $sql_check = "SELECT id FROM clientes WHERE cpf = '$cpf' AND id != $id";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        header('Location: index.php?error=cpf_duplicado');
        exit;
    } else {
        $sql_update = "UPDATE clientes SET nome = '$nome', cpf = '$cpf' WHERE id = $id"; // 06 Campos "nomes" e "cpf" estão sendo salvos invertidos no banco de dados 
        if (mysqli_query($conn, $sql_update)) {
            header('Location: index.php?success=atualizado');
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
  <title>Editar Cliente</title>
</head>
<body>
  <h1>Editar</h1>
  <form method="post">
    <label>Nome:<br><input type="text" name="nome" value="<?php echo $row['nome']; ?>" required></label><br><br>
    <label>CPF:<br><input type="text" name="cpf" value="<?php echo $row['cpf']; ?>" required></label><br><br>
    <button type="submit">Atualizar</button>
  </form>
  <p><a href="index.php">Voltar</a></p>
</body>
</html>