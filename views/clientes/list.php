<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <header>
        <h1>Lista de Clientes</h1>
        <nav>
            <a href="/">Início</a> |
            <a href="/clientes/novo">Novo Cliente</a>
        </nav>
        <hr>
    </header>
    <main>
        <?php if (count($clientes) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['nome']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                            <td>
                                <a href="/clientes/editar?id=<?= $cliente['id'] ?>">Editar</a>
                                <form method="post" action="/clientes/deletar" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja deletar este cliente?');">
                                    <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                                    <button type="submit" class="confirm-button">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum cliente cadastrado.</p>
        <?php endif; ?>
    </main>
</body>

</html>