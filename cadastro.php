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
        $this->senha    = password_hash($senha, PASSWORD_ARGON2ID);
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
            return (object) [
                'sucesso' => true,
                'mensagem' => 'Cadastro realizado com sucesso!'
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



}
?>