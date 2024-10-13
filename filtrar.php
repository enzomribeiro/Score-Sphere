<?php
include('db.php'); 

$filtro = isset($_POST['filtro']) ? $_POST['filtro'] : '';
$pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

$sql = "SELECT * FROM jogadores";

if ($filtro == 'nome') {
    $sql .= " WHERE nome LIKE '%$pesquisa%' ORDER BY nome";
} else if ($filtro == 'sexo') {
    $sql .= " WHERE sexo LIKE '%$pesquisa%' ORDER BY sexo";
} else if ($filtro == 'escola') {
    $sql .= " WHERE escola = '$pesquisa' ORDER BY escola";
}

$result = $conn->query($sql);

if (!$result) {
    echo "Erro: " . $conn->error;
}

$escolasQuery = "SELECT DISTINCT escola FROM jogadores ORDER BY escola ASC";
$escolasResult = $conn->query($escolasQuery);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/iconeTrofeu" type="image/png">
    <title>Pontuação</title>

    <style>
        <?php include 'css/style_fil.css'; ?>
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="filtro"]').change(function() {
                if ($(this).val() == 'escola') {
                    $('#pesquisa').hide(); // Esconde a barra de pesquisa
                    $('#selectEscola').show(); // Mostra o select
                } else {
                    $('#pesquisa').show(); // Mostra a barra de pesquisa
                    $('#selectEscola').hide(); // Esconde o select
                }
            });

            $('#pesquisa').keyup(function() {
                var val = $.trim(this.value);

                if (val !== "") {
                    $.ajax({
                        url: 'buscarJogadores.php', 
                        method: 'GET',
                        data: { query: val }, 
                        success: function(data) {
                            var jogadores = JSON.parse(data); 
                            var output = ''; 

                            jogadores.forEach(function(jogador) {
                                output += '<div class="jogador">';
                                output += '<p><strong>Nome:</strong> ' + jogador.nome + '<p><strong> Escola:</strong> ' + jogador.escola + '</p>' + '</p>';
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


        <select id="selectEscola" name="pesquisa" style="display:none;"> 
            <option value="">Selecione uma escola</option>
            <?php
            if ($escolasResult->num_rows > 0) {
     
                while ($escola = $escolasResult->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($escola['escola']) . "'>" . htmlspecialchars($escola['escola']) . "</option>";
                }
            }
            ?>
        </select>

        <input type="text" id="pesquisa" name="pesquisa" placeholder="Pesquisar por..." value="<?php echo htmlspecialchars($pesquisa); ?>">
        <button type="submit">Filtrar</button>
        <div id="resultadoBusca"></div>
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

?>
</body>
</html>
