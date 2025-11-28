<?php
// Conexão com o banco de dados
$host = "localhost";
$user = "root";
$pass = "root";  //01 nn havia senha
$db   = "manutencao";


$conn = mysqli_connect($host, $user, $pass, $db); //02 "server" em vez de "host"

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>