<?php
// Controlador para gerenciar clientes

class ClienteController
{
    private $model;

    public function __construct()
    {
        $this->model = new Cliente();
    }

    public function index()
    {
        $clientes = $this->model->all();
        include __DIR__ . '/../views/clientes/list.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/clientes/form.php';
    }

    public function store()
    {
        $nome = $_POST['nome'] ?? '';
        $telefone = $_POST['telefone'] ?? '';

        if (empty($nome) || empty($telefone)) {
            $error = "Nome e telefone são obrigatórios.";
            include __DIR__ . '/../views/clientes/form.php';
            return;
        }

        $this->model->create(['nome' => $nome, 'telefone' => $telefone]);
        header('Location: /clientes');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /clientes');
            exit;
        }
        $cliente = $this->model->find($id);
        if (!$cliente) {
            header('Location: /clientes');
            exit;
        }
        include __DIR__ . '/../views/clientes/form.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $nome = $_POST['nome'] ?? '';
        $telefone = $_POST['telefone'] ?? '';

        if (!$id || empty($nome) || empty($telefone)) {
            $error = "ID, nome e telefone são obrigatórios.";
            $cliente = ['id' => $id, 'nome' => $nome, 'telefone' => $telefone];
            include __DIR__ . '/../views/clientes/form.php';
            return;
        }

        $this->model->update($id, ['nome' => $nome, 'telefone' => $telefone]);
        header('Location: /clientes');
        exit;
    }

    public function delete()
    {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header('Location: /clientes');
        exit;
    }
}
