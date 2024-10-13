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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/iconeBola" type="image/png">
    <title>Consultar</title>
    <style>
    <?php include 'css/style_jg.css'; ?>
    </style>
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="cadastro.php">Cadastrar Jogadores</a></li>
                <li><a href="consultarJogadores.php">Jogadores</a></li>
                <li><a href="filtrar.php">Pontuação Geral</a></li>
                <li><a id="connectButton">Conectar ao Arduino</a></li>
</header>

    <h1>Jogadores Cadastrados:</h1>
    <div class="lista">
   <?php
// Recupera todos os jogadores cadastrados
$sql = "SELECT * FROM jogadores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Inicia a tabela
    echo "<table border='1'>";
    echo "<tr><th>Nome</th><th>Sexo</th><th>Escola</th></tr>"; // Cabeçalho da tabela

    // Saída dos dados de cada linha
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . ($row['sexo'] == 'M' ? 'Masculino' : ($row['sexo'] == 'F' ? 'Feminino' : 'Não Informado')) . "</td>";
        echo "<td>" . $row['escola'] . "</td>";
        echo "</tr>";
    }

    // Fecha a tabela
    echo "</table>";
} else {
    echo "Nenhum jogador cadastrado";
}
?>

    </div>
</body>
</html>
