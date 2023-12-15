<?php
include('models/EventModel.php');

class EventController
{
    public function listarEventos($pdo)
    {
        $eventModel = new EventModel($pdo);
        $eventos = $eventModel->listarEventos();

        foreach ($eventos as $key => $evento) {
            $eventos[$key]['comentarios'] = $this->listarComentarios($pdo, $evento['id']);
        }
        include('views/list_eventos.php');
    }

    public function listarComentarios($pdo, $eventoId)
    {
        if (isset($_SESSION['user_id'])) {
            $query = "SELECT c.*, u.nome AS user_nome FROM comentario c
                  INNER JOIN user u ON c.user_id = u.id
                  WHERE evento_id = :eventoId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':eventoId', $eventoId, PDO::PARAM_INT);
            $stmt->execute();

            $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            header('Location: login.php');
            exit();
        }
        return $comentarios;
    }
}
