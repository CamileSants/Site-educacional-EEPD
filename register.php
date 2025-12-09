<?php
require 'config.php';
require 'header.php';

$errors = [];
$success = false;
$name_value = $_POST['name'] ?? ''; // Mantém o nome preenchido após erro
$email_value = $_POST['email'] ?? ''; // Mantém o email preenchido após erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validação dos campos
    if (!$name || !$email || !$password) $errors[] = 'Preencha todos os campos.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido.';
    if (strlen($password) < 6) $errors[] = 'Senha deve ter ao menos 6 caracteres.';
    
    if (empty($errors) && isset($pdo)) {
        // Checagem de duplicidade
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $errors[] = 'Email já cadastrado.';
        } else {
            // Criação do novo usuário
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name,email,password,created_at) VALUES (?, ?, ?, NOW())');
            $stmt->execute([$name,$email,$hash]);
            $success = true;
            
            // Limpa os campos após o sucesso
            $name_value = '';
            $email_value = '';
        }
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <!-- Card centralizado e estilizado (mesmo estilo do login) -->
    <div class="card shadow-lg p-4 p-md-5" style="max-width: 450px; width: 100%;">
        
        <div class="text-center mb-4">
            <!-- Ícone/Logo Placeholder (Use um ícone adequado para registro) -->
            <span style="font-size: 3rem; color: #198754;">📝</span> 
            <h1 class="h3 mb-3 fw-normal">Criar sua conta</h1>
        </div>

        <!-- Mensagem de Sucesso -->
        <?php if($success): ?>
            <div class="alert alert-success">
                Conta criada com sucesso! <a href="login.php" class="alert-link">Entre agora</a>.
            </div>
        <?php endif; ?>

        <!-- Mensagens de Erro -->
        <?php if($errors): foreach($errors as $e): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($e); ?></div>
        <?php endforeach; endif; ?>
        
        <form method="post">
            <div class="mb-3">
                <label for="inputName" class="form-label">Nome Completo</label>
                <input id="inputName" class="form-control form-control-lg" name="name" required value="<?php echo htmlspecialchars($name_value); ?>" placeholder="Seu nome">
            </div>
            
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input id="inputEmail" class="form-control form-control-lg" type="email" name="email" required value="<?php echo htmlspecialchars($email_value); ?>" placeholder="seu.email@exemplo.com">
            </div>
            
            <div class="mb-4">
                <label for="inputPassword" class="form-label">Senha</label>
                <input id="inputPassword" class="form-control form-control-lg" type="password" name="password" required placeholder="Mínimo 6 caracteres">
            </div>
            
            <button class="btn btn-success w-100 mb-3 btn-lg">Criar Conta</button>

            <div class="text-center mt-3">
                <a href="login.php" class="btn btn-link">Já tem conta? **Fazer Login**</a>
            </div>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>