<?php
require_once 'conexao.php';

class Endereco {
    public ?int $id = null;
    public int $cliente_id;
    public string $cep;
    public string $rua;
    public string $numero;
    public string $bairro;
    public string $cidade;
    public string $estado; 

    public function __construct(
        int     $cliente_id,
        string  $cep,
        string  $rua,
        string  $numero,
        string  $bairro,
        string  $cidade,
        string  $estado,
        ?int    $id = null
    ) {
        $this->cliente_id = $cliente_id;
        $this->cep =        $cep;
        $this->rua =        $rua;
        $this->numero =     $numero;
        $this->bairro =     $bairro;
        $this->cidade =     $cidade;
        $this->estado =     $estado;
        $this->id =         $id;
    }

    public static function buscarPorCliente(int $cliente_id): array {
        $pdo = Conexao::conectar();
        $sql = "SELECT endereco_id AS id, CEP, logradouro, num_logradouro, bairro, cidade, estado 
                FROM endereco WHERE cliente_id = :cliente_id ORDER BY endereco_id DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":cliente_id", $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deletar(int $endereco_id, int $cliente_id): bool {
        $pdo = Conexao::conectar();
        $sql = "DELETE FROM endereco WHERE endereco_id = :id AND cliente_id = :cliente_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $endereco_id, PDO::PARAM_INT);
        $stmt->bindValue(":cliente_id", $cliente_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    private function clienteExiste(): bool {
        $pdo  = Conexao::conectar();
        $sql  = "SELECT COUNT(*) FROM cliente WHERE cliente_id = :cliente_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":cliente_id", $this->cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return (int) $stmt->fetchColumn() > 0;
    }

    public function salvarEndereco(): bool {
        if ($this->id) {
            return $this->atualizar();
        } else {
            return $this->inserir();
        }
    }

    private function inserir(): bool {
        if (!$this->clienteExiste()) {
            throw new Exception("Cliente não encontrado.");
        }
        $pdo = Conexao::conectar();
        $sql = "INSERT INTO endereco 
                    (cliente_id, CEP, logradouro, num_logradouro, bairro, cidade, estado)
                VALUES 
                    (:cliente_id, :cep, :rua, :numero, :bairro, :cidade, :estado)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":cliente_id", $this->cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(":cep",        $this->cep,        PDO::PARAM_STR);
        $stmt->bindValue(":rua",        $this->rua,        PDO::PARAM_STR);
        $stmt->bindValue(":numero",     $this->numero,     PDO::PARAM_STR);
        $stmt->bindValue(":bairro",     $this->bairro,     PDO::PARAM_STR);
        $stmt->bindValue(":cidade",     $this->cidade,     PDO::PARAM_STR);
        $stmt->bindValue(":estado",     $this->estado,     PDO::PARAM_STR);
        return $stmt->execute();
    }

    private function atualizar(): bool {
        if (!$this->clienteExiste()) {
            throw new Exception("Cliente não encontrado.");
        }
        $pdo = Conexao::conectar();
        $sql = "UPDATE endereco SET 
                    CEP = :cep, logradouro = :rua, num_logradouro = :numero, 
                    bairro = :bairro, cidade = :cidade, estado = :estado
                WHERE endereco_id = :id AND cliente_id = :cliente_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id",         $this->id,         PDO::PARAM_INT);
        $stmt->bindValue(":cliente_id", $this->cliente_id, PDO::PARAM_INT);
        $stmt->bindValue(":cep",        $this->cep,        PDO::PARAM_STR);
        $stmt->bindValue(":rua",        $this->rua,        PDO::PARAM_STR);
        $stmt->bindValue(":numero",     $this->numero,     PDO::PARAM_STR);
        $stmt->bindValue(":bairro",     $this->bairro,     PDO::PARAM_STR);
        $stmt->bindValue(":cidade",     $this->cidade,     PDO::PARAM_STR);
        $stmt->bindValue(":estado",     $this->estado,     PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>