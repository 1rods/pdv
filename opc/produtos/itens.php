<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            cursor: pointer;
        }

        .selected {
            background-color: #f0f0f0;
        }

        .functions-bar {
            display: none;
            margin-top: 10px;
            background-color: red;
            padding: 5px;
        }

        .functions-bar.active {
            display: block;
        }

        .back-button {
            background-color: #ffffff;
            color: #000000;
            font-size: 1.5rem;
            border: none;
            padding: 8px 10px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .search-container {
            margin-top: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-box {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 80%;
            max-width: 300px;
        }
    </style>
</head>
<body>
    </div>
    <div class="container">
        <div class="search-container">
        <form id="voltar" action="../index.php" method="post">
  <input class="back-button" type="submit" value="voltar">
</form>
            <h2>ㅤㅤItens do Banco de Dadosㅤㅤㅤ</h2><h4>Pesquisar:ㅤ</h4>
            <input type="text" class="search-box" id="search-box" placeholder="Pesquisar...">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Selecionar</th>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Descrição</th>
                </tr>
    </thead>
<tbody>
<?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "eco";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM imagens";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' class='item-checkbox'></td>";
                        echo "<td class='cod'>" . $row["cod"] . "</td>";
                        echo "<td>" . $row["titulo"] . "</td>";
                        echo "<td>" . $row["descricao"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum resultado encontrado.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="functions-bar" id="functions-bar">
            <button id="btn-edit">Editar</button>
            <button id="btn-duplicate">Duplicar</button>
            <button id="btn-delete">Excluir</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".item-checkbox");
            const functionsBar = document.getElementById("functions-bar");
            const searchBox = document.getElementById("search-box");

            checkboxes.forEach(checkbox => {
            });
            searchBox.addEventListener("input", function() {
                const searchTerm = searchBox.value.toLowerCase();
                const rows = document.querySelectorAll("tbody tr");

                rows.forEach(row => {
                    const titleCell = row.querySelector("td:nth-child(3)");
                    const descriptionCell = row.querySelector("td:nth-child(4)");

                    const title = titleCell.textContent.toLowerCase();
                    const description = descriptionCell.textContent.toLowerCase();

                    if (title.includes(searchTerm) || description.includes(searchTerm)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".item-checkbox");
            const functionsBar = document.getElementById("functions-bar");

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    const row = this.parentNode.parentNode;
                    if (this.checked) {
                        row.classList.add("selected");
                    } else {
                        row.classList.remove("selected");
                    }

                    const selectedItems = document.querySelectorAll(".item-checkbox:checked");
                    if (selectedItems.length > 0) {
                        functionsBar.classList.add("active");
                    } else {
                        functionsBar.classList.remove("active");
                    }
                });
            });

            const btnEdit = document.getElementById("btn-edit");
            const btnDuplicate = document.getElementById("btn-duplicate");
            const btnDelete = document.getElementById("btn-delete");

            btnEdit.addEventListener("click", function() {
                const selectedItems = document.querySelectorAll(".item-checkbox:checked");
                const selectedIds = Array.from(selectedItems).map(item => item.closest("tr").querySelector(".cod").textContent);
                window.location.href = `edit.php?ids=${selectedIds.join(",")}`;
            });

            btnDuplicate.addEventListener("click", function() {
                const selectedItems = document.querySelectorAll(".item-checkbox:checked");
                const selectedIds = Array.from(selectedItems).map(item => item.closest("tr").querySelector(".cod").textContent);
                window.location.href = `duplicate.php?ids=${selectedIds.join(",")}`;
            });

            btnDelete.addEventListener("click", function() {
                const selectedItems = document.querySelectorAll(".item-checkbox:checked");
                const selectedIds = Array.from(selectedItems).map(item => item.closest("tr").querySelector(".cod").textContent);
                if (confirm("Tem certeza que deseja excluir os itens selecionados?")) {
                    window.location.href = `delete.php?ids=${selectedIds.join(",")}`;
                }
            });
        });
    </script>
</body>
</html>