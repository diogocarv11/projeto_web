<?php
class EventController
{
    public function listarEventos($pdo)
    {
        $query = "SELECT DISTINCT * FROM evento";
        $stmt = $pdo->query($query);
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($eventos as &$evento) {
            $evento['comentarios'] = $this->listarComentarios($pdo, $evento['id']);
        }

        include('../views/list_eventos.php');
    }

    public function listarComentarios($pdo, $eventoId)
    {
        $query = "SELECT c.*, u.nome AS user_nome FROM comentario c
                  RIGHT JOIN user u ON c.user_id = u.id
                  WHERE evento_id = :eventoId";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':eventoId', $eventoId, PDO::PARAM_INT);
        $stmt->execute();

        $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $comentarios;
    }
}
