<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Vneda</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f44336;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .pdv {
            font-family: Impact, sans-serif;
            font-size: 5rem;
            color: #ffffff;
            text-shadow: 3px 3px 4px rgba(0, 0, 0, 0.6);
            margin-bottom: 20px;
        }

        .btn-iniciar-venda {
            background-color: #ffffff;
            color: #f44336;
            font-size: 1.5rem;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .btn-iniciar-venda:hover {
            background-color: #f1f1f1;
        }
        .btn-voltar {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #ffffff;
            color: #f44336;
            font-size: 1rem;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
<a href="../index.php" class="btn-voltar">Voltar</a>
    <div class="container">
        <div class="pdv">PDV</div>
        <form action="venda.php" method="POST">
            <input class="btn-iniciar-venda" type="submit" name="iniciar_venda" value="Iniciar Venda">
        </form>
    </div>
</body>
</html>
