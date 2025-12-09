<?php
require 'config.php';
require 'header.php';
session_start();

// Verifica se o usuário está logado. Se não estiver, redireciona para o login.
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

// Dados do Usuário
$userName = htmlspecialchars($user['name']);
$userRole = htmlspecialchars($user['role']);
$userMatricula = htmlspecialchars($user['matricula']);
$userCourse = htmlspecialchars($user['course'] ?? 'N/A');

// Link simulado para o serviço de geração de código de barras
// Em produção, você usaria uma biblioteca PHP (ex: Zend Barcode) ou SVG.
$barcodeData = $userMatricula;
$barcodeUrl = "https://placehold.co/300x70/212529/FFFFFF/png?text={$barcodeData}"; 

// Placeholder para foto de perfil
$photoUrl = "https://placehold.co/150x150/0D6EFD/FFFFFF/png?text=FOTO";

?>

<style>
    .cracha-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 20px;
        background-color: #f8f9fa; /* Fundo cinza claro */
    }
    .cracha-card {
        max-width: 400px;
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        border: 4px solid #0D6EFD; /* Borda Azul para Crachá */
    }
    .cracha-header {
        background-color: #0D6EFD; /* Azul */
        color: white;
        padding: 20px;
        border-top-left-radius: 11px;
        border-top-right-radius: 11px;
        text-align: center;
    }
    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        margin-top: -60px; /* Sobrepõe o header */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .barcode-img {
        width: 100%;
        max-width: 250px;
        height: auto;
    }
</style>

<div class="cracha-container">
    <div class="cracha-card">
        
        <!-- Cabeçalho (Azul) -->
        <div class="cracha-header">
            <h4 class="mb-1 fw-bold">ESCOLA TÉCNICA</h4>
            <small><?php echo $userRole; ?></small>
        </div>
        
        <div class="card-body text-center pt-0">
            
            <!-- Foto de Perfil -->
            <img src="<?php echo $photoUrl; ?>" class="profile-photo" alt="Foto de Perfil">
            
            <h3 class="mt-3 mb-1 fw-bold text-dark"><?php echo $userName; ?></h3>
            <p class="text-muted mb-4"><?php echo $userCourse; ?></p>
            
            <!-- Detalhes do Crachá -->
            <div class="row mb-4 text-start justify-content-center">
                <div class="col-10">
                    <p class="mb-1 small"><strong>MATRÍCULA:</strong> <?php echo $userMatricula; ?></p>
                    <p class="mb-1 small"><strong>TIPO:</strong> <?php echo $userRole; ?></p>
                </div>
            </div>

            <!-- Botões de Ação (Para trocar a foto) -->
            <div class="d-grid gap-2 col-10 mx-auto mb-4">
                <button type="button" class="btn btn-sm btn-outline-primary" style="border-color: #0D6EFD; color: #0D6EFD;" onclick="alert('Funcionalidade de upload de foto a ser implementada!')">
                    <span style="font-size: 1.2em; vertical-align: middle;">📸</span> Alterar Foto
                </button>
            </div>
            
            <!-- Código de Barras -->
            <div class="text-center p-3 border-top">
                <img src="<?php echo $barcodeUrl; ?>" class="barcode-img" alt="Código de Barras Matrícula">
                <p class="small text-muted mt-1"><?php echo $barcodeData; ?></p>
            </div>
            
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>