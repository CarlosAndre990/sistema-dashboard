<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - Sistema Administrativo</title>
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
            color: #4e73df; /* Azul primário */
            font-weight: 700;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
    </style>
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100 align-items-center">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    
                    <div class="text-center my-4">
                        <i class="bi bi-lock-fill text-secondary" style="font-size: 3rem;"></i>
                    </div>
                    
                    <div class="card login-card">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold text-center header-title mb-4">Acesso ao Painel</h1>
                            
                            <?php 
                                if (isset($_SESSION['nao_autenticado'])): 
                                unset($_SESSION['nao_autenticado']);
                            ?>
                            <div class="alert alert-danger text-center small" role="alert">
                                E-mail ou Senha incorretos.
                            </div>
                            <?php endif; ?>

                            <?php 
                                if (isset($_SESSION['mensagem'])): 
                            ?>
                            <div class="alert alert-success text-center small" role="alert">
                                <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="login.php" class="needs-validation" novalidate="" autocomplete="off">
                                
                                <div class="mb-3">
                                    <label class="text-muted" for="email">E-mail</label>
                                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Senha</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="senha" required>
                                </div>

                                <div class="d-flex align-items-center mt-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Entrar <i class="bi bi-box-arrow-in-right"></i>
                                    </button>
                                </div> 
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Não tem uma conta? <a href="telacadastro.php" class="text-primary fw-bold">Crie uma!</a>
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