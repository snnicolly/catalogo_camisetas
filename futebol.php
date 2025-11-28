<?php
include 'conexao.php';

// Consulta apenas camisas de Futebol
$sql = "SELECT * FROM camisas WHERE categoria = 'futebol'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camisas de Futebol</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Menu -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="futebol.php">Futebol</a></li>
            <li><a href="esports.php">E-Sports</a></li>
        </ul>
    </nav>

    <!-- Banner -->
    <header>
        <h1>Camisas de Futebol 2025</h1>
    </header>

    <!-- Catálogo -->
    <main>
        <div class="catalogo">
            <?php
            if ($result->num_rows > 0) {
                while($camisa = $result->fetch_assoc()) {
                    echo '<div class="produto">';
                    echo '<img src="uploads/'.$camisa['imagem'].'" alt="'.$camisa['nome'].'">';
                    echo '<h2>'.$camisa['nome'].'</h2>';
                    echo '<p>R$ '.$camisa['preco'].'</p>';
                    echo '</div>';
                }
            } else {
                echo "<p>Nenhuma camisa de Futebol cadastrada.</p>";
            }
            ?>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <p>Loja de Camisas &copy; 2025</p>
    </footer>
</body>
</html>
