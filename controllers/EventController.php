<?php
include(__DIR__ . '/../models/EventModel.php');

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

    public function adicionarEvento($pdo, $nome, $data, $horario, $local, $descricao, $lotacao)
    {
        $eventModel = new EventModel($pdo);
        $eventModel->inserirEvento($nome, $data, $horario, $local, $descricao, $lotacao);

        // redirecionar para a página de eventos após adição bem-sucedida
        header('Location: ../index.php');
        exit();
    }

    public function adicionarComentario($pdo, $user_id, $evento_id, $comentario)
    {
        $query = "INSERT INTO comentario (user_id, evento_id, comentario, data_comentario) 
                  VALUES (:user_id, :evento_id, :comentario, NOW())";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':evento_id', $evento_id, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        $stmt->execute();

        header('Location: ../index.php');
        exit();
    }

    public function participarEvento($pdo, $user_id, $evento_id)
    {
        if ($this->userParticipaEvento($pdo, $user_id, $evento_id)) {
            $this->removerParticipacao($pdo, $user_id, $evento_id);
        } else {
            $this->adicionarParticipacao($pdo, $user_id, $evento_id);
        }

        // atualizar contagem de participantes no evento
        $eventModel = new EventModel($pdo);
        $contagemParticipantes = $eventModel->obterContagemParticipantes($evento_id);
        $eventModel->atualizarParticipantes($evento_id, $contagemParticipantes);

        header('Location: ../index.php');
        exit();
    }

    private function userParticipaEvento($pdo, $user_id, $evento_id)
    {
        $query = "SELECT COUNT(*) FROM participantes WHERE user_id = :user_id AND evento_id = :evento_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':evento_id', $evento_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    private function adicionarParticipacao($pdo, $user_id, $evento_id)
    {
        $query = "INSERT INTO participantes (user_id, evento_id) VALUES (:user_id, :evento_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':evento_id', $evento_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function removerParticipacao($pdo, $user_id, $evento_id)
    {
        $query = "DELETE FROM participantes WHERE user_id = :user_id AND evento_id = :evento_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':evento_id', $evento_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
