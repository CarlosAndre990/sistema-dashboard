<?php
session_start();
include('conexao.php'); // Usa sua conexão MySQLi

// 1. Coleta e sanitização dos dados
$nome_completo = mysqli_real_escape_string($conexao, trim($_POST['nome_completo']));
$data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
$rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
$numero = mysqli_real_escape_string($conexao, trim($_POST['numero']));
$bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
$cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$curso = mysqli_real_escape_string($conexao, trim($_POST['curso']));
$nome_responsavel = mysqli_real_escape_string($conexao, trim($_POST['nome_responsavel']));
$tipo_responsavel = mysqli_real_escape_string($conexao, trim($_POST['tipo_responsavel']));


// 2. Verifica se algum campo obrigatório está vazio
if (empty($nome_completo) || empty($data_nascimento) || empty($rua) || empty($curso)) {
    $_SESSION['mensagem_aluno'] = "Erro: Preencha todos os campos obrigatórios!";
    header('Location: novo_formulario_aluno.php');
    exit();
}

// 3. Monta e executa a query de inserção
$sql = "INSERT INTO alunos 
        (nome_completo, data_nascimento, rua, numero, bairro, cep, curso, nome_responsavel, tipo_responsavel) 
        VALUES 
        ('$nome_completo', '$data_nascimento', '$rua', '$numero', '$bairro', '$cep', '$curso', '$nome_responsavel', '$tipo_responsavel')";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem_aluno'] = "Aluno **$nome_completo** cadastrado com sucesso no curso de **$curso**!";
    // Redireciona de volta para o formulário ou para o painel de estatísticas
    header('Location: novo_formulario_aluno.php');
    exit();
} else {
    $_SESSION['mensagem_aluno'] = "Erro ao cadastrar aluno: " . mysqli_error($conexao);
    header('Location: novo_formulario_aluno.php');
    exit();
}

// Fecha a conexão
mysqli_close($conexao);
?>