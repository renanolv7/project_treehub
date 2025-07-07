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
    <title>Tree Hub | Configurações</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="<?= CSS_URL ?>configuracoes_usuario.css" rel="stylesheet">

</head>

<body class="min-h-screen w-auto flex flex-col bg-gray-50">

    <?php include(__DIR__ . '../../../includes/header_person.php');?>

    <main class="ml-3 mb-3 mr-3 p-6 bg-white flex-grow rounded-xl shadow-sm">

        <h1 class="text-2xl font-bold text-gray-600 mb-6">Configurações da Conta</h1>

        <div class="container flex flex-row h-[500px] py-4">

            <aside class="bg-gray-100 rounded-lg w-1/4 h-auto">
                <nav class="flex flex-col space-y-1  p-3 h-auto">
                    <a href="#" class="sidebar-link p-3 rounded-lg text-gray-700 hover:bg-gray-200 active" data-target="profile-section">Perfil Público</a>
                    <a href="#" class="sidebar-link p-3 rounded-lg text-gray-700 hover:bg-gray-200" data-target="account-section">Conta</a>
                    <a href="#" class="sidebar-link p-3 rounded-lg text-gray-700 hover:bg-gray-200" data-target="notifications-section">Notificações</a>
                    <a href="#" class="sidebar-link p-3 rounded-lg text-gray-700 hover:bg-gray-200" data-target="security-section">Segurança</a>
                </nav>
            </aside>
    
            <section class="w-3/4 px-6">
                <div id="profile-section" class="content-section active">
                    <h2 class="text-xl font-semibold text-gray-600 mb-4">Perfil Público</h2>
                    <div class="space-y-6">
                        <div>
                            <p class="name"><?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário'); ?></p>    
                            <input type="text" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <p class="mt-2 text-sm text-gray-500">Seu nome pode aparecer onde você contribui ou é mencionado.</p>
                        </div>
                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                            <textarea id="bio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">Técnico em Desenvolvimento de Sistemas e graduando em Gestão da Tecnologia da Informação pelo IFPR.</textarea>
                        </div>
                    </div>
                </div>
    
                <div id="account-section" class="content-section">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Conta</h2>
                    <div class="p-6 rounded-lg border border-red-300 bg-red-50">
                        <h3 class="text-lg font-semibold text-red-800">Desativar Conta</h3>
                        <p class="mt-2 text-red-700">
                            Você estará desativando sua conta. Poderá retornar a utilizar o nosso sistema quando desejar.
                        </p>
                        <div class="mt-4">
                            <button id="deactivateAccountBtn" class="text-red-600 hover:text-red-800 font-semibold transition-colors">
                                Quero desativar minha conta
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <div id="confirmationModal" class="modal-hidden fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-fit py-3">
            <h3 class="text-lg font-bold text-gray-800">Confirmar Ação</h3>
            <p class="mt-2 text-gray-600">Você tem certeza que deseja desativar sua conta?</p>
            <p class="mt-4 text-sm text-gray-600">Para confirmar, escreva a frase "<strong class="text-gray-800">Desejo desativar minha conta</strong>" no campo abaixo:</p>
            <input type="text" id="confirmationInput" class="mt-2 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm" placeholder="Desejo desativar minha conta">
            <div class="mt-6 flex justify-end space-x-4">
                <button id="modalCancelBtn" class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-colors">Cancelar</button>
                <button id="modalConfirmBtn" class="px-6 py-2 bg-red-300 text-white rounded-lg text-sm font-semibold cursor-not-allowed">Sim, desativar</button>
            </div>
        </div>
    </div>

    
</body>

<script src="../../assets/js/dropdown.js"></script>
<script src="../../assets/js/edit_infos_user.js"></script>
<script src="../../assets/js/desativa_conta.js"></script>

</html>
