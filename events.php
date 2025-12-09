<?php
// Garante que a sessão está iniciada (necessário para o header.php)
if (session_status() == PHP_SESSION_NONE) session_start();

require 'config.php'; 
require 'header.php'; 

// --- CONFIGURAÇÃO DAS IMAGENS ---

// Lista de arquivos de calendário que você deseja exibir
$calendarFiles = [
    'calendario1.png', 
    'calendario2.png'  
];

$baseDir = 'assets/images/';
$calendarData = [];

// Verifica quais arquivos existem e monta o array de dados
foreach ($calendarFiles as $fileName) {
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . $baseDir . $fileName;
    // Verifica se o arquivo existe E se é legível para evitar erros
    if (file_exists($filePath) && is_readable($filePath)) {
        $calendarData[] = [
            'url' => $baseDir . $fileName,
            'name' => str_replace('.png', '', $fileName),
            'modified' => filemtime($filePath)
        ];
    }
}
// --- FIM DA LÓGICA PHP ---
?>

<style>
    /* Estilos para o container principal */
    .calendar-container {
        max-width: 1200px; /* Aumentamos a largura para acomodar duas colunas */
        margin: 30px auto;
        padding: 30px;
        background-color: #f8f9fa; 
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); 
    }

    /* Estilos para a área da imagem */
    .calendar-wrapper {
        overflow: hidden; 
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.4s ease-in-out; /* Transição suave para o zoom */
        cursor: zoom-in; 
    }

    /* Estilos para a imagem em si */
    .calendar-image {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 10px;
    }

    /* Efeito de Zoom ao passar o mouse */
    .calendar-wrapper:hover {
        transform: scale(1.02); /* Aumenta um pouco o wrapper */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Acentua a sombra no hover */
    }
    
    /* Estilo para a área de destaque (ex: data de atualização) */
    .info-badge {
        display: inline-block;
        padding: 6px 12px;
        background-color: #e9ecef;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
        color: #6c757d;
        margin-top: 10px;
    }
    
    /* Centraliza os títulos e badges dentro da coluna */
    .calendar-item {
        text-align: center;
    }
</style>

<div class="container my-5">
    
    <h1 class="text-center text-primary mb-2">
        <span class="me-2">📅</span> Calendário de Eventos
    </h1>
    <p class="lead text-center text-muted mb-5">
        Datas importantes, feriados e cronograma letivo oficial da escola.
    </p>

    <div class="calendar-container">
        
        <h2 class="mb-4 text-dark text-center">Calendário Letivo Oficial 2025</h2>

        <?php if (!empty($calendarData)): ?>
            
            <div class="row g-4"> 
                
                <?php foreach($calendarData as $calendar): ?>
                    <div class="col-12 col-md-6 calendar-item">
                        
                        <div class="calendar-wrapper">
                            <img src="<?php echo htmlspecialchars($calendar['url']); ?>?t=<?php echo time(); ?>" 
                                 alt="Calendário Oficial" 
                                 class="calendar-image"
                                 title="Passe o mouse para ver em destaque, clique para ampliar."
                                 onclick="window.open(this.src, '_blank');"
                            >
                        </div>
                        
                        <span class="info-badge">
                            Atualizado: <?php echo date("d/m/Y H:i", $calendar['modified']); ?>
                        </span>
                    </div>
                <?php endforeach; ?>
                
            </div> <div class="text-center mt-5 pt-3 border-top text-muted small">
                <p>Em caso de dúvidas sobre as datas, consulte a Secretaria Escolar.</p>
            </div>
        
        <?php else: ?>
            
            <div class="alert alert-danger text-center p-4">
                <h4 class="alert-heading">⚠️ Calendários Não Encontrados</h4>
                <p>Nenhum dos arquivos de calendário esperados foi encontrado na pasta **`assets/images/`**.</p>
                <hr>
                <p class="mb-0 small">Verifique se as imagens `calendario1.png` e `calendario2.png` estão no local correto.</p>
            </div>
            
            <img src="https://placehold.co/900x600/CCCCCC/666666?text=Calend%C3%A1rio+Indispon%C3%ADvel" 
                 alt="Placeholder Calendário" 
                 class="calendar-image">

        <?php endif; ?>
        
    </div>
    
</div>

<?php require 'footer.php'; ?>