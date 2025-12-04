<?php
session_start();

// 1. Limpa todas as variáveis de sessão (boa prática antes de destruir)
if (isset($_SESSION)) {
    session_unset();
}

// 2. Destrói a sessão por completo
session_destroy();

// 3. Redireciona o usuário para a página de login
header('Location: index.php');
exit();
?>
