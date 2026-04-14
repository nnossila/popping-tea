<?php
session_start();
require_once "cadastro.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $telefone = preg_replace('/\D/', '', $_POST['telefone'] ?? '');

    if (strlen($telefone) != 11) {
        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Telefone inválido (deve ter 11 dígitos)'
        ]);
        exit;
    }

    $usuario = new Cadastro($nome, $email, $senha, $telefone);
    $resultado = $usuario->salvar();

    if ($resultado->sucesso) {
        // Define a sessão para manter o usuário logado após o cadastro
        $_SESSION['usuario_logado'] = true;
        $_SESSION['usuario_id'] = $resultado->id;
        $_SESSION['usuario_nome'] = $nome;
    }

    echo json_encode($resultado);
    exit;
}

echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido']);
exit;
?>