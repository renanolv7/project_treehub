<?php 
    require_once __DIR__ . '/../config/urls.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>Tree Hub | Cadastro</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="<?= CSS_URL ?>style_login.css" rel="stylesheet">
    
</head>

<body>
    <!-- Include header -->
    <?php include('/wamp64/www/dev/project_treehub/includes/header_seta.php') ?>

    <main class="w-screen h-screen flex justify-center items-center">

        <div class="box w-[34rem] h-fit bg-[#fffefe] rounded-2xl m-5 p-8 shadow-xl">

            <div class="header-box">
                <h1 class="text-2xl font-normal text-gray-950">Começar a usar</h1>
                <div class="w-28 h-[3px] bg-[#2f4f1c] mt-2 mb-6"></div>
                <p class="text-gray-600 mt-6">Seja bem-vindo, vamos criar sua conta!</p>
            </div>

            <div class="inputs mt-5">
                <form id="form-cadastro" action="../services/cadastro_service.php" method="post">

                    <div class="input-group space-y-4">
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-treehub-green focus:border-transparent"
                                placeholder="teste@email.com">
                        </div>
                    
                        <div class="input-group space-y-2">

                        <!-- Senha -->
                        <div>
                            <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                            <input 
                                type="password" 
                                id="senha" 
                                name="senha" 
                                required
                                minlength="6"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-treehub-green focus:border-transparent"
                                placeholder="••••••••">
                        </div>

                        <!-- Tipo de cadastro -->
                        <div class="pt-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de cadastro:</label>
                            <div class="flex space-x-16">
                                <label class="flex items-center space-x-2">
                                    <input 
                                        type="radio" 
                                        name="tipo_cadastro" 
                                        value="pf" 
                                        class="h-4 w-4 text-treehub-green focus:ring-treehub-green">

                                    <span class="text-gray-950 text-sm">Pessoa física</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input 
                                        type="radio" 
                                        name="tipo_cadastro" 
                                        value="pj" 
                                        checked class="h-4 w-4 text-treehub-green focus:ring-treehub-green">
                                    <span class="text-gray-950 text-sm">Organização</span>
                                </label>
                            </div>
                        </div>

                        <div id="document-container">
                            <label id="document-label" 
                                   for="document-input" 
                                   class="block text-sm font-medium text-gray-700 mb-1 mt-5">CNPJ</label>

                            <input 
                                id="document-input" 
                                name="documento"
                                type="text" 
                                required
                                placeholder="00.000.000/0000-00" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-treehub-green focus:border-transparent">
                        </div>
                    </div>
                    <button class="w-full bg-[#2f4f1c] text-white py-2 mt-5 rounded-md 
                           border-2 border-transparent transition-all duration-300 
                         hover:bg-white hover:text-[#2f4f1c] hover:border-[#2f4f1c]">
                        Cadastrar
                    </button>                    
                </form>    
            </div>
            
            <div class="text-center mt-6 p-6 border-t border-gray-200">
                <p class="text-sm text-gray-950">Já tem uma conta? 
                    <a href="<?= LOGIN ?>login.php" class="font-semibold hover:underline">Login</a>
                </p>
            </div>
        </div>
    </main>
</body>

<script src="<?= JS_URL ?>Alter_user.js" defer></script>
<script src="<?= JS_URL ?>documento_validator.js" defer></script>

</html>