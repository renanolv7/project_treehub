<header class="flex h-[60px] w-auto">
    
    <div class="flex justify-stretch items-center w-full">
        <div class="logo">
            <a href="<?= INICIO ?>index.php"><img class="w-24" src="<?= IMAGENS ?>logo-tree-hub.png" alt="Logo" srcset=""></a>
        </div>
    
        <nav class="hidden md:flex items-center space-x-6">
            <a href="<?= INICIO ?>index.php" class="">Inicio</a>
            <a href="#" class="">Sobre</a>
            <a href="#" class="">Metas</a>
            <a href="#" class="">Contato</a>
        </nav>
        
        <div class="hidden md:block w-1/4 h-px bg-gray-900"></div>

        <div class="hidden md:flex space-x-4">
            <a href="#" class="social-instagram w-5"><img src="<?= ICONES ?>instagram.png" alt="" srcset=""></a>
            <a href="#" class="social-facebook w-5"><img src="<?= ICONES ?>facebook.png" alt="" srcset=""></a>
            <a href="#" class="social-other w-5"><img src="<?= ICONES ?>icone_partilhar.png" alt="" srcset=""></a>
        </div>

    </div>

    <div class="flex justify-evenly items-end bg-white w-80 rounded-t-lg mt-3 mr-3">
        <a href="<?= CADASTRO ?>cadastro.php"><button class="border-2 border-[#02300b] px-6 py-1 rounded-lg font-semibold">APOIE A CAUSA</button></a>
        <a class="items-center" href=""><img src="<?= ICONES ?>do-utilizador.png"></a>
    </div>
        
</header>