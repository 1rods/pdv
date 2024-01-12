<!DOCTYPE html>
<html>
<head>
    <title>Frente de Caixa</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Calibri, sans-serif;
            background-color: #f44336;
            color: #ffffff;
        }

        h2 {
            font-family: Impact, sans-serif;
            font-weight: bold;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .secao-vendas {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
            width: 45%;
        }

        .cupom-container {
            background-image: url('caminho_da_imagem_do_cupom.png');
            background-color: #ed0000;
            background-repeat: no-repeat;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
            width: 45%;
        }

        .cupom-container h2 {
            font-family: Impact, sans-serif;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 10px;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .cupom-container pre {
            white-space: pre-wrap;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        .form-group input[type="submit"] {
            background-color: #ffffff;
            color: #f44336;
            font-size: 1rem;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .form-group input[type="submit"]:hover {
            background-color: #f1f1f1;
        }

        .carrinho-total-container {
            width: 45%;
        }

        .carrinho-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
            color: #000000;
        }

        .btn-iniciar-venda {
            background-color: #ff0000;
    color: #ffffff;
    font-size: 1rem;
    border: none;
    padding: -5px 20px;
    cursor: pointer;
    border-radius: 4px;
    }

    .btn-finalizar-compra {
        background-color: #ffffff;
        color: #f44336;
        font-size: 1rem;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 8px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .btn-finalizar-compra:hover {
        background-color: #f1f1f1;
    }
    .btn-add-car{
        background-color: #30ff77;
    color: #ffffff;
    font-size: 1rem;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 8px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
.btn-cup{
    background-color: #ffffff;
    color: #000000;
    font-size: 1rem;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 8px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
}

    </style>
</head>
<body>
    <?php
    session_start();
    require_once '../config.php';
function gerarNumeroVenda()
{
    return time() . '-' . rand(1000, 9999);
}

if (isset($_POST['iniciar_venda'])) {
    $numero_venda = gerarNumeroVenda();
    $query = "INSERT INTO vendas_pdv (numero_venda) VALUES ('$numero_venda')";
    mysqli_query($connection, $query);
    header("Location: venda.php?numero_venda=$numero_venda");
    exit;

}
    function calcularTotal($carrinho)
    {
        $total = 0;
        foreach ($carrinho as $item) {
            $total += $item['quantidade'] * $item['preco'];
        }
        return $total;
    }
    function adicionarAoCarrinho($produto, $quantidade)
    {
        if (isset($_SESSION['carrinho'][$produto['cod']])) {
            $_SESSION['carrinho'][$produto['cod']]['quantidade'] += $quantidade;
        } else {
            $_SESSION['carrinho'][$produto['cod']] = $produto;
            $_SESSION['carrinho'][$produto['cod']]['quantidade'] = $quantidade;
        }
    }

    function removerDoCarrinho($produto_id)
    {
        unset($_SESSION['carrinho'][$produto_id]);
    }

    if (isset($_POST['codigo_produto'])) {
        $codigo_produto = $_POST['codigo_produto'];
        $query = "SELECT * FROM imagens WHERE cod = '$codigo_produto'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $produto = mysqli_fetch_assoc($result);
            if (isset($_POST['quantidade']) && is_numeric($_POST['quantidade']) && $_POST['quantidade'] > 0) {
                $quantidade = intval($_POST['quantidade']);
                adicionarAoCarrinho($produto, $quantidade);
            } else {
                echo "Quantidade inválida.";
            }
        } else {
            echo "Nenhum produto encontrado com o código informado.";
        }
    }

    if (isset($_POST['forma_pagamento'])) {
        $forma_pagamento = $_POST['forma_pagamento'];
        $recibo = "Recibo da Venda\n";
        $recibo .= "Forma de Pagamento: " . $forma_pagamento . "\n";
        $recibo .= "--------------------------------\n";
        foreach ($_SESSION['carrinho'] as $produto_id => $item) {
            $subtotal = $item['quantidade'] * $item['preco'];
            $recibo .= $item['titulo'] . " " . $item['quantidade'] . " x $" . number_format($item['preco'], 2) . " $" . number_format($subtotal, 2) . "\n";
            $quantidade_vendida = $item['quantidade'];
            $nova_quantidade = $item['quantidade'] - $quantidade_vendida;
            $query = "UPDATE produtos SET quantidade = '$nova_quantidade' WHERE cod = '$produto_id'";
            mysqli_query($connection, $query);
        }
        $recibo .= "--------------------------------\n";
        $recibo .= "Total: $" . number_format(calcularTotal($_SESSION['carrinho']), 2);
    }

    if (isset($_POST['remover_produto'])) {
        $produto_id = $_POST['produto_id'];
        removerDoCarrinho($produto_id);
    }

function atualizarQuantidadeVendida($produto, $quantidade_vendida, $connection) {
    $query = "UPDATE imagens SET quantidade = quantidade - '$quantidade_vendida' WHERE cod = '$produto'";
    mysqli_query($connection, $query);
}

if (isset($_POST['forma_pagamento'])) {
    $forma_pagamento = $_POST['forma_pagamento'];
    if (isset($_GET['numero_venda'])) {
        $numero_venda = $_GET['numero_venda'];
        $itens_carrinho = $_SESSION['carrinho'];
        $valor_total = 0;
        foreach ($itens_carrinho as $item) {
            $valor_total += $item['quantidade'] * $item['preco'];
        }
        $itens_vendidos = serialize($itens_carrinho);
        $query = "INSERT INTO vendas_pvp (numero_venda, itens_vendidos, metodo_pagamento, valor_total) VALUES ('$numero_venda', '$itens_vendidos', '$forma_pagamento', '$valor_total')";
        mysqli_query($connection, $query);
        foreach ($itens_carrinho as $produto_id => $codigo_produto) {
            $quantidade_vendida = $codigo_produto['quantidade'];
            atualizarQuantidadeVendida($produto_id, $quantidade_vendida, $connection);
        }
        $_SESSION['carrinho'] = array();
    }
}
    mysqli_close($connection);
    ?>
    <a href="./index.php" class="btn-finalizar-compra">Voltar</a>
    <h2>Seção de Vendas</h2>
    <div class="container">
        <div class="secao-vendas">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="codigo_produto">Pesquise o Produto:</label>
                    <input type="text" name="codigo_produto" id="codigo_produto" required>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" name="quantidade" id="quantidade" required min="1" value="1">
                </div>
                <input type="submit" value="Adicionar ao Carrinho" class="btn-add-car">
            </form>
        </div>
        <div class="cupom-container">
            <?php if (isset($recibo)) { ?>
                <h2>Recibo da Venda</h2>
                <pre><?php echo $recibo; ?></pre>
                <form action="gerar_recibo.php" method="POST" target="_blank">
            <input type="hidden" name="recibo" value="<?php echo $recibo; ?>">
            <input type="submit" value="Gerar Recibo em Nova Aba" class="btn-cup">
        </form>
        <form action="" method="POST">
            <input type="submit" name="iniciar_venda" value="Iniciar Nova Venda" class="btn-cup">
        </form>
            <?php } ?>

            <?php if (!isset($recibo) && isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) { ?>
                <h2 class="total-pagamento">Total e Pagamento</h2>
        <div class="carrinho-total-container">
            <div class="carrinho-container">
                Carrinho:
                <?php
                if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                    foreach ($_SESSION['carrinho'] as $produto_id => $item) {
                        $subtotal = $item['quantidade'] * $item['preco'];
                        echo "<div>";
                        echo "[X] " . $item['titulo'] . " " . $item['quantidade'] . " x $" . number_format($item['preco'], 2) . " $" . number_format($subtotal, 2);
                        echo "<form action='' method='POST'>
                                <input type='hidden' name='produto_id' value='$produto_id'>
                                <input type='submit' name='remover_produto' value='Remover' class='btn-iniciar-venda'>
                            </form>";
                        echo "</div>";
                    }
                } else {
                    echo "Nenhum produto no carrinho.";
                }
                ?>
            </div>
            <div>
                Total: $<?= number_format(calcularTotal($_SESSION['carrinho']), 2) ?>
                <form action="" method="POST">
                    Forma de Pagamento:
                    <input type="radio" name="forma_pagamento" value="dinheiro"> Dinheiro
                    <input type="radio" name="forma_pagamento" value="pix"> Pix
                    <br>
                    <input type="submit" value="Finalizar Compra" class="btn-finalizar-compra">
                </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>