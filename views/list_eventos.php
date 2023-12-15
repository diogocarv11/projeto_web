<!-- list_eventos.php -->

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
</head>

<body>
    <h1>Lista de Eventos</h1>

    <?php foreach ($eventos as $evento) : ?>
        <div>
            <h2><?php echo $evento['nome']; ?></h2>
            <p>Data: <?php echo $evento['data']; ?></p>
            <p>Horário: <?php echo $evento['horario']; ?></p>
            <p>Local: <?php echo $evento['local']; ?></p>
            <p>Descrição: <?php echo $evento['descricao']; ?></p>
            <h3>Comentários:</h3>

            <?php if (!empty($evento['comentarios'])) : ?>
                <ul>
                    <?php foreach ($evento['comentarios'] as $comentario) : ?>
                        <li>
                            <p><?php echo $comentario['comentario']; ?></p>
                            <p>Data: <?php echo $comentario['data_comentario']; ?></p>
                            <p>Autor: <?php echo $comentario['user_nome']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Sem comentários</p>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>

</body>

</html>
