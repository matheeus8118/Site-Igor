<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $relato = trim($_POST['relato'] ?? '');

    if (empty($relato)) {
        header("Location: blog.php?erro=Relato vazio");
        exit;
    }

    // Caminho para o arquivo onde os relatos serão armazenados
    $arquivo = 'relatos.txt';

    // Dados do usuário
    $usuario = $_SESSION['usuario']['nome_social'] ?? 'Anônimo';
    $data = date("d/m/Y H:i");

    // Formata o relato
    $entrada = "[$data] $usuario:\n$relato\n---\n";

    // Salva no arquivo
    file_put_contents($arquivo, $entrada, FILE_APPEND);

    // Redireciona de volta
    header("Location: blog.php?sucesso=1");
    exit;
} else {
    header("Location: blog.php");
    exit;
}
