<?php
session_start();
header('Content-Type: application/json'); 

// verificacao se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit;
}

require_once __DIR__ . '/../config/database/conexao_banco.php';
$connection = new mysqli($servername, $username, $password, $dbname);

$idusuario = $_SESSION['usuario_id'];

// Busca os dados do usuário
$sql = "SELECT nome, email, telefone FROM usuario WHERE idusuario = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if ($userData) {
    echo json_encode($userData);
} else {
    echo json_encode(['error' => 'Usuário não encontrado']);
}

$stmt->close();

$connection->close();

?>