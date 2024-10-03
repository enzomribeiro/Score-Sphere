<?php
    include('./PHP/db.php');  // Inclui a conexão com o banco de dados

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
<?php endif; ?>