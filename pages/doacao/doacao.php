<?php
    require_once __DIR__ . '../../../config/urls.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>TreeHub | Personalize sua Doação</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Leaflet.js CSS e JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Font Awesome (Ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= CSS_URL ?>doacao.css">
</head>

<body class="min-h-screen flex flex-col bg-gray-50">

    <main class="m-3 bg-white flex-grow rounded-xl overflow-hidden flex flex-col shadow-lg">
        
        <header class="flex justify-between items-center mb-6 px-8 py-6 w-full">
            <button id="back-btn" class="nav-arrow text-gray-600 hover:text-gray-800 transition-colors duration-300 cursor-pointer disabled:text-gray-300 disabled:cursor-not-allowed">
                <i class="fas fa-arrow-left fa-2x"></i>
            </button>

            <h1 class="text-3xl font-extrabold text-gray-700 text-center">PERSONALIZE SUA DOAÇÃO</h1>
            
            <button id="forward-btn" class="nav-arrow text-gray-600 hover:text-gray-800 transition-colors duration-300 cursor-pointer disabled:text-gray-300 disabled:cursor-not-allowed">
                <i class="fas fa-arrow-right fa-2x"></i>
            </button>
        </header>
    
        <div class="container mx-auto px-10 flex-grow">
            <div class="relative">
                <div id="step-1" class="step active">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="flex flex-col justify-center space-y-8">
                            <div>
                                <label for="tree-name" class="block text-lg font-semibold text-gray-600 mb-2">Nome para a sua árvore</label>
                                <input type="text" id="tree-name" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2f4f1c] focus:border-[#2f4f1c] outline-none transition duration-200" placeholder="Ex: Minha Esperança Verde">
                            </div>
                            <div>
                                <label for="tree-species" class="block text-lg font-semibold text-gray-600 mb-2">Espécie da sua árvore</label>
                                <select id="tree-species" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2f4f1c] focus:border-[#2f4f1c] outline-none transition duration-200 bg-white">
                                    <option value="">Selecione uma espécie</option>
                                    <option value="Ipê Amarelo">Ipê Amarelo</option>
                                    <option value="Pau-Brasil">Pau-Brasil</option>
                                    <option value="Jacarandá">Jacarandá</option>
                                </select>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-700 text-center mb-3">Ajude-nos a expandir nossos impactos</h3>
                                <textarea id="suggestion-box" class="w-full p-3 border-2 border-gray-300 rounded-lg" rows="2" placeholder="Deixe sua sugestão de local para reflorestamento."></textarea>
                                <button id="send-suggestion-btn" class="mt-3 w-full sm:w-auto float-right bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">Enviar</button>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-lg font-semibold text-gray-600 mb-2 text-center lg:text-left">Selecione um dos locais disponíveis</h2>
                            <div class="h-[450px] w-full rounded-lg border-2 border-gray-300 flex-grow">
                                <div id="map" class="h-full w-full rounded-lg z-10"></div>
                            </div>
                            <p id="selected-location-text" class="text-md font-semibold mt-2 text-center lg:text-left min-h-[20px]">Nenhum local selecionado.</p>
                        </div>
                    </div>
                </div>
    
                <div id="step-2" class="step h-60">
                    <h1 class="text-3xl font-bold text-center text-gray-700 mb-4">ESCOLHA O VALOR</h1>
                    <p id="donation-summary-1" class="text-center text-gray-500 mb-8 text-lg"></p>
                    <div class="flex justify-center flex-wrap gap-4 mb-8">
                        <button class="donation-amount-btn w-32 bg-white border-2 border-[#2f4f1c] text-[#2f4f1c] font-bold py-3 px-6 rounded-lg hover:bg-[#2f4f1c] hover:text-white transition-all duration-300" data-amount="25">R$ 25</button>
                        <button class="donation-amount-btn w-32 bg-white border-2 border-[#2f4f1c] text-[#2f4f1c] font-bold py-3 px-6 rounded-lg hover:bg-[#2f4f1c] hover:text-white transition-all duration-300" data-amount="50">R$ 50</button>
                        <button class="donation-amount-btn w-32 bg-white border-2 border-[#2f4f1c] text-[#2f4f1c] font-bold py-3 px-6 rounded-lg hover:bg-[#2f4f1c] hover:text-white transition-all duration-300" data-amount="100">R$ 100</button>
                    </div>
                    <div class="text-center">
                         <input type="number" id="custom-amount" placeholder="Outro valor (R$)" class="text-center w-48 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:border-[#2f4f1c] transition">
                    </div>
                </div>
    
                <div id="step-3" class="step">
                    <h1 class="text-3xl font-bold text-center text-gray-700 mb-4">PAGAMENTO</h1>
                    <p id="donation-summary-2" class="text-center text-gray-500 mb-8 text-lg"></p>
                    <div class="max-w-md mx-auto">
                        <div class="space-y-4">
                            <input type="text" id="card-name" placeholder="Nome no cartão" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            <input type="text" id="card-number" placeholder="Número do cartão" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            <div class="flex gap-4">
                                <input type="text" id="card-expiry" placeholder="Validade (MM/AA)" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg">
                                <input type="text" id="card-cvc" placeholder="CVC" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                            <button id="pay-button" class="w-full bg-[#2f4f1c] text-white font-bold py-3 px-8 rounded-lg text-lg hover:bg-[#2a4719] flex items-center justify-center gap-3 shadow-lg">
                               <span id="pay-button-text"><i class="fas fa-lock"></i> Doar Agora</span>
                               <div id="pay-spinner" class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin hidden"></div>
                            </button>
                        </div>
                    </div>
                </div>
    
                <div id="step-4" class="step text-center">
                     <div class="w-24 h-24 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-6">
                         <i class="fas fa-check-circle text-6xl text-[#2f4f1c]"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">OBRIGADO!</h1>
                    <p id="final-summary" class="text-gray-600 mb-8 text-lg"></p>
                    <button id="reset-button" class="bg-gray-700 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-800">Plantar outra árvore</button>
                    <a href="../org/dashboard_org.php"><button class="bg-gray-700 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-800">Ir para dashboard</button></a>
                </div>
            </div>
        </div>
    </main>
    
    <div id="custom-alert" class="custom-alert bg-red-600 text-white font-medium py-4 px-8 rounded-lg shadow-md"></div>

    <script src="../../assets/js/doacao.js"></script>
    
</body>

</html>
