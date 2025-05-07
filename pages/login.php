<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Hub | Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="../assets/styles/style_login.css">

</head>

<body>

    <!-- Include header -->
    <?php include('../includes/header_seta.php') ?>

    <main class="w-screen h-screen flex justify-center items-center">

        <div class="box w-[30rem] h-fit bg-[#fffefe] rounded-2xl m-5 p-8 shadow-xl">

            <div class="header-box">
                <h1 class="underline-title text-2xl font-normal text-gray-950">Começar a usar</h1>
                <p class="text-gray-600 mt-6">Seja bem-vindo, vamos acessar sua conta</p>
            </div>

            <div class="inputs mt-5">

                <div class="input-group space-y-3">
                    <label class="block text-sm font-medium text-gray-700 ">Email</label>
                    <input type="email" class="w-full p-2 h-9 border border-gray-300 rounded-md">

                    <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                    <input type="password" class="w-full p-2 h-9 border border-gray-300 rounded-md ">
                </div>

                <div class="text-left mt-2">
                    <a href="#" class="text-sm hover:underline font-semibold">Esqueceu sua senha?</a>
                </div>

            </div>
            
            <button class="w-full bg-[#2f4f1c] text-white py-2 mt-5 rounded-md 
                           border-2 border-transparent transition-all duration-300 
                         hover:bg-white hover:text-[#2f4f1c] hover:border-[#2f4f1c]">
                Login
            </button>

            <div class="text-center mt-6 p-6 border-t border-gray-200">
                <p class="text-sm text-gray-950">Ainda não tem uma conta? <a href="#" class="font-semibold hover:underline">Cadastrar</a></p>
            </div>


        </div>

    </main>

</body>

</html>