
document.addEventListener('DOMContentLoaded', function() {
    const tipoCadastroRadios = document.querySelectorAll('input[name="tipo_cadastro"]');
    const documentLabel = document.getElementById('document-label');
    let documentInput = document.getElementById('document-input');
    
    // Função para aplicar máscara e validação
    function aplicarMascaraValidacao(input, pattern, validator) {
        // Clone o input para remover event listeners anteriores
        const newInput = input.cloneNode(true);
        input.parentNode.replaceChild(newInput, input);
        input = newInput;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            let newValue = '';
            let j = 0;
            
            // Aplica máscara
            for (let i = 0; i < pattern.length && j < value.length; i++) {
                if (pattern[i] === '0') {
                    newValue += value[j++];
                } else {
                    newValue += pattern[i];
                }
            }
            
            e.target.value = newValue;
            
            // Validação
            const rawValue = e.target.value.replace(/\D/g, '');
            if (validator && rawValue.length === (pattern.match(/0/g) || []).length) {
                const isValid = validator(rawValue);
                e.target.classList.toggle('border-green-500', isValid);
                e.target.classList.toggle('border-red-500', !isValid);
            } else {
                e.target.classList.remove('border-green-500', 'border-red-500');
            }
        });
        
        return input;
    }
    
    // Funções de validação
    function validarCPF(cpf) {
        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
        
        let sum = 0;
        for (let i = 0; i < 9; i++) sum += parseInt(cpf.charAt(i)) * (10 - i);
        let rest = 11 - (sum % 11);
        if (rest === 10 || rest === 11) rest = 0;
        if (rest !== parseInt(cpf.charAt(9))) return false;
        
        sum = 0;
        for (let i = 0; i < 10; i++) sum += parseInt(cpf.charAt(i)) * (11 - i);
        rest = 11 - (sum % 11);
        if (rest === 10 || rest === 11) rest = 0;
        
        return rest === parseInt(cpf.charAt(10));
    }
    
    function validarCNPJ(cnpj) {
        if (cnpj.length !== 14 || /^(\d)\1{13}$/.test(cnpj)) return false;
        
        const weights = [6,5,4,3,2,9,8,7,6,5,4,3,2];
        let sum = 0;
        
        // Valida primeiro dígito
        for (let i = 0; i < 12; i++) sum += parseInt(cnpj.charAt(i)) * weights[i+1];
        let rest = sum % 11;
        let digit = rest < 2 ? 0 : 11 - rest;
        if (digit !== parseInt(cnpj.charAt(12))) return false;
        
        // Valida segundo dígito
        sum = 0;
        for (let i = 0; i < 13; i++) sum += parseInt(cnpj.charAt(i)) * weights[i];
        rest = sum % 11;
        digit = rest < 2 ? 0 : 11 - rest;
        
        return digit === parseInt(cnpj.charAt(13));
    }
    
    // Inicializa com máscara de CNPJ (padrão) e validação
    documentInput = aplicarMascaraValidacao(
        documentInput, 
        '00.000.000/0000-00', 
        validarCNPJ
    );
    
    // Troca entre CPF e CNPJ
    tipoCadastroRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'pf') {
                documentLabel.textContent = 'CPF';
                documentInput.placeholder = '000.000.000-00';
                documentInput.value = '';
                documentInput = aplicarMascaraValidacao(
                    documentInput, 
                    '000.000.000-00', 
                    validarCPF
                );
            } else {
                documentLabel.textContent = 'CNPJ';
                documentInput.placeholder = '00.000.000/0000-00';
                documentInput.value = '';
                documentInput = aplicarMascaraValidacao(
                    documentInput, 
                    '00.000.000/0000-00', 
                    validarCNPJ
                );
            }
        });
    });
});