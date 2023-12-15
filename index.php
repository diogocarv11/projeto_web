<?php
include('includes/db.php');
include('controllers/EventController.php');
session_start();

$eventController = new EventController();
$eventController->listarEventos($pdo);
