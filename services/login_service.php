<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    include('../includes/conexao_banco.php');

    $connection = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM usuarios where email = '$email' and senha = SHA('$senha')";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['logged_in'] = true;
        header("Location: ../../index.php");
    } else {
        header("Location: ../login.php");
    }
}
?>