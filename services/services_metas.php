<?php

require_once __DIR__ . '/../config/database/conexao_banco.php';

$metaArvores = 10000;
$metaValor = 30000000;

$connection = new mysqli($servername, $username, $password, $dbname);

// Total de Árvores Doadas no sistema
$sql_arvores = "SELECT COUNT(iddoacao) as total FROM doacao";
$resultado_arvores = $connection->query($sql_arvores)->fetch_assoc();
$totalArvores = $resultado_arvores['total'] ?? 0;

// Valor Total Arrecadado no sistema
$sql_valor = "SELECT SUM(valor) as total FROM doacao";
$resultado_valor = $connection->query($sql_valor)->fetch_assoc();
$valorArrecadado = $resultado_valor['total'] ?? 0;

// Total de Organizações
$sql_orgs = "SELECT COUNT(idusuario) as total FROM usuario WHERE tipo_usuario = 'pj'";
$resultado_orgs = $connection->query($sql_orgs)->fetch_assoc();
$totalOrgs = $resultado_orgs['total'] ?? 0;

// Total de Pessoas Físicas
$sql_pfs = "SELECT COUNT(idusuario) as total FROM usuario WHERE tipo_usuario = 'pf'";
$resultado_pfs = $connection->query($sql_pfs)->fetch_assoc();
$totalPFs = $resultado_pfs['total'] ?? 0;

// Calculo das porcentagens
$porcentagemArvores = ($metaArvores > 0) ? ($totalArvores / $metaArvores) * 100 : 0;
$porcentagemValor = ($metaValor > 0) ? ($valorArrecadado / $metaValor) * 100 : 0;

// Limitar a porcentagem em 100% para não ultrapassar limite visual
$porcentagemArvores = min($porcentagemArvores, 100);
$porcentagemValor = min($porcentagemValor, 100);

$connection->close();
?>