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
<header>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="cadastro.php">Jogadores</a></li>
                <li><a href="consultarJogadores.php">Consultar Jogadores</a></li>
                <li><a href="filtrar.php">Buscar</a></li>
                <li><a id="connectButton">Conectar ao Arduino</a></li>
                <li><label for="jogadores">Escolha um jogador:</label></li>
                <li><select id="jogadores">
                    <option value="">Selecione um jogador</option>
                        <?php foreach ($jogadores as $jogador): ?>
                    <option value="<?php echo htmlspecialchars($jogador['nome']); ?>"><?php echo htmlspecialchars($jogador['nome']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
            </ul>
        </nav>
    </header>
    

    <h1 id="jogadorSelecionado">Selecione um Jogador</h1>
    <div id="counter">0</div>
    <script src="script/script.js"></script>

</body>
</html>
