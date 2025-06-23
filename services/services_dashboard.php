<?php

require_once __DIR__ . '/../config/database/conexao_banco.php';

// conexao banco
$connection = new mysqli($servername, $username, $password, $dbname);


$idusuario = $_SESSION['usuario_id'];

// Total de Árvores Doadas 
$sql_arvores = "SELECT COUNT(iddoacao) as total FROM doacao WHERE idusuario = ?";
$stmt_arvores = $connection->prepare($sql_arvores);
$stmt_arvores->bind_param("i", $idusuario);
$stmt_arvores->execute();
$resultado_arvores = $stmt_arvores->get_result()->fetch_assoc();
$totalArvores = $resultado_arvores['total'] ?? 0;

// Valor Total Doado
$sql_valor = "SELECT SUM(valor) as total FROM doacao WHERE idusuario = ?";
$stmt_valor = $connection->prepare($sql_valor);
$stmt_valor->bind_param("i", $idusuario);
$stmt_valor->execute();
$resultado_valor = $stmt_valor->get_result()->fetch_assoc();
$valorTotal = $resultado_valor['total'] ?? 0;

// Ranking do Usuário 
$sql_ranking = "SELECT COUNT(*) + 1 as posicao_ranking FROM (SELECT idusuario, SUM(valor) as total_doado FROM doacao GROUP BY idusuario) as totais WHERE total_doado > ?";
$stmt_ranking = $connection->prepare($sql_ranking);
$stmt_ranking->bind_param("d", $valorTotal);
$stmt_ranking->execute();
$resultado_ranking = $stmt_ranking->get_result()->fetch_assoc();

$ranking = $resultado_ranking['posicao_ranking'] ?? 'N/D';

// Contagem de outras pessoas que doaram
$sql_outros_hoje = "SELECT COUNT(DISTINCT idusuario) as total FROM doacao WHERE DATE(data_doacao) = CURDATE() AND idusuario != ?";
$stmt_outros_hoje = $connection->prepare($sql_outros_hoje);
$stmt_outros_hoje->bind_param("i", $idusuario);
$stmt_outros_hoje->execute();
$resultado_outros_hoje = $stmt_outros_hoje->get_result()->fetch_assoc();
$outrasDoacoesHoje = $resultado_outros_hoje['total'] ?? 0;

$stmt_arvores->close();
$stmt_valor->close();
$stmt_ranking->close();
$stmt_outros_hoje->close();
$connection->close();
?>