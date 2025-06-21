<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recebendo Dados</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<h3 style='color:red;'>⚠️ Este formulário deve ser enviado via POST.</h3>";
    exit;
}

$conexao = new mysqli("localhost", "root", "", "teste");
if ($conexao->connect_error) {
    die("<strong>Erro de conexão:</strong> " . mysqli_connect_error());
}

$cpf        = mysqli_real_escape_string($conexao, $_POST['cpf']);
$nome       = mysqli_real_escape_string($conexao, $_POST['nome']);
$idade      = mysqli_real_escape_string($conexao, $_POST['idade']);
$email      = mysqli_real_escape_string($conexao, $_POST['email']);
$nomesocial = mysqli_real_escape_string($conexao, $_POST['nomesocial']);
$genero     = mysqli_real_escape_string($conexao, $_POST['genero']);
$orientacao = mysqli_real_escape_string($conexao, $_POST['orientacao']);
$senha      = $_POST['senha'];
$confirmar  = $_POST['confirmar'];

// Verifica se as senhas coincidem
if ($senha !== $confirmar) {
    echo "<h3 style='color:red;'>❌ As senhas não coincidem.</h3>";
    exit;
}

// Criptografa a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se CPF já está cadastrado
$sql_verifica = "SELECT cpf FROM dados WHERE cpf = '$cpf'";
$retorno = mysqli_query($conexao, $sql_verifica);

if (mysqli_num_rows($retorno) > 0) {
    echo "<h3 style='color:orange;'>⚠️ CPF JÁ CADASTRADO!</h3>";
} else {
    // Insere no banco
    $sql = "INSERT INTO dados (cpf, nome, idade, email, nomesocial, genero, orientacao, senha)
            VALUES ('$cpf', '$nome', '$idade', '$email', '$nomesocial', '$genero', '$orientacao', '$senha_hash')";
    
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        echo "<h2 style='color:blue;'>✅ USUÁRIO CADASTRADO COM SUCESSO!</h2>";
    } else {
        echo "<h3 style='color:red;'>❌ ERRO AO INSERIR DADOS: " . mysqli_error($conexao) . "</h3>";
    }

    echo "<br><a href='cadastro.html'>🔙 Voltar ao formulário</a>";
}

mysqli_close($conexao);
?>
</body>
</html>
