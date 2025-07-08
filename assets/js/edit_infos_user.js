
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
            if (dataInput) { 
                originalValue = dataText.textContent;
                dataInput.value = originalValue;
                dataInput.focus();
            }
            displayView.classList.add('hidden');
            editView.classList.remove('hidden');
        };

        const switchToDisplayMode = () => {
            editView.classList.add('hidden');
            displayView.classList.remove('hidden');
        };

        editBtn.addEventListener('click', switchToEditMode);
        cancelBtn.addEventListener('click', switchToDisplayMode);

        // Modificado: Botão Salvar agora abre o modal

        saveBtn.addEventListener('click', () => {
            
            // Identifica se estamos editando a senha ou outro campo
            const isPasswordRow = row.id === 'senha-row';

            const saveAction = async () => {
                let serviceUrl;
                let payload;

                // SE FOR A LINHA DA SENHA, usa a lógica segura e o serviço dedicado
                if (isPasswordRow) {
                    const currentPassword = row.querySelector('#senha_atual').value;
                    const newPassword = row.querySelector('#senha_nova').value;
                    const confirmPassword = row.querySelector('#confirma_senha').value;

                    // Validação no frontend antes de enviar
                    if (newPassword !== confirmPassword) {
                        alert('A nova senha e a confirmação não correspondem.');
                        return; 
                    }

                    serviceUrl = '../../services/alterar_senha_service.php'; // Usa o serviço dedicado
                    payload = { currentPassword, newPassword, confirmPassword };
                
                // SE FOR QUALQUER OUTRO CAMPO, usa a lógica simples
                } else {
                    const dataInput = row.querySelector('.data-input');
                    serviceUrl = '../../services/alterar_dados_service.php'; // Usa o serviço geral
                    payload = {
                        field: dataInput.id,
                        value: dataInput.value
                    };
                }

                // A lógica de fetch agora funciona para ambos os casos
                try {
                    const response = await fetch(serviceUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });
                    const result = await response.json();

                    alert(result.message);

                    if (result.success) {
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Falha na comunicação:', error);
                    alert('Não foi possível salvar os dados.');
                }
            };

            openModal(saveAction);

        });
    });
});