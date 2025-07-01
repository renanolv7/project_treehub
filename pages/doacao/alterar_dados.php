<?php
    require_once __DIR__ . '/../../config/urls.php';
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
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="<?= CSS_URL ?>style_dashboard.css" rel="stylesheet">
</head>

<body class="min-h-screen w-auto flex flex-col">
    <?php include(__DIR__ . '/../../includes/header_person.php');?>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl">
        <div class="m-6 flex justify-center h-full">
            <div class="border border-gray-200 rounded-lg w-full my-2 mx-32">
                <div class="p-6 space-y-6">

                    <div class="flex justify-between items-center pb-6 border-b border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-800">Nome</p>
                            <p class="text-gray-600">Renan Oliveira</p>
                        </div>
                        <button class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Editar</button>
                    </div>
    
                    <div class="flex justify-between items-center pb-6 border-b border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-800">E-mail</p>
                            <p class="text-gray-600">teste@gmail.com</p>
                        </div>
                        <button class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Editar</button>
                    </div>
    
                    <div class="flex justify-between items-center pb-6 border-b border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-800">Número de celular principal</p>
                            <p class="text-gray-600">+55912345678</p>
                        </div>
                        <button class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors self-start mt-1">Editar</button>
                    </div>
    
                    <div class="flex justify-between items-center pb-6 border-b border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-800">Senha</p>
                            <p class="text-gray-600">************</p>
                        </div>
                        <button class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Editar</button>
                    </div>
    
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-gray-800">CPF</p>
                            <p class="text-gray-600">************</p>
                        </div>
                        <button class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Editar</button>
                    </div>
    
                </div>
            </div>
        </div>
    </main>
</body>

<script src="../../assets/js/charts_person.js"></script>
<script src="../../assets/js/dropdown.js"></script>

</html>
