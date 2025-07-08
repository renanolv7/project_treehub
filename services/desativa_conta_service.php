<?php
session_start();
header('Content-Type: application/json');

// Resposta padrão
$response = ['success' => false, 'message' => 'Não foi possível desativar a conta.'];

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    $response['message'] = 'Usuário não autenticado.';
    echo json_encode($response);
    exit;
}

require_once __DIR__ . '/../config/database/conexao_banco.php';
$connection = new mysqli($servername, $username, $password, $dbname);

$idusuario = $_SESSION['usuario_id'];

// Prepara a query para setar o usuário como inativo (ativo = 0)
$sql = "UPDATE usuario SET ativo = 0 WHERE idusuario = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $idusuario);

if ($stmt->execute()) {
    // Se a conta foi desativada, destrói a sessão (faz o logout)
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();

    $response = ['success' => true, 'message' => 'Conta desativada com sucesso.'];
}

$stmt->close();
$connection->close();

echo json_encode($response);
?>