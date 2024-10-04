<?php
$servername = "localhost";
$username = "root";  // Seu usuário do MySQL
$password = "";      // Sua senha do MySQL
$dbname = "jogadores_db";  // O nome do seu banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
