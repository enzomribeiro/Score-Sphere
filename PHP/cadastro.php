<?php
include('db.php');  // Inclui a conexão com o banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $escola = $_POST['escola'];

    // Inserir o jogador no banco de dados
    $sql = "INSERT INTO jogadores (nome, sexo, escola) VALUES ('$nome', '$sexo', '$escola')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Jogador cadastrado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro: " . $conn->error . "');</script>";
    }
}

    // Recupera todos os jogadores cadastrados
    $sql = "SELECT * FROM jogadores";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Saída dos dados de cada linha
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['nome'] . " - " . ($row['sexo'] == 'M' ? 'Masculino' : 'Feminino') . " - " . $row['escola'] . "</li>";
        }
    } else {
        echo "<li>Nenhum jogador cadastrado</li>";
}
?>