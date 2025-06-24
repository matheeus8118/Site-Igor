<?php
session_start();

// Redireciona para login se não estiver logado
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}
$carrinhoQuantidade = count($_SESSION['carrinho']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bem-vindos ao Site LGBT+</title>
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
      align-items: center;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      position: relative;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .carrinho-contador {
      position: absolute;
      top: -10px;
      right: -14px;
      background-color: red;
      color: white;
      border-radius: 50%;
      font-size: 12px;
      padding: 2px 6px;
      font-weight: bold;
    }

    .btn-doacao {
      background-color: white;
      color: black;
      padding: 10px 15px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      margin-left: 10px;
    }

    .btn-doacao:hover {
      background-color: gold;
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

    .banner {
      text-align: center;
      padding: 80px 20px 50px;
    }

    .banner img {
      max-width: 100%;
      height: auto;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
      margin-bottom: 30px;
    }

    .banner h1 {
      font-size: 48px;
      margin-bottom: 20px;
    }

    .banner p {
      font-size: 22px;
      max-width: 700px;
      margin: auto;
    }

    section {
      padding: 60px 20px;
      background-color: rgba(255, 255, 255, 0.1);
    }

    section h2 {
      text-align: center;
      margin-bottom: 20px;
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
      <a href="carrinho.php">🛒
        <?php if ($carrinhoQuantidade > 0): ?>
          <span class="carrinho-contador"><?= $carrinhoQuantidade ?></span>
        <?php endif; ?>
      </a>
    </nav>

    <div class="perfil">
      <a href="configuracoesConta.php">
        <img src="<?= isset($_SESSION['usuario']['foto']) && file_exists($_SESSION['usuario']['foto']) ? $_SESSION['usuario']['foto'] : 'fotopadrao.png' ?>" alt="Perfil">
      </a>
      <a href="doacao.html" class="btn-doacao">Doação</a>
    </div>
  </header>

  <div class="banner">
    <img src="paginalinicial.png" alt="Ilustração LGBTQIA+">
    <h1>Mais afeto, menos fronteiras.</h1>
    <p>Somos uma comunidade acolhedora e diversa, dedicada ao apoio e inclusão da população LGBTQIA+.</p>
  </div>

  <section>
    <h2>Nosso propósito</h2>
    <p style="text-align: center; max-width: 700px; margin: auto;">
      Nosso objetivo é criar um ambiente seguro, informativo e de apoio para todas as pessoas da comunidade LGBTQIA+, promovendo inclusão, respeito e oportunidades.
    </p>
  </section>

  <footer>
    &copy; 2025 Comunidade LGBT+ | Desenvolvido por Estudantes da Unijorge
  </footer>

</body>
</html>
