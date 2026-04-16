<?php
ob_start();
session_start();
header('Content-Type: application/json');

require_once "cadastro.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean();
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido.']);
    exit;
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    ob_clean();
    echo json_encode(['sucesso' => false, 'mensagem' => 'E-mail e senha são obrigatórios.']);
    exit;
}

$usuario = Cadastro::buscarPorEmail($email);

if ($usuario && password_verify($senha, $usuario->senha)) {
    $_SESSION['usuario_logado'] = true;
    $_SESSION['usuario_id'] = $usuario->cliente_id;       // ajuste se o campo for 'id_cliente'
    $_SESSION['usuario_nome'] = $usuario->nome_cliente;
    $resposta = ['sucesso' => true, 'mensagem' => 'Login realizado!'];
} else {
    $resposta = ['sucesso' => false, 'mensagem' => 'E-mail ou senha inválidos.'];
}

ob_clean();
echo json_encode($resposta);
exit;
?>