<?php
session_start();
include('conexao.php'); // arquivo de conexão com o banco

// Verifica se os campos foram enviados
if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
    $_SESSION['mensagem'] = "Preencha todos os campos!";
    header('Location: telacadastro.php'); // sua página de cadastro
    exit();
}

$nome  = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
$senha_md5 = MD5($senha); // Hash da senha para verificação

// 1. VERIFICAÇÃO DE DUPLICIDADE GERAL (E-MAIL OU SENHA)

// Checa se JÁ EXISTE um usuário com esse e-mail OU essa senha (já em MD5)
$sql_check = "SELECT COUNT(*) AS total FROM users WHERE user_email = '$email' OR user_password = '$senha_md5'";
$result_check = mysqli_query($conexao, $sql_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['total'] > 0) {
    // Se o total for maior que zero, significa que o E-MAIL OU a SENHA já estão em uso.
    $_SESSION['mensagem'] = "Ops! O E-mail ou a Senha que você tentou usar já estão registrados por outro usuário. Tente dados diferentes.";
    header('Location: telacadastro.php');
    exit();
}

// 2. INSERÇÃO DO NOVO USUÁRIO (SE NÃO HOUVER DUPLICIDADE)

// Insere o novo usuário
$sql_insert = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$nome', '$email', '$senha_md5')";

if (mysqli_query($conexao, $sql_insert)) {
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login.";
    header('Location: index.php'); // redireciona para a tela de login
    exit();
} else {
    // Caso ocorra um erro de SQL inesperado
    $_SESSION['mensagem'] = "Erro ao registrar usuário. Tente novamente mais tarde.";
    header('Location: telacadastro.php');
    exit();
}

mysqli_close($conexao);
?>