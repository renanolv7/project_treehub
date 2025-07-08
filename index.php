<?php
    session_start();
    require_once __DIR__ . '/config/urls.php';
    $paginaAtual = basename($_SERVER['SCRIPT_NAME']);  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>Tree Hub | Metas</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Link CSS geral -->
    <link href="<?= CSS_URL ?>meta.css" rel="stylesheet">

</head>
<body class="min-h-screen w-auto flex flex-col bg-gray-50">
    
    <?php include('includes/header_principal.php') ?>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl flex items-center justify-center">

        <div class="container_logo_center my-8 w-full max-w-4xl h-48 md:h-64 lg:h-80">
            <img src="assets/images/logo_fundo_index.png" alt="Tree Hub Logo" class="w-full h-full object-contain">
        </div>

        <div class="slogan absolute bottom-3 left-3 mb-4 ml-4">
            <h2 class="text-3xl font-bold text-gray-800 tracking-wide">NÓS TRANSFORMAMOS A NOSSA GERAÇÃO!</h2>
            <p class="text-gray-600 mt-2">SUA PÁGINA DE DOAÇÕES</p>
            <a href="<?= SOBRE ?>sobre.php" class="inline-flex items-center mt-4 text-sm font-semibold text-gray-500 hover:text-gray-800">
                VEJA MAIS SOBRE
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </a>
        </div>
        
    </main>

</body>


</html> 