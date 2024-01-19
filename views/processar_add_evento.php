<?php
include_once '../includes/db.php';
include_once '../controllers/EventController.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $local = $_POST['local'];
    $descricao = $_POST['descricao'];
    $lotacao = isset($_POST['lotacao']) ? $_POST['lotacao'] : 0;

    // verifica se $lotacao é um número válido
    $lotacao = is_numeric($lotacao) ? intval($lotacao) : 0;

    $eventController = new EventController();
    $eventController->adicionarEvento($pdo, $nome, $data, $horario, $local, $descricao, $lotacao);
} else {
    // redireciona para a página de eventos
    header('Location: ../index.php');
    exit();
}
?>
