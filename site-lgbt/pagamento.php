<?php
session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['carrinho'])) {
  header("Location: loja.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pagamento</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #ee0979, #ff6a00);
      color: white;
      margin: 0;
    }
    .container {
      max-width: 700px;
      margin: 60px auto;
      background-color: rgba(0,0,0,0.5);
      padding: 40px;
      border-radius: 10px;
      text-align: center;
    }
    h2 {
      margin-bottom: 30px;
    }
    .opcoes button {
      padding: 12px 25px;
      font-size: 16px;
      font-weight: bold;
      margin: 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .pix {
      background-color: lime;
      color: black;
    }
    .paypal {
      background-color: #0070ba;
      color: white;
    }
    .qr-code {
      margin-top: 30px;
    }
    .qr-code img {
      width: 200px;
    }
    .btn-voltar {
  background-color: yellow;
  color: black;
  padding: 10px 16px;
  border-radius: 5px;
  text-decoration: none;
  font-weight: bold;
  display: inline-block;
  margin-top: 30px;
}

.btn-voltar:hover {
  background-color: gold;
}

  </style>
</head>
<body>

<div class="container">
  <h2>Escolha sua forma de pagamento</h2>

  <form method="post">
    <button type="submit" name="pagamento" value="pix" class="pix">💸 Pagar com PIX</button>
    <button type="submit" name="pagamento" value="paypal" class="paypal">💳 Pagar com PayPal</button>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pagamento'])) {
    if ($_POST['pagamento'] === 'pix') {
      echo '<div class="qr-code">';
      echo '<p>Escaneie o QR Code abaixo com seu aplicativo bancário:</p>';
      echo '<img src="qrcode_pix.png" alt="QR Code PIX">';
      echo '</div>';
    } elseif ($_POST['pagamento'] === 'paypal') {
      echo "<script>window.location.href='https://www.paypal.com/signin';</script>";
    }
  }
  ?>
  <a href="carrinho.php" class="btn-voltar">⟵ Voltar ao carrinho</a>

</div>

</body>
</html>
