<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

$carrinhoQuantidade = count($_SESSION['carrinho']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto'])) {
  $produtos = [
    'camisa' => ['nome' => 'Camisa Orgulho', 'preco' => 59.90, 'imagem' => 'camisa.png'],
    'caneca' => ['nome' => 'Caneca Inclusiva', 'preco' => 39.90, 'imagem' => 'caneca.png']
  ];

  $id = $_POST['produto'];
  if (isset($produtos[$id])) {
    $_SESSION['carrinho'][] = $produtos[$id];
    $carrinhoQuantidade = count($_SESSION['carrinho']);
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Loja Virtual</title>
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

    .perfil img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 20px;
      background-color: rgba(0,0,0,0.3);
      border-radius: 10px;
      text-align: center;
    }

    h1 {
      margin-bottom: 40px;
    }

    .produtos {
      display: flex;
      justify-content: center;
      gap: 50px;
      flex-wrap: wrap;
    }

    .item {
      background-color: rgba(255,255,255,0.1);
      padding: 20px;
      border-radius: 10px;
      width: 250px;
      box-shadow: 0 0 8px rgba(0,0,0,0.3);
    }

    .item img {
      width: 100%;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .item h3 {
      margin: 10px 0 5px;
    }

    .item p {
      margin-bottom: 10px;
    }

    .item button {
      background-color: yellow;
      color: black;
      border: none;
      padding: 10px;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
    }

    .item button:hover {
      background-color: gold;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: rgba(0,0,0,0.5);
      margin-top: 60px;
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
    <a href="carrinho.php" class="carrinho-link">🛒
      <?php if ($carrinhoQuantidade > 0): ?>
        <span class="carrinho-contador"><?= $carrinhoQuantidade ?></span>
      <?php endif; ?>
    </a>
  </nav>

  <div class="perfil">
    <a href="configuracoesConta.php">
      <img src="<?= isset($_SESSION['usuario']['foto']) && file_exists($_SESSION['usuario']['foto']) ? $_SESSION['usuario']['foto'] : 'fotopadrao.png' ?>" alt="Perfil">
    </a>
  </div>
</header>

<div class="container">
  <h1>Loja Virtual</h1>

  <div class="produtos">
    <div class="item">
      <img src="camisa.png" alt="Camisa LGBT">
      <h3>Camisa Orgulho</h3>
      <p>R$ 59,90</p>
      <form method="post">
        <input type="hidden" name="produto" value="camisa">
        <button type="submit">🛒 Adicionar ao carrinho</button>
      </form>
    </div>

    <div class="item">
      <img src="caneca.png" alt="Caneca LGBT">
      <h3>Caneca Inclusiva</h3>
      <p>R$ 39,90</p>
      <form method="post">
        <input type="hidden" name="produto" value="caneca">
        <button type="submit">🛒 Adicionar ao carrinho</button>
      </form>
    </div>
  </div>
</div>

<footer>
  &copy; 2025 Comunidade LGBT+ | Desenvolvido por Estudantes da Unijorge
</footer>

</body>
</html>
