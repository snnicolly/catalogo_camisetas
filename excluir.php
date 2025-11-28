<?php
include 'conexao.php';

// Verifica se ID foi enviado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<h2>ID inválido.</h2>";
    exit;
}

$id = intval($_GET['id']);

// Primeiro busca as imagens para apagar da pasta
$sqlImg = "SELECT imagem_frente, imagem_costas FROM camisas WHERE id = $id";
$resultImg = $conn->query($sqlImg);

if ($resultImg->num_rows > 0) {
    $img = $resultImg->fetch_assoc();

    // Apagar as imagens da pasta
    if (file_exists("uploads/" . $img['imagem_frente'])) {
        unlink("uploads/" . $img['imagem_frente']);
    }
    if (file_exists("uploads/" . $img['imagem_costas'])) {
        unlink("uploads/" . $img['imagem_costas']);
    }
}

// Apaga o registro do banco
$sql = "DELETE FROM camisas WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Produto excluído com sucesso!</h2>";
    echo "<a href='admin.php'>Voltar</a>";
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>
