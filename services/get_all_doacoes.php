<?php
    session_start();

    require_once __DIR__ . '/../config/database/conexao_banco.php';

    $doacoes = [];

    if (isset($_SESSION['usuario_id'])) {
        
        $connection = new mysqli($servername, $username, $password, $dbname);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
            
        } else {
            $idusuario = $_SESSION['usuario_id'];

            $sql = "SELECT idarvores_adotadas, nome_arvore, especie, status FROM arvores_adotadas WHERE doacao_idusuario = ?";
            
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $idusuario);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $doacoes = $result->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
            $connection->close();
        } 
    }
?>