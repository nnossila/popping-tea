<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popping Tea</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">Popping Tea</div>
        <nav>
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="menu.php">Cardápio</a></li>
                <li><a href="contatos.php">Contatos</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <a href="menu.php#cardapio"  class="btn-order">FAZER PEDIDO</a>
            <p class="login"><a onclick="trocarParaLogin(event)">Login</a></p>
            <p class="logout"><a href="logout.php">Logout</a></p>
        </div>
    </header>

    <section class="banner" style="background-image: url(img/banner.jpg);">
        <div class="conteudo">
            <h1><span>Não é só Chá</span><br>É <span class="destaque">Popping Tea</span></h1>
            <p>Uma nova experiência de sabor, feita com ingredientes naturais e um toque especial que só o Popping Tea tem. Descubra o chá que virou tendência.</p>
            <a href="sobre.php" class="botao">SAIBA MAIS</a>
        </div>
        <div class="social">
            <a href="#"><img src="img/icons8-instagram.svg" alt="Instagram"></a>
            <a href="#"><img src="img/icons8-facebook.svg" alt="Facebook"></a>
            <a href="#"><img src="img/icons8-whatsapp.svg" alt="WhatsApp"></a>
        </div>
    </section>

    <?php include "popup_cadastro_login.php"; ?>
    <script>
        let usuarioLogado = <?= isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] ? 'true' : 'false' ?>;
        let carrinho = [];
        let contador = 0;
        const precos = {
            Yakult: 19.9,
            Tradicional: 18.9,
            Frozen: 23.9,
        };
    </script>
    <script src="login-cadastro.js"></script>
</body>
</html>