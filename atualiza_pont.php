<?php
include('db.php');  // Inclui a conexão com o banco de dados

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados enviados
    $nome = $_POST['nome'] ?? null;
    $pontuacao = $_POST['pontuacao'] ?? null;

    // Verifica se os dados são válidos
    if ($nome && $pontuacao) {
        // Prepare a consulta SQL para atualizar a pontuação
        $sql = "UPDATE jogadores SET pontuacao = pontuacao + ? WHERE nome = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $pontuacao, $nome); // "is" significa integer e string

        // Executa a consulta
        if ($stmt->execute()) {
            echo "Pontuação atualizada com sucesso!";
        } else {
            echo "Erro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Dados inválidos: ID ou pontuação não foram recebidos corretamente.";
    }
} else {
    echo "Método não permitido.";
}
error_log("Nome: $nome, Pontuação: $pontuacao");

?>
