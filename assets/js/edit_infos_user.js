
document.addEventListener('DOMContentLoaded', () => {
    const infoRows = document.querySelectorAll('.info-row');
    const modal = document.getElementById('confirmationModal');
    const modalConfirmBtn = document.getElementById('modalConfirmBtn');
    const modalCancelBtn = document.getElementById('modalCancelBtn');
    let onConfirmAction = null; // Armazena a função a ser executada ao confirmar

    // Funcao para carregar os dados do usuario
    const loadUserData = async () => {
        try {
            // Salva JSON dados do usuario 
            const response = await fetch('../../services/pegar_dados_service.php');
            const data = await response.json();

            if (data.error) {
                console.error(data.error);
                return;
            }

            // Preenchimento dos campos
            // Uso de seletores para preenchimento dos campos do usuario
            document.querySelector('#nome-row .data-text').textContent = data.nome || 'Não informado';
            document.querySelector('#nome-row .data-input').value = data.nome || '';
            
            document.querySelector('#email-row .data-text').textContent = data.email || 'Não informado';
            document.querySelector('#email-row .data-input').value = data.email || '';

            document.querySelector('#celular-row .data-text').textContent = data.telefone || 'Não informado';
            document.querySelector('#celular-row .data-input').value = data.telefone || '';

        } catch (error) {
            console.error('Falha ao buscar dados do usuário:', error);
        }
    };

    loadUserData(); // funcao para carregar os dados

    
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
            
            const fieldName = dataInput.id; // 'id' do input
            const newValue = dataInput.value;

            const saveAction = async () => {
                try {
                    const response = await fetch('../../services/alterar_dados_service.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            field: fieldName,
                            value: newValue
                        })
                    });

                    const result = await response.json();

                    if (result.success) {

                        alert(result.message);
                        window.location.reload(); 
                    } else {
                        alert('Erro: ' + result.message);
                    }

                } catch (error) {
                    console.error('Falha na comunicação com o servidor:', error);
                    alert('Não foi possível salvar os dados. Tente novamente.');
                } finally {
                    switchToDisplayMode();
                }
            };

            openModal(saveAction); // Abre o modal de confirmação com a nova ação de salvar
        });
    });
});