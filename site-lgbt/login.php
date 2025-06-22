<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('fundocadastro.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      margin: 0;
      padding: 30px;
    }

    .login-box {
      background-color: rgba(137, 88, 227, 0.9);
      padding: 30px;
      margin: 80px auto;
      width: 400px;
      border-radius: 10px;
      color: gold;
    }

    h1 {
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input {
      font-size: 18px;
      padding: 10px;
      border-radius: 5px;
      border: none;
      width: 100%;
    }

    button {
      margin-top: 20px;
      font-size: 20px;
      background-color: rgb(147, 34, 203);
      color: gold;
      cursor: pointer;
      padding: 10px;
      border: none;
      border-radius: 5px;
      align-self: center;
    }

    button:hover {
      background-color: rgb(201, 45, 158);
      transition: background-color 0.3s ease;
    }

    .mensagem {
      margin-top: 15px;
      text-align: center;
      font-weight: bold;
    }

    .erro {
      color: red;
    }

    .sucesso {
      color: limegreen;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h1>Login de Usuário</h1>
    <form method="POST" action="recebelogin.php" autocomplete="off">
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" required autocomplete="off">
      </div>

      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" minlength="6" required autocomplete="off">
      </div>

      <button type="submit">Entrar</button>

      <?php
        if (isset($_GET['erro'])) {
           echo '<div class="mensagem erro">❌ CPF ou senha inválidos.</div>';
        }
        if (isset($_GET['ok'])) {
           echo '<div class="mensagem sucesso">✅ Login realizado com sucesso!</div>';
        }
        if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok') {
           echo '<div class="mensagem sucesso">✅ Cadastro realizado com sucesso! Faça login abaixo.</div>';
        }
      ?>

    </form>
  </div>

  <!-- Script de máscara para CPF -->
  <script>
    const cpfInput = document.getElementById('cpf');
    cpfInput.addEventListener('input', () => {
      let cpf = cpfInput.value.replace(/\D/g, '');
      cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
      cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
      cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
      cpfInput.value = cpf;
    });
  </script>
</body>
</html>
