document.addEventListener('DOMContentLoaded', function() {
    const tipoCadastroRadios = document.querySelectorAll('input[name="tipo_cadastro"]');
    const docLabel = document.getElementById('document-label');
    const docInput = document.getElementById('document-input');
    const form = document.getElementById('form-cadastro');

    // Máscaras
    const mascaras = {
        pf: {
            pattern: '000.000.000-00',
            placeholder: '000.000.000-00',
            label: 'CPF'
        },
        pj: {
            pattern: '00.000.000/0000-00',
            placeholder: '00.000.000/0000-00',
            label: 'CNPJ'
        }
    };

    // Aplica máscara
    function aplicarMascara(input, pattern) {
        let value = input.value.replace(/\D/g, '');
        let newValue = '';
        let j = 0;
        
        for (let i = 0; i < pattern.length && j < value.length; i++) {
            if (pattern[i] === '0') {
                newValue += value[j++];
            } else {
                newValue += pattern[i];
            }
        }
        
        input.value = newValue;
        return value.substring(0, j);
    }

    // Validação
    function validarDocumento(tipo, valor) {
        valor = valor.replace(/\D/g, '');
        
        if (tipo === 'pf') {
            return validarCPF(valor);
        } else {
            return validarCNPJ(valor);
        }
    }

    function validarCPF(cpf) {
        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
        
    }
    function validarCNPJ(cnpj) {
        if (cnpj.length !== 14 || /^(\d)\1{13}$/.test(cnpj)) return false;
        
    }

    // Atualiza o campo conforme o tipo
    function atualizarCampoDocumento(tipo) {
        const config = mascaras[tipo];
        docLabel.textContent = config.label;
        docInput.placeholder = config.placeholder;
        docInput.value = '';
        docInput.dataset.tipo = tipo;
    }

    tipoCadastroRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            atualizarCampoDocumento(this.value);
        });
    });

    docInput.addEventListener('input', function() {
        const tipo = document.querySelector('input[name="tipo_cadastro"]:checked').value;
        const rawValue = aplicarMascara(this, mascaras[tipo].pattern);
        
        if (rawValue.length === (tipo === 'pf' ? 11 : 14)) {
            const valido = validarDocumento(tipo, rawValue);
            this.classList.toggle('border-green-500', valido);
            this.classList.toggle('border-red-500', !valido);
        } else {
            this.classList.remove('border-green-500', 'border-red-500');
        }
    });

    // Validação no submit
    form.addEventListener('submit', function(e) {
        const tipo = document.querySelector('input[name="tipo_cadastro"]:checked').value;
        const docValue = docInput.value.replace(/\D/g, '');
        
        if ((tipo === 'pf' && docValue.length !== 11) || 
            (tipo === 'pj' && docValue.length !== 14)) {
            e.preventDefault();
            docInput.classList.add('border-red-500');
            alert(`Por favor, insira um ${tipo === 'pf' ? 'CPF' : 'CNPJ'} válido`);
        }
    });

    // Inicializa com CNPJ (padrão)
    atualizarCampoDocumento('pj');
});
