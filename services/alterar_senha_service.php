<?php
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Ocorreu um erro.'];

if (!isset($_SESSION['usuario_id'])) {
    $response['message'] = 'Usuário não autenticado.';
    echo json_encode($response);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$idusuario = $_SESSION['usuario_id'];
$senha_atual = $data['currentPassword'] ?? '';
$nova_senha = $data['newPassword'] ?? '';
$confirma_senha = $data['confirmPassword'] ?? '';

// Validação dos dados recebidos
if (empty($senha_atual) || empty($nova_senha) || empty($confirma_senha)) {
    $response['message'] = 'Todos os campos de senha são obrigatórios.';
    echo json_encode($response);
    exit;
}
if ($nova_senha !== $confirma_senha) {
    $response['message'] = 'A nova senha e a confirmação não correspondem.';
    echo json_encode($response);
    exit;
}

require_once __DIR__ . '/../config/database/conexao_banco.php';
$connection = new mysqli($servername, $username, $password, $dbname);

// Busca a senha atual do usuário no banco
$sql_check = "SELECT senha FROM usuario WHERE idusuario = ?";
$stmt_check = $connection->prepare($sql_check);
$stmt_check->bind_param("i", $idusuario);
$stmt_check->execute();
$result = $stmt_check->get_result();
$usuario = $result->fetch_assoc();
$hash_sha1_db = $usuario['senha'];
$stmt_check->close();

//  Compara a senha atual enviada com a do banco usando
if (sha1($senha_atual) === $hash_sha1_db) {
    // Se a senha atual estiver correta, atualiza para nova senha
    $sql_update = "UPDATE usuario SET senha = SHA(?) WHERE idusuario = ?";
    $stmt_update = $connection->prepare($sql_update);
    $stmt_update->bind_param("si", $nova_senha, $idusuario);
    
    if ($stmt_update->execute()) {
        $response = ['success' => true, 'message' => 'Senha alterada com sucesso!'];
    } else {
        $response['message'] = 'Não foi possível alterar a senha.';
    }
    $stmt_update->close();
} else {
    // Se senha incorreta
    $response['message'] = 'A senha atual está incorreta.';
}

$connection->close();
echo json_encode($response);

?>