// Seleciona o formulário pelo ID
const formCamisa = document.getElementById('formCamisa');

if (formCamisa) {
    formCamisa.addEventListener('submit', function(e) {
        // Pega os valores dos campos
        let nome = document.getElementById('nome').value.trim();
        let categoria = document.getElementById('categoria').value;
        let preco = document.getElementById('preco').value.trim();
        let tamanho = document.getElementById('tamanho').value.trim();

        // Array para armazenar mensagens de erro
        let erros = [];

        // Validações
        if(nome === '') erros.push("O campo Nome é obrigatório.");
        if(categoria === '') erros.push("Selecione uma Categoria.");
        if(preco === '' || isNaN(preco) || parseFloat(preco) <= 0) erros.push("Preço inválido.");
        if(tamanho === '') erros.push("O campo Tamanho é obrigatório.");

        // Se houver erros, impede o envio e mostra alert
        if(erros.length > 0) {
            e.preventDefault(); // impede envio do formulário
            alert(erros.join("\n")); // exibe todos os erros
        }
    });
}
