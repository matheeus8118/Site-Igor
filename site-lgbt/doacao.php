<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Doação</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('fundo-doacao.png') no-repeat center center fixed;
      background-size: cover;
      color: white;
      text-align: center;
      padding: 20px;
      backdrop-filter: brightness(0.8);
    }

    h1 {
      margin-top: 30px;
      font-size: 32px;
    }

    .descricao {
      max-width: 600px;
      margin: 20px auto;
      font-size: 18px;
      line-height: 1.6;
      background-color: rgba(0, 0, 0, 0.4);
      padding: 20px;
      border-radius: 12px;
    }

    select, input[type="number"] {
      padding: 10px;
      margin: 10px;
      border: none;
      border-radius: 8px;
      width: 200px;
    }

    .qr-code {
      margin-top: 20px;
    }

    .voltar {
      display: inline-block;
      margin-top: 40px;
      text-decoration: none;
      background-color: white;
      color: #ee0979;
      padding: 10px 20px;
      border-radius: 20px;
      font-weight: bold;
    }

    .voltar:hover {
      background-color: #f2f2f2;
    }
  </style>

  <script>
    function atualizarQRCode() {
      const select = document.getElementById("valor");
      const customInput = document.getElementById("custom");
      const qrBox = document.getElementById("qrBox");
      let valorSelecionado = select.value;

      if (valorSelecionado === "outro") {
        customInput.style.display = "inline-block";
        if (customInput.value && parseFloat(customInput.value) > 0) {
          valorSelecionado = customInput.value;
        } else {
          qrBox.style.display = "none";
          return;
        }
      } else {
        customInput.style.display = "none";
      }

      document.getElementById("valorDoado").innerText = "R$ " + parseFloat(valorSelecionado).toFixed(2).replace(".", ",");
      qrBox.style.display = "block";
    }

    function monitorarInput() {
      const customInput = document.getElementById("custom");
      customInput.addEventListener("input", atualizarQRCode);
    }

    window.onload = monitorarInput;
  </script>
</head>
<body>

  <h1>Faça uma Doação</h1>

  <div class="descricao">
    Sua contribuição é essencial para fortalecer nossa comunidade LGBTQIAPN+.  
    Com sua ajuda, conseguimos oferecer apoio psicológico gratuito, oficinas de formação,  
    eventos culturais e espaços seguros de acolhimento para quem mais precisa.  
    <br><br>
    🌈 <strong>Juntos, construímos um futuro com mais respeito, dignidade e amor.</strong>
  </div>

  <label for="valor">Escolha um valor:</label><br>
  <select id="valor" name="valor" onchange="atualizarQRCode()">
    <option value="10">R$ 10,00</option>
    <option value="25">R$ 25,00</option>
    <option value="50">R$ 50,00</option>
    <option value="outro">Outro valor</option>
  </select><br>

  <input type="number" id="custom" name="valor_custom" placeholder="Digite outro valor" style="display:none;"><br>

  <div id="qrBox" class="qr-code" style="display:none;">
    <p>Escaneie o QR Code abaixo com seu app bancário para doar <strong id="valorDoado"></strong>:</p>
    <img src="qrcode-pix.png" alt="QR Code PIX" width="250">
  </div>

  <br>
  <a class="voltar" href="index.php">Voltar ao Início</a>

</body>
</html>
