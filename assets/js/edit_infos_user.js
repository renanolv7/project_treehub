
document.addEventListener('DOMContentLoaded', () => {
    const infoRows = document.querySelectorAll('.info-row');
    const modal = document.getElementById('confirmationModal');
    const modalConfirmBtn = document.getElementById('modalConfirmBtn');
    const modalCancelBtn = document.getElementById('modalCancelBtn');
    let onConfirmAction = null; // Armazena a função a ser executada ao confirmar

    // Função para fechar o modal
    const closeModal = () => {
        modal.classList.add('modal-hidden');
        onConfirmAction = null; // Limpa a ação
    };

    // Função para abrir o modal
    const openModal = (action) => {
        onConfirmAction = action; // Define a ação a ser executada
        modal.classList.remove('modal-hidden');
    };

    // Eventos do modal
    modalCancelBtn.addEventListener('click', closeModal);
    modalConfirmBtn.addEventListener('click', () => {
        if (typeof onConfirmAction === 'function') {
            onConfirmAction(); // Executa a ação de salvar
        }
        closeModal(); // Fecha o modal após a ação
    });

    // Lógica para cada linha de informação
    infoRows.forEach(row => {
        const displayView = row.querySelector('.display-view');
        const editView = row.querySelector('.edit-view');
        const editBtn = row.querySelector('.edit-btn');
        
        if (!editBtn || editBtn.disabled) return;

        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
        const dataText = row.querySelector('.data-text');
        const dataInput = row.querySelector('.data-input');
        let originalValue = dataText.textContent;

        const switchToEditMode = () => {
            originalValue = dataInput.type === 'password' ? '' : dataText.textContent;
            dataInput.value = originalValue;
            displayView.classList.add('hidden');
            editView.classList.remove('hidden');
            dataInput.focus();
        };

        const switchToDisplayMode = () => {
            editView.classList.add('hidden');
            displayView.classList.remove('hidden');
        };

        editBtn.addEventListener('click', switchToEditMode);
        cancelBtn.addEventListener('click', switchToDisplayMode);

        // Modificado: Botão Salvar agora abre o modal
        saveBtn.addEventListener('click', () => {
            // Define a ação que o botão de confirmação do modal irá executar
            const saveAction = () => {
                const newValue = dataInput.value;
                
                // AQUI você faria a chamada para o backend (fetch para um script PHP)
                
                if (dataInput.type === 'password') {
                    if (newValue.trim() !== '') {
                        dataText.textContent = '************';
                    }
                } else {
                    dataText.textContent = newValue;
                }
                switchToDisplayMode();
            };

            openModal(saveAction); // Abre o modal com a ação de salvar definida
        });
    });
});