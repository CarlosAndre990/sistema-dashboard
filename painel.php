<?php
session_start();
include('verifica_login.php'); 

$email_usuario = htmlspecialchars($_SESSION['email']); 
$username = explode('@', $email_usuario)[0]; 

// --- DADOS DE EXEMPLO (MOCK DATA) PARA MODERNIZAÇÃO ---
// ATENÇÃO: Substituir os valores 'value' e 'count' pela consulta real do seu banco de dados quando a conexão for resolvida.

// 1. Indicadores Chave de Performance (KPIs)
$kpis = [
    ['title' => 'Total de Alunos', 'value' => 450, 'icon' => 'person-fill', 'color' => 'primary'],
    ['title' => 'Alunos Ativos', 'value' => 380, 'icon' => 'check-circle-fill', 'color' => 'success'],
    // VALOR ATUALIZADO PARA 4 (Cursos Oferecidos)
    ['title' => 'Cursos Oferecidos', 'value' => 4, 'icon' => 'book-fill', 'color' => 'info'],
    ['title' => 'Média Geral', 'value' => '7.8', 'icon' => 'award-fill', 'color' => 'warning'],
];

// 2. Dados de Distribuição de Status (Para o Gráfico de Barras)
$total_alunos_mock = 450;
$status_data = [
    ['label' => 'Ativo', 'count' => 380, 'color' => 'success'],
    ['label' => 'Inativo', 'count' => 45, 'color' => 'danger'],
    ['label' => 'Trancado', 'count' => 25, 'color' => 'warning'],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistema de Gerenciamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Variáveis CSS: Deep Teal & Corporate Dark */
        :root {
            --sidebar-width: 250px;
            --primary-color: #00796B; /* Deep Teal/Corporate Cyan */
            --primary-dark: #004D40;
            --background-color: #F4F6F9; /* Off-White / Light Gray */
            --sidebar-bg: #212529; /* Dark Charcoal */
            --sidebar-text: #ecf0f1;
            --header-bg: #ffffff;
            --card-shadow: 0 6px 20px rgba(0, 0, 0, 0.08); /* Sombra mais suave e forte */
        }

        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; /* Fonte limpa */
            background-color: var(--background-color);
            margin-left: var(--sidebar-width); 
            transition: margin-left 0.3s;
        }

        /* --- TOP NAVBAR --- */
        .navbar-top {
            background-color: var(--header-bg);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Sombra um pouco mais escura */
            position: fixed;
            width: calc(100% - var(--sidebar-width));
            left: var(--sidebar-width);
            top: 0;
            z-index: 1030;
            height: 60px;
            display: flex;
            align-items: center;
            padding-right: 20px;
        }
        .user-info {
            font-size: 0.85rem;
        }
        
        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 60px; 
            z-index: 1000;
            overflow-y: auto;
        }
        .sidebar-header {
            background-color: var(--primary-color);
            position: absolute; top: 0; width: 100%; height: 60px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; font-weight: 600; color: white;
        }
        .nav-link {
            color: var(--sidebar-text);
            padding: 15px 20px;
            border-left: 5px solid transparent;
            transition: all 0.3s;
        }
        .nav-link:hover {
            color: white;
            background-color: #34495e; 
        }
        .nav-link.active {
            color: white;
            background-color: var(--primary-dark); 
            border-left: 5px solid var(--primary-color); 
        }
        /* ESTILO DO BOTÃO SAIR NA BARRA LATERAL */
        .nav-link-logout {
            display: block;
            text-align: center;
            background-color: #e74c3c; /* Vermelho sólido para destaque do botão */
            color: white !important; 
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
            font-weight: bold;
        }
        .nav-link-logout:hover {
            background-color: #c0392b; 
            color: white !important;
        }

        /* --- MAIN CONTENT & CARDS --- */
        .main-content {
            padding-top: 80px; 
            padding-left: 30px; 
            padding-right: 30px;
            min-height: 100vh;
        }
        .modern-card { 
            border: 1px solid #e0e0e0; 
            border-radius: 12px; 
            box-shadow: var(--card-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        .modern-card:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); 
        }
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: 700 !important;
        }
        .alert-heading {
            color: var(--primary-dark);
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-briefcase-fill me-2"></i> Painel Gerencial
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="painel.php">
                    <i class="bi bi-speedometer2 me-2"></i> Painel Principal
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="estatisticas.php">
                    <i class="bi bi-bar-chart-line-fill me-2"></i> Relatórios & Gráficos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="novo_formulario_aluno.php">
                    <i class="bi bi-person-plus-fill me-2"></i> Cadastrar Aluno
                </a>
            </li>
            <hr class="mx-3 my-2" style="border-color: #4e5e6e;">
            
            <li class="nav-item p-3">
                <a class="nav-link-logout" href="logout.php">
                    <i class="bi bi-box-arrow-left me-2"></i> Sair do Sistema
                </a>
            </li>
        </ul>
    </div>
    
    <nav class="navbar navbar-top navbar-expand-lg">
        <div class="container-fluid d-flex justify-content-end">
            <div class="user-info d-flex align-items-center">
                <span class="text-muted me-2">Bem-vindo(a),</span>
                <span class="fw-bold text-dark"><?php echo ucfirst($username); ?></span>
                <i class="bi bi-person-circle ms-2 text-secondary" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <h1 class="mb-4 text-dark"><i class="bi bi-grid-fill me-2" style="color: var(--primary-color);"></i> Painel de Controle Corporativo</h1>
        
        <div class="alert alert-info border-0 rounded-3 shadow-sm mb-5" style="border-left: 5px solid var(--primary-color) !important;" role="alert">
            <h4 class="alert-heading"><i class="bi bi-info-circle-fill me-2"></i> Visão Executiva</h4>
            <p class="mb-0">Aqui você acessa os indicadores chave de performance (KPIs) e o resumo de distribuição dos alunos.</p>
        </div>

        <div class="row mb-5">
            <div class="col-12 col-xl-3 mb-4 order-xl-last">
                <div class="card modern-card p-3 bg-white h-100 border-0 shadow-sm text-center">
                    <h5 class="card-title text-muted fw-bold mb-0">Horário Local</h5>
                    <h1 class="display-5 fw-bolder text-dark" id="live-clock">--:--</h1>
                    <p class="text-muted mb-0" id="live-date">--/--/----</p>
                </div>
            </div>
            
            <div class="col-12 col-xl-9 order-xl-first">
                <div class="row">
                    <?php foreach ($kpis as $kpi): ?>
                    <div class="col-sm-6 col-lg-3 mb-4">
                        <div class="card modern-card p-3 bg-white h-100 shadow-sm">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-<?php echo $kpi['icon']; ?> me-3 text-<?php echo $kpi['color']; ?>" style="font-size: 2rem;"></i>
                                <div>
                                    <p class="text-muted text-uppercase mb-0" style="font-size: 0.75rem;"><?php echo $kpi['title']; ?></p>
                                    <h4 class="fw-bold text-dark mb-0"><?php echo $kpi['value']; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card modern-card p-4">
                    <h5 class="card-title text-dark mb-4"><i class="bi bi-pie-chart-fill me-2" style="color: var(--primary-color);"></i> Distribuição de Status dos Alunos</h5>
                    
                    <?php foreach ($status_data as $status): 
                        $percent = round(($status['count'] / $total_alunos_mock) * 100);
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <small class="fw-bold"><?php echo $status['label']; ?> (<?php echo $status['count']; ?>)</small>
                            <small class="text-muted"><?php echo $percent; ?>%</small>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-<?php echo $status['color']; ?>" 
                                 role="progressbar" 
                                 style="width: <?php echo $percent; ?>%;" 
                                 aria-valuenow="<?php echo $percent; ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <small class="text-muted mt-3">Baseado nos <?php echo $total_alunos_mock; ?> alunos cadastrados (Dados de Exemplo).</small>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateClock() {
            const now = new Date();
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };

            document.getElementById('live-clock').textContent = now.toLocaleTimeString('pt-BR', timeOptions);
            document.getElementById('live-date').textContent = now.toLocaleDateString('pt-BR', dateOptions);
        }

        // Atualiza a cada segundo
        setInterval(updateClock, 1000);
        // Chama a função imediatamente para evitar o delay inicial
        updateClock();
    </script>
</body>
</html>
