<?php
include 'conexao.php';

$nome = $_POST['nome'];
$categoria = $_POST['categoria'];
$preco = $_POST['preco'];
$tamanho = $_POST['tamanho'];
$descricao = $_POST['descricao'];

$imgFrente = $_FILES['imagem_frente']['name'];
$imgCostas = $_FILES['imagem_costas']['name'];

move_uploaded_file($_FILES['imagem_frente']['tmp_name'], "uploads/" . $imgFrente);
move_uploaded_file($_FILES['imagem_costas']['tmp_name'], "uploads/" . $imgCostas);

$sql = "INSERT INTO camisas (nome, categoria, preco, tamanho, descricao, imagem_frente, imagem_costas)
        VALUES ('$nome', '$categoria', '$preco', '$tamanho', '$descricao', '$imgFrente', '$imgCostas')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Produto cadastrado com sucesso!</h2>";
    echo "<a href='admin.php'>Voltar</a>";
} else {
    echo "Erro: " . $conn->error;
}
?>
