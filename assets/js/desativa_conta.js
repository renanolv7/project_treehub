document.addEventListener('DOMContentLoaded', function () {
    // Elementos do Modal
    const deactivateBtn = document.getElementById('deactivateAccountBtn');
    const confirmationModal = document.getElementById('confirmationModal');
    const modalCancelBtn = document.getElementById('modalCancelBtn');
    const modalConfirmBtn = document.getElementById('modalConfirmBtn');
    const confirmationInput = document.getElementById('confirmationInput');
    const requiredPhrase = "Desejo desativar minha conta";

    if (deactivateBtn) {
        deactivateBtn.addEventListener('click', (e) => {
            e.preventDefault();
            confirmationInput.value = ''; 
            modalConfirmBtn.disabled = true; 
            modalConfirmBtn.classList.add('bg-red-300', 'cursor-not-allowed');
            modalConfirmBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            confirmationModal.classList.remove('modal-hidden');
        });
    }

    if (modalCancelBtn) {
        modalCancelBtn.addEventListener('click', () => {
            confirmationModal.classList.add('modal-hidden');
        });
    }

    if (modalConfirmBtn) {
        modalConfirmBtn.addEventListener('click', async () => {
            if (!modalConfirmBtn.disabled) {
                try {
                    const response = await fetch('../../services/desativa_conta_service.php', {
                        method: 'POST'
                    });
                    const result = await response.json();

                    if (result.success) {
                        alert(result.message); // Exibe mensagem de sucesso
                        // Redireciona para a página de login após o logout
                        window.location.href = loginUrl; 
                    } else {
                        alert('Erro: ' + result.message);
                    }
                } catch (error) {
                    alert('Falha na comunicação com o servidor.');
                }
            }
        });
    }

    if (confirmationInput) {
        confirmationInput.addEventListener('input', () => {
            if (confirmationInput.value === requiredPhrase) {
                modalConfirmBtn.disabled = false;
                modalConfirmBtn.classList.remove('bg-red-300', 'cursor-not-allowed');
                modalConfirmBtn.classList.add('bg-red-600', 'hover:bg-red-700');
            } else {
                modalConfirmBtn.disabled = true;
                modalConfirmBtn.classList.add('bg-red-300', 'cursor-not-allowed');
                modalConfirmBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            }
        });
    }

    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const contentSections = document.querySelectorAll('.content-section');

    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            sidebarLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            const targetId = this.getAttribute('data-target');
            
            contentSections.forEach(section => {
                if (section.id === targetId) {
                    section.classList.add('active');
                } else {
                    section.classList.remove('active');
                }
            });
        });
    });
});