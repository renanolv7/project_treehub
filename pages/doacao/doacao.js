document.addEventListener('DOMContentLoaded', () => {
    const backBtn = document.getElementById('back-btn');
    const forwardBtn = document.getElementById('forward-btn');
    const steps = document.querySelectorAll('.step');
    const treeNameInput = document.getElementById('tree-name');
    const treeSpeciesSelect = document.getElementById('tree-species');
    const selectedLocationText = document.getElementById('selected-location-text');
    const customAlert = document.getElementById('custom-alert');

    const donationAmountBtns = document.querySelectorAll('.donation-amount-btn');
    const customAmountInput = document.getElementById('custom-amount');
    const donationSummary1 = document.getElementById('donation-summary-1');
    
    const donationSummary2 = document.getElementById('donation-summary-2');
    const payButton = document.getElementById('pay-button');
    const payButtonText = document.getElementById('pay-button-text');
    const paySpinner = document.getElementById('pay-spinner');

    // Elementos para métodos de pagamento
    const paymentCardBtn = document.getElementById('payment-card-btn');
    const paymentPixBtn = document.getElementById('payment-pix-btn');
    const cardPaymentForm = document.getElementById('card-payment-form');
    const pixPaymentForm = document.getElementById('pix-payment-form');
    const pixConfirmButton = document.getElementById('pix-confirm-button');
    const pixButtonText = document.getElementById('pix-button-text');
    const pixSpinner = document.getElementById('pix-spinner');

    const finalSummary = document.getElementById('final-summary');
    const resetButton = document.getElementById('reset-button');
    
    const totalSteps = steps.length;

    let donationState = {
        currentStep: 1,
        treeName: '',
        treeSpecies: '',
        selectedLocation: null,
        donationAmount: null,
        paymentMethod: 'cartao' // Padrão é cartão
    };

    const saveState = () => {
        donationState.treeName = treeNameInput.value;
        donationState.treeSpecies = treeSpeciesSelect.value;
        sessionStorage.setItem('donationProgress', JSON.stringify(donationState));
    };

    const loadState = () => {
        const savedStateJSON = sessionStorage.getItem('donationProgress');
        if (savedStateJSON) {
            donationState = JSON.parse(savedStateJSON);

            treeNameInput.value = donationState.treeName || '';
            treeSpeciesSelect.value = donationState.treeSpecies || '';

            if (donationState.selectedLocation) {
                selectedLocationText.textContent = `Local selecionado: ${donationState.selectedLocation.name}`;
                selectedLocationText.classList.add('text-blue-600');
            }

            if (donationState.donationAmount) {
                let isPresetAmount = false;
                donationAmountBtns.forEach(btn => {
                    if (parseFloat(btn.dataset.amount) === donationState.donationAmount) {
                        btn.classList.add('selected-amount');
                        isPresetAmount = true;
                    }
                });
                if (!isPresetAmount) {
                    customAmountInput.value = donationState.donationAmount;
                }
            }
        }
    };

    const showAlert = (message, duration = 3000) => {
        customAlert.textContent = message;
        customAlert.style.display = 'block';
        setTimeout(() => {
            customAlert.style.display = 'none';
        }, duration);
    };

    const updateSummaries = () => {
        const treeName = donationState.treeName || 'sua árvore';
        const treeSpecies = donationState.treeSpecies || 'uma espécie';
        const locationName = donationState.selectedLocation ? donationState.selectedLocation.name : 'um local incrível';
        const donationAmount = donationState.donationAmount ? donationState.donationAmount.toFixed(2).replace('.', ',') : '0,00';

        donationSummary1.textContent = `Você está nomeando a árvore "${treeName}" (${treeSpecies}) que será plantada em ${locationName}.`;
        donationSummary2.textContent = `Você está doando R$ ${donationAmount} para plantar a "${treeName}".`;
        finalSummary.textContent = `Sua doação de R$ ${donationAmount} foi confirmada! A árvore "${treeName}" será plantada em ${locationName}.`;
    };

    const togglePaymentMethod = (method) => {
        donationState.paymentMethod = method;
        
        paymentCardBtn.classList.toggle('selected', method === 'cartao');
        paymentPixBtn.classList.toggle('selected', method === 'pix');
        
        cardPaymentForm.classList.toggle('hidden', method !== 'cartao');
        pixPaymentForm.classList.toggle('hidden', method !== 'pix');
        
        saveState();
    };


    const map = L.map('map').setView([-14.235, -51.925], 4);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    }).addTo(map);

    const locations = [
        { id: 1, name: 'Parque Nacional da Tijuca, RJ', coords: [-22.9519, -43.2105] },
        { id: 2, name: 'Chapada dos Veadeiros, GO', coords: [-14.0932, -47.6534] },
        { id: 3, name: 'Teste', coords: [-23.4216, -46.6219] },
        { id: 4, name: 'Amazônia - Região de Manaus, AM', coords: [-3.1190, -60.0217] }
    ];

    let markerObjects = [];
    locations.forEach(location => {
        const marker = L.marker(location.coords).addTo(map);
        markerObjects.push({ marker: marker, locationData: location });

        if (donationState.selectedLocation && donationState.selectedLocation.id === location.id) {
             marker._icon.classList.add('selected');
        }

        marker.on('click', (e) => {
            markerObjects.forEach(m => m.marker._icon.classList.remove('selected'));
            e.target._icon.classList.add('selected');
            donationState.selectedLocation = location;
            selectedLocationText.textContent = `Local selecionado: ${location.name}`;
            selectedLocationText.classList.add('text-blue-600');
            saveState();
        });
    });

    const updateStepUI = () => {
        steps.forEach(step => step.classList.remove('active'));
        const currentStepElement = document.getElementById(`step-${donationState.currentStep}`);
        if(currentStepElement) {
            currentStepElement.classList.add('active');
        }
        
        if (donationState.currentStep === 1) setTimeout(() => map.invalidateSize(), 10);
        if (donationState.currentStep > 1) updateSummaries();
        
        backBtn.classList.toggle('disabled', donationState.currentStep === 1);

        forwardBtn.classList.toggle('disabled', donationState.currentStep >= totalSteps);
        if (donationState.currentStep === totalSteps) {
             backBtn.classList.add('disabled');
        }
    };

    const goToNextStep = () => {
        if (donationState.currentStep < totalSteps) {
            donationState.currentStep++;
            updateStepUI();
            saveState();
        }
    };

    const goToPreviousStep = () => {
        if (donationState.currentStep > 1) {
            donationState.currentStep--;
            updateStepUI();
            saveState();
        }
    };

    forwardBtn.addEventListener('click', () => {
        if (forwardBtn.classList.contains('disabled')) return;

        if (donationState.currentStep === 1) {
            if (!treeNameInput.value.trim() || !treeSpeciesSelect.value || !donationState.selectedLocation) {
                showAlert('Por favor, preencha todos os campos e selecione um local');
                return;
            }
        } else if (donationState.currentStep === 2) {
             if (!donationState.donationAmount || donationState.donationAmount <= 0) {
                showAlert('Por favor, escolha um valor de doação válido');
                return;
            }
        }
        goToNextStep();
    });

    backBtn.addEventListener('click', () => {
        if (!backBtn.classList.contains('disabled')) goToPreviousStep();
    });

    treeNameInput.addEventListener('input', saveState);
    treeSpeciesSelect.addEventListener('change', saveState);

    donationAmountBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            donationAmountBtns.forEach(b => b.classList.remove('selected-amount'));
            btn.classList.add('selected-amount');
            customAmountInput.value = '';
            donationState.donationAmount = parseFloat(btn.dataset.amount);
            saveState();
        });
    });

    customAmountInput.addEventListener('input', () => {
        donationAmountBtns.forEach(b => b.classList.remove('selected-amount'));
        const amount = parseFloat(customAmountInput.value);
        donationState.donationAmount = isNaN(amount) ? null : amount;
        saveState();
    });

    paymentCardBtn.addEventListener('click', () => togglePaymentMethod('cartao'));
    paymentPixBtn.addEventListener('click', () => togglePaymentMethod('pix'));

    payButton.addEventListener('click', async () => {
        // Validação específica para cartão
        if (donationState.paymentMethod === 'cartao') {
            const cardFields = ['card-name', 'card-number', 'card-expiry', 'card-cvc'];
            const isInvalid = cardFields.some(id => !document.getElementById(id).value.trim());
            if (isInvalid) {
                showAlert('Por favor, preencha todos os dados do cartão.');
                return;
            }
        }

        // Desativa o botão e mostra o spinner
        payButton.disabled = true;
        paySpinner.classList.remove('hidden');
        payButtonText.textContent = 'Processando...';

        try {
            // Envia os dados do estado da doação
            const response = await fetch('../../services/doacao_service.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(donationState)
            });

            const result = await response.json();
            if (result.success) {
                goToNextStep();
            } else {
                showAlert(result.message || 'Ocorreu um erro ao processar sua doação.');
            }

        } catch (error) {
            console.error('Falha na comunicação:', error);
            showAlert('Não foi possível conectar ao servidor. Verifique sua conexão.');
        } finally {
            // Reativa o botão e esconde o spinner
            payButton.disabled = false;
            paySpinner.classList.add('hidden');
            payButtonText.innerHTML = '<i class="fas fa-lock"></i> Doar Agora';
        }
    });

    // Event listener para pagamento via Pix
    pixConfirmButton.addEventListener('click', async () => {
        // Desativa o botão e mostra o spinner
        pixConfirmButton.disabled = true;
        pixSpinner.classList.remove('hidden');
        pixButtonText.textContent = 'Processando...';

        try {
            // Envia os dados do estado da doação
            const response = await fetch('../../services/doacao_service.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(donationState)
            });

            const result = await response.json();
            if (result.success) {
                goToNextStep();
            } else {
                showAlert(result.message || 'Ocorreu um erro ao processar sua doação.');
            }

        } catch (error) {
            console.error('Falha na comunicação:', error);
            showAlert('Não foi possível conectar ao servidor. Verifique sua conexão.');

        } finally {
            // Reativa o botão e esconde o spinner
            pixConfirmButton.disabled = false;
            pixSpinner.classList.add('hidden');
            pixButtonText.innerHTML = '<i class="fas fa-check"></i> Confirmar Pagamento Pix';
        }
    });

    resetButton.addEventListener('click', () => {
        sessionStorage.removeItem('donationProgress');
        window.location.reload();
    });

    loadState();
    updateStepUI();
    
    togglePaymentMethod(donationState.paymentMethod);
});