<header class="flex h-[60px] w-auto px-4">
    <div class="flex justify-between items-center w-full mr-5">
        <div class="logo">
            <a href="<?= INICIO ?>index.php"><img class="w-24" src="<?= IMAGENS ?>logo-tree-hub.png" alt="Logo" srcset=""></a>
        </div>
    
        <nav class="hidden md:flex items-center space-x-6">
            <a href="index.php" class="">Inicio</a>
            <a href="<?= DASHBOARD_PERSON ?>dashboard.php" class="">Dashboard</a>
            <a href="#" class="">Doações</a>
        </nav>
        
        <div class="hidden md:block w-1/4 h-px bg-gray-900"></div>

        <div class="hidden md:flex space-x-4">
            <a href="#" class="social-instagram w-5"><img src="<?= ICONES ?>instagram.png" alt="" srcset=""></a>
            <a href="#" class="social-facebook w-5"><img src="<?= ICONES ?>facebook.png" alt="" srcset=""></a>
            <a href="#" class="social-other w-5"><img src="<?= ICONES ?>icone_partilhar.png" alt="" srcset=""></a>
        </div>
    </div>

    <div class="flex justify-evenly items-end bg-white w-80 rounded-t-lg mt-3">
        <div class="flex items-center h-full">
            <p class="name"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>        
        </div>
        <div class="relative">
            <button id="user-menu-button" type="button" class="flex items-center p-2">
                <img src="<?= ICONES ?>do-utilizador.png">
            </button>
            <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                <a href="<?= ALTERAR_DADOS ?>alterar_dados.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Alterar dados</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Configurações</a>
                <a href="../../services/logout_service.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sair</a>
            </div>
        </div>
    </div>
</header>



 