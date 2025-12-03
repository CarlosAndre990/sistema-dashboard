<?php
session_start();
// Array de opções para o campo Curso
$cursos = [
    'Desenvolvimento de Sistemas',
    'Informática',
    'Administração',
    'Enfermagem'
];

// Array de opções para o campo Tipo de Responsável
$tipos_responsavel = [
    'Pai',
    'Mãe',
    'Tio(a)',
    'Avô(ó)',
    'Outro'
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="h-100 p-5">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-8 col-xl-8 col-lg-10 col-md-10 col-sm-12">
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Cadastro de Aluno</h1>

                            <?php 
                                if(isset($_SESSION['mensagem_aluno'])):
                            ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <?= $_SESSION['mensagem_aluno']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php 
                                unset($_SESSION['mensagem_aluno']); 
                                endif;
                            ?>

                            <form action="processa_aluno.php" method="POST" class="row g-3" novalidate>
                                
                                <h5 class="mt-4">Dados Pessoais</h5>
                                <div class="col-md-6">
                                    <label class="form-label" for="nome_completo">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome_completo" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="data_nascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control" name="data_nascimento" required>
                                </div>

                                <h5 class="mt-4">Endereço</h5>
                                <div class="col-md-6">
                                    <label class="form-label" for="rua">Rua</label>
                                    <input type="text" class="form-control" name="rua" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="numero">Número</label>
                                    <input type="text" class="form-control" name="numero" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="bairro">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="cep">CEP</label>
                                    <input type="text" class="form-control" name="cep" placeholder="Ex: 00000-000" required>
                                </div>

                                <h5 class="mt-4">Curso e Responsável</h5>
                                <div class="col-md-4">
                                    <label class="form-label" for="curso">Curso</label>
                                    <select class="form-select" name="curso" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($cursos as $c): ?>
                                            <option value="<?= $c ?>"><?= $c ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label" for="nome_responsavel">Nome Responsável</label>
                                    <input type="text" class="form-control" name="nome_responsavel" required>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label" for="tipo_responsavel">Tipo de Responsável</label>
                                    <select class="form-select" name="tipo_responsavel" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($tipos_responsavel as $t): ?>
                                            <option value="<?= $t ?>"><?= $t ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Cadastrar Aluno
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                <a href="estatisticas.php" class="text-dark">Voltar para o Painel de Estatísticas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>