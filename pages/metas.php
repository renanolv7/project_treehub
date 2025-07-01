<?php
    require_once __DIR__ . '/../config/urls.php';
    require_once __DIR__ . '/../services/services_metas.php';    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>Tree Hub | Metas</title>

    <!-- Transformar arquivos HTTP em HTTPS-->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Link CSS geral -->
    <link href="<?= CSS_URL ?>style_meta.css" rel="stylesheet">

</head>
<body class="min-h-screen flex flex-col">
    
    <?php include('../includes/header_principal.php') ?>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl flex items-center justify-center">

        <div class="container flex flex-col lg:flex-row justify-between items-center space-y-2 mx-4 md:mx-6 lg:mx-8">

            <!-- Seção das barras de progresso -->
            <section class="w-full lg:w-2/5 space-y-6 md:space-y-8 lg:space-y-10">
                
                <!-- Árvores Plantadas -->
                <div class="space-y-3">
                    <h3 class="text-xl md:text-2xl font-light">ÁRVORES PLANTADAS</h3>
                    <div class="relative w-full h-12 md:h-14 lg:h-20 bg-[#acc0b0] rounded-2xl flex items-center shadow-xl">
                        <div class="absolute h-full w-[10%] bg-[#2f4f1c] rounded-l-2xl"></div>
                        <span class="absolute left-2 md:left-4 text-white text-xl md:text-2xl lg:text-3xl font-thin"><?php echo number_format($totalArvores, 0, ',', '.'); ?></span>
                        <span class="absolute right-2 md:right-4 text-white text-xl md:text-2xl lg:text-3xl font-thin"><?php echo number_format($metaArvores, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <!-- Valor Arrecadado -->
                <div class="space-y-2">
                    <h3 class="text-xl md:text-2xl font-light">VALOR ARRECADADO</h3>
                    <div class="relative w-full h-12 md:h-14 lg:h-20 bg-[#acc0b0] rounded-2xl flex items-center shadow-xl">
                        <div class="absolute h-full w-[30%] bg-[#2f4f1c] rounded-l-2xl"></div>
                        <span class="absolute left-2 md:left-4 text-white text-xl md:text-2xl lg:text-3xl font-thin">R$<?php echo number_format($valorArrecadado, 2, ',', '.'); ?></span>
                        <span class="absolute right-2 md:right-4 text-white text-xl md:text-2xl lg:text-3xl font-thin">R$<?php echo number_format($metaValor, 2, ',', '.'); ?></span>
                    </div>
                </div>
            </section>
    
            <!-- Seção dos boxes de estatísticas -->
            <section class="flex flex-col sm:flex-row sm:gap-6 md:gap-6 w-full lg:h-auto lg:w-auto xl:ml-10 sm:h-44">
                
                <!-- Organizações -->
                <div class="flex flex-col items-center ">
                    <h3 class="text-xl md:text-2xl font-light mb-2 md:mb-3">ORGANIZAÇÕES</h3>
                    <div class="relative w-full sm:w-48 md:w-48 lg:w-64 xl:w-64 h-32 md:h-40 lg:h-64 xl:h-64 shadow-xl">
                        
                        <div class="box-org absolute inset-0 rounded-2xl brightness-50"></div>
                        
                        <div class="relative flex justify-center items-center h-full">
                            <span class="text-white text-3xl md:text-4xl lg:text-5xl font-bold"><?php echo $totalOrgs; ?>+</span>
                        </div>
                    </div>
                </div>
                
                <!-- Pessoas Físicas -->
                <div class="flex flex-col items-center">
                    <h3 class="text-xl md:text-2xl font-light mb-2 md:mb-3">PESSOAS FÍSICAS</h3>
                    <div class="flex justify-center items-center w-full sm:w-full sm:h-full md:w-48 lg:w-64 xl:w-64 h-32 md:h-40 lg:h-64 xl:h-64 bg-slate-500 rounded-2xl text-white shadow-xl">
                        <span class="text-3xl md:text-4xl lg:text-5xl font-bold"><?php echo $totalPFs; ?>+</span>
                    </div>
                </div>
            </section>
        </div>
    </main>

</body>

</html> 