<?php
session_start();

include('../config/database/conexao_banco.php');

$connection = new mysqli($servername, $username, $password, $dbname);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $connection->real_escape_string($_POST['email']);
    $senha = $_POST['senha']; // Será usada no SHA1

    $sql = "SELECT idusuario, nome, tipo_usuario FROM usuario WHERE email = ? AND senha = SHA(?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
        $_SESSION['logged_in'] = true;
        $_SESSION['usuario_id'] = $usuario['idusuario'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo_usuario'];

        // direcionamento do usuario para o dashboard correto
        if ($usuario['tipo_usuario'] == 'pj') {
            header("Location: ../pages/org/dashboard_org.php");
        } else {
            header("Location: ../pages/person/dashboard.php");
        }
        exit();

    } else {
        // Login falhou
        $_SESSION['erro_login'] = "E-mail ou senha incorretos";
        header("Location: ../pages/login.php");
    }

    $stmt->close();
    $connection->close();
    exit();
}
?>