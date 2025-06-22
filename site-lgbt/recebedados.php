<?php
$conexao = new mysqli("localhost", "root", "", "teste");
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

$nome = $_POST['nome'];
$idade = $_POST['idade'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$nomesocial = $_POST['nomesocial'];
$genero = $_POST['genero'];
$orientacao = $_POST['orientacao'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar'];

// Verifica se as senhas coincidem
if ($senha !== $confirmar) {
    echo "<h3 style='color:orange;'>⚠️ As senhas não coincidem!</h3>";
    echo "<br><a href='cadastro.php'>🔙 Voltar ao formulário</a>";
    exit;
}

// Criptografa a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se CPF já está cadastrado
$sql_verifica = "SELECT cpf FROM dados WHERE cpf = '$cpf'";
$retorno = mysqli_query($conexao, $sql_verifica);

if (mysqli_num_rows($retorno) > 0) {
    echo "<h3 style='color:orange;'>⚠️ CPF JÁ CADASTRADO!</h3>";
    echo "<br><a href='cadastro.php'>🔙 Voltar ao formulário</a>";
} else {
    // Insere no banco com senha criptografada
    $sql = "INSERT INTO dados (cpf, nome, idade, email, nomesocial, genero, orientacao, senha)
            VALUES ('$cpf', '$nome', '$idade', '$email', '$nomesocial', '$genero', '$orientacao', '$senha_hash')";
    
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        header("Location: login.php?cadastro=ok");
        exit;
    } else {
        echo "<h3 style='color:red;'>❌ ERRO AO INSERIR DADOS: " . mysqli_error($conexao) . "</h3>";
        echo "<br><a href='cadastro.php'>🔙 Voltar ao formulário</a>";
    }
}

mysqli_close($conexao);
?>
