<?php
session_start();

// Redireciona para login.php se não estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
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
  <title>O Que Fazemos</title>
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

    .top-right {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .btn-voltar {
      background-color: yellow;
      color: black;
      padding: 8px 12px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }

    .perfil img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .container {
      max-width: 700px;
      background-color: rgba(0, 0, 0, 0.4);
      padding: 40px;
      border-radius: 10px;
      margin: 40px auto;
      text-align: justify;
    }

    .container h1 {
      text-align: center;
      margin-top: 30px;
    }

    .container p {
      text-indent: 30px;
      margin-bottom: 20px;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.5);
      font-size: 14px;
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

  <div class="top-right">
    <a href="index.php" class="btn-voltar">⟵ Início</a>
    <div class="perfil">
      <a href="configuracoesConta.php">
        <img src="<?= isset($_SESSION['usuario']['foto']) && file_exists($_SESSION['usuario']['foto']) ? $_SESSION['usuario']['foto'] : 'fotopadrao.png' ?>" alt="Perfil">
      </a>
    </div>
  </div>
</header>

<div class="container">
  <h1>O Que Fazemos</h1>
  <p>Nosso site foi criado com o propósito de ser um espaço seguro, informativo e acolhedor para pessoas LGBTQIA+ e seus aliados. Aqui, oferecemos conteúdo educativo, suporte emocional, informações sobre direitos, visibilidade de causas sociais e oportunidades de engajamento com iniciativas comunitárias.</p>

  <p>Desenvolvemos ferramentas de conexão entre pessoas, instituições e projetos que atuam na promoção da diversidade, inclusão e respeito. Nossa plataforma também divulga eventos, campanhas, depoimentos e histórias inspiradoras, além de contar com uma loja virtual com produtos que fortalecem a identidade e apoiam a causa.</p>

  <p>Buscamos colaborar com a construção de uma sociedade mais justa e plural, incentivando o diálogo, o respeito às diferenças e a formação cidadã desde a base.</p>
</div>

<footer>
  &copy; 2025 Comunidade LGBT+ | Desenvolvido por Estudantes da Unijorge
</footer>

</body>
</html>
