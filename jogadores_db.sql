--retirei o comando SELECT pois estava interferindo na hora da importação para o phpmyadmin, não houve nenhum outro problema

CREATE DATABASE IF NOT EXISTS `jogadores_db` DEFAULT CHARACTER SET = 'utf8mb4' COLLATE = 'utf8mb4_general_ci';
USE `jogadores_db`;

CREATE TABLE IF NOT EXISTS `jogadores`(
    `id` INT AUTO_INCREMENT,
    `nome` VARCHAR(60),
    `sexo` CHAR(1) DEFAULT NULL,
    `escola` VARCHAR(60),
    `pontuacao` INT DEFAULT 0,
    PRIMARY KEY(`id`)
);

INSERT INTO `jogadores` (`id`, `nome`, `sexo`, `escola`, `pontuacao`) VALUES 
(NULL, "Victor Alex Moreira Gouveia", "M", "Etec José Del Guerra", 5),
(NULL, "Enzo Fernando", "M", "Etec José Del Guerra", 4);

COMMIT;
