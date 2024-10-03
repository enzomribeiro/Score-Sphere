<?php
    include('./PHP/db.php');  // Inclui a conexão com o banco de dados

    // Recupera todos os jogadores cadastrados
    $sql = "SELECT * FROM jogadores";
    $result = $conn->query($sql);
    $jogadores = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jogadores[] = $row;  // Adiciona cada jogador ao array
        }
    }
?>