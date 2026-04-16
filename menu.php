<?php
session_start();
require_once "endereco.php";

$enderecos = [];
if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado']) {
    $cliente_id = $_SESSION['usuario_id'];
    $enderecos = Endereco::buscarPorCliente($cliente_id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popping Tea - Cardápio</title>
    <link rel="stylesheet" href="css/menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">Popping Tea</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="menu.php" class="active">Cardápio</a></li>
                <li><a href="contatos.php">Contatos</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <a href="#" onclick="finalizarCompra()" class="btn-order">FAZER PEDIDO</a>
            <p class="login"><a onclick="trocarParaLogin(event)">Login</a></p>
            <p class="logout"><a href="logout.php">Logout</a></p>
        </div>
    </header>

    <?php include "popup_cadastro_login.php"; ?>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-image-container">
                <img src="img/baunilha.jpg" alt="Tradicional Baunilha - Destaque">
            </div>
            <div class="hero-text">
                <h1>Fresco, com bolinhas,<br>feito com carinho.</h1>
                <div class="featured-name">BAUNILHA</div>
                <p class="featured-desc">
                    Mate suave com baunilha natural, leite vegetal e nossas bolinhas popping.
                    Aromático, cremoso e irresistivelmente doce.
                </p>
                <p style="margin-top: 20px; font-size: 0.95rem; color: #666;">
                    Mate • Baunilha natural • Leite vegetal • Bolinhas popping • Sem glúten
                </p>
            </div>
        </div>
    </section>

    <main class="cardapio" id="cardapio">
        <!-- YAKULT -->
        <section>
            <h2>Yakult <span class="preco">R$19,90</span></h2>
            <div class="grid-produtos">
                <div class="produto">
                    <img src="img/pessego.jpg" alt="Yakult Pêssego" onclick="mostrarIngredientes('yakult-pessego')">
                    <div class="produto-info">
                        <p class="produto-name">Pêssego</p>
                        <p class="produto-desc">Yakult cremoso, chá branco e polpa de pêssego natural. Refrescante e doce.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Yakult - Pêssego', 1, 19.90)">Adicionar</button>
                        </div>
                    </div>
                </div>
                <div class="produto">
                    <img src="img/cranberry.jpg" alt="Yakult Cramberry" onclick="mostrarIngredientes('yakult-cramberry')">
                    <div class="produto-info">
                        <p class="produto-name">Cramberry</p>
                        <p class="produto-desc">Mix de frutas vermelhas com Yakult e chá verde. Antioxidante e vibrante.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Yakult - Cramberry', 2, 19.90)">Adicionar</button>
                        </div>
                    </div>
                    <span class="badge badge-popular">POPULAR</span>
                </div>
                <div class="produto">
                    <img src="img/morango.jpg" alt="Yakult Morango" onclick="mostrarIngredientes('yakult-morango')">
                    <div class="produto-info">
                        <p class="produto-name">Morango</p>
                        <p class="produto-desc">Morango natural, Yakult e chá branco. Cremoso e clássico.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Yakult - Morango', 3, 19.90)">Adicionar</button>
                        </div>
                    </div>
                </div>
                <div class="produto">
                    <img src="img/maca verde.jpg" alt="Yakult Maçã Verde" onclick="mostrarIngredientes('yakult-maca')">
                    <div class="produto-info">
                        <p class="produto-name">Maçã Verde</p>
                        <p class="produto-desc">Maçã verde crocante, Yakult e chá verde. Leve e super refrescante.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Yakult - Maçã Verde', 4, 19.90)">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TRADICIONAIS -->
        <section>
            <h2>Tradicionais <span class="preco">R$18,90</span></h2>
            <div class="grid-produtos">
                <div class="produto">
                    <img src="img/taiwan.jpg" alt="Taiwan Original" onclick="mostrarIngredientes('tradicional-taiwan')">
                    <div class="produto-info">
                        <p class="produto-name">Taiwan Original</p>
                        <p class="produto-desc">Chá preto clássico, leite vegetal e pérolas de tapioca. O verdadeiro bubble tea.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Tradicional - Taiwan', 5, 18.90)">Adicionar</button>
                        </div>
                    </div>
                </div>
                <div class="produto">
                    <img src="img/tiger.jpg" alt="Tiger Mate" onclick="mostrarIngredientes('tradicional-tiger')">
                    <div class="produto-info">
                        <p class="produto-name">Tiger Mate</p>
                        <p class="produto-desc">Mate energizante, caramelo e pérolas. Doce e poderoso.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Tradicional - Tiger Mate', 6, 18.90)">Adicionar</button>
                        </div>
                    </div>
                </div>
                <div class="produto">
                    <img src="img/baunilha.jpg" alt="Vanilla Mate" onclick="mostrarIngredientes('tradicional-vanilla')">
                    <div class="produto-info">
                        <p class="produto-name">Vanilla Mate</p>
                        <p class="produto-desc">Mate suave, baunilha e leite vegetal. Aromático e delicado.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Tradicional - Vanilla', 7, 18.90)">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FROZEN -->
        <section>
            <h2>Frozen <span class="preco">R$23,90</span></h2>
            <div class="grid-produtos">
                <div class="produto">
                    <img src="img/caramel.jpg" alt="Nutty Caramel" onclick="mostrarIngredientes('frozen-nutty')">
                    <div class="produto-info">
                        <p class="produto-name">Nutty Caramel</p>
                        <p class="produto-desc">Creme gelado de caramelo com amendoim crocante.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Frozen - Nutty Caramel', 8, 23.90)">Adicionar</button>
                        </div>
                    </div>
                    <span class="badge badge-popular">POPULAR</span>
                </div>
                <div class="produto">
                    <img src="img/oreo.jpg" alt="Chocolate Branco com Oreo" onclick="mostrarIngredientes('frozen-oreo')">
                    <div class="produto-info">
                        <p class="produto-name">Chocolate Branco com Oreo</p>
                        <p class="produto-desc">Chocolate branco cremoso com pedaços de Oreo.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Frozen - Chocolate Branco com Oreo', 9, 23.90)">Adicionar</button>
                        </div>
                    </div>
                </div>
                <div class="produto">
                    <img src="img/cafe com oreo.jpg" alt="Café com Oreo" onclick="mostrarIngredientes('frozen-cafe')">
                    <div class="produto-info">
                        <p class="produto-name">Café com Oreo</p>
                        <p class="produto-desc">Café expresso gelado, Oreo e leite.</p>
                        <div class="produto-footer">
                            <button class="adicionar-btn" onclick="adicionarAoCarrinho('Frozen - Café com Oreo', 10, 23.90)">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="finalizar">
            <div class="icone-carrinho" onclick="abrirCarrinho()">
                🛒 <span id="contador-carrinho">0</span>
            </div>
            <button class="btn-finalizar" onclick="finalizarCompra()">Finalizar compra</button>
        </div>
    </main>

    <!-- Pop-ups -->
    <div class="overlay" id="carrinhoOverlay">
        <div class="popup-form">
            <button class="fechar" onclick="fecharCarrinho()">×</button>
            <h2>Itens no Carrinho</h2>
            <ul id="lista-carrinho"></ul>
            <p id="carrinho-vazio" style="text-align:center; color: #888;">Seu carrinho está vazio.</p>
            <p id="valor-total" style="font-weight:bold; margin-top: 1rem; text-align: center;"></p>
        </div>
    </div>

    <div class="overlay" id="popupIngredientes">
        <div class="popup-form">
            <button class="fechar" onclick="fecharIngredientes()">×</button>
            <h2>Ingredientes</h2>
            <p id="texto-ingredientes"></p>
        </div>
    </div>

    <div class="overlay" id="popupConfirmar">
        <div class="popup-form">
            <button class="fechar" onclick="fecharConfirmar()">×</button>
            <h2>Confirmar Pedido</h2>
            <ul id="resumo-pedido"></ul>
            <p id="total-confirmar"></p>
            <button onclick="irParaConsumo()">Continuar</button>
        </div>
    </div>

    <div class="overlay" id="popupConsumo">
        <div class="popup-form">
            <button class="fechar" onclick="fecharConsumo()">×</button>
            <h2>Forma de Consumo</h2>
            <button onclick="selecionarConsumo('delivery')">Delivery</button>
            <button onclick="selecionarConsumo('local')">Consumir no local</button>
            <button onclick="selecionarConsumo('viagem')">Levar para viagem</button>
        </div>
    </div>

    <div class="overlay" id="popupEndereco">
        <div class="popup-form">
            <button class="fechar" onclick="fecharEndereco()">×</button>
            <h2>Endereço</h2>
            <!-- Formulário SEM action, será manipulado pelo JavaScript -->
            <form id="form-endereco">
                <input type="hidden" name="action" id="action" value="save">
                <?php if (!empty($enderecos)): ?>
                    <?php $ultimo = $enderecos[0]; ?>
                    <div class="endereco-buttons" data-id="<?= $ultimo['id'] ?>" data-cep="<?= htmlspecialchars($ultimo['CEP'], ENT_QUOTES) ?>" data-rua="<?= htmlspecialchars($ultimo['logradouro'], ENT_QUOTES) ?>" data-numero="<?= htmlspecialchars($ultimo['num_logradouro'], ENT_QUOTES) ?>" data-bairro="<?= htmlspecialchars($ultimo['bairro'], ENT_QUOTES) ?>" data-cidade="<?= htmlspecialchars($ultimo['cidade'], ENT_QUOTES) ?>" data-estado="<?= htmlspecialchars($ultimo['estado'], ENT_QUOTES) ?>">
                        <button type="button" class="endereco-btn" onclick="usarEnderecoSalvo()">Endereço Salvo</button>
                        <button type="button" class="endereco-btn" onclick="editarEnderecoSalvo()">📝</button>
                        <button type="button" class="endereco-btn endereco-btn-delete" onclick="excluirEndereco(<?= $ultimo['id'] ?>)">🗑️</button>
                    </div>
                <?php else: ?>
                    <p style="margin-bottom: 16px; color: #444;">Nenhum endereço salvo.</p>
                <?php endif; ?>
                <input type="hidden" name="endereco_id" id="endereco_id" value="">
                <input type="text" id="cep" placeholder="CEP" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onblur="buscarCEP()" name="cep" required/>
                <input type="text" id="rua" placeholder="Rua" name="rua" required/>
                <input type="text" id="numero" placeholder="Número" name="numero" required/>
                <input type="text" id="bairro" placeholder="Bairro" name="bairro" required/>
                <input type="text" id="cidade" placeholder="Cidade" name="cidade" required/>
                <input type="text" id="estado" placeholder="Estado" name="estado" required/>
                <button type="submit" id="submit-btn">Continuar para Pagamento</button>
            </form>
        </div>
    </div>

    <div class="overlay" id="popupPagamento">
        <div class="popup-form">
            <button class="fechar" onclick="fecharPagamento()">×</button>
            <h2>Pagamento</h2>
            <div class="metodos">
                <button onclick="selecionarPagamento('pix')">PIX</button>
                <button onclick="selecionarPagamento('cartao')">Cartão</button>
                <button onclick="selecionarPagamento('dinheiro')">Dinheiro</button>
            </div>
            <div id="area-pix" class="area-pagamento" style="display:none;">
                <h3>Escaneie o QR Code</h3>
                <img id="qrcode-pix" src="" style="width:200px; margin-top:15px;">
                <p style="margin-top:10px; font-size:0.9rem; color:#666;">Aguardando pagamento...</p>
                <button onclick="finalizarPedido()">Confirmar Pagamento</button>
            </div>
            <div id="area-cartao" class="area-pagamento" style="display:none;">
                <select id="cartao-tipo">
                    <option>Crédito</option>
                    <option>Débito</option>
                </select>
                <input type="text" id="cartao-numero" placeholder="Número do cartão" maxlength="16">
                <input type="text" id="cartao-nome" placeholder="Nome no cartão">
                <input type="text" id="cartao-validade" placeholder="Validade (MM/AA)" maxlength="5">
                <input type="text" id="cartao-cvv" placeholder="CVV" maxlength="3">
                <button onclick="finalizarPedido()">Pagar</button>
            </div>
            <div id="area-dinheiro" class="area-pagamento" style="display:none;">
                <p>Pagamento em dinheiro na entrega</p>
                <button onclick="finalizarPedido()">Confirmar Pedido</button>
            </div>
        </div>
    </div>

    <div class="overlay" id="popupFinalizado">
        <div class="popup-form">
            <h2>Pedido Finalizado 🎉</h2>
            <p>Seu pedido foi enviado com sucesso!</p>
            <p>Entraremos em contato por telefone ou e-mail.</p>
            <button onclick="fecharFinalizado()">Fechar</button>
        </div>
    </div>

    <form id="formFinal" method="POST" action="salvar_tudo.php" style="display:none;">
        <!-- campos ocultos -->
    </form>

    <script>
        let usuarioLogado = <?= isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] ? 'true' : 'false' ?>;
        let carrinho = [];
        let tipoConsumo = "";
        let metodoPagamento = "";
        let enderecoSelecionado = null;

        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const popup = urlParams.get('popup');
            if (popup === 'finalizar-pedido') {
                finalizarCompra();
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });

        // ======================== PERSISTÊNCIA DO CARRINHO ========================
        function salvarCarrinho() {
            sessionStorage.setItem('carrinho', JSON.stringify(carrinho));
        }

        function carregarCarrinho() {
            const saved = sessionStorage.getItem('carrinho');
            if (saved) {
                carrinho = JSON.parse(saved);
                atualizarCarrinho();
            }
        }

        // ======================== FUNÇÕES DO CARRINHO ========================
        function adicionarAoCarrinho(nome, id, preco) {
            carrinho.push({ nome: nome, id: id, preco: preco });
            atualizarCarrinho();
            salvarCarrinho();
        }

        function removerItem(index) {
            carrinho.splice(index, 1);
            atualizarCarrinho();
            salvarCarrinho();
        }

        function atualizarCarrinho() {
            const lista = document.getElementById("lista-carrinho");
            const contadorSpan = document.getElementById("contador-carrinho");
            const vazio = document.getElementById("carrinho-vazio");
            const totalSpan = document.getElementById("valor-total");
            lista.innerHTML = "";
            let total = 0;
            carrinho.forEach((item, idx) => {
                total += item.preco;
                const li = document.createElement("li");
                li.innerHTML = `${item.nome} - R$ ${item.preco.toFixed(2)} <button onclick="removerItem(${idx})" style="margin-left:10px; color:red; background:none; border:none; cursor:pointer">remover</button>`;
                lista.appendChild(li);
            });
            contadorSpan.textContent = carrinho.length;
            if (carrinho.length === 0) {
                vazio.style.display = "block";
                totalSpan.textContent = "";
                totalSpan.removeAttribute('data-total');
            } else {
                vazio.style.display = "none";
                totalSpan.textContent = `Total: R$ ${total.toFixed(2)}`;
                totalSpan.setAttribute('data-total', total.toFixed(2));
            }
        }

        function abrirCarrinho() { document.getElementById("carrinhoOverlay").style.display = "flex"; }
        function fecharCarrinho() { document.getElementById("carrinhoOverlay").style.display = "none"; }

        // ======================== FLUXO DE PEDIDO ========================
        function finalizarCompra() {
            if (carrinho.length === 0) { alert("Carrinho vazio!"); return; }
            if (!usuarioLogado) {
                abrirPopupCadastro();
            } else {
                abrirConfirmarPedido();
            }
        }

        function abrirConfirmarPedido() {
            const lista = document.getElementById("resumo-pedido");
            const totalSpan = document.getElementById("total-confirmar");
            lista.innerHTML = "";
            let total = 0;
            carrinho.forEach(item => {
                const li = document.createElement("li");
                li.textContent = `${item.nome} - R$ ${item.preco.toFixed(2)}`;
                lista.appendChild(li);
                total += item.preco;
            });
            totalSpan.textContent = "Total: R$ " + total.toFixed(2);
            document.getElementById("popupConfirmar").style.display = "flex";
        }
        function fecharConfirmar() { document.getElementById("popupConfirmar").style.display = "none"; }

        function irParaConsumo() { fecharConfirmar(); document.getElementById("popupConsumo").style.display = "flex"; }
        function fecharConsumo() { document.getElementById("popupConsumo").style.display = "none"; }

        function selecionarConsumo(tipo) {
            tipoConsumo = tipo;
            fecharConsumo();
            if (tipo === "delivery") {
                document.getElementById("popupEndereco").style.display = "flex";
            } else {
                // Consumo local ou viagem: não precisa de endereço
                document.getElementById("popupPagamento").style.display = "flex";
            }
        }

        // ======================== ENDEREÇO (SEM RECARREGAR) ========================
        function fecharEndereco() { document.getElementById("popupEndereco").style.display = "none"; }

        function capturarEndereco() {
            const cep = document.getElementById('cep').value.trim();
            const rua = document.getElementById('rua').value.trim();
            const numero = document.getElementById('numero').value.trim();
            const bairro = document.getElementById('bairro').value.trim();
            const cidade = document.getElementById('cidade').value.trim();
            const estado = document.getElementById('estado').value.trim();
            if (!cep || !rua || !numero || !bairro || !cidade || !estado) {
                alert("Preencha todos os campos do endereço.");
                return false;
            }
            enderecoSelecionado = { cep, rua, numero, bairro, cidade, estado };
            return true;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const formEndereco = document.getElementById("form-endereco");
            if (formEndereco) {
                formEndereco.addEventListener("submit", function(e) {
                    e.preventDefault();
                    if (capturarEndereco()) {
                        const formData = new FormData(formEndereco);
                        formData.append('action', 'save');
                        
                        fetch('formEndereco.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            if (response.ok) {
                                fecharEndereco();
                                document.getElementById("popupPagamento").style.display = "flex";
                            } else {
                                alert("Erro ao salvar endereço.");
                            }
                        })
                        .catch(erro => {
                            console.error(erro);
                            alert("Erro de conexão.");
                        });
                    }
                });
            }
        });

        function buscarCEP() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            if (cep.length !== 8) { alert('CEP inválido. Informe os 8 dígitos.'); return; }
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) { alert('CEP não encontrado.'); return; }
                    document.getElementById('rua').value = data.logradouro || '';
                    document.getElementById('bairro').value = data.bairro || '';
                    document.getElementById('cidade').value = data.localidade || '';
                    document.getElementById('estado').value = data.uf || '';
                    document.getElementById('cep').value = cep;
                })
                .catch(error => { alert('Erro ao buscar o CEP.'); });
        }

        function usarEnderecoSalvo() {
            const container = document.querySelector('.endereco-buttons');
            if (!container) return;
            document.getElementById('cep').value = container.dataset.cep || '';
            document.getElementById('rua').value = container.dataset.rua || '';
            document.getElementById('numero').value = container.dataset.numero || '';
            document.getElementById('bairro').value = container.dataset.bairro || '';
            document.getElementById('cidade').value = container.dataset.cidade || '';
            document.getElementById('estado').value = container.dataset.estado || '';
            document.getElementById('endereco_id').value = container.dataset.id || '';
            document.getElementById('action').value = 'save';
            document.getElementById('submit-btn').textContent = 'Continuar para Pagamento';
            alert('Endereço Selecionado com Sucesso!');
        }

        function editarEnderecoSalvo() {
            const container = document.querySelector('.endereco-buttons');
            if (!container) return;
            document.getElementById('cep').value = container.dataset.cep || '';
            document.getElementById('rua').value = container.dataset.rua || '';
            document.getElementById('numero').value = container.dataset.numero || '';
            document.getElementById('bairro').value = container.dataset.bairro || '';
            document.getElementById('cidade').value = container.dataset.cidade || '';
            document.getElementById('estado').value = container.dataset.estado || '';
            document.getElementById('endereco_id').value = container.dataset.id || '';
            document.getElementById('action').value = 'save';
            document.getElementById('submit-btn').textContent = 'Atualizar Endereço';
        }

        function excluirEndereco(id) {
            if (confirm('Tem certeza que deseja excluir este endereço?')) {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('endereco_id', id);
                fetch('formEndereco.php', { method: 'POST', body: formData }).then(response => {
                    if (response.ok) window.location.reload();
                    else alert('Erro ao excluir endereço.');
                });
            }
        }

        // ======================== PAGAMENTO ========================
        function fecharPagamento() { document.getElementById("popupPagamento").style.display = "none"; }

        function selecionarPagamento(tipo) {
            metodoPagamento = tipo;
            document.getElementById("area-pix").style.display = "none";
            document.getElementById("area-cartao").style.display = "none";
            document.getElementById("area-dinheiro").style.display = "none";
            if (tipo === "pix") {
                document.getElementById("area-pix").style.display = "block";
                const totalElem = document.getElementById("valor-total");
                const valor = totalElem.getAttribute('data-total') || "0";
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Pagamento-PoppingTea-${valor}`;
                document.getElementById("qrcode-pix").src = qrUrl;
            } else if (tipo === "cartao") {
                document.getElementById("area-cartao").style.display = "block";
            } else if (tipo === "dinheiro") {
                document.getElementById("area-dinheiro").style.display = "block";
            }
        }

        function finalizarPedido() {
            if (!metodoPagamento) {
                alert("Selecione uma forma de pagamento.");
                return;
            }
            const total = document.getElementById("valor-total").getAttribute('data-total');
            if (!total || total === "0") {
                alert("Carrinho vazio ou total inválido.");
                return;
            }

            const pedido = {
                cliente_id: <?= $_SESSION['usuario_id'] ?? 0 ?>,
                itens: carrinho,
                total: total,
                tipo_consumo: tipoConsumo,
                endereco: enderecoSelecionado,
                pagamento: metodoPagamento
            };

            fetch("salvar_pedido.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(pedido)
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    document.getElementById("popupPagamento").style.display = "none";
                    document.getElementById("popupFinalizado").style.display = "flex";
                    carrinho = [];
                    atualizarCarrinho();
                    salvarCarrinho();
                    // Limpa dados do pedido
                    tipoConsumo = "";
                    metodoPagamento = "";
                    enderecoSelecionado = null;
                } else {
                    alert("Erro ao finalizar pedido: " + data.mensagem);
                }
            })
            .catch(erro => {
                console.error(erro);
                alert("Erro de conexão. Tente novamente.");
            });
        }

        function fecharFinalizado() {
            document.getElementById("popupFinalizado").style.display = "none";
            // Opcional: redirecionar para index ou limpar URL
            // window.location.href = "index.php";
        }

        function gerarCodigo() {
            const codigo = Math.floor(1000 + Math.random() * 9000);
            alert("Seu código: " + codigo + " (mostre no balcão)");
        }

        function mostrarIngredientes(produtoId) {
            const ingredientes = {
                "yakult-pessego": "Yakult, chá branco, polpa de pêssego. Sem glúten.",
                "yakult-cramberry": "Yakult, chá verde, morango, framboesa, cereja, amora e mirtilo. Sem glúten.",
                "yakult-morango": "Yakult, chá branco, morango natural. Contém lactose.",
                "yakult-maca": "Yakult, maçã verde, chá verde. Sem glúten.",
                "tradicional-taiwan": "Chá preto, leite vegetal, perolas. Sem glúten.",
                "tradicional-tiger": "Mate, caramelo, pérolas. Pode conter traços de glúten.",
                "tradicional-vanilla": "Mate, baunilha, leite vegetal. Sem glúten.",
                "frozen-nutty": "Creme, caramelo, amendoim. Contém glúten.",
                "frozen-oreo": "Chocolate branco, Oreo, leite. Contém glúten e lactose.",
                "frozen-cafe": "Café expresso, Oreo, leite. Contém glúten.",
            };
            document.getElementById("texto-ingredientes").textContent = ingredientes[produtoId] || "Ingredientes não encontrados.";
            document.getElementById("popupIngredientes").style.display = "flex";
        }
        function fecharIngredientes() { document.getElementById("popupIngredientes").style.display = "none"; }

        // Detectar redirecionamento vindo de formEndereco.php (caso ainda exista)
        document.addEventListener("DOMContentLoaded", function() {
            carregarCarrinho();
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('endereco') === 'ok' || urlParams.get('pagamento') === 'ok') {
                // Se o usuário foi redirecionado de volta, abre o pagamento
                document.getElementById("popupPagamento").style.display = "flex";
                // Limpa os parâmetros da URL
                window.history.replaceState({}, document.title, window.location.pathname);
            }
            // Esconde logout se não logado
            const logoutBtn = document.querySelector(".logout");
            if (logoutBtn) logoutBtn.style.display = usuarioLogado ? "flex" : "none";
        });
    </script>
    <script src="login-cadastro.js"></script>
</body>
</html>