<?php
$arquivo = "api/inscricoes.json";
$inscricoes = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Agendamentos - PAS</title>
<link rel="stylesheet" href="css/agendamento.css">
</head>
<body>
  <main>
    <h2>Meus Agendamentos</h2>
    <div class="lista-agendamentos">
      <?php
        if (!empty($inscricoes)) {
            foreach ($inscricoes as $evento) {
                echo "<div class='item-agendamento'><p><strong>Evento:</strong> $evento</p><p><strong>Status:</strong> Confirmado</p></div>";
            }
        } else {
            echo "<p>Você ainda não está inscrito em nenhum evento.</p>";
        }
      ?>
    </div>
  </main>
</body>
</html>
