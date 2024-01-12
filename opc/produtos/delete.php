<?php
if(isset($_GET['ids'])) {
    $selectedIds = explode(',', $_GET['ids']);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    foreach($selectedIds as $id) {
        $stmt = $conn->prepare("DELETE FROM imagens WHERE cod = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
        } else {
        }

        $stmt->close();
    }
    $conn->close();
    $response = array('success' => true);
    echo json_encode($response);
} else {
    $response = array('success' => false, 'message' => 'Nenhum ID selecionado.');
    echo json_encode($response);
}
?>
