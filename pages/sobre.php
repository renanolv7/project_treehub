<?php
    session_start();
    require_once __DIR__ . '/../config/urls.php';
    $paginaAtual = basename($_SERVER['SCRIPT_NAME']);  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>Tree Hub | Sobre</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Link CSS geral -->
    <link href="<?= CSS_URL ?>meta.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden; /* Oculta a barra de rolagem horizontal */
        }
    </style>

</head>
<body class="min-h-screen w-auto flex flex-col bg-gray-50">
    
    <?php include('../includes/header_principal.php') ?>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl flex items-center justify-center">

        <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white border-l-4 border-[#2f4f1c] shadow-xl p-8 rounded-lg flex items-center slide-in-left">
                <p class="text-xl text-gray-800 leading-relaxed">
                    Nós somos Tree Hub, uma plataforma digital criada para conectar pessoas e empresas a projetos de reflorestamento...
                </p>
            </div>

            <div class="flex flex-col space-y-8 slide-in-right">
                <div class="bg-white p-6 rounded-lg shadow-xl hover:shadow-xl hover:-translate-y-1 transform transition-all duration-300 slide-in-item">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-seedling text-2xl text-[#2f4f1c] mr-4"></i>
                            <h3 class="font-semibold text-gray-800">Pequenas Ações, Grandes Transformações</h3>
                        </div>
                        <p class="text-gray-700">
                            Acreditamos que com transparência e tecnologia, cada contribuição gera um impacto real e duradouro.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-xl hover:shadow-xl hover:-translate-y-1 transform transition-all duration-300 slide-in-item">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-paint-brush text-2xl text-[#2f4f1c] mr-4"></i>
                            <h3 class="font-semibold text-gray-800">Experiência Personalizada</h3>
                        </div>
                        <p class="text-gray-700">
                            Além de somente realizar uma doação, com a Tree Hub você acompanha o crescimento da sua árvore.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-xl hover:shadow-xl hover:-translate-y-1 transform transition-all duration-300 slide-in-item">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-leaf text-2xl text-[#2f4f1c] mr-4"></i>
                            <h3 class="font-semibold text-gray-800">Imagem Sustentável</h3>
                        </div>
                        <p class="text-gray-700">
                            Alavanque a imagem sustentável da sua organização com a gente, mostrando seu compromisso ambiental.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="../assets/js/GSAP/sobre_cards_animation.js"></script>

</html> 