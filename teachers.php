<?php
require 'config.php';
require 'header.php';

// ----------------------------------------------------------------------
// VARIÁVEL PARA IMAGEM DE TOPO (REMOVIDA NA ETAPA ANTERIOR)
// ----------------------------------------------------------------------
$headerImageUrl = ''; 

// ----------------------------------------------------------------------
// DADOS HARDCODED (15 Professores)
// ----------------------------------------------------------------------

// Dados dos Professores (Disciplinas de Formação Geral)
$teachers = [
    [
        'name' => 'Prof. Jesus', 
        'course' => 'Desenvolvimento de Sistemas', 
        'description' => 'Coordenação de projetos técnicos e sistemáticos.'
    ],
    [
        'name' => 'Prof. Rosângela', 
        'course' => 'Matemática', 
        'description' => 'Especialista em cálculo e lógica aplicada ao raciocínio crítico.'
    ],
    [
        'name' => 'Prof. Simone', 
        'course' => 'Português', 
        'description' => 'Focada em linguística, redação e interpretação de textos técnicos.'
    ],
    [
        'name' => 'Prof. Marlos', 
        'course' => 'Sociologia', 
        'description' => 'Abordando a estrutura social, cultura e o impacto da tecnologia na sociedade.'
    ],
    [
        'name' => 'Prof. Tiago', 
        'course' => 'História', 
        'description' => 'Docente em história contemporânea, política e relações internacionais.'
    ],
    [
        'name' => 'Prof. Joyce', 
        'course' => 'Geografia', 
        'description' => 'Estudo de geoprocessamento, clima, recursos naturais e geopolítica.'
    ],
    [
        'name' => 'Prof. Joyce', 
        'course' => 'Práticas Profissionais', 
        'description' => 'Ênfase em ética, liderança, comunicação no ambiente de trabalho e soft skills.'
    ],
    [
        'name' => 'Prof. Flávia', 
        'course' => 'Filosofia', 
        'description' => 'Focada em pensamento crítico, ética e teoria do conhecimento.'
    ],
    [
        'name' => 'Prof. Gilda', 
        'course' => 'Biologia', 
        'description' => 'Especialista em ecologia, genética e sustentabilidade ambiental.'
    ],
    [
        'name' => 'Prof. Thiago Luz', 
        'course' => 'Química', 
        'description' => 'Focado em química inorgânica e orgânica, com aplicações práticas e ambientais.'
    ],
    [
        'name' => 'Prof. Francisco', 
        'course' => 'Física', 
        'description' => 'Professor de mecânica, termodinâmica e eletromagnetismo.'
    ],
    [
        'name' => 'Prof. Hudson', 
        'course' => 'Educação Física', 
        'description' => 'Focado em saúde, bem-estar, esportes e qualidade de vida.'
    ],
    [
        'name' => 'Prof. Valdirene', 
        'course' => 'Projeto de Vida', 
        'description' => 'Apoiando o planejamento de carreira e o desenvolvimento de metas pessoais.'
    ],
    [
        'name' => 'Prof. Jorge', 
        'course' => 'Educação Fiscal', 
        'description' => 'Focado em cidadania, impostos e a função social do Estado e do orçamento público.'
    ],
    [
        'name' => 'Prof. Déborah', 
        'course' => 'Estudos Orientados', 
        'description' => 'Promovendo a autonomia, organização e otimização do tempo de estudo.'
    ],
];

// Dados da Gestão Escolar (Mantidos)
$management = [
    [
        'name' => 'Pedro', 
        'role' => 'Diretor', 
        'description' => 'Responsável pela visão estratégica, liderança e sucesso da instituição.'
    ],
    [
        'name' => 'Cristine', 
        'role' => 'Diretora', 
        'description' => 'Responsável pela visão estratégica, liderança e sucesso da instituição.'
    ],
    [
        'name' => 'Silvio', 
        'role' => 'Vice-Diretor(a)', 
        'description' => 'Apoia a gestão geral, focando em operações diárias e coordenação de recursos.'
    ],
    [
        'name' => 'Margareth', 
        'role' => 'Vice-Diretor(a)', 
        'description' => ' Gerencia a infraestrutura, os laboratórios técnicos e a prática profissional.'
    ],
    [
        'name' => 'Flávinha', 
        'role' => 'Supervisora', 
        'description' => 'Cuida do bem-estar dos alunos, problemas relatados e organização escolar.'
    ],
    [
        'name' => 'Valéria', 
        'role' => 'Coordenadora', 
        'description' => 'Apoia o desenvolvimento pessoal e acadêmico dos alunos, oferecendo suporte emocional.'
    ],
    [
        'name' => 'Breno', 
        'role' => 'Coordenador', 
        'description' => 'Apoia o desenvolvimento pessoal e acadêmico dos alunos, oferecendo suporte emocional.'
    ],
    [
        'name' => 'Bruna', 
        'role' => 'Coordenadora', 
        'description' => 'Apoia o desenvolvimento pessoal e acadêmico dos alunos, oferecendo suporte emocional.'
    ],
    [
        'name' => 'Rosângela', 
        'role' => 'Coordenadora', 
        'description' => 'Apoia o desenvolvimento pessoal e acadêmico dos alunos, oferecendo suporte emocional.'
    ],

];

