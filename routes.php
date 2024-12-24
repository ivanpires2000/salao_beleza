<?php
function definirRotas() {
    return [
        '/' => 'mostrarHome',
        '/clientes' => 'gerenciarClientes',
        '/servicos' => 'agendarServicos',
        '/funcionarios' => 'controlarFuncionarios',
        '/pagamentos' => 'gerirPagamentos',
    ];
}
