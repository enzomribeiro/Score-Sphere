<?php
include('db.php');  // Inclui a conexão com o banco de dados

// Inicializa as variáveis
$filtro = "";
$valores = [];

// Verifica se o filtro foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filtro = $_POST['filtro'];

    // Define a consulta SQL com base no filtro
    if ($filtro === 'nome') {
        $sql = "SELECT DISTINCT nome FROM jogadores";
    } elseif ($filtro === 'sexo') {
        $sql = "SELECT DISTINCT sexo FROM jogadores";
    } elseif ($filtro === 'escola') {
        $sql = "SELECT DISTINCT escola FROM jogadores";
    }

    // Executa a consulta
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $valores[] = $row;  // Adiciona os resultados ao array de valores
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pontuação</title>
</head>
<body>

    <form method="POST" action="pontuacao.php">
        <label>Filtro:</label>
        <input type="radio" id="nome" name="filtro" value="nome" required>
        <label for="nome">Nome</label>

        <input type="radio" id="sexo" name="filtro" value="sexo" required>
        <label for="sexo">Sexo</label>

        <input type="radio" id="escola" name="filtro" value="escola" required>
        <label for="escola">Escola</label>

        <button type="submit">Filtrar</button>
    </form>

    <div id="filtroContainer">
        <?php if (!empty($valores)): ?>
            <h2>Resultados do Filtro:</h2>
            <ul>
                <?php
                foreach ($valores as $valor) {
                    if ($filtro === 'nome') {
                        echo "<li>Nome: " . htmlspecialchars($valor['nome']) . "</li>";
                    } elseif ($filtro === 'sexo') {
                        echo "<li>Sexo: " . htmlspecialchars($valor['sexo']) . "</li>";
                    } elseif ($filtro === 'escola') {
                        echo "<li>Escola: " . htmlspecialchars($valor['escola']) . "</li>";
                    }
                }
                ?>
            </ul>
        <?php endif; ?>
    </div>

    <h2><a href="index.php">Inicial</a></h2>

</body>
</html>
