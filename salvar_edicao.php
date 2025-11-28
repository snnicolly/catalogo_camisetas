<?php
include 'conexao.php';

// Recebe ID
$id = $_POST['id'];

// Recebe campos
$nome = $_POST['nome'];
$categoria = $_POST['categoria'];
$preco = $_POST['preco'];
$tamanho = $_POST['tamanho'];
$descricao = $_POST['descricao'];

// Consulta para pegar imagens antigas
$sql = "SELECT imagem_frente, imagem_costas FROM camisas WHERE id = $id";
$result = $conn->query($sql);
$old = $result->fetch_assoc();

$novaFrente = $old['imagem_frente'];
$novaCostas = $old['imagem_costas'];

// Se enviou nova imagem da frente
if (!empty($_FILES['imagem_frente']['name'])) {
    $novaFrente = $_FILES['imagem_frente']['name'];
    move_uploaded_file($_FILES['imagem_frente']['tmp_name'], "uploads/" . $novaFrente);

    // Remove imagem antiga
    if (file_exists("uploads/" . $old['imagem_frente'])) {
        unlink("uploads/" . $old['imagem_frente']);
    }
}

// Se enviou nova imagem das costas
if (!empty($_FILES['imagem_costas']['name'])) {
    $novaCostas = $_FILES['imagem_costas']['name'];
    move_uploaded_file($_FILES['imagem_costas']['tmp_name'], "uploads/" . $novaCostas);

    // Remove imagem antiga
    if (file_exists("uploads/" . $old['imagem_costas'])) {
        unlink("uploads/" . $old['imagem_costas']);
    }
}

// Atualiza no banco
$sqlUpdate = "
    UPDATE camisas 
    SET nome = '$nome',
        categoria = '$categoria',
        preco = '$preco',
        tamanho = '$tamanho',
        descricao = '$descricao',
        imagem_frente = '$novaFrente',
        imagem_costas = '$novaCostas'
    WHERE id = $id
";

if ($conn->query($sqlUpdate) === TRUE) {
    echo "<h2>Produto atualizado com sucesso!</h2>";
    echo "<a href='admin.php'>Voltar ao Painel</a>";
} else {
    echo "Erro ao atualizar: " . $conn->error;
}
?>
