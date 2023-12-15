<?php
class EventController {
    public function listarEventos($pdo) {
        // Implemente a lógica para obter os eventos do banco de dados
        $query = "SELECT * FROM eventos";
        $stmt = $pdo->query($query);
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Chame a visualização para exibir os eventos
        include('views/listagem_eventos.php');
    }
}
