<!-- Popup Cadastro -->
<div class="overlay" id="popupCadastro">
  <div class="popup-form">
    <button class="fechar" onclick="fecharCadastro()">×</button>
    <h2>Cadastro</h2>
    <?php
    if (isset($_SESSION['resultado_cadastro'])) {
        $res = $_SESSION['resultado_cadastro'];
        $classe = $res->sucesso ? 'sucesso' : 'erro';
        echo "<div class='$classe'>{$res->mensagem}</div>";
        unset($_SESSION['resultado_cadastro']);
    }
    ?>
    <form method="POST" action="formCadastro.php" onsubmit="finalizarCadastro(event)">
      <input type="text" placeholder="Nome" name="nome" id="nome" required />
      <input type="email" placeholder="E-mail" name="email" id="email" required />
      <input type="password" placeholder="Senha (Letras, números e símbolos.)" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&]).{6,}$" name="senha" id="senha" required />
      <ul style="font-size: 12px; padding-left: 20px">
        <li>Pelo menos 1 Letra Maiúscula</li>
        <li>Pelo menos 1 Letra Minúscula</li>
        <li>Pelo menos 1 caractere numérico</li>
        <li>Pelo menos 1 caractere especial (ex: @ | # | &)</li>
      </ul>
      <input type="tel" placeholder="Telefone" maxlength="15" name="telefone" id="telefone" required />
      <button type="submit">Cadastrar</button>
      <p class="link-login">Já tem conta? <a href="#" onclick="trocarParaLogin(event)">Entrar</a></p>
    </form>
    <style>
      .erro { background: #f8d7da; color: #721c24; border-radius: 8px; padding: 10px; margin: 10px 0; }
      .sucesso { background: #d4edda; color: #155724; border-radius: 8px; padding: 10px; margin: 10px 0; }
    </style>
  </div>
</div>

<!-- Popup Login -->
<div class="overlay" id="popupLogin">
  <div class="popup-form">
    <button class="fechar" onclick="fecharLogin()">×</button>
    <h2>Login</h2>
    <form onsubmit="fazerLogin(event)" method="POST">
      <input type="text" placeholder="Nome" pattern="[A-Za-zÀ-ú\s]+" name="nome" required />
      <input type="email" placeholder="E-mail" name="email" required />
      <input type="password" placeholder="Senha (Letras, números e símbolos.)" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&]).{6,}$" name="senha" required />
      <button type="submit">Entrar</button>
      <p class="link-login">Não tem uma conta? <a href="#" onclick="trocarParaCadastro(event)">Cadastro</a></p>
    </form>
  </div>
</div>