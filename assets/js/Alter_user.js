
document.addEventListener('DOMContentLoaded', function() {
    const tipoCadastroRadios = document.querySelectorAll('input[name="tipo_cadastro"]');
    const documentLabel = document.getElementById('document-label');
    let documentInput = document.getElementById('document-input');
    
    // Função para aplicar máscara
    function aplicarMascara(input, pattern) {
        
        // Primeiro removemos qualquer evento anterior
        const newInput = input.cloneNode(true);
        input.parentNode.replaceChild(newInput, input);
        input = newInput;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            let newValue = '';
            let j = 0;
            
            for (let i = 0; i < pattern.length && j < value.length; i++) {
                if (pattern[i] === '0') {
                    newValue += value[j++];
                } else {
                    newValue += pattern[i];
                }
            }
            
            e.target.value = newValue;
        });
        
        return input;
    }
    
    // Inicializa com máscara de CNPJ (padrão)
    documentInput = aplicarMascara(documentInput, '00.000.000/0000-00');
    
    // Troca entre CPF e CNPJ
    tipoCadastroRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'pf') {
                documentLabel.textContent = 'CPF';
                documentInput.placeholder = '000.000.000-00';
                documentInput.value = '';
                documentInput = aplicarMascara(documentInput, '000.000.000-00');
            } else {
                documentLabel.textContent = 'CNPJ';
                documentInput.placeholder = '00.000.000/0000-00';
                documentInput.value = '';
                documentInput = aplicarMascara(documentInput, '00.000.000/0000-00');
            }
        });
    });
});
   