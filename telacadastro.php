<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro - Sistema Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #e9ecef; /* Fundo cinza claro */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .header-title {
            color: #1cc88a; /* Verde sucesso */
            font-weight: 700;
        }
        .form-control:focus {
            border-color: #1cc88a;
            box-shadow: 0 0 0 0.25rem rgba(28, 200, 138, 0.25);
        }
    </style>
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100 align-items-center">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    
                    <div class="text-center my-4">
                        <i class="bi bi-person-fill-add text-secondary" style="font-size: 3rem;"></i>
                    </div>
                    
                    <div class="card login-card">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold text-center header-title mb-4">Crie sua Conta</h1>
                            
                            <?php 
                                if (isset($_SESSION['mensagem'])): 
                            ?>
                            <div class="alert alert-danger text-center small" role="alert">
                                <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="cadastro.php" class="needs-validation" novalidate="" autocomplete="off">
                                
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="name">Nome Completo</label>
                                    <input id="name" type="text" class="form-control" name="nome" value="" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">E-mail</label>
                                    <input id="email" type="email" class="form-control" name="email" value="" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="password">Senha</label>
                                    <input id="password" type="password" class="form-control" name="senha" required>
                                </div>
                                
                                <div class="align-items-center d-flex mt-4">
                                    <button type="submit" class="btn btn-success w-100">
                                        Registrar <i class="bi bi-person-plus-fill"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Já tem uma conta? <a href="index.php" class="text-success fw-bold">Faça Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
                        Sistema Administrativo | <?php echo date('Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>