<?php
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="container-header">
        <div class="logo">Admin - FUT & E-SPORTS STORE</div>
        <nav class="menu">
            <a href="index.php">Home</a>
        </nav>
    </div>
</header>

<main class="admin-container">

    <h2>Cadastrar Camisa</h2>

    <form action="salvar_produto.php" method="POST" enctype="multipart/form-data">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Categoria:</label>
        <select name="categoria">
            <option value="futebol">Futebol</option>
            <option value="esports">E-Sports</option>
        </select>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" required>

        <label>Tamanho:</label>
        <input type="text" name="tamanho" required>

        <label>Descrição:</label>
        <textarea name="descricao"></textarea>

        <label>Imagem Frente:</label>
        <input type="file" name="imagem_frente" required>

        <label>Imagem Costas:</label>
        <input type="file" name="imagem_costas" required>

        <button type="submit">Salvar Produto</button>

    </form>

    <hr><br>

    <h2>Produtos Cadastrados</h2>

    <?php
    // Buscar produtos
    $sql = "SELECT * FROM camisas ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "<table border='1' class='tabela-admin'>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Tamanho</th>
                    <th>Ações</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nome'] . "</td>
                    <td>" . $row['categoria'] . "</td>
                    <td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>
                    <td>" . $row['tamanho'] . "</td>
                    <td>
                        <a href='detalhes.php?id=" . $row['id'] . "'>Ver</a> |
                        <a href='editar.php?id=" . $row['id'] . "'>Editar</a> |
                        <a href='excluir.php?id=" . $row['id'] . "' onclick=\"return confirm('Excluir este produto?');\">Excluir</a>
                    </td>
                </tr>";
        }

        echo "</table>";

    } else {
        echo "<p>Nenhum produto cadastrado ainda.</p>";
    }
    ?>

</main>
<script src="js/validacao.js"></script>

</body>
</html>
