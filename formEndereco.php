<?php
require_once 'endereco.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: menu.php?endereco=erro");
    exit;
}

if (empty($_SESSION['usuario_id'])) {
    header("Location: menu.php?endereco=erro_nao_logado");
    exit;
}

$cliente_id = (int) $_SESSION['usuario_id'];
$action = $_POST['action'] ?? 'save';

// DELETE
if ($action === 'delete') {
    $endereco_id = (int) ($_POST['endereco_id'] ?? 0);
    if (Endereco::deletar($endereco_id, $cliente_id)) {
        header("Location: menu.php?endereco=deletado");
    } else {
        header("Location: menu.php?endereco=erro_delete");
    }
    exit;
}

// Selecionar endereço (apenas armazenar na sessão, sem salvar)
if ($action === 'select') {
    $endereco_id = (int) ($_POST['endereco_id'] ?? 0);
    if ($endereco_id) {
        $_SESSION['endereco_selecionado'] = $endereco_id;
    }
    header("Location: menu.php?endereco=selecionado");
    exit;
}

// SAVE or UPDATE
$endereco_id = !empty($_POST['endereco_id']) ? (int)$_POST['endereco_id'] : null;
$cep = preg_replace('/\D/', '', $_POST['cep'] ?? '');
$rua = trim($_POST['rua'] ?? '');
$numero = trim($_POST['numero'] ?? '');
$bairro = trim($_POST['bairro'] ?? '');
$cidade = trim($_POST['cidade'] ?? '');
$estado = trim($_POST['estado'] ?? '');

if (!$cep || !$rua || !$numero || !$bairro || !$cidade || !$estado) {
    header("Location: menu.php?endereco=invalid");
    exit;
}

try {
    $endereco = new Endereco($cliente_id, $cep, $rua, $numero, $bairro, $cidade, $estado, $endereco_id);
    if ($endereco->salvarEndereco()) {
        $redirect = $endereco_id ? "atualizado" : "ok";
        header("Location: menu.php?endereco=$redirect");
        exit;
    }
} catch (Exception $e) {
    // erro
}
header("Location: menu.php?endereco=erro");
exit;
?>