<?php
include('includes/db.php');
include('controllers/EventController.php');

$eventController = new EventController();
$eventController->listarEventos($pdo);
