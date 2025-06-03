

function limparDocumento(doc) {
    return doc.replace(/\D/g, '');
}


function validarCPF(cpf) {
    cpf = limparDocumento(cpf);
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

    // Calcula primeiro dígito
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf[i]) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    const digito1 = resto > 9 ? 0 : resto;
    
    // Calcula segundo dígito
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf[i]) * (11 - i);
    }
    resto = 11 - (soma % 11);
    const digito2 = resto > 9 ? 0 : resto;

    return (digito1 === parseInt(cpf[9]) && digito2 === parseInt(cpf[10]));
}


function validarCNPJ(cnpj) {
    cnpj = limparDocumento(cnpj);
    if (cnpj.length !== 14 || /^(\d)\1{13}$/.test(cnpj)) return false;

    const pesos = [6,5,4,3,2,9,8,7,6,5,4,3,2];
    
    // Valida primeiro dígito
    let soma = 0;
    for (let i = 0; i < 12; i++) {
        soma += parseInt(cnpj[i]) * pesos[i+1];
    }
    let resto = soma % 11;
    const digito1 = resto < 2 ? 0 : 11 - resto;
    
    // Valida segundo dígito
    soma = 0;
    for (let i = 0; i < 13; i++) {
        soma += parseInt(cnpj[i]) * pesos[i];
    }
    resto = soma % 11;
    const digito2 = resto < 2 ? 0 : 11 - resto;

    return (digito1 === parseInt(cnpj[12]) && digito2 === parseInt(cnpj[13]);
}


function formatarDocumento(doc, tipo) {
    doc = limparDocumento(doc);
    
    if (tipo === 'cpf') {
        return doc.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    } else {
        return doc.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
    }
}


function configurarValidadorDocumento(inputId, tipoInputId) {
    const input = document.getElementById(inputId);
    const tipoInput = document.querySelector(`input[name="${tipoInputId}"]:checked`);

    if (!input || !tipoInput) {
        console.error('Elementos não encontrados!');
        return;
    }

    // Atualiza máscara quando o tipo muda
    document.querySelectorAll(`input[name="${tipoInputId}"]`).forEach(radio => {
        radio.addEventListener('change', function() {
            input.value = formatarDocumento(limparDocumento(input.value), this.value);
            validarDocumento(input, this.value);
        });
    });

    // Valida enquanto digita
    input.addEventListener('input', function() {
        const tipo = document.querySelector(`input[name="${tipoInputId}"]:checked`).value;
        this.value = formatarDocumento(this.value, tipo);
        validarDocumento(input, tipo);
    });

    // Função de validação principal
    function validarDocumento(input, tipo) {
        const documento = limparDocumento(input.value);
        let valido = false;

        if (tipo === 'cpf') {
            valido = documento.length === 11 ? validarCPF(documento) : false;
        } else {
            valido = documento.length === 14 ? validarCNPJ(documento) : false;
        }

        // Feedback visual
        input.classList.toggle('doc-valido', valido);
        input.classList.toggle('doc-invalido', !valido && documento.length > 0);
    }
}
