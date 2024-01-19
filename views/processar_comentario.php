<?php
include_once '../includes/db.php';
include_once '../controllers/EventController.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $evento_id = $_POST['evento_id'];
    $comentario = $_POST['comentario'];

    $eventController = new EventController();
    $eventController->adicionarComentario($pdo, $user_id, $evento_id, $comentario);
}

// redireciona para a página de eventos
header('Location: ../index.php');

exit();
?>