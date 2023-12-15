-- Criação da Base de Dados
CREATE DATABASE IF NOT EXISTS agenda_eventos;
USE agenda_eventos;

-- Tabela de Evento
CREATE TABLE IF NOT EXISTS evento (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    data DATE NOT NULL,
    horario TIME NOT NULL,
    local VARCHAR(255) NOT NULL,
    descricao TEXT
);

-- Tabela de Users
CREATE TABLE IF NOT EXISTS user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabela de Participantes
CREATE TABLE IF NOT EXISTS participante (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    evento_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (evento_id) REFERENCES evento(id)
);

-- Tabela de Comentários
CREATE TABLE IF NOT EXISTS comentario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    evento_id INT,
    comentario TEXT,
    data_comentario DATETIME,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (evento_id) REFERENCES evento(id)
);
