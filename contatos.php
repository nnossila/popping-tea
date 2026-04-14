<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popping Tea</title>
    <link rel="stylesheet" href="css/contatos.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet">
  </head>
  <body>
    <header>
      <div class="logo">Popping Tea</div>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="sobre.php">Sobre</a></li>
          <li><a href="menu.php">Cardápio</a></li>
          <li><a href="contatos.php" class="active">Contatos</a></li>
        </ul>
      </nav>
    </header>

    <main class="contato-container">
      <section class="faq-form-wrapper">
        <div class="faq-box">
          <h2>FAQ</h2>
          <div class="faq-item">
            <h4>Qual o horário de atendimento?</h4>
            <p>Seg a Sáb: 10h às 20h</p>
            <p>Domingos e feriados: Fechado.</p>
          </div>
          <div class="faq-item">
            <h4>Fazem entrega?</h4>
            <p>Sim! Entregamos via iFood, Rappi e WhatsApp. Atendemos toda a
              região urbana de Curitiba, com entregas rápidas e seguras.</p>
          </div>
          <div class="faq-item">
            <h4>Quais as formas de pagamento?</h4>
            <p>Cartão de crédito, débito, Pix e dinheiro.</p>
          </div>
          <div class="faq-item">
            <h4>Os produtos têm lactose?</h4>
            <p>Temos opções com e sem lactose. Consulte o cardápio para
              detalhes.</p>
          </div>

          <div class="social-box">
            <h3>Canais de comunicação</h3>
            <ul>
              <li>Instagram: @poppingtea</li>
              <li>Facebook: Popping Tea</li>
              <li>WhatsApp: (41) 9279-0000</li>
            </ul>
          </div>
          <div class="social-box">
            <h3>Trabalhe conosco</h3>
            <ul>
              <li>Contato: rh@poppingtea.com.br</li>
            </ul>
          </div>
        </div>

        <div class="form-box">
          <h2>Fale com a gente</h2>
          <form id="form-contato">
            <input type="text" name="nome" placeholder="Seu nome" required />
            <input type="email" name="email" placeholder="Seu e-mail"
              required />
            <input type="text" name="assunto" placeholder="Assunto" required />
            <textarea name="mensagem" rows="5" placeholder="Sua mensagem"
              required></textarea>
            <button type="submit">Enviar</button>
            <p class="mensagem-sucesso" id="mensagem-sucesso">Mensagem enviada
              com sucesso!</p>
          </form>
        </div>

        <div class="overlay" id="popupCadastro">
          <div class="popup-form">
            <button class="fechar" onclick="fecharCadastro()">×</button>
            <h2>Cadastro</h2>
            <form onsubmit="finalizarCadastro(event)">
              <input type="text" placeholder="Nome completo" required />
              <input type="email" placeholder="E-mail" required />
              <input type="password" placeholder="Senha" required />
              <input type="tel" placeholder="Telefone" required />
              <button type="submit">Cadastrar</button>
              <p class="link-login">Já tem conta? <a href="#"
                  onclick="trocarParaLogin(event)">Entrar</a></p>
            </form>
          </div>
        </div>

        <div class="overlay" id="popupLogin">
          <div class="popup-form">
            <button class="fechar" onclick="fecharLogin()">×</button>
            <h2>Login</h2>
            <form onsubmit="fazerLogin(event)">
              <input type="text" placeholder="Nome completo" required />
              <input type="email" placeholder="E-mail" required />
              <input type="password" placeholder="Senha" required />
              <button type="submit">Entrar</button>
            </form>
          </div>
        </div>

<script src="login-cadastro.js"></script>
<script>
const form = document.getElementById("form-contato");
const mensagem = document.getElementById("mensagem-sucesso");

form.addEventListener("submit", function (e) {
  e.preventDefault();
  form.reset();
  mensagem.style.display = "block";
  mensagem.style.opacity = "1";

  setTimeout(() => {
    mensagem.style.opacity = "0";
    setTimeout(() => {
    mensagem.style.display = "none";
    }, 500);
  }, 3000);
});
</script>
      </section>
    </main>
  </body>
</html>