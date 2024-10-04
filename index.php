<?php
include('db.php');  // Inclui a conexão com o banco de dados

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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Detecções</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
    body {
        display: flex; /* Ativa o Flexbox */
        flex-direction: column; /* Organiza os itens em coluna */
        align-items: center; /* Centraliza horizontalmente */
        justify-content: center; /* Centraliza verticalmente */
        height: 100vh; /* Ocupa toda a altura da tela */
        margin: 0; /* Remove a margem padrão */
        font-family: Arial, sans-serif;
        text-align: center;
        background-image: url(basquete.jpg);
        background-size: cover; /* Para cobrir toda a tela */
    }

    h1 {
    font-size: 85px;
    }

    #counter {
    font-size: 80px;
    color: black
    }

    button {
    padding: 10px 20px;
    font-size: 25px;
    margin-top: 20px;
    border-radius: 15px;
    }

    a {
        color: #800000;
    }
    </style>

    <h1 id="jogadorSelecionado">Selecione um Jogador</h1>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    
    <label for="jogadores">Escolha um jogador:</label>
    <select id="jogadores">
        <option value="">Selecione um jogador</option>
        <?php foreach ($jogadores as $jogador): ?>
            <option value="<?php echo htmlspecialchars($jogador['nome']); ?>"><?php echo htmlspecialchars($jogador['nome']); ?></option>
        <?php endforeach; ?>
    </select>

  
    <div id="counter">0</div>
    <button id="connectButton">Conectar ao Arduino</button>
    
    <script src="script/script.js"></script>
    <h2><a href="cadastro.php">Jogadores</a></h2>
    <h2><a href="filtrar.php">Pontuação</a></h2>

</body>
</html>