// ----------------------------------------------------------------------
// ESTILOS CUSTOMIZADOS (Com divisão de cores: Azul vs Preto)
// ----------------------------------------------------------------------
?>

<style>
    /* ------------------------------------------------------ */
    /* MELHORIAS VISUAIS GERAIS */
    /* ------------------------------------------------------ */

    /* Container Principal: Adiciona profundidade e sombra */
    .container.page-content {
        padding-top: 50px;
        padding-bottom: 50px;
        background-color: #ffffffb9; 
        border-radius: 1rem; 
        /* Sombra mais suave e moderna */
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08); 
    }

    /* Section Title: Glow effect e linha de gradiente */
    .section-title {
        text-transform: uppercase;
        letter-spacing: 1.5px; 
        font-weight: 700;
        padding-bottom: 8px;
        margin-top: 3rem; 
        position: relative;
        /* Efeito de brilho sutil */
        text-shadow: 0 0 5px rgba(13, 110, 253, 0.3); 
    }
    
    /* Linha Divisória de Gradiente (Geral) */
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px; /* Linha mais longa */
        height: 3px;
        background-color: var(--bs-secondary); 
        border-radius: 5px;
    }

    /* Linha Divisória para o Título AZUL (Docentes) */
    .section-title.text-primary::after {
        background: linear-gradient(to right, transparent, var(--bs-primary), transparent);
    }
    /* Linha Divisória para o Título ESCURO (Gestão) */
    .section-title.text-dark::after {
        background: linear-gradient(to right, transparent, var(--bs-dark), transparent);
    }

    /* ------------------------------------------------------ */
    /* ESTILOS DOS CARDS (Docentes e Gestão) */
    /* ------------------------------------------------------ */

    /* Estilo para o CARD GERAL: Mais compacto e com transição */
    .team-member-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border: 1px solid #e9ecef; 
        border-top: 5px solid transparent; 
        border-radius: .4rem; 
        min-height: 180px; 
        padding: 15px; 
        position: relative; 
    }
    .team-member-card:hover {
        transform: translateY(-3px); 
        /* Sombra aprimorada: externa (levantar) + interna (3D/recesso) */
        box-shadow: inset 0 0 10px rgba(13, 110, 253, 0.1), 0 0.5rem 1.5rem rgba(13, 110, 253, 0.25) !important;
    }

    /* Cores de Borda: Docente AZUL, Gestão PRETO */
    .teacher-top-border { 
        border-top-color: var(--bs-primary) !important; 
    }
    .management-top-border { 
        border-top-color: var(--bs-dark) !important; 
    }

    /* CARIMBO DECORATIVO (Estrela/Coração) - APARECE NO HOVER */
    .team-member-card::after {
        content: "⭐"; 
        position: absolute;
        top: -10px;
        right: -10px;
        font-size: 1.5rem;
        opacity: 0; 
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        transform: scale(0.5);
        z-index: 10;
    }

    .management-top-border::after {
        content: "✨"; 
    }

    .team-member-card:hover::after {
        opacity: 1; 
        transform: scale(1) rotate(5deg);
    }

    /* FUNDOS TRANSLÚCIDOS: Docente AZUL, Gestão PRETO */
    .teacher-bg-light {
        background-color: rgba(13, 110, 253, 0.05); 
    }
    .management-bg-light {
        background-color: rgba(33, 37, 41, 0.05); 
    }
    
    /* ------------------------------------------------------ */
    /* ANIMAÇÃO DO SEPARADOR */
    /* ------------------------------------------------------ */
    .animated-separator {
        overflow: hidden;
        padding: 10px 0;
    }
    .animated-separator i {
        font-size: 1.5rem;
        color: var(--bs-primary);
        animation: pulse 1.5s infinite ease-in-out; /* Animação de pulsar */
        margin: 0 10px;
        display: inline-block;
    }
    /* Atraso para um efeito cascata */
    .animated-separator i:nth-child(even) { animation-delay: 0.3s; }
    .animated-separator i:nth-child(odd) { animation-delay: 0s; }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.8; }
        50% { transform: scale(1.15); opacity: 1; }
        100% { transform: scale(1); opacity: 0.8; }
    }


    /* ------------------------------------------------------ */
    /* HOVER CUSTOMIZADO (Mantido) */
    /* ------------------------------------------------------ */

    .team-member-card:hover .text-primary {
        color: #0a58ca !important; 
    }

    .team-member-card:hover .text-muted {
        color: #000000 !important;
    }

    .team-member-card:hover .text-dark { 
        color: #000000 !important; 
    }
    
    .team-member-card:hover .badge.bg-primary {
        background-color: #0a58ca !important; 
        color: #f9f9f9ff !important; 
    }
    
    .team-member-card:hover .badge.bg-dark {
        background-color: #3b4a5aff !important; 
        color: #fff !important; 
    }
</style>

