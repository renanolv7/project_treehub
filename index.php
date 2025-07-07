<?php
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

    <!-- Transformar arquivos HTTP em HTTPS-->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Link CSS geral -->
    <link href="<?= CSS_URL ?>meta.css" rel="stylesheet">

</head>
<body class="min-h-screen w-auto flex flex-col bg-gray-50">
    
    <?php include('includes/header_principal.php') ?>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl flex items-center justify-center">

        <section>
            
        </section>
        
    </main>

</body>


</html> 