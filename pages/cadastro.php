<?php 
    // Use caminho relativo para incluir o config
    require_once __DIR__ . '/../config/urls.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Hub | Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="<?= CSS_URL ?>style_login.css" rel="stylesheet">
    
</head>

<body>

    <!-- Include header -->
    <?php include('/wamp64/www/dev/project_treehub/includes/header_seta.php') ?>

    <main class="w-screen h-screen flex justify-center items-center">

        <div class="box w-[32rem] h-fit bg-[#fffefe] rounded-2xl m-5 p-8 shadow-xl">

            <div class="header-box">
                <h1 class="underline-title text-2xl font-normal text-gray-950">Começar a usar</h1>
                <p class="text-gray-600 mt-6">Seja bem-vindo, vamos criar sua conta!</p>
            </div>

            <div class="inputs mt-5">
                <form id="form-cadastro" action="../services/cadastro_service.php" method="post">
                    <div class="input-group space-y-4">
                        <label class="block text-sm font-medium text-gray-700 ">Email</label>
                        <input type="email" class="w-full p-2 h-9 border border-gray-300 rounded-md" name="email">

<<<<<<< HEAD
                <div class="input-group space-y-3">

                    <!-- Email -->
                    <label class="block text-sm font-medium text-gray-700 ">Email</label>
                    <input type="email" class="w-full p-2 h-9 border border-gray-300 rounded-md">
=======
                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                        <input type="password" class="w-full p-2 h-9 border border-gray-300 rounded-md " name="senha">
>>>>>>> 5423d6c92d3847068ffed6a24fe4176c52af2c0e

                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de cadastro: </label>

<<<<<<< HEAD
                    <!-- Tipo de cadastro -->
                    <div class="pt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de cadastro:</label>
                        <div class="flex space-x-16">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="tipo_cadastro" value="pf" class="h-4 w-4 text-treehub-green focus:ring-treehub-green">
                                <span class="text-gray-950 text-sm">Pessoa física</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="tipo_cadastro" value="pj" checked class="h-4 w-4 text-treehub-green focus:ring-treehub-green">
                                <span class="text-gray-950 text-sm">Organização</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Documento -->
                    <div id="document-container">
                        <label id="document-label" class="block text-sm font-medium text-gray-700 mb-1 mt-6">CNPJ</label>
                        <input id="document-input" type="text" placeholder="00.000.000/0000-00" 
                            class="w-full p-2 h-9 border border-gray-300 rounded-md focus:ring-treehub-green focus:border-treehub-green">
                    </div>
        
                </div>
=======
                        <div class="options-radio flex flex-row space-x-10">

                            <label class="option flex flex-row space-x-2">
                                <input type="radio" name="opcao" value="opcao1" class="w-5">
                                <p class="text-gray-900 text-sm whitespace-nowrap">Pessoa física</p>
                            </label>
                            <label class="option flex flex-row space-x-2">
                                <input type="radio" name="opcao" value="opcao2" class="w-5">
                                <p class="text-gray-900 text-sm">Organização</p>
                            </label>

                        </div>
                    </div>
                </form>    
>>>>>>> 5423d6c92d3847068ffed6a24fe4176c52af2c0e
            </div>
            
            <button class="w-full bg-[#2f4f1c] text-white py-2 mt-5 rounded-md 
                           border-2 border-transparent transition-all duration-300 
                         hover:bg-white hover:text-[#2f4f1c] hover:border-[#2f4f1c]">
                Cadastrar
            </button>

            <div class="text-center mt-6 p-6 border-t border-gray-200">
                <p class="text-sm text-gray-950">Já tem uma conta? <a href="../pages/login.php" class="font-semibold hover:underline">Login</a></p>
            </div>
        </div>
    </main>
</body>

<script src="<?= JS_URL ?>Alter_user.js" defer></script>

</html>