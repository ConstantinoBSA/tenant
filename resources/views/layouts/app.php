<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(yieldSection('title')) ?></title>
</head>
<body>
    <header>
        <h1>Cabeçalho do Site</h1>
    </header>

    <main>
        <?= yieldSection('content') ?>
    </main>

    <footer>
        <p>Rodapé do Site</p>
    </footer>
</body>
</html>
