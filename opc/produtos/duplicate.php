<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedIds = $_POST["ids"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    $sql = "INSERT INTO imagens (cod, titulo, descricao) SELECT cod, titulo, descricao FROM imagens WHERE cod = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedIds);
    
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Erro ao duplicar os itens: " . $conn->error;
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
    <h2>Duplicar Itens</h2>
    <form method="POST" action="">
        <input type="hidden" name="ids" value="<?php echo $_GET["ids"]; ?>">
        <input type="submit" value="Duplicar">
    </form>
</body>
</html>
