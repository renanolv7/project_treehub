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
    
        <div class="flex justify-stretch items-center w-full">
            <div class="logo">
                <a href=""><img class="w-24" src="<?= IMAGENS ?>logo-tree-hub.png" alt="Logo" srcset=""></a>
            </div>
        
            <nav class="hidden md:flex items-center space-x-6">
                <a href="<?= INICIO ?>index.php" class="">Inicio</a>
                <a href="<?= ICONES ?>" class="">Sobre</a>
                <a href="<?= ICONES ?>" class="">Metas</a>
                <a href="<?= ICONES ?>" class="">Contato</a>
            </nav>
            
            <div class="hidden md:block w-1/4 h-px bg-gray-900"></div>

            <div class="hidden md:flex space-x-4">
                <a href="" class="social-instagram w-5"><img src="<?= ICONES ?>instagram.png" alt="" srcset=""></a>
                <a href="" class="social-facebook w-5"><img src="<?= ICONES ?>facebook.png" alt="" srcset=""></a>
                <a href="" class="social-other w-5"><img src="<?= ICONES ?>instagram.png" alt="" srcset=""></a>
            </div>

        </div>

        <div class="flex justify-evenly items-end bg-white w-80 rounded-t-lg mt-3 mr-3">
            <button class="border-2 border-[#02300b] px-6 py-1 rounded-lg font-semibold">APOIE A CAUSA</button>
            <a class="items-center" href=""><img src="<?= ICONES ?>do-utilizador.png"></a>
       
        </div>
        
    </header>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl flex ">
        <div class="container flex justify-between">

            <section class="left-section hidden md:block relative w-1/2 h-full overflow-hidden">

                <img class="absolute -top-56 left-10 h-4/5 object-contain rotate-180 opacity-30" src="<?= IMAGENS ?>folha_arvore.png" alt="" srcset="">
                <img class="absolute -bottom-56 -left-10  object-contain rotate-90 opacity-25 w-[400px]" src="<?= IMAGENS ?>folha_arvore.png" alt="" srcset="">
                
            </section>
    
            <section class="w-full md:w-1/2 p-8">
                <form class="flex items-center" id="form-contato" action="" method="post">
        
                    <div class="w-[30rem] h-fit bg-[#fffefe] rounded-2xl m-5 p-8 shadow-xl">
                        <div class="header-box">
                            <h1 class="text-2xl font-normal text-gray-950">Você tem uma mensagem?</h1>
                            <div class="w-2/4 h-[3px] bg-[#2f4f1c] mt-2 mb-6"></div>
                            <p class="text-gray-600 mt-6">Preencha o pequeno formulário abaixo, entraremos em contato em breve</p>
                        </div>
        
                        <div class="inputs mt-5 space-y-2">
    
                            <div>
                                <input class="w-full px-3 py-2 border border-gray-300 rounded-md t" 
                                       type="text" 
                                       name="name" 
                                       placeholder="Nome"
                                       required>
                            </div>
        
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                                <input type="email" 
                                       name="email" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md " 
                                       placeholder="Email"
                                       required>
                                <input type="tel" 
                                       name="telefone" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md " 
                                       placeholder="Telefone">
                            </div>
                            
                            <div>
                                <textarea name="mensagem" 
                                          id="mensagem-contato" 
                                          class="w-full h-40 px-3 py-2 border border-gray-300 rounded-md" 
                                          placeholder="Escreva sua mensagem"
                                          required
                                          resize=none
                                          ></textarea>
                            </div>
                        </div>
                        
                        <button class="w-full bg-[#2f4f1c] text-white py-2 mt-5 rounded-md 
                                    border-2 border-transparent transition-all duration-300 
                                    hover:bg-white hover:text-[#2f4f1c] hover:border-[#2f4f1c]"
                                    type="submit">
                            Enviar mensagem
                        </button>
        
                    </div>
        
                </form>
            </section>
        </div>
        

    </main>
    
    <footer>
            <?php include('C:\wamp64\www\dev\project_treehub\includes\footer.php') ?>
    </footer>
</body>

</html>