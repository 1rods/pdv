<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Index - Barra de Opções</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Calibri, sans-serif;
        }

        .navbar {
            background-color: #f44336;
            display: flex;
            justify-content: space-between;
            padding: 10px;
            color: #ffffff;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: #000000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .tab-content {
            display: none;
            padding: 20px;
            background-color: #ffffff;
        }

        .inicio-tab {
            display: block;
        }
    </style>
</head>
<body>
<div class="navbar">
        <div>
            <div class="dropdown">
                <span>≡</span>
                <div class="dropdown-content">
                    <a href="#" onclick="showTab('inicio')">Inicio</a>
                    <a href="./pdv/index.php">Vendas</a>
                    <a href="./produtos/cadastro.php">Cadastrar Produtos</a>
                    <a href="./produtos/itens.php">Produtos</a>
                </div>
            </div>
        </div>
        <div>
            <span>eVendas</span>
        </div>
        <div>
            <div class="dropdown">
                <span><?php echo $_SESSION['username']; ?></span>
                <div class="dropdown-content">
                    <form method="post">
                        <button type="submit" name="logout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content inicio-tab">
    </div>
    <script>
        function showTab(tabId) {
            var tabs = document.getElementsByClassName('tab-content');
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].style.display = 'none';
            }
            document.getElementById(tabId).style.display = 'block';
        }
    </script>
</body>
</html>
