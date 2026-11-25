CREATE DATABASE meu_mvc CHARACTER SET utf8mb4;
USE meu_mvc;

CREATE TABLE users (
  id_user    INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  last_name  VARCHAR(100) NOT NULL,
  email      VARCHAR(150) NOT NULL UNIQUE,
  cpf        CHAR(11) NOT NULL UNIQUE,
  birth_date DATE NOT NULL,
  password   VARCHAR(255) NOT NULL,
  active     TINYINT(1) NOT NULL DEFAULT 1
);
