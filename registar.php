<?php
include 'includes/db.php';
include 'models/LoginModel.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (!usernameExists($pdo, $nome)) {
        addUser($pdo, $nome, $password, $email);
        $_SESSION['user_nome'] = $nome;
        header('Location: login.php');
        exit();
    } else {
        $error_message = "O nome de utilizador já existe. Escolha outro.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar</title>
</head>

<body>
    <h1>Registar</h1>
    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="registar.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Registar</button>
    </form>
</body>

</html>
