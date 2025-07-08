<?php
session_start();
header('Content-Type: application/json');

include('../config/database/conexao_banco.php');
$connection = new mysqli($servername, $username, $password, $dbname);

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Busca o usuário pelo e-mail
$sql = "SELECT idusuario, nome, tipo_usuario, senha, ativo FROM usuario WHERE email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    // PRIMEIRO, checa se a conta está ativa
    if ($usuario['ativo'] == 0) {
        // Se a conta está inativa, retorna um status específico. NÃO checa a senha.
        echo json_encode(['status' => 'inactive']);
        exit;
    }

    // SE a conta está ativa, checa a senha
    if (sha1($senha) === $usuario['senha']) { // Mantendo o SHA1 como você usa
        // Login bem-sucedido
        $_SESSION['logged_in'] = true;
        $_SESSION['usuario_id'] = $usuario['idusuario'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo_usuario'];
        
        // Determina o link do dashboard para o frontend
        $dashboard_url = ($usuario['tipo_usuario'] == 'pj') 
            ? '../pages/org/dashboard_org.php' 
            : '../pages/person/dashboard.php';
        
        echo json_encode(['status' => 'success', 'redirect' => $dashboard_url]);

    } else {
        // Senha incorreta
        echo json_encode(['status' => 'error', 'message' => 'E-mail ou senha incorretos.']);
    }
} else {
    // Usuário não encontrado
    echo json_encode(['status' => 'error', 'message' => 'E-mail ou senha incorretos.']);
}

$stmt->close();
$connection->close();
?>