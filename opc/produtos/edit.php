<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedId = $_POST["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $newTitle = $_POST["new_title"];
    $newDescription = $_POST["new_description"];
    $newCategory = $_POST["new_category"];
    $newType = $_POST["new_type"];
    $newPrice = $_POST["new_price"];
    $newLink = $_POST["new_link"];
    $newQuantity = $_POST["new_quantity"];
    $newPurchasePrice = $_POST["new_purchase_price"];

    $sql = "UPDATE imagens SET titulo = ?, descricao = ?, categoria = ?, tipo = ?, preco = ?, link = ?, quantidade = ?, preco_compra = ? WHERE cod = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdssdd", $newTitle, $newDescription, $newCategory, $newType, $newPrice, $newLink, $newQuantity, $newPurchasePrice, $selectedId);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Erro ao atualizar os itens: " . $conn->error;
    }
    $id = $_GET["id"];
$sql = "SELECT * FROM imagens WHERE cod = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("d", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentTitle = $row["titulo"];
    $currentDescription = $row["descricao"];
    $currentCategory = $row["categoria"];
    $currentType = $row["tipo"];
    $currentPrice = $row["preco"];
    $currentLink = $row["link"];
    $currentQuantity = $row["quantidade"];
    $currentPurchasePrice = $row["preco_compra"];
}

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form id="voltar" action="./itens.php" method="post">
<input type="submit" value="voltar">
</form>
    <h2>Editar Item</h2>
    <form method="POST" action="">
        <label for="new_title">Novo Título:</label>
        <input type="text" name="new_title" id="new_title" value="<?php echo $currentTitle; ?>" required><br>
        <label for="new_description">Nova Descrição:</label>
        <textarea name="new_description" id="new_description" required><?php echo $currentDescription; ?></textarea><br>
        <label for="new_category">Nova Categoria:</label>
        <input type="text" name="new_category" id="new_category" value="<?php echo $currentCategory; ?>" required><br>
        <label for="new_type">Novo Tipo:</label>
        <input type="text" name="new_type" id="new_type" value="<?php echo $currentType; ?>" required><br>
        <label for="new_price">Novo Preço:</label>
        <input type="number" name="new_price" id="new_price" value="<?php echo $currentPrice; ?>" required><br>
        <label for="new_link">Novo Link:</label>
        <input type="text" name="new_link" id="new_link" value="<?php echo $currentLink; ?>" required><br>
        <label for="new_quantity">Nova Quantidade:</label>
        <input type="number" name="new_quantity" id="new_quantity" value="<?php echo $currentQuantity; ?>" required><br>
        <label for="new_purchase_price">Novo Preço de Compra:</label>
        <input type="number" name="new_purchase_price" id="new_purchase_price" value="<?php echo $currentPurchasePrice; ?>" required><br>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
