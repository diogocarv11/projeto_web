<?php
function usernameExists($pdo, $nome)
{
    $stmt = $pdo->prepare("SELECT nome FROM user WHERE nome = :nome");
    $stmt->execute(['nome' => $nome]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result !== false;
}

function addUser($pdo, $nome, $password, $email)
{
    $stmt = $pdo->prepare("INSERT INTO user (nome, password, email) VALUES (:nome, :password, :email)");
    $stmt->execute(['nome' => $nome, 'password' => $password, 'email' => $email]);
}
?>
