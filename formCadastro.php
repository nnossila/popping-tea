<?php
session_start();
require_once "cadastro.php";

header('Content-Type: application/json'); // Importante!

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $telefone = preg_replace('/\D/', '', $_POST['telefone'] ?? '');

    if (strlen($telefone) == 11) {
        $usuario = new Cadastro($nome, $email, $senha, $telefone);
        $resultado = $usuario->salvar(); // Retorna objeto com sucesso e mensagem
        
        echo json_encode($resultado);
        exit;
    } else {
        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Telefone inválido (deve ter 11 dígitos)'
        ]);
        exit;
    }
}

// Se não for POST, retorna erro
echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido']);
exit;
?>