<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= isset($cliente) ? 'Editar Cliente' : 'Novo Cliente' ?></title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <header>
        <h1><?= isset($cliente) ? 'Editar Cliente' : 'Novo Cliente' ?></h1>
        <nav>
            <a href="/clientes">Voltar à Lista</a>
        </nav>
        <hr>
    </header>
    <main>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post" action="<?= isset($cliente) ? '/clientes/atualizar' : '/clientes/salvar' ?>">
            <?php if (isset($cliente)): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['id']) ?>">
            <?php endif; ?>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= isset($cliente) ? htmlspecialchars($cliente['nome']) : '' ?>" required>
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?= isset($cliente) ? htmlspecialchars($cliente['telefone']) : '' ?>" required>
            <button type="submit"><?= isset($cliente) ? 'Salvar' : 'Cadastrar' ?></button>
        </form>
    </main>
</body>

</html>