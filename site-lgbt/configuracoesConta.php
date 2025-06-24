<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Configurações da Conta</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #ee0979, #ff6a00);
      color: white;
    }

    header {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    nav {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .perfil {
      display: flex;
      align-items: center;
    }

    .perfil img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-left: 20px;
      object-fit: cover;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: rgba(0, 0, 0, 0.6);
      padding: 30px;
      border-radius: 10px;
    }

    .container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: none;
      font-size: 16px;
      margin-top: 5px;
      box-sizing: border-box;
    }

    .botoes {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 20px;
    }

    .botoes button,
    .botoes .logout-btn {
      font-size: 18px;
      background-color: yellow;
      color: black;
      cursor: pointer;
      padding: 10px;
      border: none;
      border-radius: 5px;
      width: 100%;
      text-align: center;
      text-decoration: none;
      box-sizing: border-box;
    }

    .botoes button:hover,
    .botoes .logout-btn:hover {
      background-color: gold;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.5);
    }
  </style>
</head>
<body>

  <header>
    <nav>
      <a href="index.php">Início</a>
      <a href="QUEMSOMOS.php">Quem somos</a>
      <a href="OQUEFAZEMOS.php">O que fazemos</a>
      <a href="blog.php">Blog e Notícias</a>
      <a href="loja.php">Loja Virtual</a>
    </nav>
    <div class="perfil">
      <a href="configuracoesConta.php">
        <img src="<?= htmlspecialchars($_SESSION['usuario']['foto']) ?>" alt="Perfil">
      </a>
    </div>
  </header>

  <div class="container">
    <h2>Configurações da Conta</h2>
    <form method="POST" action="salvarConfiguracoes.php" enctype="multipart/form-data">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_SESSION['usuario']['nome']) ?>" required>

      <label for="nomesocial">Nome Social:</label>
      <input type="text" id="nomesocial" name="nomesocial" value="<?= htmlspecialchars($_SESSION['usuario']['nomesocial'] ?? '') ?>">

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['usuario']['email']) ?>" required>

      <label for="senha">Nova Senha: <small>(deixe em branco para não alterar)</small></label>
      <input type="password" id="senha" name="senha" minlength="6">

      <label for="foto">Foto de Perfil:</label>
      <input type="file" id="foto" name="foto" accept="image/*">

      <div class="botoes">
        <button type="submit">Salvar Alterações</button>
        <a href="logout.php" class="logout-btn">Sair da Conta</a>
      </div>
    </form>
  </div>

  <footer>
    &copy; 2025 Comunidade LGBT+ | Desenvolvido por Estudantes da Unijorge
  </footer>

</body>
</html>
