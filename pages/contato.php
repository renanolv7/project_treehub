<?php
// Use caminho relativo para incluir o config
require_once __DIR__ . '/../config/urls.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Hub | Contato</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Link CSS geral -->
    <link href="<?= LOGIN_CSS_URL ?>style_contato.css" rel="stylesheet">

</head>
<body class="min-h-screen flex flex-col ">
    
    <header class="flex h-[60px] w-auto">
    
        <div class="container-nav flex justify-around items-center w-full">
            <div class="logo">
                <img src="" alt="Logo" srcset="">
            </div>
        
            <nav class="space-x-6">
                <a href="<?= ICONES ?>instagram.png" class="">Sobre</a>
                <a href="<?= ICONES ?>instagram.png" class="">Metas</a>
                <a href="<?= ICONES ?>instagram.png" class="">Contato</a>
                <a href="<?= ICONES ?>instagram.png" class="">Inicio</a>
            </nav>
        
            <div class="divider border"></div>
        
            <div class="redes-sociais flex space-x-5">
                <a href="" class="social-instagram w-5"><img src="<?= ICONES ?>instagram.png" alt="" srcset=""></a>
                <a href="" class="social-facebook w-5"><img src="<?= ICONES ?>facebook.png" alt="" srcset=""></a>
                <a href="" class="social-other w-5"><img src="<?= ICONES ?>instagram.png" alt="" srcset=""></a>
            </div>

        </div>

        <div class="flex justify-evenly items-end bg-white w-80 rounded-t-lg mt-3 mr-3">
            <button class="border-2 border-[#02300b] px-3 py-1 rounded-3xl">APOIE A CAUSA</button>
            <a class="items-center" href=""><img src="<?= ICONES ?>do-utilizador.png"></a>
        </div>
        
    </header>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl">
        
    </main>
    
    <footer>
    
    </footer>
</body>

</html>