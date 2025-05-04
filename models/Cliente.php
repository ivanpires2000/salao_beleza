<?php
// Modelo Cliente para acesso ao banco de dados usando PDO

class Cliente
{
    private $pdo;

    public function __construct()
    {
        $config = include __DIR__ . '/../config.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
        try {
            $this->pdo = new PDO($dsn, $config['user'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM clientes ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, telefone) VALUES (?, ?)");
        return $stmt->execute([$data['nome'], $data['telefone']]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE clientes SET nome = ?, telefone = ? WHERE id = ?");
        return $stmt->execute([$data['nome'], $data['telefone'], $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
