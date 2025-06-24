<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

$conexao = new mysqli("localhost", "root", "", "teste");
if ($conexao->connect_error) {
  die("Erro na conexão: " . $conexao->connect_error);
}

$cpf          = $_SESSION['usuario']['cpf'];
$nome         = $_POST['nome'] ?? '';
$email        = $_POST['email'] ?? '';
$senha        = $_POST['senha'] ?? '';
$nome_social  = $_POST['nomesocial'] ?? '';
$foto         = $_FILES['foto'] ?? null;

$senha_alterada = false;

// Atualização básica
$atualiza_sql = "UPDATE dados SET nome = ?, email = ?, nomesocial = ?";
$parametros   = [$nome, $email, $nome_social];
$tipos        = "sss";

// Se senha foi informada
if (!empty($senha)) {
  $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
  $atualiza_sql .= ", senha = ?";
  $parametros[] = $senha_hash;
  $tipos .= "s";
  $senha_alterada = true;
}

// Se foto foi enviada
if ($foto && $foto['error'] === 0) {
  $pasta = "uploads/";
  if (!is_dir($pasta)) mkdir($pasta);
  $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
  $caminho_foto = $pasta . uniqid() . "." . $extensao;
  move_uploaded_file($foto['tmp_name'], $caminho_foto);
  $atualiza_sql .= ", foto = ?";
  $parametros[] = $caminho_foto;
  $tipos .= "s";
  $_SESSION['usuario']['foto'] = $caminho_foto;
}

$atualiza_sql .= " WHERE cpf = ?";
$parametros[] = $cpf;
$tipos .= "s";

$stmt = $conexao->prepare($atualiza_sql);
$stmt->bind_param($tipos, ...$parametros);

if ($stmt->execute()) {
  $_SESSION['usuario']['nome']        = $nome;
  $_SESSION['usuario']['email']       = $email;
  $_SESSION['usuario']['nomesocial']  = $nome_social;

  if ($senha_alterada) {
    session_unset();
    session_destroy();
    header("Location: login.php?senhaAtualizada=1");
    exit;
  }

  $mensagem = "✅ Dados atualizados com sucesso!";
  $classe = "success";
} else {
  $mensagem = "❌ Erro ao atualizar: " . $stmt->error;
  $classe = "error";
}

$stmt->close();
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Atualização de Dados</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #ee0979, #ff6a00);
      color: white;
      text-align: center;
      padding: 80px 20px;
    }

    .mensagem {
      background-color: rgba(0, 0, 0, 0.6);
      display: inline-block;
      padding: 30px;
      border-radius: 10px;
      font-size: 20px;
    }

    .mensagem.success {
      border-left: 8px solid limegreen;
    }

    .mensagem.error {
      border-left: 8px solid red;
    }

    a.botao-voltar {
      display: inline-block;
      margin-top: 25px;
      padding: 10px 20px;
      background-color: yellow;
      color: black;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    a.botao-voltar:hover {
      background-color: gold;
    }
  </style>
</head>
<body>
  <div class="mensagem <?= $classe ?>"><?= $mensagem ?></div>
  <?php if ($classe !== 'error'): ?>
    <br><br>
    <a href="configuracoesConta.php" class="botao-voltar">🔙 Voltar para Configurações</a>
  <?php endif; ?>
</body>
</html>
