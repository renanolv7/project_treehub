<?php
    require_once __DIR__ . '/../../config/urls.php';
?>
<?php

session_start();

// verificação da sessao se esta logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../pages/login.php");
    exit;
}

require_once __DIR__ . '/../../services/services_dashboard.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>Tree Hub | Dashboard</title>

    <!-- Chart.js para o gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="<?= CSS_URL ?>dashboard.css" rel="stylesheet">

</head>

<body class="min-h-screen w-auto flex flex-col bg-gray-50">
    <?php include(__DIR__ . '/../../includes/header_person.php');?>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8">

            <div class="flex justify-end my-4">
                <a href="<?= DOACAO ?>doacao.php" class="flex items-center space-x-2 bg-black text-white font-semibold px-5 py-2.5 rounded-md hover:bg-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <span>Doar</span>
                </a>
            </div>

            <!-- Seção de Estatísticas -->
            <section class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-4">
                <div class="bg-gray-100 p-2 rounded-lg flex flex-col justify-center items-center text-center h-40">
                    <p class="text-[16px] text-gray-600 mb-1">Árvores adotadas</p>
                    <p class="text-2xl font-bold"><?php echo($totalArvores); ?></p>
                </div>
                <div class="bg-gray-100 p-2 rounded-lg flex flex-col justify-center items-center text-center h-40">
                    <p class="text-[16px] text-gray-600 mb-1">Valor total doado</p>
                    <p class="text-2xl font-bold">R$<?php echo number_format($valorTotal, 2, ',', '.'); ?></p>
                </div>
                <div class="bg-gray-100 p-2 rounded-lg flex flex-col justify-center items-center text-center h-40">
                    <p class="text-[16px] text-gray-600 mb-1">Ranking</p>
                    <p class="text-2xl font-bold"><?php echo ($ranking); ?>°</p>
                </div>
                
                <div class="bg-gray-100 p-2 rounded-lg flex items-center justify-center text-center h-40">
                    <p class="text-[16px] text-gray-600">Outras <span class="font-bold"><?php echo($outrasDoacoesHoje); ?></span> doaram hoje</p>
                </div>
            </section>

            <!-- Seção do Gráfico -->
            <div class="bg-gray-100 p-2 sm:p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-700 mb-6">Progresso de doações</h2>
                <div class="h-48">
                    <canvas id="donationChart"></canvas>
                </div>
            </div>
        </div>
    </main>
</body>

<script src="../../assets/js/charts_person.js"></script>
<script src="../../assets/js/dropdown.js"></script>

</html>
