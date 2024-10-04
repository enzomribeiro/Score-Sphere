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
    <title>Cadastro de Jogador</title>

    <style>
    <?php include 'css/style_cad.css'; ?>
    </style>

</head>
<body>
    <h1>Cadastro de Jogador</h1>
    <form id="formCadastro" method="POST" action="cadastro.php">
        <div class="form-control">
            <label for="nome">Nome do Jogador:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-control">
            <label>Sexo:</label>
            <input type="radio" id="masculino" name="sexo" value="M" required>
            <label for="masculino">Masculino</label>
            <input type="radio" id="feminino" name="sexo" value="F" required>
            <label for="feminino">Feminino</label>
        </div>

        <div class="form-control">
            <label for="escola">Selecione a Escola:</label>
            <select id="escola" name="escola" required>
                <option value="">Selecione</option>
                <option value="Cândido">E.E. "Dr. Cândido Rodrigues"</option>
                <option value="Unigrau">Unigrau</option>
                <option value="João Gabriel">E.E "João Gabriel Ribeiro"</option>
                <option value="Santa Inês">Colégio Santa Inês</option>
                <option value="Euclides">E.E "Euclides da Cunha"</option>
            </select>
        </div>

        <button type="submit">Cadastrar</button>
    </form>

    <h2>Jogadores Cadastrados:</h2>
    <ul id="listaJogadores">
        <?php
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
    </ul>

    <h2><a href="index.php">Inicial</a></h2>
</body>
</html>
