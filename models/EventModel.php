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

    //inserção de evento
    public function inserirEvento($nome, $data, $horario, $local, $descricao)
    {
        $query = "INSERT INTO evento (nome, data, horario, local, descricao) VALUES (:nome, :data, :horario, :local, :descricao)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        $stmt->bindParam(':horario', $horario, PDO::PARAM_STR);
        $stmt->bindParam(':local', $local, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->execute();
        return $this->pdo->lastInsertId(); // Retorna o ID do evento recém-inserido
    }
}
