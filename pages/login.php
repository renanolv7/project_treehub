<?php 
    require_once __DIR__ . '/../config/urls.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>Tree Hub | Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="<?= CSS_URL ?>login.css" rel="stylesheet">

</head>

<body>

    <!-- Include header -->
    <?php include('../includes/header_seta.php') ?>

    <main class="w-screen h-screen flex justify-center items-center">
    
        <form id="form-login" action="../services/login_service.php" method="post">
            <div class="box w-[30rem] h-fit bg-[#fffefe] rounded-2xl m-5 p-8 shadow-xl">

                <div class="header-box">
                        <div id="login-error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        </div>
                    <h1 class="underline-title text-2xl font-normal text-gray-950">Começar a usar</h1>
                    <p class="text-gray-600 mt-6">Seja bem-vindo, vamos acessar sua conta!</p>
                </div>

                <div class="inputs mt-5">

                    <div class="input-group space-y-3">
                        <label class="block text-sm font-medium text-gray-700 ">Email</label>
                        <input type="email" name="email" class="w-full p-2 h-9 border border-gray-300 rounded-md">

                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                        <input type="password" name="senha" class="w-full p-2 h-9 border border-gray-300 rounded-md ">
                    </div>

                    <div class="text-left mt-2">
                        <a href="#" class="text-sm hover:underline font-semibold">Esqueceu sua senha?</a>
                    </div>
                </div>
                
                <button class="w-full bg-[#2f4f1c] text-white py-2 mt-5 rounded-md 
                            border-2 border-transparent transition-all duration-300 
                            hover:bg-white hover:text-[#2f4f1c] hover:border-[#2f4f1c]"
                            type="submit">
                    Login
                </button>

                <div class="text-center mt-6 p-6 border-t border-gray-200">
                    <p class="text-sm text-gray-950">Ainda não tem uma conta? <a href="<?= CADASTRO ?>cadastro.php" class="font-semibold hover:underline">Cadastrar</a></p>
                </div>

            </div>
        </form>
    </main>

    <!-- Modal login desativado -->
    <div id="inactiveAccountModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full text-center">
            <h3 class="text-lg font-bold text-gray-800">Conta Desativada</h3>
            <p class="mt-2 text-gray-600">Você desativou sua conta. Aguarde 3 dias úteis ou entre em contato com a equipe da Tree Hub.</p>
            <div class="mt-6">
                <button id="closeInactiveModal" class="px-6 py-2 bg-[#2f4f1c] text-white rounded-lg text-sm font-semibold hover:bg-[#2a4719] transition-colors">Entendi</button>
            </div>
        </div>
    </div>  
      
</body>

<script src="<?= JS_URL ?>login_handler.js" defer></script>

</html>