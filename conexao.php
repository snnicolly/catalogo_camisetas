
<?php
$host = "localhost";       // Servidor do MySQL
$usuario = "root";         // Usuário padrão do XAMPP
$senha = "";               // Senha padrão do XAMPP (normalmente vazio)
$banco = "catalogo_camisas";  // Nome do banco de dados

// Cria a conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se deu certo
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>

