<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$userNome = $_SESSION['user_nome'];

$userLogado = isset($_SESSION['user_id']);
$userParticipaEvento = false;
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Lista de Eventos</h1>
            </div>
            <div class="col-md-6 text-right">
                <span><strong> Bem-vindo, <?php echo $userNome; ?>!</strong></span>
                <a href="/projeto_web-main/views/add_event.php" class="btn btn-primary">Adicionar Evento</a>
                <form method="post" action="logout.php" style="display: inline;">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div><br><br>

    <?php if (!empty($eventos) && is_array($eventos)) : ?>
        <?php foreach ($eventos as $evento) : ?>
            <div class="event-card">
                <h2><?php echo $evento['nome']; ?></h2>
                <p>Data: <?php echo $evento['data']; ?></p>
                <p>Horário: <?php echo $evento['horario']; ?></p>
                <p>Local: <?php echo $evento['local']; ?></p>
                <p>Descrição: <?php echo $evento['descricao']; ?></p>
                <p>Lotação: <?php echo $evento['lotacao']; ?></p>
                <?php if (isset($evento['participantes'])) : ?> <p>Participantes: <?php echo $evento['participantes']; ?></p>
                    <?php if ($userLogado) : ?>
                        <form method="post" action="/projeto_web-main/views/processar_participacao.php">
                            <input type="hidden" name="evento_id" value="<?php echo $evento['id']; ?>">
                            <button type="submit" class="btn btn-success">
                                <?php echo $userParticipaEvento ? 'Cancelar Participação' : 'Participar'; ?>
                            </button>
                        </form>
                    <?php endif; ?>
                <?php else : ?>
                    <p>Número de participantes não disponível</p>
                <?php endif; ?>
                <h5>Comentários:</h5>
                <form method="post" action="/projeto_web-main/views/processar_comentario.php">
                    <input type="hidden" name="evento_id" value="<?php echo $evento['id']; ?>">
                    <input name="comentario" placeholder="Adicionar Comentário" size="50" rows="4" required>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"></path>
                        </svg>
                    </button>
                </form>
                <?php if (!empty($evento['comentarios'])) : ?>
                    <ul style="list-style: none;">
                        <?php foreach ($evento['comentarios'] as $comentario) : ?>
                            <li>
                                <p><?php echo $comentario['user_nome']; ?>: <?php echo $comentario['comentario']; ?> | <?php echo $comentario['data_comentario']; ?></p>
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