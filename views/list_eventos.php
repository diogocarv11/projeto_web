<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Eventos</title>
</head>
<body>
    <h1>Listagem de Eventos</h1>
    <?php foreach ($eventos as $evento): ?>
        <div>
            <h2><?php echo $evento['nome']; ?></h2>
            <p>Data: <?php echo $evento['data']; ?></p>
            <p>Horário: <?php echo $evento['horario']; ?></p>
            <p>Local: <?php echo $evento['local']; ?></p>
            <p>Descrição: <?php echo $evento['descricao']; ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
