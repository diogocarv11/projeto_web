<?php
include 'includes/db.php';
include 'models/LoginModel.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, nome, password FROM user WHERE nome = :nome");
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nome'] = $user['nome'];
        header('Location: index.php');
        exit();
    } else {
        $error_message = "Credenciais inválidas. Tente novamente.";
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
    <title>Login</title>
</head>

<body>
    <div class="cardLogin">
        <div class="cardLogin-body">
            <div class="imglogin"><img src="img/loginIcon.png" width="50px" height="50px"></div><br>
            <?php if (isset($error_message)) : ?>
                <p><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form method="post" action="login.php">
                <div class="form-group">
                    <label for="nome"><strong>Nome</strong></label>
                    <input type="nome" name="nome" class="form-control" id="nome" placeholder="insira o nome" required>
                </div>
                <div class="form-group">
                    <label for="password" font-weight="bold"><strong>Password</strong></label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="insira a password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form><br>
            <p class="text-center">Não tem conta? <a href="registar.php">Registe-se aqui</a></p>
        </div>
    </div>
</body>

</html>
