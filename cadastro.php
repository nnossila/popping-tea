<?php
require_once "conexao.php";

class Cadastro {
    public string $nome;
    public string $email;
    public string $senha;
    public string $telefone;

    public function __construct(
        string $nome,
        string $email,
        string $senha,
        string $telefone
    ) {
        $this->nome     = $nome;
        $this->email    = $email;
        $this->senha    = password_hash($senha, PASSWORD_DEFAULT); // mais compatível
        $this->telefone = $telefone;
    }

    public function salvar() {
        $pdo = Conexao::conectar();
        $sql = "INSERT INTO `cliente`(`nome_cliente`, `email_cliente`, `senha`, `telefone`) 
                VALUES (:nome_cliente, :email_cliente, :senha, :telefone)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(":nome_cliente", $this->nome);
        $stmt->bindValue(":email_cliente", $this->email);
        $stmt->bindValue(":senha", $this->senha);
        $stmt->bindValue(":telefone", $this->telefone);

        try {
            $stmt->execute();
            $id = $pdo->lastInsertId(); // obtém o ID gerado
            return (object) [
                'sucesso' => true,
                'mensagem' => 'Cadastro realizado com sucesso!',
                'id' => $id
            ];
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return (object) [
                    'sucesso' => false,
                    'mensagem' => 'Email já cadastrado no sistema!'
                ];
            } else {
                return (object) [
                    'sucesso' => false,
                    'mensagem' => 'Erro: ' . $e->getMessage()
                ];
            }
        }
    }

    public static function buscarPorEmail($email) {
        try {
            $pdo = Conexao::conectar();
            $sql = "SELECT * FROM cliente WHERE email_cliente = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Em produção, logue o erro; aqui retornamos null para não quebrar o JSON
            error_log('Erro no buscarPorEmail: ' . $e->getMessage());
            return null;
        }
    }
}
?>