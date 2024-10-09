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
<header>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="cadastro.php">Jogadores</a></li>
                <li><a href="consultarJogadores.php">Consultar Jogadores</a></li>
                <li><a href="filtrar.php">Buscar</a></li>
                <li><a id="connectButton">Conectar ao Arduino</a></li>
</header>
    <div class="container">
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
                <option value="Cândido">E.E. Doutor Cândido Rodrigues</option>
                <option value="Unigrau">Colegio Unigrau</option>
                <option value="João Gabriel">E.E. Doutor João Gabriel Ribeiro</option>
                <option value="Santa Inês">Colégio Santa Inês</option>
                <option value="Coc">Escola De Grau Em Grau Coc</option>
                <option value="Euclides">E.E. Euclides da Cunha</option>
                <option value="Lumen">Colegio Lumen</option>
                <option value="Stella Maris">EMEB Professora Stella Maris Barbosa Catalano</option>
                <option value="Fundação">Fundação Educacional </option>
                <option value="Laudelina">E.E. Professora Laudelina de Oliveira Pourrat</option>
                <option value="Sylvia Portugal">E.E. Professora Sylvia Portugal Gouvêa De Sylos</option>
                <option value="Stella Couvert">E.E. Professora Stella Couvert Ribeiro</option>
                <option value="Etec">Etec Professor Rodolpho José Del Guerra</option>
            </select>
        </div>

        <button type="submit">Cadastrar</button>
    </form>
    </div>
</body>
</html>
