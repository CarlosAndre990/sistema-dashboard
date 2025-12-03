<?php
session_start();
include('conexao.php'); 

// --- 1. BUSCA DE TOTAIS ---

// a) Consulta para contagem total de usuários (tabela users)
$sql_count_users = "SELECT COUNT(*) AS total_usuarios FROM users";
$resultado_count_users = mysqli_query($conexao, $sql_count_users);
$total_usuarios_users = 0;

if ($resultado_count_users) {
    $row = mysqli_fetch_assoc($resultado_count_users);
    $total_usuarios_users = (int)$row['total_usuarios'];
}

// b) Consulta para contagem total de alunos (tabela alunos)
$sql_count_alunos = "SELECT COUNT(*) AS total_alunos FROM alunos";
$resultado_count_alunos = mysqli_query($conexao, $sql_count_alunos);
$total_usuarios_alunos = 0;

if ($resultado_count_alunos) {
    $row = mysqli_fetch_assoc($resultado_count_alunos);
    $total_usuarios_alunos = (int)$row['total_alunos'];
}

// c) Cálculo do Total Geral
$total_geral = $total_usuarios_users + $total_usuarios_alunos;


// --- 2. DADOS PARA GRÁFICOS DETALHADOS ---

// a) Consulta para contagem de alunos por Curso (para o 2º Gráfico)
$dados_cursos = [];
$sql_cursos = "SELECT curso, COUNT(*) AS total_curso FROM alunos GROUP BY curso";
$resultado_cursos = mysqli_query($conexao, $sql_cursos);

if ($resultado_cursos) {
    while($row = mysqli_fetch_assoc($resultado_cursos)) {
        $dados_cursos[] = "['" . $row['curso'] . "', " . $row['total_curso'] . "]";
    }
}
$dados_cursos_js = implode(",\n", $dados_cursos);


// b) Consulta para contagem de alunos por Tipo de Responsável (para o 3º Gráfico)
$dados_responsavel = [];
$sql_responsavel = "SELECT tipo_responsavel, COUNT(*) AS total_responsavel FROM alunos GROUP BY tipo_responsavel";
$resultado_responsavel = mysqli_query($conexao, $sql_responsavel);

if ($resultado_responsavel) {
    while($row = mysqli_fetch_assoc($resultado_responsavel)) {
        $dados_responsavel[] = "['" . $row['tipo_responsavel'] . "', " . $row['total_responsavel'] . "]";
    }
}
$dados_responsavel_js = implode(",\n", $dados_responsavel);


// c) Consulta para listar os últimos alunos cadastrados (para a Tabela)
$dados_tabela_alunos = [];
$sql_tabela_alunos = "SELECT nome_completo, curso, data_cadastro FROM alunos ORDER BY aluno_id DESC LIMIT 5"; 
$resultado_tabela_alunos = mysqli_query($conexao, $sql_tabela_alunos);

if ($resultado_tabela_alunos) {
    while($row = mysqli_fetch_assoc($resultado_tabela_alunos)) {
        $dados_tabela_alunos[] = $row;
    }
}

