<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php?erro=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel do Usuário</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      text-align: center;
      padding: 50px;
    }
    .painel {
      background-color: #fff;
      border-radius: 10px;
      padding: 40px;
      box-shadow: 0 0 10px #ccc;
      display: inline-block;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #b700c5;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    a:hover {
      background-color: #9500a8;
    }
  </style>
</head>
<body>
  <div class="painel">
    <h1>Bem-vindo(a) ao Painel</h1>
    <p>Usuário logado com CPF: <strong><?= htmlspecialchars($_SESSION['cpf']) ?></strong></p>
    <a href="logout.php">Sair</a>
  </div>
</body>
</html>
