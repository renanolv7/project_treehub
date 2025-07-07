<?php
session_start();

include('../config/database/conexao_banco.php');

$connection = new mysqli($servername, $username, $password, $dbname);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $connection->real_escape_string($_POST['name']);
    $email = $connection->real_escape_string($_POST['email']);
    $senha = $_POST['senha'];
    $tipo_usuario = $connection->real_escape_string($_POST['tipo_cadastro']);
    $documento = $connection->real_escape_string(preg_replace('/[^0-9]/', '', $_POST['documento']));

    $check_sql = "SELECT idusuario FROM usuario WHERE email = ?";
    $stmt = $connection->prepare($check_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['erro'] = "Email ja consta no cadastro";
        header("Location: ../pages/cadastro.php");
        exit();
    }

    $insert_sql = "INSERT INTO usuario (nome, email, senha, tipo_usuario, cpf_cnpj) VALUES (?, ?, SHA(?), ?, ?)";
    $stmt = $connection->prepare($insert_sql);
    $stmt->bind_param("sssss", $nome, $email, $senha, $tipo_usuario, $documento);

    if ($stmt->execute()) {
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
        header("Location: ../pages/login.php");
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar: " . $connection->error;
        header("Location: ../pages/cadastro.php");
    }

    $stmt->close();
    $connection->close();
    exit();
}
?>