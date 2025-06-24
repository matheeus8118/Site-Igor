<?php
session_start();

// Proteção contra campos vazios
$cpf   = $_POST['cpf'] ?? '';
$senha = $_POST['senha'] ?? '';
if (empty($cpf) || empty($senha)) {
    header("Location: login.php?erro=1");
    exit;
}

// Conexão com o banco
$conexao = new mysqli("localhost", "root", "", "teste");
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Remove caracteres do CPF
$cpf_limpo = preg_replace('/[^0-9]/', '', $cpf);

// Consulta SQL (agora inclui nome_social)
$stmt = $conexao->prepare("
    SELECT cpf, nome, nomesocial, email, senha, foto 
    FROM dados 
    WHERE REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') = ?
");
$stmt->bind_param("s", $cpf_limpo);
$stmt->execute();
$result = $stmt->get_result();

// Verificação
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = [
            'cpf'         => $usuario['cpf'],
            'nome'        => $usuario['nome'],
            'nomesocial' =>  $usuario['nomesocial'] ?? '',
            'email'       => $usuario['email'],
            'foto'        => (!empty($usuario['foto']) && file_exists($usuario['foto'])) 
                                ? $usuario['foto'] 
                                : 'fotopadrao.png'
        ];
        header("Location: index.php");
        exit;
    }
}

header("Location: login.php?erro=1");
exit;
?>

