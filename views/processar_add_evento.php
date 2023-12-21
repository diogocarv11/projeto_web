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

    $eventController = new EventController();
    $eventController->adicionarEvento($pdo, $nome, $data, $horario, $local, $descricao);
} else {
    // Redirecionar para a página de eventos se não for uma solicitação POST
    header('Location: index.php');
    exit();
}
