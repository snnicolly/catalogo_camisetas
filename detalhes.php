<?php
include 'conexao.php';

// Validação se ID foi enviado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<h2>Produto inválido.</h2>";
    exit;
}

$id = intval($_GET['id']);

// Busca o produto
$sql = "SELECT * FROM camisas WHERE id = $id LIMIT 1";
$result = $conn->query($sql);

// Se não encontrar
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
    <title><?php echo $camisa['nome']; ?> - Detalhes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="container-header">
        <div class="logo">FUT & E-SPORTS STORE</div>
        <nav class="menu">
            <a href="index.php">Home</a>
            <a href="admin.php">Admin</a>
        </nav>
    </div>
</header>

<main class="detalhes-container">

    <div class="detalhes-img">
        <img src="uploads/<?php echo $camisa['imagem_frente']; ?>" alt="Imagem da frente">
        <img src="uploads/<?php echo $camisa['imagem_costas']; ?>" alt="Imagem das costas">
    </div>

    <div class="detalhes-info">
        <h2><?php echo $camisa['nome']; ?></h2>

        <p><strong>Categoria:</strong> <?php echo ucfirst($camisa['categoria']); ?></p>
        <p><strong>Preço:</strong> R$ <?php echo number_format($camisa['preco'], 2, ',', '.'); ?></p>

        <!-- Select de tamanho -->
        <label for="tamanho"><strong>Escolha o tamanho:</strong></label>
        <select id="tamanho">
            <option value="P">P</option>
            <option value="M" selected>M</option>
            <option value="G">G</option>
            <option value="GG">GG</option>
        </select>

        <!-- Quantidade -->
        <div class="quantidade-container">
            <button type="button" id="diminuir">-</button>
            <input type="number" id="quantidade" value="1" min="1">
            <button type="button" id="aumentar">+</button>
        </div>

        <?php if (!empty($camisa['descricao'])): ?>
            <p><strong>Descrição:</strong><br><?php echo nl2br($camisa['descricao']); ?></p>
        <?php else: ?>
            <p><strong>Descrição:</strong> Nenhuma descrição cadastrada.</p>
        <?php endif; ?>

        <!-- Botões -->
        <button class="btn-whatsapp" id="btn-whatsapp">Comprar via WhatsApp</button>
        <button class="btn-voltar" onclick="window.history.back()">Voltar</button>
    </div>

</main>

<script>
    const btnWhatsApp = document.getElementById('btn-whatsapp');
    const quantidadeInput = document.getElementById('quantidade');
    const produto = "<?php echo $camisa['nome']; ?>";
    const telefone = "5591991445427"; // Seu número
    const tamanhoSelect = document.getElementById('tamanho');

    // Botões de aumentar/diminuir quantidade
    document.getElementById('aumentar').addEventListener('click', () => {
        quantidadeInput.value = parseInt(quantidadeInput.value) + 1;
    });
    document.getElementById('diminuir').addEventListener('click', () => {
        if (parseInt(quantidadeInput.value) > 1) {
            quantidadeInput.value = parseInt(quantidadeInput.value) - 1;
        }
    });

    // WhatsApp
    btnWhatsApp.addEventListener('click', () => {
        const tamanho = tamanhoSelect.value;
        const quantidade = quantidadeInput.value;
        const mensagem = `Boa tarde, gostaria da camisa ${produto}, tamanho ${tamanho}, quantidade ${quantidade}.`;
        const url = `https://api.whatsapp.com/send?phone=${telefone}&text=${encodeURIComponent(mensagem)}`;
        window.open(url, '_blank');
    });
</script>

</body>
</html>
