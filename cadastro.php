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
                <li><a href="cadastro.php">Cadastrar Jogadores</a></li>
                <li><a href="consultarJogadores.php">Jogadores</a></li>
                <li><a href="filtrar.php">Pontuação Geral</a></li>
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
            <input type="radio" id="NaoInformar" name="sexo" value="*" required>
            <label for="NaoInformar">Não Informar</label>
        </div>

        <div class="form-control">
            <label for="escola">Selecione a Escola:</label>
            <select id="escola" name="escola" required>
                <option value="">Selecione</option>
                <option value="E.E. Doutor Cândido Rodrigues">E.E. Doutor Cândido Rodrigues</option>
                <option value="Colégio Unigrau">Colégio Unigrau</option>
                <option value="E.E. Doutor João Gabriel Ribeiro">E.E. Doutor João Gabriel Ribeiro</option>
                <option value="Colégio Santa Inês">Colégio Santa Inês</option>
                <option value="Escola De Grau Em Grau Coc">Escola De Grau Em Grau Coc</option>
                <option value="E.E. Euclides da Cunha">E.E. Euclides da Cunha</option>
                <option value="Colégio Lumen">Colégio Lumen</option>
                <option value="EMEB Professora Stella Maris Barbosa Catalano">EMEB Professora Stella Maris Barbosa Catalano</option>
                <option value="Fundação Educacional">Fundação Educacional</option>
                <option value="E.E. Professora Laudelina de Oliveira Pourrat">E.E. Professora Laudelina de Oliveira Pourrat</option>
                <option value="E.E. Professora Sylvia Portugal Gouvêa De Sylos">E.E. Professora Sylvia Portugal Gouvêa De Sylos</option>
                <option value="E.E. Professora Stella Couvert Ribeiro">E.E. Professora Stella Couvert Ribeiro</option>
                <option value="Etec Professor Rodolpho José Del Guerra">Etec Professor Rodolpho José Del Guerra</option>
                <option value="Outro">Outro</option>
            </select>
        </div>

        <button type="submit">Cadastrar</button>
    </form>
    </div>
</body>
</html>
