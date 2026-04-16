<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
require_once "cadastro.php";

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $acao = $_POST['acao'] ?? '';

    if($acao === 'cadastro') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = preg_replace('/\D/', '', $_POST['telefone']);

        if(strlen($telefone) == 11){
            $usuario = new Cadastro($nome, $email, $senha, $telefone);
            $id = $usuario->salvar();

            if($id){
                $_SESSION['cliente_id'] = $id;
                $_SESSION['cliente_nome'] = $nome;
                header("Location: menu.php?cadastro=ok");
                exit;
            } else {
                echo "Erro ao salvar";
            }
        } else {
            echo "Telefone inválido";
        }
    }
    elseif($acao === 'login') {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $usuario = Cadastro::login($email, $senha);

        if ($usuario) {
            $_SESSION['cliente_id'] = (int)$usuario['cliente_id'];
            $_SESSION['cliente_nome'] = $usuario['nome_cliente'];
            header("Location: menu.php?login=ok");
            exit;
        } else {
            header("Location: menu.php?login=failed");
            echo("Email ou senha inválidos.");
            exit;
        }
    }
}
