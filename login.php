<?php
require 'config.php';
require 'header.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($email && $password && isset($pdo)) {
        // Simulação de busca no banco de dados
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = ['id'=>$user['id'],'name'=>$user['name'],'email'=>$user['email']];
            header('Location: index.php'); exit;
        } else {
            $errors[] = 'Credenciais inválidas.';
        }
    } else {
        $errors[] = 'Preencha email e senha.';
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <!-- Card centralizado e estilizado -->
    <div class="card shadow-lg p-4 p-md-5" style="max-width: 450px; width: 100%;">
        
        <div class="text-center mb-4">
            <!-- Ícone/Logo Placeholder (Use sua logo real aqui) -->
            <span style="font-size: 3rem; color: #007bff;">🔑</span> 
            <h1 class="h3 mb-3 fw-normal">Acessar Conta</h1>
        </div>
        
        <?php if($errors): foreach($errors as $e): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($e); ?></div>
        <?php endforeach; endif; ?>
        
        <form method="post">
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input id="inputEmail" class="form-control form-control-lg" type="email" name="email" required placeholder="seu.email@exemplo.com">
            </div>
            
            <div class="mb-4">
                <label for="inputPassword" class="form-label">Senha</label>
                <input id="inputPassword" class="form-control form-control-lg" type="password" name="password" required placeholder="••••••••">
            </div>
            
            <button class="btn btn-primary w-100 mb-3 btn-lg">Entrar</button>
            
            <div class="text-center mt-3">
                <a href="register.php" class="btn btn-link">Não tem conta? **Criar conta**</a>
            </div>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>