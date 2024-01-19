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
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Registar</title>
</head>

<body>
    <div class="cardLogin">
        <div class="cardLogin-body">
            <div class="imglogin"><img src="img/loginIcon.png" width="50px" height="50px"></div><br>
            <?php if (isset($error_message)) : ?>
                <p class="text-center"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form method="post" action="registar.php">
                <div class="form-group">
                    <label for="nome"><strong>Nome</strong></label>
                    <input type="nome" name="nome" class="form-control" id="nome" placeholder="insira o nome" required>
                </div>
                <div class="form-group">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="insira o email" required>
                </div>
                <div class="form-group">
                    <label for="password"><strong>Password</strong></label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="insira a password" required>
                </div>
                <button type="submit" class="btn btn-primary">Registar</button>
            </form>

            <br>
            <p class="text-center">Já tem conta? <a href="login.php">Faça login aqui</a></p>
        </div>
    </div>
</body>

</html>