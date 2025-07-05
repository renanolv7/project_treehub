<?php
    require_once __DIR__ . '/../../config/urls.php';
    session_start();

    // verificação da sessao se esta logado
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: ../pages/login.php");
        exit;
    }    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tree Hub">
    <title>Tree Hub | Dados</title>

    <!-- Chart.js para o gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="<?= CSS_URL ?>dashboard.css" rel="stylesheet">

    <style>
        /* Adiciona uma transição suave para uma melhor experiência do usuário */
        .view-container, #confirmationModal {
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }
        /* Garante que o modal escondido não ocupe espaço nem receba eventos */
        .modal-hidden {
            opacity: 0;
            visibility: hidden;
        }
    </style>

</head>

<body class="min-h-screen w-auto flex flex-col bg-gray-50">

    <?php include(__DIR__ . '../../../includes/header_person.php');?>
    
    <main class="ml-3 mb-3 mr-3 bg-white flex-grow rounded-xl shadow-sm">
        <div class="m-6 flex justify-center h-full">
            <div class="w-full my-2 mx-4 md:mx-16 lg:mx-32">
                <div class="p-6 space-y-4">
                    <div id="nome-row" class="info-row py-4 border-b border-gray-200">
                        <div class="view-container display-view flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">Nome</p>
                                <p class="text-gray-600 data-text"></p>
                            </div>
                            <button class="edit-btn px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Editar</button>
                        </div>
                        <div class="view-container edit-view hidden">
                            <label for="nome" class="font-semibold text-gray-800">Nome</label>
                            <input type="text" id="nome" class="data-input mt-2 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#2f4f1c] focus:border-[#2f4f1c]" value="Renan Oliveira">
                            <div class="flex justify-end space-x-3 mt-4">
                                <button class="cancel-btn px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Cancelar</button>
                                <button class="save-btn px-6 py-2 bg-[#2f4f1c] text-white rounded-lg text-sm font-semibold hover:bg-[#2f4f1c] transition-colors">Salvar</button>
                            </div>
                        </div>
                    </div>
    
                    <div id="email-row" class="info-row py-4 border-b border-gray-200">
                        <div class="view-container display-view flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">E-mail</p>
                                <p class="text-gray-600 data-text"></p>
                            </div>
                            <button class="edit-btn px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Editar</button>
                        </div>
                        <div class="view-container edit-view hidden">
                            <label for="email" class="font-semibold text-gray-800">E-mail</label>
                            <input type="email" id="email" class="data-input mt-2 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#2f4f1c] focus:border-[#2f4f1c]" value="teste@gmail.com">
                            <div class="flex justify-end space-x-3 mt-4">
                                <button class="cancel-btn px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Cancelar</button>
                                <button class="save-btn px-6 py-2 bg-[#2f4f1c] text-white rounded-lg text-sm font-semibold hover:bg-[#2f4f1c] transition-colors">Salvar</button>
                            </div>
                        </div>
                    </div>
    
                    <div id="celular-row" class="info-row py-4 border-b border-gray-200">
                        <div class="view-container display-view flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">Número de celular principal</p>
                                <p class="text-gray-600 data-text"></p>
                            </div>
                            <button class="edit-btn px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Editar</button>
                        </div>
                        <div class="view-container edit-view hidden">
                            <label for="celular" class="font-semibold text-gray-800">Número de celular principal</label>
                            <input type="tel" id="celular" class="data-input mt-2 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#2f4f1c] focus:border-[#2f4f1c]" value="+55912345678">
                            <div class="flex justify-end space-x-3 mt-4">
                                <button class="cancel-btn px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Cancelar</button>
                                <button class="save-btn px-6 py-2 bg-[#2f4f1c] text-white rounded-lg text-sm font-semibold hover:bg-[#2f4f1c] transition-colors">Salvar</button>
                            </div>
                        </div>
                    </div>
    
                    <div class="info-row py-4 border-b border-gray-200">
                        <div class="view-container display-view flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">Senha</p>
                                <p class="text-gray-600 data-text">************</p>
                            </div>
                            <button class="edit-btn px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Editar</button>
                        </div>

                        <div class="view-container edit-view hidden">
                            <label for="senha" class="font-semibold text-gray-800">Nova Senha</label>
                            <input type="password" id="senha" class="data-input mt-2 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#2f4f1c] focus:border-[#2f4f1c]" placeholder="Digite a nova senha">
                            <div class="flex justify-end space-x-3 mt-4">
                                <button class="cancel-btn px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Cancelar</button>
                                <button class="save-btn px-6 py-2 bg-[#2f4f1c] text-white rounded-lg text-sm font-semibold hover:bg-[#2f4f1c] transition-colors">Salvar</button>
                            </div>
                        </div>
                    </div>
    
                    <div class="info-row py-4">
                        <div class="view-container display-view flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">CPF</p>
                                <p class="text-gray-600 data-text">************</p>
                            </div>
                            <button class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-400 bg-gray-100" disabled>Editar</button>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </main>

    <div id="confirmationModal" class="modal-hidden fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">
            <h3 class="text-lg font-bold text-gray-800">Confirmar Alteração</h3>
            <p class="mt-2 text-gray-600">Você tem certeza que deseja salvar esta alteração?</p>
            <div class="mt-6 flex justify-end space-x-4">
                <button id="modalCancelBtn" class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Cancelar</button>
                <button id="modalConfirmBtn" class="px-6 py-2 bg-[#2f4f1c] text-white rounded-lg text-sm font-semibold hover:bg-[#2f4f1c] transition-colors">Sim, alterar</button>
            </div>
        </div>
    </div>

    <script src="../../assets/js/charts_person.js"></script>
    <script src="../../assets/js/dropdown.js"></script>
    <script src="../../assets/js/edit_infos_user.js"></script>

</body>
</html>