<div class="container mt-5 mb-5 page-content">

    <h1 class="section-title text-center text-primary mb-5">
        <i class="bi bi-person-video2 me-2"></i> EQUIPE DESENVOLVIMENTO DE SISTEMAS <span style="font-size: 1.2rem;"></span>
    </h1>
    <p class="lead mb-4 text-center text-muted small">
        Especialistas da educação, transformando estudantes em cidadãos bem sucedidos.
    </p>

    <div class="row g-3 justify-content-center">
        <?php foreach($teachers as $t): 
            $teacherName = htmlspecialchars($t['name']);
            $course = htmlspecialchars($t['course']);
            $description = htmlspecialchars($t['description']);

            // Mapeamento de Ícones de Curso (TUDO AZUL: bg-primary)
            $courseIcon = 'bi-book'; 
            $courseTagClass = 'bg-primary'; 

            if (strpos($course, 'Matemática') !== false) {
                $courseIcon = 'bi-calculator';
            } elseif (strpos($course, 'Português') !== false) {
                $courseIcon = 'bi-chat-left-text';
            } elseif (strpos($course, 'Sociologia') !== false || strpos($course, 'História') !== false || strpos($course, 'Filosofia') !== false) {
                $courseIcon = 'bi-book';
            } elseif (strpos($course, 'Geografia') !== false) {
                $courseIcon = 'bi-globe-americas';
            } elseif (strpos($course, 'Práticas Profissionais') !== false) {
                $courseIcon = 'bi-briefcase';
            } elseif (strpos($course, 'Biologia') !== false || strpos($course, 'Química') !== false || strpos($course, 'Física') !== false) {
                $courseIcon = 'bi-dna';
            } elseif (strpos($course, 'Educação Física') !== false) {
                $courseIcon = 'bi-person-running';
            } elseif (strpos($course, 'Projeto de Vida') !== false || strpos($course, 'Estudos Orientados') !== false) {
                $courseIcon = 'bi-journal-check';
            } elseif (strpos($course, 'Educação Fiscal') !== false) {
                $courseIcon = 'bi-cash-coin';
            } elseif (strpos($course, 'Curso') !== false) {
                $courseIcon = 'bi-mortarboard';
            }
        ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 team-member-card teacher-top-border teacher-bg-light">
                    <div class="card-body p-3 d-flex flex-column text-center">
                        
                        <i class="bi bi-person-circle fs-3 mb-2 text-primary"></i>
                        
                        <h6 class="card-title fw-bolder mb-0 text-dark">
                            <?php echo $teacherName; ?>
                        </h6>
                        
                        <p class="mb-2">
                            <span class="badge <?php echo $courseTagClass; ?> fw-normal small">
                                <i class="bi <?php echo $courseIcon; ?> me-1"></i> <?php echo $course; ?>
                            </span>
                        </p>
                        
                        <p class="card-text text-muted small fst-italic flex-grow-1" style="font-size: 0.8rem;">
                            <?php echo $description; ?>
                        </p>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-5 mb-5 animated-separator">
        <h3 class="text-muted fw-light">
            <i class="bi bi-heart-fill"></i>
            <i class="bi bi-lightning-fill"></i>
            
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-heart-fill"></i>
        </h3>
    </div>
    <h2 class="section-title text-center text-dark mt-5 mb-5">
        <i class="bi bi-kanban me-2"></i> GESTÃO DUTRA <span style="font-size: 1.2rem;"></span>
    </h2>
    <p class="lead mb-4 text-center text-muted small">
        Os pilares administrativos e estratégicos da EEPD.
    </p>

    <div class="row g-3 justify-content-center">
        <?php foreach($management as $m): 
            $managerName = htmlspecialchars($m['name']);
            $role = htmlspecialchars($m['role']);
            $description = htmlspecialchars($m['description']);

            // Mapeamento de Ícones de Cargo (TUDO PRETO: bg-dark)
            $managementIcon = 'bi-person';
            $roleTagClass = 'bg-dark'; 
            
            // Lógica de mapeamento baseada na função (Mantida)
            if (strpos($role, 'Diretor') !== false) {
                $managementIcon = 'bi-flag';
            } elseif (strpos($role, 'Vice-Diretor') !== false) {
                $managementIcon = 'bi-person-badge';
            } elseif (strpos($role, 'Surpevisora') !== false) {
                $managementIcon = 'bi-file-earmark-text'; 
            } elseif (strpos($role, 'Coordenador') !== false) {
                $managementIcon = 'bi-chat-dots';
            }
        ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 team-member-card management-top-border management-bg-light">
                    <div class="card-body p-3 d-flex flex-column text-center">
                        
                        <i class="bi <?php echo $managementIcon; ?> fs-3 mb-2 text-dark"></i>

                        <h6 class="card-title fw-bolder mb-0 text-dark">
                            <?php echo $managerName; ?>
                        </h6>
                        
                        <p class="mb-2">
                            <span class="badge <?php echo $roleTagClass; ?> text-uppercase fw-normal small">
                                <?php echo $role; ?>
                            </span>
                        </p>
                        
                        <p class="card-text text-muted small fst-italic flex-grow-1" style="font-size: 0.8rem;">
                            <?php echo $description; ?>
                        </p>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require 'footer.php'; ?>