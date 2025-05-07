<?php 

include('../includes/conexao_banco.php');

$connection = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_acesso = $_POST['opcao'];

    $sql = "INSERT INTO usuarios (email, senha, tipo_acesso) values ('$email', SHA('$senha'), '$tipo_acesso');";

    header("Location: ../login.php");

    $connection->query($sql);
    $connection->close();
}
