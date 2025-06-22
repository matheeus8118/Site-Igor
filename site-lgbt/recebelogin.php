<?php
session_start();

$conexao = new mysqli("localhost", "root", "", "teste");
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

// Remove pontos e traço do CPF
$cpf_limpo = preg_replace('/[^0-9]/', '', $cpf);

// Busca o registro completo
$stmt = $conexao->prepare("SELECT cpf, senha FROM dados WHERE REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') = ?");
$stmt->bind_param("s", $cpf_limpo);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($cpf_bd, $senhaHash);
    $stmt->fetch();

    if (password_verify($senha, $senhaHash)) {
        $_SESSION['cpf'] = $cpf_bd;
        header("Location: painel.php");
        exit;
    } else {
        header("Location: login.php?erro=1");
        exit;
    }
} else {
    header("Location: login.php?erro=1");
    exit;
}

$stmt->close();
$conexao->close();
