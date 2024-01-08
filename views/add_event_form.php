<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Evento</title>
</head>

<body>
    <h1>Adicionar Evento</h1>

    <form method="post" action="processar_add_evento.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="data">Data:</label>
        <input type="date" name="data" required>

        <label for="horario">Horário:</label>
        <input type="time" name="horario" required>

        <label for="local">Local:</label>
        <input type="text" name="local" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" rows="4" required></textarea>

        <button type="submit">Adicionar Evento</button>
    </form>
</body>

</html>
