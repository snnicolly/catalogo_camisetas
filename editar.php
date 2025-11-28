<?php
include 'conexao.php';

// Verifica ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<h2>ID inválido.</h2>";
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM camisas WHERE id = $id LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<h2>Produto não encontrado.</h2>";
    exit;
}

$camisa = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="container-header">
        <div class="logo">Editar Produto</div>
        <nav class="menu">
            <a href="admin.php">Voltar</a>
        </nav>
    </div>
</header>

<main class="admin-container">

    <h2>Editando: <?php echo $camisa['nome']; ?></h2>

    <form action="salvar_edicao.php" method="POST" enctype="multipart/form-data">

        <!-- ID oculto -->
        <input type="hidden" name="id" value="<?php echo $camisa['id']; ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $camisa['nome']; ?>" required>

        <label>Categoria:</label>
        <select name="categoria">
            <option value="futebol" <?php if($camisa['categoria']=="futebol") echo "selected"; ?>>Futebol</option>
            <option value="esports" <?php if($camisa['categoria']=="esports") echo "selected"; ?>>E-Sports</option>
        </select>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" value="<?php echo $camisa['preco']; ?>" required>

        <label>Tamanho:</label>
        <input type="text" name="tamanho" value="<?php echo $camisa['tamanho']; ?>" required>

        <label>Descrição:</label>
        <textarea name="descricao"><?php echo $camisa['descricao']; ?></textarea>

        <p><strong>Imagem Atual - Frente:</strong></p>
        <img src="uploads/<?php echo $camisa['imagem_frente']; ?>" width="150">

        <label>Trocar Imagem Frente (opcional):</label>
        <input type="file" name="imagem_frente">

        <p><strong>Imagem Atual - Costas:</strong></p>
        <img src="uploads/<?php echo $camisa['imagem_costas']; ?>" width="150">

        <label>Trocar Imagem Costas (opcional):</label>
        <input type="file" name="imagem_costas">

        <button type="submit">Salvar Alterações</button>
    </form>

</main>

</body>
</html>
