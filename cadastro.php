<?php
include('db.php');  // Inclui a conexão com o banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $escola = $_POST['escola'];

    // Usando uma declaração preparada para evitar injeção de SQL
    $stmt = $conn->prepare("INSERT INTO jogadores (nome, sexo, escola) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $sexo, $escola);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Jogador cadastrado com sucesso!');</script>";
        echo "<script>window.location.href = 'index.php'; </script>";  // Corrigido
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "');</script>";
    }

    $stmt->close();  // Fecha a declaração
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/iconeBola.ico" type="image/png">
    <title>Cadastro de Jogador</title>

    <style>
    <?php include 'css/style_cad.css'; ?>
    </style>

</head>
<body>
<header>
        <nav>
            <ul>
                <div class="image-container">
                    <img src="img/logo.png" alt="Descrição da imagem">
                </div>
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
            <input type="radio" id="masculino" name="sexo" value="Masculino" required>
            <label for="masculino">Masculino</label>
            <input type="radio" id="feminino" name="sexo" value="Feminino" required>
            <label for="feminino">Feminino</label>
            <input type="radio" id="NaoInformar" name="sexo" value="Não Informardo" required>
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
