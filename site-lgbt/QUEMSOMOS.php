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
  <title>Quem Somos</title>
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

    .container h1, .container h2 {
      text-align: center;
      margin-top: 30px;
    }

    .container p {
      text-indent: 30px;
      margin-bottom: 20px;
    }

    ul {
      margin-left: 40px;
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
  <h1>Quem Somos</h1>
  <p>Somos uma iniciativa comprometida com a inclusão, o respeito e o fortalecimento da comunidade LGBTQIA+. Nosso site nasceu do desejo de construir um espaço seguro, educativo e solidário, onde todas as pessoas, independentemente de sua orientação sexual ou identidade de gênero, possam encontrar acolhimento, apoio e representatividade.</p>

  <p>Trabalhamos diariamente para promover visibilidade, empoderamento e oportunidades, combatendo o preconceito e incentivando a diversidade como valor fundamental para uma sociedade mais justa.</p>

  <h2>Missão</h2>
  <p>Criar um ambiente acolhedor e informativo para a população LGBTQIA+, promovendo suporte, conscientização e acesso a recursos que ajudem a combater a discriminação e fortalecer identidades.</p>

  <h2>Visão</h2>
  <p>Ser reconhecido como uma plataforma de referência nacional no acolhimento, formação e mobilização da comunidade LGBTQIA+, contribuindo para a construção de uma sociedade plural e inclusiva.</p>

  <h2>Valores</h2>
  <ul>
    <li>Respeito à diversidade</li>
    <li>Empatia e acolhimento</li>
    <li>Compromisso social</li>
    <li>Transparência e ética</li>
    <li>Colaboração e escuta ativa</li>
    <li>Coragem para lutar contra o preconceito</li>
  </ul>
</div>

<footer>
  &copy; 2025 Comunidade LGBT+ | Desenvolvido por Estudantes da Unijorge
</footer>

</body>
</html>
