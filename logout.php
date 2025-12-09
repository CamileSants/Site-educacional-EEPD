<?php
// Garante que a sessão está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destrói todas as variáveis de sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona o usuário para a página inicial ou de login
header('Location: index.php');
exit;
?>