<?php
include_once '../includes/db.php';
include_once '../controllers/EventController.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $evento_id = $_POST['evento_id'];

    $eventController = new EventController();
    $eventController->participarEvento($pdo, $user_id, $evento_id);
}

// redireciona para a página de eventos 
header('Location: ../index.php');
exit();
?>