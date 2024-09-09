<?php
include 'config.php';

// Processar o formulário de vendas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $fornecedor_id = $_POST['fornecedor_id'];
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];
    $forma_de_pagamento = $_POST['forma_de_pagamento'];
    $transportadora = $_POST['transportadora'];
    $valor_frete = $_POST['valor_frete'];
    $data_venda = date('Y-m-d');

    // Buscar preço do produto
    $produto_query = $conn->query("SELECT preco FROM produtos WHERE id = $produto_id");
    $produto = $produto_query->fetch_assoc();
    $preco = $produto['preco'];

    // Calcular o valor total
    $valor_total = ($preco * $quantidade) + $valor_frete;

    // Inserir venda no banco de dados
    $sql = "INSERT INTO vendas (cliente_id, fornecedor_id, produto_id, quantidade, data_venda, valor_total, forma_de_pagamento, transportadora, valor_frete) 
            VALUES ($cliente_id, $fornecedor_id, $produto_id, $quantidade, '$data_venda', $valor_total, '$forma_de_pagamento', '$transportadora', $valor_frete)";
    if ($conn->query($sql) === TRUE) {
        echo "Venda realizada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Consultar clientes, fornecedores e produtos
$clientes = $conn->query("SELECT * FROM clientes");
$fornecedores = $conn->query("SELECT * FROM fornecedores");
$produtos = $conn->query("SELECT * FROM produtos");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Venda</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Realizar Venda</h2>
    <form method="POST">
        <div class="input-field">
            <select name="cliente_id" required>
                <option value="" disabled selected>Escolha um cliente</option>
                <?php while ($cliente = $clientes->fetch_assoc()): ?>
                    <option value="<?= $cliente['id'] ?>"><?= $cliente['nome'] ?></option>
                <?php endwhile; ?>
            </select>
            <label>Cliente</label>
        </div>

        <div class="input-field">
            <select name="fornecedor_id" required>
                <option value="" disabled selected>Escolha um fornecedor</option>
                <?php while ($fornecedor = $fornecedores->fetch_assoc()): ?>
                    <option value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome_comercial'] ?> - <?= $fornecedor['razao_social'] ?></option>
                <?php endwhile; ?>
            </select>
            <label>Fornecedor</label>
        </div>

        <div class="input-field">
            <select name="produto_id" required>
                <option value="" disabled selected>Escolha um produto</option>
                <?php while ($produto = $produtos->fetch_assoc()): ?>
                    <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?> - R$ <?= $produto['preco'] ?></option>
                <?php endwhile; ?>
            </select>
            <label>Produto</label>
        </div>

        <div class="input-field">
            <input type="number" name="quantidade" id="quantidade" required min="1">
            <label for="quantidade">Quantidade</label>
        </div>

        <div class="input-field">
            <select name="forma_de_pagamento" required>
                <option value="" disabled selected>Escolha a forma de pagamento</option>
                <option value="cartao">Cartão</option>
                <option value="boleto">Boleto</option>
                <option value="transferencia">Transferência</option>
            </select>
            <label>Forma de Pagamento</label>
        </div>

        <div class="input-field">
            <input type="text" name="transportadora" id="transportadora">
            <label for="transportadora">Transportadora</label>
        </div>

        <div class="input-field">
            <input type="number" name="valor_frete" id="valor_frete" step="0.01">
            <label for="valor_frete">Valor do Frete</label>
        </div>

      <button type="button" class="btn waves-effect waves-light" onclick="window.location.href='https://kauanclopes.github.io/'">
        Realizar Compra
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    // Inicializar os selects do Materialize
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
</script>
</body>
</html>
