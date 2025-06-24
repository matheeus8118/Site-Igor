<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

if (isset($_GET['remover'])) {
  $indice = $_GET['remover'];
  if (isset($_SESSION['carrinho'][$indice])) {
    unset($_SESSION['carrinho'][$indice]);
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
  }
}

$carrinhoQuantidade = count($_SESSION['carrinho']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Carrinho de Compras</title>
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
    }

    nav a:hover {
      text-decoration: underline;
    }

    .carrinho-container {
      position: relative;
      display: inline-block;
    }

    .carrinho-contador {
      position: absolute;
      top: -10px;
      right: -12px;
      background-color: red;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 12px;
      font-weight: bold;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background-color: rgba(0,0,0,0.4);
      padding: 30px;
      border-radius: 10px;
    }

    h2 {
      text-align: center;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: rgba(255,255,255,0.2);
    }

    tr:nth-child(even) {
      background-color: rgba(255,255,255,0.1);
    }

    .remover-btn {
      background-color: crimson;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
    }

    .remover-btn:hover {
      background-color: darkred;
    }

    .finalizar {
      display: block;
      margin-top: 30px;
      text-align: center;
    }

    .finalizar button {
      background-color: yellow;
      color: black;
      padding: 10px 20px;
      border: none;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
    }

    .finalizar button:hover {
      background-color: gold;
    }

    .item-img {
      width: 60px;
      border-radius: 6px;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: rgba(0,0,0,0.5);
      margin-top: 40px;
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
    <div class="carrinho-container">
      <a href="carrinho.php">🛒</a>
      <?php if ($carrinhoQuantidade > 0): ?>
        <span class="carrinho-contador"><?= $carrinhoQuantidade ?></span>
      <?php endif; ?>
    </div>
  </nav>
</header>

<div class="container">
  <h2>🛍️ Seus Itens</h2>

  <?php if (empty($_SESSION['carrinho'])): ?>
    <p style="text-align: center;">Seu carrinho está vazio.</p>
  <?php else: ?>
    <table>
      <tr>
        <th>Imagem</th>
        <th>Produto</th>
        <th>Preço</th>
        <th>Ação</th>
      </tr>
      <?php
        $total = 0;
        foreach ($_SESSION['carrinho'] as $indice => $item):
          $total += $item['preco'];
      ?>
        <tr>
          <td><img src="<?= htmlspecialchars($item['imagem']) ?>" class="item-img" alt="Produto"></td>
          <td><?= htmlspecialchars($item['nome']) ?></td>
          <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
          <td>
            <a href="carrinho.php?remover=<?= $indice ?>">
              <button class="remover-btn">Remover</button>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>

    <h3 style="text-align:center; margin-top: 30px;">Total: R$ <?= number_format($total, 2, ',', '.') ?></h3>

    <div class="finalizar">
      <form action="pagamento.php" method="post">
  <button type="submit">Finalizar compra</button>
</form>
    </div>
  <?php endif; ?>
</div>

<footer>
  &copy; 2025 Comunidade LGBT+ | Desenvolvido por Estudantes da Unijorge
</footer>

</body>
</html>
