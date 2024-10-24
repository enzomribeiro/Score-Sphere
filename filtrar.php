<?php
include('db.php'); 

$filtro = $_POST['filtro'] ?? '';
$pesquisa = $_POST['pesquisa'] ?? '';
$pesquisaEscola = $_POST['pesquisaEscola'] ?? '';
$pesquisaSexo = $_POST['pesquisaSexo'] ?? '';

$sql = "SELECT * FROM jogadores";
$params = [];

if ($filtro == 'nome') {
    $sql .= " WHERE nome LIKE ? ORDER BY nome";
    $params[] = "%$pesquisa%";
} elseif ($filtro == 'sexo') {
    $sql .= " WHERE sexo = ? ORDER BY sexo";
    $params[] = $pesquisaSexo;
} elseif ($filtro == 'escola') {
    $sql .= " WHERE escola = ? ORDER BY escola";
    $params[] = $pesquisaEscola;
}

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo "Erro: " . $conn->error;
}

$escolasQuery = "SELECT DISTINCT escola FROM jogadores ORDER BY escola ASC";
$escolasResult = $conn->query($escolasQuery);
$sexoQuery = "SELECT DISTINCT sexo FROM jogadores ORDER BY sexo ASC";
$sexoResult = $conn->query($sexoQuery);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/iconeTrofeu.ico" type="image/png">
    <title>Pontuação</title>
  
    <style>
        <?php include 'css/style_fil.css'; ?>
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
    $('input[name="filtro"]').change(function() {
        const filtroSelecionado = $(this).val();

        // Alterna a visibilidade com base no filtro selecionado
        $('#pesquisa').toggle(filtroSelecionado === 'nome'); // Mostra apenas para nome
        $('#selectEscola').toggle(filtroSelecionado === 'escola'); // Mostra o select para escola
        $('#selectSexo').toggle(filtroSelecionado === 'sexo'); // Mostra o select para sexo
    });

            $('#pesquisa').keyup(function() {
                const val = $.trim(this.value);
                if (val !== "") {
                    $.ajax({
                        url: 'buscarJogadores.php', 
                        method: 'GET',
                        data: { query: val }, 
                        success: function(data) {
                            const jogadores = JSON.parse(data); 
                            let output = ''; 

                            jogadores.forEach(function(jogador) {
                                output += '<div class="jogador">';
                                output += `<p><strong>Nome:</strong> ${jogador.nome}<br><strong>Escola:</strong> ${jogador.escola}</p>`;
                                output += '</div>';
                            });
                            $('#resultadoBusca').html(output);
                        }
                    });
                } else {
                    $('#resultadoBusca').html('');
                }
            });
        });
    </script>
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
        </ul>
    </nav>
</header>

<form method="POST" action="filtrar.php">
    <div id="filtro">
        <label>Filtro:</label>
        <input type="radio" id="nome" name="filtro" value="nome" required>
        <label for="nome">Nome</label>

        <input type="radio" id="sexo" name="filtro" value="sexo" required>
        <label for="sexo">Sexo</label>

        <input type="radio" id="escola" name="filtro" value="escola" required>
        <label for="escola">Escola</label>

        <select id="selectEscola" name="pesquisaEscola" style="display:none;"> 
            <option value="">Selecione uma escola</option>
            <?php
            if ($escolasResult->num_rows > 0) {
                while ($escola = $escolasResult->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($escola['escola']) . "'>" . htmlspecialchars($escola['escola']) . "</option>";
                }
            }
            ?>
        </select>

        <select id="selectSexo" name="pesquisaSexo" style="display:none;"> 
            <option value="">Selecione um sexo</option>
            <?php
            if ($sexoResult->num_rows > 0) {
                while ($sexo = $sexoResult->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($sexo['sexo']) . "'>" . htmlspecialchars($sexo['sexo']) . "</option>";
                }
            }
            ?>
        </select>

        <input type="text" id="pesquisa" name="pesquisa" placeholder="Pesquisar por..." value="<?php echo htmlspecialchars($pesquisa); ?>">
        <button type="submit">Filtrar</button>
    </div>
</form>

<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nome</th><th>Sexo</th><th>Escola</th><th>Pontuação</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sexo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['escola']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pontuacao']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum jogador encontrado.";
}
$stmt->close();
$conn->close();
?>
</body>
</html>
