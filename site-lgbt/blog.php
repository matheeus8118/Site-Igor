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

$relatos = [];
if (file_exists('relatos.txt')) {
  $relatos = file('relatos.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Blog e Notícias</title>
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

    main {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 10px;
    }

    h1, h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .noticia {
      margin-bottom: 15px;
      padding: 10px;
      border-left: 4px solid yellow;
      background-color: rgba(255, 255, 255, 0.1);
    }

    .noticia a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    .noticia a:hover {
      text-decoration: underline;
    }

    form textarea {
      width: 100%;
      height: 100px;
      border-radius: 5px;
      padding: 10px;
      font-size: 16px;
      margin-bottom: 10px;
      border: none;
      resize: vertical;
    }

    form button {
      background-color: yellow;
      color: black;
      font-weight: bold;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
    }

    form button:hover {
      background-color: gold;
    }

    .relato {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 10px;
      margin-top: 10px;
      border-left: 4px solid #fff;
      border-radius: 5px;
    }

    footer {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 20px;
      text-align: center;
      color: white;
      font-size: 14px;
      width: 100%;
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
    <a href="doacao.php" class="btn-doacao">Doação</a>
  </div>
</header>

<main>
  <h1>📰 Blog e Notícias</h1>

  <h2>🌈 Notícias e Eventos Recentes</h2>
  <div class="noticia">
    <a href="https://agenciabrasil.ebc.com.br/geral/noticia/2024-06/dia-do-orgulho-lgbtqia-movimento-ganha-espaco-e-avanca-no-brasil" target="_blank">
      🎉 Orgulho LGBTQIA+: Avanços no Brasil ganham destaque
    </a>
  </div>
  <div class="noticia">
    <a href="https://www.cnnbrasil.com.br/nacional/marcha-do-orgulho-trans-leva-milhares-as-ruas-em-sp/" target="_blank">
      🚶‍♀️ Marcha do Orgulho Trans reúne milhares em SP
    </a>
  </div>
  <div class="noticia">
    <a href="https://g1.globo.com/pop-arte/musica/noticia/2024/05/01/festival-lgbt-diversidade-2024.ghtml" target="_blank">
      🎶 Festival LGBT+ da Diversidade celebra cultura em show gratuito
    </a>
  </div>

  <h2>💬 Relatos da Comunidade</h2>

  <form action="enviar_relato.php" method="POST">
    <textarea name="relato" placeholder="Compartilhe sua história com a comunidade..." required></textarea>
    <button type="submit">Enviar Relato</button>
  </form>

  <?php if (!empty($relatos)): ?>
    <?php foreach ($relatos as $relato): ?>
      <div class="relato"><?= htmlspecialchars($relato) ?></div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align: center;">Nenhum relato enviado ainda. Seja o primeiro a compartilhar!</p>
  <?php endif; ?>
</main>

<footer>
  <p>&copy; 2025 Comunidade LGBT+ | Desenvolvido por Estudantes da Unijorge</p>
</footer>

</body>
</html>
