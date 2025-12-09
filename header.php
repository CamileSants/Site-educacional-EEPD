<?php
if (session_status() == PHP_SESSION_NONE) session_start();

// Verifica se o usuário está logado
$isLoggedIn = isset($_SESSION['user']);
// Define o texto e o link do botão de ação
$actionText = $isLoggedIn ? 'Sair' : 'Entrar';
$actionLink = $isLoggedIn ? 'logout.php' : 'login.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>EEPD</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="assets/images/logo.png" sizes="32x32">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="assets/images/logo.png" alt="Logo" height="50" class="me-2 rounded">
            <span class="fw-bold">Escola Estadual Presidente Dutra</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">História</a></li>
                <li class="nav-item"><a class="nav-link" href="courses.php">Cursos</a></li>
                <li class="nav-item"><a class="nav-link" href="teachers.php">Professores</a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                
                <li class="nav-item">
                    <a 
                        class="nav-link btn btn-light text-primary ms-2 px-3 rounded-pill" 
                        href="<?php echo $actionLink; ?>" 
                        <?php if ($isLoggedIn): ?>
                            onclick="return confirm('Tem certeza que deseja sair da sua conta?');"
                        <?php endif; ?>
                    >
                        <?php echo $actionText; ?>
                    </a>
                </li>
 
                </ul>
        </div>
    </div>
</nav>

<div class="container my-4">