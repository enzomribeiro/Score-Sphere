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

COMMIT;
