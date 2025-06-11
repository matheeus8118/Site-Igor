<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["evento"])) {
    $evento = $_POST["evento"];
    $arquivo = "inscricoes.json";
    $dados = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];
    $dados[] = $evento;
    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    header("Location: ../agendamento.php");
    exit;
} else {
    echo "Nenhum evento selecionado.";
}
?>