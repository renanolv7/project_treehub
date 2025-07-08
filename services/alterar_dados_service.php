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

if (!$data) {
    $response['message'] = 'Nenhum dado recebido.';
    echo json_encode($response);
    exit;
}

require_once __DIR__ . '/../config/database/conexao_banco.php';
$connection = new mysqli($servername, $username, $password, $dbname);

$idusuario = $_SESSION['usuario_id'];
$campo = $data['field'] ?? null;
$valor = $data['value'] ?? null;

if (empty($campo) || !in_array($campo, ['nome', 'email', 'telefone', 'senha'])) {
    $response['message'] = 'Campo inválido.';
    echo json_encode($response);
    exit;
}

$sql = "UPDATE usuario SET {$campo} = ? WHERE idusuario = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("si", $valor, $idusuario);

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Dado atualizado com sucesso!';
    
    if ($campo === 'nome') {
        $_SESSION['usuario_nome'] = $valor;
    }
} else {
    $response['message'] = 'Falha ao atualizar o dado.';
}

echo json_encode($response);

$stmt->close();
$connection->close();
?>