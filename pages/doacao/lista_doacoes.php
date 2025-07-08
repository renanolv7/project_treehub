<?php
    require_once __DIR__ . '/../../config/urls.php';
    require_once __DIR__ . '/../../services/get_all_doacoes.php';  
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>Tree Hub | Lista Doações</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="<?= CSS_URL ?>lista_doacoes.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen w-auto flex flex-col bg-gray-50">
    <?php include(__DIR__ . '/../../includes/header_person.php');?>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl">
        <div class="container">
            <div class="flex h-full overflow-hidden">
                <div class=" lg:w-1/2 p-6 sm:p-8 md:p-12">

                    <h1 class="text-3xl font-bold text-gray-800 mb-8">Lista de árvores adotadas</h1>

                    <div class="space-y-4 max-h-[65vh] overflow-y-auto pr-4 custom-scrollbar">
                        <?php if (!empty($doacoes)): ?>
                            <?php foreach ($doacoes as $index => $doacao): ?>
                                <a href="#" class="block">
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:shadow-md transition-all duration-300 ease-in-out cursor-pointer">
                                        <div class="flex items-center space-x-4">
                                            <span class="text-lg font-semibold text-gray-500 w-8 text-center"><?= $index + 1 ?>º</span>
                                            <span class="text-lg text-gray-800 font-medium"><?= htmlspecialchars($doacao['nome_arvore']) ?></span>
                                        </div>
                                        <div class="text-gray-400 group-hover:text-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="py-4 text-center text-gray-500">
                                <p class="text-start">Você ainda não adotou nenhuma árvore.</p>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
            
            <div class="absolute top-0 right-4 h-full w-1/2 pointer-events-none z-0 overflow-hidden lg:block">
                <img src="../../assets/images/arvore_lista_doacoes.png" alt="Ilustração de uma árvore" class="tree-image absolute bottom-3 right-0 h-[80%] w-auto max-w-none opacity-50 grayscale-[20%] sm:w-50%" style="transform: translateX(35%);"/>
            </div>
        </div>
    </main>
    
    <script src="../../assets/js/dropdown.js"></script>
</body>
</html>
