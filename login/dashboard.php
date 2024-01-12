<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require_once '../config.php';
$username = $_SESSION["username"];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Bem-vindo, " . $row['username'] . "!</h2>";
} else {
    echo "Não foi possível encontrar as informações do usuário.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Protegida</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Página Protegida</h2>
    <p>Esta é uma página protegida que requer autenticação.</p>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>
