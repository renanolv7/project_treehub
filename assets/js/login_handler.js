document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('form-login');
    const errorContainer = document.getElementById('login-error-message');
    const inactiveModal = document.getElementById('inactiveAccountModal');
    const closeInactiveModal = document.getElementById('closeInactiveModal');

    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault(); // Impede o envio padrão do formulário
            errorContainer.classList.add('hidden');

            const formData = new FormData(loginForm);

            try {
                const response = await fetch('../services/login_service.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.status === 'success') {
                    // Redireciona para o dashboard correto
                    window.location.href = result.redirect;
                } else if (result.status === 'inactive') {
                    // Mostra o modal de conta inativa
                    inactiveModal.classList.remove('hidden');
                } else {
                    // Mostra a mensagem de erro
                    errorContainer.textContent = result.message;
                    errorContainer.classList.remove('hidden');
                }
            } catch (error) {
                errorContainer.textContent = 'Erro de comunicação. Tente novamente.';
                errorContainer.classList.remove('hidden');
            }
        });
    }

    if(closeInactiveModal) {
        closeInactiveModal.addEventListener('click', () => {
            inactiveModal.classList.add('hidden');
        });
    }
});