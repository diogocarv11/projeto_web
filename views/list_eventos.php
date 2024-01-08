<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
    <style>
        /* Estilize os cards conforme necessário */
        .event-card {
        display: inline-block;
        margin: 10px; /* Adapte a margem conforme necessário */
        width: 300px; /* Defina a largura desejada para cada card */
        border: 1px solid #ddd; /* Adicione uma borda para destacar os cards */
        padding: 10px; /* Adapte o preenchimento conforme necessário */
    }

        .event-card h2 {
            margin-bottom: 5px;
        }

        .event-card p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <h1>Lista de Eventos</h1>
    <?php if (!empty($eventos) && is_array($eventos)) : ?>
        <?php foreach ($eventos as $evento) : ?>
            <div class="event-card">
                <h2><?php echo $evento['nome']; ?></h2>
                <p>Data: <?php echo $evento['data']; ?></p>
                <p>Horário: <?php echo $evento['horario']; ?></p>
                <p>Local: <?php echo $evento['local']; ?></p>
                <p>Descrição: <?php echo $evento['descricao']; ?></p>
                <h5>Comentários:</h5>

                <?php if (!empty($evento['comentarios'])) : ?>
                    <ul>
                        <?php foreach ($evento['comentarios'] as $comentario) : ?>
                            <li>
                                <p><?php echo $comentario['user_nome']; ?>: <?php echo $comentario['comentario']; ?></p>
                                <p><?php echo $comentario['data_comentario']; ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>Sem comentários</p>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Nenhum evento disponível</p>
    <?php endif; ?>
</body>

</html>