<?php
require_once "conexao.php";

class Cadastro {
    public int $id;
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
        $this->senha    = $senha;
        $this->telefone = $telefone;
    }
    public function salvar(){
        $pdo = Conexao::conectar();
        $sql = "INSERT INTO `cliente`(`nome_cliente`, `email_cliente`, `senha`, `telefone`) VALUES (:nome_cliente,:email_cliente,:senha,:telefone)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(":nome_cliente",  $this->nome);
        $stmt->bindValue(":email_cliente", $this->email);
        $stmt->bindValue(":senha",         $this->senha);
        $stmt->bindValue(":telefone",      $this->telefone);

        if ($stmt->execute()) {
            return (int) $pdo->lastInsertId();
        }

        return false;
    }
    public static function login($email, $senha){ /* o "static" executa essa classe sem necessitar utilizar o método pdo, ele é um facilitador de acesso */
        $pdo = Conexao::conectar();
        $sql = "SELECT * FROM cliente WHERE email_cliente = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue("email", $email);
        $stmt->execute();

        $usuario=$stmt->fetch(PDO::FETCH_ASSOC);

        /* Se o usuario for verdadeiro E a senha for igual ao que está dentro do banco de dados, ele executa esse bloco de código */
        if($usuario && $senha === $usuario['senha'] /* password_verify($senha, $usuario['senha']) */) {
            return $usuario;
        }
        return false;
    }    
}
?>