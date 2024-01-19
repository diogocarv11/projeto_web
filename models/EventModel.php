<?php

class EventModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function listarEventos()
    {
        $query = "SELECT * FROM evento";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterEventoPorId($eventoId)
    {
        $query = "SELECT * FROM evento WHERE id = :eventoId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':eventoId', $eventoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inserir evento
    public function inserirEvento($nome, $data, $horario, $local, $descricao, $lotacao)
    {
        $query = "INSERT INTO evento (nome, data, horario, local, descricao, lotacao) 
                  VALUES (:nome, :data, :horario, :local, :descricao, :lotacao)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        $stmt->bindParam(':horario', $horario, PDO::PARAM_STR);
        $stmt->bindParam(':local', $local, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':lotacao', $lotacao, PDO::PARAM_INT);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function atualizarParticipantes($eventoId, $novaContagem)
    {
        $query = "UPDATE evento SET participantes = :novaContagem WHERE id = :eventoId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':eventoId', $eventoId, PDO::PARAM_INT);
        $stmt->bindParam(':novaContagem', $novaContagem, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function obterContagemParticipantes($eventoId)
    {
        $query = "SELECT COUNT(*) FROM participantes WHERE evento_id = :evento_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':evento_id', $eventoId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
