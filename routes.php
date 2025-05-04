<?php
// Definição de rotas (routes.php) com suporte a métodos HTTP e rotas dinâmicas
function definirRotas()
{
    return [
        ['GET', '/', 'mostrarHome'],
        ['GET', '/clientes', 'listarClientes'],
        ['POST', '/clientes/adicionar', 'adicionarCliente'],
        ['GET', '/clientes/editar/{id}', 'mostrarEditarCliente'],
        ['POST', '/clientes/editar/{id}', 'editarCliente'],
        ['POST', '/clientes/deletar/{id}', 'deletarCliente'],
        ['GET', '/servicos', 'agendarServicos'],
        ['GET', '/funcionarios', 'controlarFuncionarios'],
        ['GET', '/pagamentos', 'gerirPagamentos'],
    ];
}
