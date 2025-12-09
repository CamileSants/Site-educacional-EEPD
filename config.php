<?php
// config.php - database configuration (edit with your credentials)
$DB_HOST = '127.0.0.1';
$DB_NAME = 'eepd_bh';
$DB_USER = 'root';
$DB_PASS = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Tenta estabelecer a conexão com o banco de dados
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, $options);
} catch (Exception $e) {
    // Se a conexão falhar, interrompe o script e exibe a mensagem de erro
    die('Database connection failed: ' . $e->getMessage());
}

// ----------------------------------------------------
// CORREÇÃO DO AVISO DE SESSÃO:
// ----------------------------------------------------

// Verifica se a sessão ainda não está ativa (PHP_SESSION_NONE) antes de iniciá-la
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>