<?php
session_start();
include('verifica_login.php');

$email_usuario = htmlspecialchars($_SESSION['email']); 
$username = explode('@', $email_usuario)[0]; // Usa a primeira parte do e-mail como nome de usuário
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
        /* Variáveis CSS para um tema corporativo (pode ser usado para Dark Mode) */
        :root {
            --sidebar-width: 250px;
            --primary-color: #007bff; /* Azul Corporativo */
            --primary-light: #4e9bff;
            --background-color: #f8f9fa;
            --sidebar-bg: #2c3e50; /* Cinza Escuro */
            --sidebar-text: #ecf0f1;
            --header-bg: #ffffff;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: var(--background-color);
            margin-left: var(--sidebar-width); /* Espaço para a sidebar */
            transition: margin-left 0.3s;
        }

        /* ----------------------- */
        /* 1. TOP NAVBAR (HEADER)  */
        /* ----------------------- */
        .navbar-top {
            background-color: var(--header-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: calc(100% - var(--sidebar-width));
            left: var(--sidebar-width);
            top: 0;
            z-index: 1030;
            transition: width 0.3s, left 0.3s;
            height: 60px;
        }
        .user-info {
            font-size: 0.85rem;
        }
        
        /* ----------------------- */
        /* 2. SIDEBAR (NAVIGATION) */
        /* ----------------------- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 60px; /* Alinha o conteúdo abaixo do logo/header */
            z-index: 1000;
            overflow-y: auto;
        }
        .sidebar-header {
            background-color: var(--primary-color);
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            position: absolute;
            top: 0;
            width: 100%;
            height: 60px;
        }
        .nav-link {
            color: var(--sidebar-text);
            padding: 15px 20px;
            border-left: 5px solid transparent;
            transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: #34495e; 
            border-left: 5px solid #2ecc71; /* Verde esmeralda para hover/active */
        }
        
        /* NOVO ESTILO: BOTÃO SAIR NA BARRA LATERAL */
        .nav-link-logout {
            display: block;
            text-align: center;
            background-color: #e74c3c; /* Vermelho sólido */
            color: white !important; /* Letra Branca */
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
            font-weight: bold;
        }
        .nav-link-logout:hover {
            background-color: #c0392b; /* Vermelho escuro no hover */
            color: white !important;
        }

        /* ----------------------- */
        /* 3. MAIN CONTENT         */
        /* ----------------------- */
        .main-content {
            padding-top: 80px; /* Espaço para a top navbar */
            padding-left: 20px;
            padding-right: 20px;
            min-height: 100vh;
        }
        .modern-card { 
            border: none; 
            border-radius: 12px; 
            box-shadow: var(--card-shadow);
            transition: transform 0.3s;
            height: 100%;
        }
        .modern-card:hover { transform: translateY(-3px); }

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-briefcase-fill me-2"></i> Dashboard
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
                <i class="bi bi-person-circle ms-2 text-primary" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <h1 class="mb-4 text-dark"><i class="bi bi-house-door-fill text-primary me-2"></i> Visão Geral do Sistema</h1>
        
        <div class="alert alert-info border-0 rounded-3 shadow-sm mb-5" role="alert">
            <h4 class="alert-heading"><i class="bi bi-info-circle-fill"></i> Painel Principal</h4>
            <p class="mb-0">Aqui você tem acesso rápido às principais áreas do sistema. Use a barra lateral para navegação rápida e eficiente.</p>
        </div>

        <div class="row">
            
            <div class="col-md-6 mb-4">
                <a href="estatisticas.php" class="text-decoration-none">
                    <div class="card modern-card text-center p-4 border-primary">
                        <i class="bi bi-bar-chart-line-fill card-icon text-primary"></i>
                        <h5 class="card-title fw-bold text-primary">Relatórios Analíticos</h5>
                        <p class="card-text text-muted">Acesse o dashboard completo com gráficos e 4 métricas de análise de dados dos alunos.</p>
                        <span class="btn btn-primary mt-3">Ver Estatísticas <i class="bi bi-arrow-right"></i></span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 mb-4">
                <a href="novo_formulario_aluno.php" class="text-decoration-none">
                    <div class="card modern-card text-center p-4 border-success">
                        <i class="bi bi-person-plus-fill card-icon text-success"></i>
                        <h5 class="card-title fw-bold text-success">Cadastrar Novo Aluno</h5>
                        <p class="card-text text-muted">Acesse o formulário de registro para incluir novos alunos no banco de dados.</p>
                        <span class="btn btn-success mt-3">Iniciar Cadastro <i class="bi bi-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>