// Fecha a conexão
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Moderno de Estatísticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <style>
        body { background-color: #f4f6f9; }
        .container-fluid { padding: 20px; }
        .modern-card { 
            border: none; 
            border-radius: 12px; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .modern-card:hover { transform: translateY(-5px); }
        .metric-icon { font-size: 2.5rem; }
        .chart-container { 
            height: 350px; 
            background-color: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
    </style>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawAllCharts);

        function drawAllCharts() {
            drawDistributionChart();
            drawCourseChart();
            drawResponsibleChart();
        }

        // --- GRÁFICO 1: DISTRIBUIÇÃO GERAL (COLUNA) ---
        function drawDistributionChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tipo', 'Total', { role: 'style' }],
                ['Usuários (Sistema)', <?php echo $total_usuarios_users; ?>, '#4e73df'],
                ['Alunos (Cadastrados)', <?php echo $total_usuarios_alunos; ?>, '#1cc88a']
            ]);

            var options = {
                title: 'Distribuição de Cadastros (Usuários vs Alunos)',
                backgroundColor: 'transparent',
                legend: { position: 'none' },
                chartArea: { width: '70%' },
                vAxis: { format: '0' }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('distribution_chart_div'));
            chart.draw(data, options);
        }

        // --- GRÁFICO 2: ALUNOS POR CURSO (PIZZA) ---
        function drawCourseChart() {
            var data_cursos = google.visualization.arrayToDataTable([
                ['Curso', 'Total de Alunos'],
                <?php echo $dados_cursos_js; ?>
            ]);

            var options_cursos = {
                title: 'Alunos por Curso',
                is3D: true,
                pieSliceText: 'percentage',
                backgroundColor: 'transparent'
            };

            var chart_cursos = new google.visualization.PieChart(document.getElementById('course_chart_div'));
            chart_cursos.draw(data_cursos, options_cursos);
        }

        // --- GRÁFICO 3: ALUNOS POR TIPO DE RESPONSÁVEL (BARRAS) ---
        function drawResponsibleChart() {
            var data_responsavel = google.visualization.arrayToDataTable([
                ['Responsável', 'Total'],
                <?php echo $dados_responsavel_js; ?>
            ]);

            var options_responsavel = {
                title: 'Distribuição por Tipo de Responsável',
                backgroundColor: 'transparent',
                legend: { position: 'none' },
                chartArea: { width: '80%', height: '70%' },
                hAxis: { format: '0' }
            };

            var chart_responsavel = new google.visualization.BarChart(document.getElementById('responsible_chart_div'));
            chart_responsavel.draw(data_responsavel, options_responsavel);
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <h1 class="mb-4 text-dark"><i class="bi bi-speedometer2"></i> Dashboard Administrativo Moderno</h1>
        
        <?php 
            if(isset($_SESSION['mensagem'])):
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php 
            unset($_SESSION['mensagem']); 
            endif;
        ?>
        
        <hr class="mb-5">

        <div class="row mb-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card modern-card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Geral de Cadastros</div>
                                <div class="h5 mb-0 fw-bold text-gray-800"><?php echo $total_geral; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people-fill metric-icon text-gray-300 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card modern-card border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Total de Alunos (Formulário Detalhado)</div>
                                <div class="h5 mb-0 fw-bold text-gray-800"><?php echo $total_usuarios_alunos; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-mortarboard-fill metric-icon text-gray-300 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 mb-4">
                <div class="d-grid gap-3 h-100">
                    <a href="novo_formulario_aluno.php" class="btn btn-warning btn-lg shadow">
                        <i class="bi bi-person-plus-fill"></i> Novo Cadastro de Aluno
                    </a>
                    <a href="index.php" class="btn btn-secondary btn-lg shadow">
                        <i class="bi bi-box-arrow-in-right"></i> Ir para Login
                    </a>
                    <?php if(isset($_SESSION['email'])): ?>
                        <a href="painel.php" class="btn btn-info btn-lg shadow">
                            <i class="bi bi-box-seam-fill"></i> Meu Painel (Restrito)
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <h2 class="mt-4 mb-3 text-secondary"><i class="bi bi-graph-up"></i> Análise de Dados e Distribuição</h2>
        
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="chart-container">
                    <div id="distribution_chart_div" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                 <div class="chart-container">
                    <div id="course_chart_div" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                 <div class="chart-container">
                    <div id="responsible_chart_div" style="width: 100%; height: 100%;"></div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card modern-card h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-primary"><i class="bi bi-table"></i> Últimos 5 Alunos Cadastrados</h6>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($dados_tabela_alunos)): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover small">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nome Completo</th>
                                            <th scope="col">Curso</th>
                                            <th scope="col">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dados_tabela_alunos as $dado): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($dado['nome_completo']); ?></td>
                                                <td><span class="badge bg-info text-dark"><?php echo htmlspecialchars($dado['curso']); ?></span></td>
                                                <td><?php echo date('d/m/Y', strtotime($dado['data_cadastro'])); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">Nenhum aluno encontrado para exibir.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>