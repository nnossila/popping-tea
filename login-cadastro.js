function abrirPopupCadastro() {
    if (!usuarioLogado) {
        document.getElementById("popupCadastro").style.display = "flex";
    } else {
        window.location.href = 'menu.php';
    }
}

function fecharCadastro() {
    document.getElementById("popupCadastro").style.display = "none";
}

function trocarParaLogin(event) {
    event.preventDefault();
    fecharCadastro();
    document.getElementById("popupLogin").style.display = "flex";
}

function trocarParaCadastro(event) {
    event.preventDefault();
    fecharLogin();
    document.getElementById("popupCadastro").style.display = "flex";
}

function fecharLogin() {
    document.getElementById("popupLogin").style.display = "none";
}

function finalizarCadastro(event) {
    event.preventDefault();
    const form = document.querySelector('#popupCadastro form');
    const dados = new FormData(form);

    fetch('formCadastro.php', {
        method: 'POST',
        body: dados
    })
    .then(response => response.json())
    .then(resultado => {
        if (resultado.sucesso) {
            alert(resultado.mensagem);
            usuarioLogado = true;
            fecharCadastro();
            location.reload();
        } else {
            let msgDiv = document.querySelector('#popupCadastro .mensagem-ajax');
            if (!msgDiv) {
                msgDiv = document.createElement('div');
                msgDiv.className = 'erro';
                form.prepend(msgDiv);
            }
            msgDiv.innerText = resultado.mensagem;
        }
    })
    .catch(erro => {
        console.error('Erro no fetch:', erro);
        alert('Erro de conexão. Tente novamente.');
    });
}

function fazerLogin(event) {
    event.preventDefault();
    const form = document.querySelector('#popupLogin form');
    const dados = new FormData(form);

    console.log('Enviando requisição para login.php...');

    fetch('login.php', {
        method: 'POST',
        body: dados
    })
    .then(response => {
        console.log('Status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        return response.json();
    })
    .then(resultado => {
        if (resultado.sucesso) {
            alert(resultado.mensagem);
            usuarioLogado = true;
            fecharLogin();
            location.reload();
        } else {
            let msgDiv = document.querySelector('#popupLogin .mensagem-ajax');
            if (!msgDiv) {
                msgDiv = document.createElement('div');
                msgDiv.className = 'erro';
                form.prepend(msgDiv);
            }
            msgDiv.innerText = resultado.mensagem;
        }
    })
    .catch(erro => {
        console.error('Erro no fetch:', erro);
        alert('Erro de conexão. Tente novamente.');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function () {
            let valor = this.value.replace(/\D/g, '');
            if (valor.length > 11) {
                valor = valor.slice(0, 11);
            }
            if (valor.length > 0) {
                valor = '(' + valor;
            }
            if (valor.length > 2) {
                valor = valor.slice(0, 3) + ') ' + valor.slice(3);
            }
            if (valor.length > 10) {
                valor = valor.slice(0, 10) + '-' + valor.slice(10);
            }
            this.value = valor;
        });
    }
});