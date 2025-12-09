<?php
// Note: Assumindo que 'require 'config.php';' e 'require 'header.php';'
// estão corretos no seu ambiente Bootstrap.

require 'config.php';
require 'header.php';

// Carousel: choose up to 8 random images from assets/images/carrosel (fallback placeholders)
// DIRETÓRIO DE IMAGENS ATUALIZADO PARA 'assets/images/carrosel'
$imgDir = __DIR__ . '/assets/images/carrosel';
$images = [];

if (is_dir($imgDir)) {
    // Busca imagens reais
    foreach (glob($imgDir . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $f) {
        // Exclui a imagem de fundo e a logo para o carrossel (assumindo que foram nomeadas nos outros arquivos)
        if (basename($f) !== 'fundo_site.jpg' && basename(dirname($f)) !== 'logo.png') {
            $images[] = basename($f);
        }
    }
}

shuffle($images);
$images = array_slice($images, 0, 8);

if (count($images) < 1) {
    // fallback placeholders se nenhuma imagem for encontrada
    // Usando placehold.co para URLs externas
    $images = [
        'https://placehold.co/1200x500/1E3A8A/ffffff?text=Slide+1',
        'https://placehold.co/1200x500/2563EB/ffffff?text=Slide+2',
        'https://placehold.co/1200x500/DC2626/ffffff?text=Slide+3'
    ];
}
?>

<style>
    /* Estilo customizado para os cards de destaque */
    .custom-card {
        padding: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    .custom-card .icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    /* ------------------------------------------------ */
    /* ESTILOS REFINADOS PARA A SEÇÃO DE INFRAESTRUTURA */
    /* ------------------------------------------------ */

    .infra-section {
        background-color: transparent; 
        padding: 40px 0;
        margin-bottom: 50px;
    }

    .infra-section h2 {
        color: #343a40; 
        font-weight: 600;
        margin-bottom: 40px;
        border-bottom: 2px solid #007bff; 
        display: inline-block;
        padding-bottom: 5px;
    }
    
    /* Card principal: mais arredondado, sombra mais suave */
    .info-card {
        border: none;
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); 
        background-color: #ffffff;
        padding: 30px;
    }

    /* NOVO: Estilo para os mini-cards internos */
    .mini-card {
        background-color: #f7f9fc; /* Fundo suave para separar */
        border: 1px solid #e0e6ed;
        border-radius: 15px; /* Bordas arredondadas */
        padding: 20px;
        height: 100%; /* Garante que todos tenham a mesma altura */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); /* Sombra leve */
        transition: transform 0.3s;
    }
    .mini-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Título da Categoria: Centralizado no Mini-Card */
    .info-category-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E3A8A;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: none; 
        display: flex;
        align-items: center;
        justify-content: center; 
        gap: 8px; 
        text-align: center;
    }
    
    .info-category-title .emoji-icon {
        font-size: 1.5rem;
        background-color: #e0f7fa; 
        color: #007bff;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Estilo para cada item listado: ALINHAMENTO À ESQUERDA DENTRO DO MINI-CARD */
    .info-item {
        margin-bottom: 12px; 
        color: #555; 
        font-size: 0.95rem;
        display: flex;
        align-items: flex-start;
        text-align: left; 
    }
    
    .info-item i {
        color: #28a745; 
        margin-right: 10px;
        font-size: 1.1rem;
        flex-shrink: 0; 
        margin-top: 3px;
    }
    
    .final-message {
        text-align: center;
        margin-top: 30px;
        font-size: 1rem;
        padding: 15px;
        border-radius: 10px;
        background-color: #e0f7fa; /* Fundo fofo para a mensagem final */
        color: #1E3A8A;
        font-weight: bold;
    }

</style>

<div class="container mt-4">

    <h1 class="mb-3">Bem-vindo ao Presidente Dutra</h1>
    
    <div id="mainCarousel" 
          class="carousel slide mb-4 shadow-lg" 
          data-bs-ride="carousel" 
          data-bs-interval="2500">

        <div class="carousel-indicators">
            <?php foreach ($images as $i => $img): ?>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></button>
            <?php endforeach; ?>
        </div>

        <div class="carousel-inner">
            <?php
            foreach ($images as $i => $img):
                $src = (strpos($img, 'http') === 0) ? $img : 'assets/images/carrosel/' . $img; // CAMINHO DE BUSCA ATUALIZADO
                $active = $i === 0 ? 'active' : '';
            ?>
                <div class="carousel-item <?= $active ?>">
                    <img src="<?= $src ?>" class="d-block w-100" alt="Slide <?= $i + 1 ?>" style="max-height:500px;object-fit:cover;">

                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-white">Escola Estadual Presidente Dutra - BH</h5>
                        <p>Excelência no Ensino para o Futuro.</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-4">Destaques</h2>
        <div class="row g-4 d-flex align-items-stretch"> 

            <div class="col-md-3">
                <div class="custom-card h-100">
                    <div class="icon">🏫</div>
                    <h4>História</h4>
                    <p>Conheça a trajetória da nossa escola.</p>
                    <a href="about.php" class="btn btn-primary mt-2">Ver mais</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="custom-card h-100">
                    <div class="icon">📘</div>
                    <h4>Cursos</h4>
                    <p>Veja os cursos disponiveis.</p>
                    <a href="courses.php" class="btn btn-primary mt-2">Ver mais</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="custom-card h-100">
                    <div class="icon">👨‍🏫</div>
                    <h4>Professores</h4>
                    <p>Conheça nosso corpo docente.</p>
                    <a href="teachers.php" class="btn btn-primary mt-2">Ver mais</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="custom-card h-100">
                    <div class="icon">📰</div>
                    <h4>Blog</h4>
                    <p>Notícias e novidades da escola.</p>
                    <a href="blog.php" class="btn btn-primary mt-2">Ler blog</a>
                </div>
            </div>

        </div>
    </div>
    
    <div class="row mt-5 mb-5">
        
        <div class="col-md-8">
            <h3>Onde nos Localizamos?</h3>
            <p class="lead">Av. José Cândido da Silveira, 2000 - Horto Florestal, Belo Horizonte - MG, 31170-000, Brasil</p>
            
            <div class="shadow-lg rounded-3 overflow-hidden" style="height: 350px;">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3749.1990422204566!2d-43.90563458489726!3d-19.92555364402604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa698c92b2d075d%3A0x1d75c962b146e91!2sAv.%20Jos%C3%A9%20C%C3%A2ndido%20da%20Silveira%2C%202000%20-%20Horto%20Florestal%2C%20Belo%20Horizonte%20-%20MG%2C%2031170-000%2C%20Brasil!5e0!3m2!1spt-BR!2sus!4v1701398400000!5m2!1spt-BR!2sus" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="col-md-4">
            <div class="custom-card p-4 h-100">
                <h5 class="mb-3 text-primary fw-bold">Próximos Eventos</h5>
                
                <div class="event-item mb-3 pb-2 border-bottom">
                    <span class="badge bg-danger text-white rounded-pill mb-1">03/DEZ</span>
                    <p class="mb-0 fw-bold">Prova Ciências Humanas</p>
                    <small class="text-muted">Salas de Aula</small>
                </div>

                <div class="event-item mb-3 pb-2 border-bottom">
                    <span class="badge bg-primary text-white rounded-pill mb-1">10/DEZ</span>
                    <p class="mb-0 fw-bold">Jantar Formandos</p>
                    <small class="text-muted">Cantina</small>
                </div>

                <div class="event-item mb-3">
                    <span class="badge bg-success text-white rounded-pill mb-1">13/DEZ</span>
                    <p class="mb-0 fw-bold">Colação de Grau</p>
                    <small class="text-muted">Faminas</small>
                </div>

                <a href="events.php" class="btn btn-primary btn-sm mt-2 w-100">Ver Calendário Letivo</a>
            </div>
        </div>
    </div>
    
    
    <div class="row justify-content-center infra-section">
        <div class="col-12 col-lg-10 text-center">
            <h2 class="mb-5">Infraestrutura e Recursos EEPD</h2>
            
            <div class="card info-card">
                <div class="card-body">
                    <p class="text-muted small mb-4">✨ Detalhes da nossa estrutura (Censo Escolar 2023)</p>
                    
                    <div class="row g-4 mb-4 d-flex align-items-stretch">
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="mini-card">
                                <div class="info-category-title">
                                    <span class="emoji-icon">♿</span> Acessibilidade & Estrutura
                                </div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Banheiro adequado para PCD/mobilidade reduzida</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Biblioteca com Sala de leitura</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Quadra de esportes coberta e descoberta</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Pátio coberto e descoberto</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Auditório e Laboratório de ciências</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Cozinha e Refeitório (Alimentação escolar)</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="mini-card">
                                <div class="info-category-title">
                                    <span class="emoji-icon">💻</span> Tecnologia & Inovação
                                </div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Internet Banda Larga (uso pedagógico)</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Laboratório de informática e Desktop para aluno</div>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="mini-card">
                                <div class="info-category-title">
                                    <span class="emoji-icon">🧑‍💼</span> Equipe e Suporte
                                </div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Bibliotecário(a) e monitores de leitura</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Profissionais de preparação e segurança alimentar</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Profissionais de apoio e supervisão pedagógica</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-4 d-flex align-items-stretch justify-content-center">
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="mini-card">
                                <div class="info-category-title">
                                    <span class="emoji-icon">🌳</span> Sustentabilidade
                                </div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Área verde no campus</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="mini-card">
                                <div class="info-category-title">
                                    <span class="emoji-icon">📚</span> Material Didático
                                </div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Acervo multimídia e Jogos Educativos</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Equipamento para amplificação de som/áudio</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="mini-card">
                                <div class="info-category-title">
                                    <span class="emoji-icon">🛠️</span> Materiais Específicos
                                </div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Materiais para Educação Profissional</div>
                                <div class="info-item"><i class="bi bi-check-circle-fill"></i> Materiais para prática desportiva e recreação</div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <p class="final-message">
                        Nosso ambiente é pensado para o seu máximo desenvolvimento!
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
    </div> <?php require 'footer.php'; ?>