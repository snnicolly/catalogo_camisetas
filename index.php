<?php
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>FUT & E-SPORTS STORE</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="container-header">
        <div class="logo">FUT & E-SPORTS STORE</div>
        <nav class="menu">
            <a href="index.php">Home</a>
            <a href="#futebol">Futebol</a>
            <a href="#esports">E-Sports</a>
            <a href="admin.php">Admin</a>
        </nav>
    </div>
</header>

<section class="banner-principal">
    <div class="banner-conteudo">
        <h2>Bem-vindo à FUT & E-SPORTS STORE</h2>
        <p>Confira nossas camisas de futebol e e-sports</p>
        <a href="#catalogo" class="btn-banner">Ver Catálogo</a>
    </div>
</section>

<main>
    <h2 id="catalogo">Catálogo de Camisas</h2>

    <!-- FUTEBOL -->
    <h3 id="futebol">Camisas de Futebol</h3>
    <div class="catalogo">
    <?php
        $sql = "SELECT * FROM camisas WHERE categoria = 'futebol'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="uploads/' . $row["imagem_frente"] . '" alt="' . $row["nome"] . '">';
                echo '<h3>' . $row["nome"] . '</h3>';
                echo '<p>R$ ' . number_format($row["preco"], 2, ',', '.') . '</p>';
                echo '<button onclick="window.location.href=\'detalhes.php?id=' . $row["id"] . '\'">Ver Detalhes</button>';
                echo '</div>';
            }
        } else {
            echo "<p>Nenhuma camisa de futebol cadastrada ainda.</p>";
        }
    ?>
    </div>

    <!-- E-SPORTS -->
    <h3 id="esports">Camisas de E-Sports</h3>
    <div class="catalogo">
    <?php
        $sql = "SELECT * FROM camisas WHERE categoria = 'esports'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="uploads/' . $row["imagem_frente"] . '" alt="' . $row["nome"] . '">';
                echo '<h3>' . $row["nome"] . '</h3>';
                echo '<p>R$ ' . number_format($row["preco"], 2, ',', '.') . '</p>';
                echo '<button onclick="window.location.href=\'detalhes.php?id=' . $row["id"] . '\'">Ver Detalhes</button>';
                echo '</div>';
            }
        } else {
            echo "<p>Nenhuma camisa de e-sports cadastrada ainda.</p>";
        }
    ?>
    </div>
</main>

<footer>
    <p>FUT & E-SPORTS STORE © 2025</p>
    <div class="redes-sociais">
        <a href="#">Instagram</a> |
        <a href="#">Facebook</a> |
        <a href="#">Twitter</a>
    </div>
</footer>

</body>
</html>
