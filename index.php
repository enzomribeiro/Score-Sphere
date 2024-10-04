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

    <style>
    <?php include 'css/style.css'; ?>
    </style>

</head>
<body>

    

    <h1 id="jogadorSelecionado">Selecione um Jogador</h1>
    
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
