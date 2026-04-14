<?php
// Inicia buffer de saída para capturar qualquer erro inesperado
ob_start();
session_start();

// Define o header JSON antes de qualquer saída
header('Content-Type: application/json');

try {
    require_once "cadastro.php";
} catch (Exception $e) {
    // Limpa qualquer saída anterior e retorna erro JSON
    ob_clean();
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao carregar cadastro.php: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean();
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido. Use POST.']);
    exit;
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    ob_clean();
    echo json_encode(['sucesso' => false, 'mensagem' => 'E-mail e senha são obrigatórios.']);
    exit;
}

try {
    $usuario = Cadastro::buscarPorEmail($email);
    
    if ($usuario && password_verify($senha, $usuario->senha)) {
        $_SESSION['usuario_logado'] = true;
        $_SESSION['usuario_id'] = $usuario->id_cliente;
        $_SESSION['usuario_nome'] = $usuario->nome_cliente;
        $resposta = ['sucesso' => true, 'mensagem' => 'Login realizado!'];
    } else {
        $resposta = ['sucesso' => false, 'mensagem' => 'E-mail ou senha inválidos.'];
    }
} catch (Exception $e) {
    $resposta = ['sucesso' => false, 'mensagem' => 'Erro interno: ' . $e->getMessage()];
}

// Limpa qualquer saída indesejada antes de enviar o JSON
ob_clean();
echo json_encode($resposta);
exit;
?>