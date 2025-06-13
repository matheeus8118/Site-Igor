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
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['evento'])) {
    $evento = $_POST['evento'];
    $arquivo = 'inscricoes.json';

    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([]));
    }

    $inscricoes = json_decode(file_get_contents($arquivo), true);
    if (!in_array($evento, $inscricoes)) {
        $inscricoes[] = $evento;
        file_put_contents($arquivo, json_encode($inscricoes, JSON_PRETTY_PRINT));
        echo "<script>alert('Inscrição realizada com sucesso!'); window.location.href='../agendamento.php';</script>";
    } else {
        echo "<script>alert('Você já está inscrito neste evento.'); window.location.href='../eventos.html';</script>";
    }
} else {
    echo "<script>alert('Evento inválido.'); window.location.href='../eventos.html';</script>";
}
?>
<?php
$arquivo = 'api/inscricoes.json';
$inscricoes = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Meus Agendamentos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main>
    <h2>Eventos Inscritos</h2>
    <?php if (!empty($inscricoes)) : ?>
      <ul>
        <?php foreach ($inscricoes as $evento) : ?>
          <li><?= htmlspecialchars($evento) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php else : ?>
      <p>Você ainda não se inscreveu em nenhum evento.</p>
    <?php endif; ?>
  </main>
</body>
</html>
php -S localhost:8000