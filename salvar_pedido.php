<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
header('Content-Type: application/json');

require_once "conexao.php";

if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário não está logado.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Dados inválidos.']);
    exit;
}

$cliente_id = (int) $input['cliente_id'];
$itens = $input['itens'];
$tipo_consumo = $input['tipo_consumo'] ?? 'local';
$endereco = $input['endereco'] ?? null;
$pagamento_metodo = $input['pagamento'] ?? '';

// Calcula o total do pedido (já que o front pode não enviar)
$total_pedido = 0;
foreach ($itens as $item) {
    $total_pedido += (float) $item['preco'];
}

if (empty($itens)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Carrinho vazio.']);
    exit;
}

try {
    $pdo = Conexao::conectar();
    $pdo->beginTransaction();

    // 1. Inserir endereço (se delivery)
    $endereco_id = null;
    if ($tipo_consumo === 'delivery' && $endereco && !empty($endereco['cep'])) {
        $sqlEnd = "INSERT INTO endereco (cliente_id, CEP, logradouro, num_logradouro, bairro, cidade, estado)
                   VALUES (:cliente_id, :cep, :rua, :numero, :bairro, :cidade, :estado)";
        $stmtEnd = $pdo->prepare($sqlEnd);
        $stmtEnd->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmtEnd->bindValue(':cep', $endereco['cep']);
        $stmtEnd->bindValue(':rua', $endereco['rua']);
        $stmtEnd->bindValue(':numero', $endereco['numero']);
        $stmtEnd->bindValue(':bairro', $endereco['bairro']);
        $stmtEnd->bindValue(':cidade', $endereco['cidade']);
        $stmtEnd->bindValue(':estado', $endereco['estado']);
        $stmtEnd->execute();
        $endereco_id = $pdo->lastInsertId();
    }

    // 2. Inserir pedido na tabela pedido_loja
    $sqlPedido = "INSERT INTO pedido_loja (cliente_id, endereco_id, data_pedido, status)
                  VALUES (:cliente_id, :endereco_id, CURDATE(), 'pendente')";
    $stmtPedido = $pdo->prepare($sqlPedido);
    $stmtPedido->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmtPedido->bindValue(':endereco_id', $endereco_id, PDO::PARAM_INT);
    $stmtPedido->execute();
    $pedido_id = $pdo->lastInsertId();

    // 3. Inserir itens
    $sqlItem = "INSERT INTO item_pedido (pedido_id, produto_id, preco_unitario, quantidade, preco_total)
                VALUES (:pedido_id, :produto_id, :preco_unitario, :quantidade, :preco_total)";
    $stmtItem = $pdo->prepare($sqlItem);
    foreach ($itens as $item) {
        $produto_id = isset($item['id']) ? (int)$item['id'] : 0;
        $quantidade = 1;
        $preco_unitario = (float)$item['preco'];
        $preco_total = $preco_unitario * $quantidade;
        $stmtItem->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);
        $stmtItem->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
        $stmtItem->bindValue(':preco_unitario', $preco_unitario);
        $stmtItem->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmtItem->bindValue(':preco_total', $preco_total);
        $stmtItem->execute();
    }

    // 4. Inserir pagamento com valor_pago
    $sqlPag = "INSERT INTO pagamento (pedido_id, metodo, status, valor_pago) 
               VALUES (:pedido_id, :metodo, 'pendente', :valor_pago)";
    $stmtPag = $pdo->prepare($sqlPag);
    $stmtPag->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);
    $stmtPag->bindValue(':metodo', $pagamento_metodo);
    $stmtPag->bindValue(':valor_pago', $total_pedido);
    $stmtPag->execute();

    $pdo->commit();

    echo json_encode(['sucesso' => true, 'mensagem' => 'Pedido registrado com sucesso!', 'pedido_id' => $pedido_id]);
} catch (Exception $e) {
    if (isset($pdo)) {
        $pdo->rollBack();
    }
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao salvar pedido: ' . $e->getMessage()]);
}
?>