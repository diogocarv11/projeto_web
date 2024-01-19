<?php
include_once '../includes/db.php';
include_once '../controllers/EventController.php';

session_start();
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Evento</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="cardLogin">
            <div class="cardLogin-body">
                <h1 class="mb-4">Adicionar Evento</h1>

                <form method="post" action="processar_add_evento.php">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="data">Data:</label>
                        <input type="date" name="data" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="horario">Horário:</label>
                        <input type="time" name="horario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="local">Local:</label>
                        <input type="text" name="local" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="lotacao">Lotação:</label>
                        <input type="number" name="lotacao" class="form-control" min="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Adicionar Evento</button>
                    <a href="../index.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
        
    </div>
</body>

</html>
