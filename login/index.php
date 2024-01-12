<?php
session_start();

require_once '../opc/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($hostname, $username, $password, $database);
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["username"] = $username;
        header("Location: ../opc/index.php");
        exit();
    } else {
        $error = "Usuário ou senha inválidos.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Entrar</h2>
<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="action" value="login">
			<h1>Login</h1>
            <input type="text" placeholder="username" name="username" required>
            <input type="password" placeholder="password" name="password" required>
			<a href="#">Esqueceu a senha?</a>
			<button>Entrar</button>
            <?php if (isset($loginError)) { ?>
            <p class="error"><?php echo $loginError; ?></p>
        <?php } ?>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Ops</h1>
				<p>Já é cadastrado?</p>
				<button class="ghost" id="signIn">Voltar</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Seja Bem-Vindo</h1>
				<p>Cadastre-se aqui</p>
				<button class="ghost" id="signUp">Cadastar</button>
			</div>
		</div>
	</div>
    </div>
    <script>
document.getElementById("signUp").addEventListener("click", function() {
  var url = "https://www.example.com";
  window.open(url, "_blank");
});
</script>
</body>
</html>