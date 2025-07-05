<?php
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Ocorreu um erro inesperado.'];

if (!isset($_SESSION['usuario_id'])) {
    $response['message'] = 'Usuário não autenticado. Faça login para doar.';
    echo json_encode($response);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || empty($data['donationAmount']) || empty($data['treeName']) || empty($data['treeSpecies']) || empty($data['selectedLocation'])) {
    $response['message'] = 'Dados da doação incompletos.';
    echo json_encode($response);
    exit;
}

require_once __DIR__ . '/../config/database/conexao_banco.php';
$connection = new mysqli($servername, $username, $password, $dbname);

$connection->begin_transaction();

try {
    // Inserção na tabela 'doacao'
    $sql_doacao = "INSERT INTO doacao (idusuario, valor, quantidade_arvores, metodo_pagamento, status, localizacao) VALUES (?, ?, 1, 'cartao', 'concluido', ?)";
    $stmt_doacao = $connection->prepare($sql_doacao);
    $stmt_doacao->bind_param("ids", $_SESSION['usuario_id'], $data['donationAmount'], $data['selectedLocation']['name']);
    $stmt_doacao->execute();

    $id_nova_doacao = $connection->insert_id;

    // --- INÍCIO DA MODIFICAÇÃO ---
    // MUDANÇA 1: A query agora insere um placeholder '?' no lugar de CURDATE()
    $sql_arvore = "INSERT INTO arvores_adotadas (doacao_iddoacao, doacao_idusuario, nome_arvore, especie, data_plantio, status) VALUES (?, ?, ?, ?, ?, 'a plantar')";
    $stmt_arvore = $connection->prepare($sql_arvore);
    $data_plantio_nula = null;
    
    //bind_param tem 5 parâmetros (i, i, s, s, s) e passa a variável nula
    $stmt_arvore->bind_param("iisss", $id_nova_doacao, $_SESSION['usuario_id'], $data['treeName'], $data['treeSpecies'], $data_plantio_nula);
    $stmt_arvore->execute();

    // Inserção na tabela 'transacao_financeira'
    $codigo_transacao_fake = 'tr_' . uniqid() . time();
    $sql_transacao = "INSERT INTO transacao_financeira (doacao_iddoacao, doacao_idusuario, codigo_transacao, status) VALUES (?, ?, ?, 'pago')";
    $stmt_transacao = $connection->prepare($sql_transacao);
    $stmt_transacao->bind_param("iis", $id_nova_doacao, $_SESSION['usuario_id'], $codigo_transacao_fake);
    $stmt_transacao->execute();

    $connection->commit();
    $response = ['success' => true, 'message' => 'Doação registrada com sucesso!'];

} catch (Exception $e) {
    $connection->rollback();
    $response['message'] = 'Falha ao registrar a doação no banco de dados.';
}

echo json_encode($response);

if (isset($stmt_doacao)) $stmt_doacao->close();
if (isset($stmt_arvore)) $stmt_arvore->close();
if (isset($stmt_transacao)) $stmt_transacao->close();
$connection->close();
?>