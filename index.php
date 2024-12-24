<?php
// Arquivo principal do aplicativo para gerenciar um salão de beleza

require_once 'config.php';
require_once 'routes.php';

// Configuração inicial do sistema
function iniciarApp()
{
    session_start(); // Inicializa sessões

    // Verifica se o ambiente está configurado corretamente
    if (!file_exists('config.php')) {
        die('Arquivo de configuração ausente. Por favor, configure o sistema corretamente.');
    }

    // Carregar as rotas
    $rotas = definirRotas();

    // Definir REQUEST_URI para testes locais, se não estiver definida
    if (php_sapi_name() == "cli") {
        // Se estiver rodando no terminal, defina um valor padrão
        $_SERVER['REQUEST_URI'] = '/';
    } elseif (!isset($_SERVER['REQUEST_URI'])) {
        $_SERVER['REQUEST_URI'] = '/'; // Defina o valor padrão conforme necessário
    }

    // Verifica se a chave "REQUEST_URI" existe
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (array_key_exists($uri, $rotas)) {
        call_user_func($rotas[$uri]);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Página não encontrada.";
    }
}

// Inicia o aplicativo
iniciarApp();

// Configuração do banco de dados e variáveis globais (config.php)
function configurarBancoDeDados() {
    return include 'config.php';
}

// Implementação de funções para cada recurso
function mostrarHome() {
    echo "<h1>Bem-vindo ao Sistema de Gerenciamento do Salão de Beleza</h1>";
    echo "<ul>
            <li><a href='/clientes'>Gerenciar Clientes</a></li>
            <li><a href='/servicos'>Agendar Serviços</a></li>
            <li><a href='/funcionarios'>Controlar Funcionários</a></li>
            <li><a href='/pagamentos'>Gerir Pagamentos</a></li>
          </ul>";
}

function gerenciarClientes() {
    echo "<h1>Gerenciamento de Clientes</h1>";
    echo "<form method='post' action='/clientes/adicionar'>
            <label for='nome'>Nome:</label>
            <input type='text' id='nome' name='nome' required>
            <label for='telefone'>Telefone:</label>
            <input type='text' id='telefone' name='telefone' required>
            <button type='submit'>Adicionar Cliente</button>
          </form>";
    // Lógica para listar, adicionar e editar clientes
}

function agendarServicos() {
    echo "<h1>Agendamento de Serviços</h1>";
    echo "<form method='post' action='/servicos/agendar'>
            <label for='cliente'>Cliente:</label>
            <input type='text' id='cliente' name='cliente' required>
            <label for='servico'>Serviço:</label>
            <input type='text' id='servico' name='servico' required>
            <label for='data'>Data:</label>
            <input type='date' id='data' name='data' required>
            <button type='submit'>Agendar</button>
          </form>";
    // Lógica para agendar serviços para clientes
}

function controlarFuncionarios() {
    echo "<h1>Controle de Funcionários</h1>";
    echo "<form method='post' action='/funcionarios/adicionar'>
            <label for='nome'>Nome:</label>
            <input type='text' id='nome' name='nome' required>
            <label for='cargo'>Cargo:</label>
            <input type='text' id='cargo' name='cargo' required>
            <button type='submit'>Adicionar Funcionário</button>
          </form>";
    // Lógica para gerenciar funcionários do salão
}

function gerirPagamentos() {
    echo "<h1>Gestão de Pagamentos</h1>";
    echo "<form method='post' action='/pagamentos/registrar'>
            <label for='cliente'>Cliente:</label>
            <input type='text' id='cliente' name='cliente' required>
            <label for='valor'>Valor:</label>
            <input type='number' id='valor' name='valor' required>
            <label for='data'>Data:</label>
            <input type='date' id='data' name='data' required>
            <button type='submit'>Registrar Pagamento</button>
          </form>";
    // Lógica para registrar e acompanhar pagamentos
}

// Script SQL para criar tabelas no banco de dados
function criarTabelas() {
    $db = configurarBancoDeDados();

    $conn = new mysqli($db['host'], $db['user'], $db['password'], $db['dbname']);
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sqlClientes = "CREATE TABLE IF NOT EXISTS clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        telefone VARCHAR(15) NOT NULL
    );";

    $sqlServicos = "CREATE TABLE IF NOT EXISTS servicos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_id INT NOT NULL,
        servico VARCHAR(255) NOT NULL,
        data DATE NOT NULL,
        FOREIGN KEY (cliente_id) REFERENCES clientes(id)
    );";

    $sqlFuncionarios = "CREATE TABLE IF NOT EXISTS funcionarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        cargo VARCHAR(255) NOT NULL
    );";

    $sqlPagamentos = "CREATE TABLE IF NOT EXISTS pagamentos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_id INT NOT NULL,
        valor DECIMAL(10,2) NOT NULL,
        data DATE NOT NULL,
        FOREIGN KEY (cliente_id) REFERENCES clientes(id)
    );";

    $conn->query($sqlClientes);
    $conn->query($sqlServicos);
    $conn->query($sqlFuncionarios);
    $conn->query($sqlPagamentos);

    $conn->close();
}

// Chamar função para criar tabelas ao iniciar
criarTabelas();
