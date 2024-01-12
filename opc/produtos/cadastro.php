<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Imagens</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f44336;
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

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #ffffff;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        .form-group textarea {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            resize: vertical;
        }

        .btn-cadastrar {
            background-color: #ffffff;
            color: #f44336;
            font-size: 1.5rem;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .btn-cadastrar:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "eco";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        $cod = $_POST["cod"];
        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];
        $categoria = $_POST["categoria"];
        $tipo = $_POST["tipo"];
        $preco = $_POST["preco"];
        $link = $_POST["link"];
        $quantidade = $_POST["quantidade"];
        $preco_compra = $_POST["preco_compra"];

        $sql = "INSERT INTO imagens (cod, titulo, descricao, categoria, tipo, preco, link, quantidade, preco_compra)
                VALUES ('$cod', '$titulo', '$descricao', '$categoria', '$tipo', $preco, '$link', $quantidade, $preco_compra)";

        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso!";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
        $conn->close();
    }
    ?>

    <a href="../index.php" class="btn-finalizar-compra">Voltar</a>
    <div class="container">
        <h2>Cadastro de Imagens</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="cod">Código:</label>
                <input type="text" name="cod" id="cod" required>
            </div>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <input type="text" name="categoria" id="categoria">
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" name="tipo" id="tipo">
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="number" name="preco" id="preco">
            </div>
            <div class="form-group">
                <label for="link">Link:</label>
                <input type="text" name="link" id="link">
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade">
            </div>
            <div class="form-group">
                <label for="preco_compra">Preço de Compra:</label>
                <input type="number" name="preco_compra" id="preco_compra">
            </div>
            <input class="btn-cadastrar" type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
