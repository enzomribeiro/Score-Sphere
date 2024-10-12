<?php
include('db.php');

if (isset($_GET['query'])) {
    $pesquisa = $_GET['query'];

    // Faz uma busca no banco de dados pelos jogadores cujo nome contenha a pesquisa
    $sql = "SELECT nome, sexo, escola, pontuacao FROM jogadores WHERE nome LIKE '%$pesquisa%' ORDER BY nome";
    $result = $conn->query($sql);

    $jogadores = [];

    // Verifica se há resultados e adiciona ao array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jogadores[] = $row;
        }
    }

    // Retorna o array de jogadores como JSON
    echo json_encode($jogadores);
}
?>
