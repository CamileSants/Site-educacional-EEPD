<?php
require 'config.php';
require 'header.php';

// Dados dos cursos com descrições mais elaboradas (resumo)
$coursesData = [
    ['title' => 'Desenvolvimento de Sistemas', 'id' => 1, 'description' => 'Aprenda a construir e programar softwares, desde aplicativos móveis e jogos até sistemas complexos para empresas, utilizando as linguagens e tecnologias mais atuais do mercado.'],
    ['title' => 'Informática', 'id' => 2, 'description' => 'Foco nos fundamentos da computação. Você vai estudar manutenção de computadores, redes de dados, segurança da informação e como dar suporte técnico a usuários e sistemas.'],
    ['title' => 'Logística', 'id' => 3, 'description' => 'Organize o fluxo de materiais, produtos e informações. O curso aborda planejamento de transporte, gestão de estoque, compras, distribuição e otimização de toda a cadeia produtiva.'],
    ['title' => 'Fabricação Mecânica', 'id' => 4, 'description' => 'Desenvolva habilidades em processos industriais, como usinagem, soldagem e controle numérico. Você aprenderá a projetar e fabricar peças e equipamentos com precisão técnica.'],
    ['title' => 'Energia Renovável', 'id' => 5, 'description' => 'Prepare-se para o futuro da energia. O curso foca na instalação, manutenção e gestão de sistemas de energia limpa, como painéis solares (fotovoltaicos) e turbinas eólicas.'],
    ['title' => 'Segurança do Trabalho', 'id' => 6, 'description' => 'Garanta ambientes de trabalho seguros e saudáveis. O curso ensina a identificar riscos, elaborar programas de prevenção, inspecionar equipamentos e aplicar normas de segurança.'],
    ['title' => 'Propedêutica', 'id' => 7, 'description' => 'Um curso preparatório fundamental que fortalece sua base em matérias essenciais (como Matemática e Português), preparando você de forma sólida para os desafios da vida adulta.'],
    ['title' => 'Eletrônica', 'id' => 8, 'description' => 'Projete, monte e teste circuitos eletrônicos. Você vai trabalhar com microcontroladores, automação e sistemas digitais, essenciais na tecnologia moderna.']
];
?>

<div class="container mt-4">

    <h1>Cursos Oferecidos</h1>
    <p class="lead mb-4">Conheça nossos cursos técnicos e as oportunidades de carreira que eles oferecem.</p>

    <!-- Adicionando d-flex e align-items-stretch para garantir que os cards tenham a mesma altura -->
    <div class="row g-4 d-flex align-items-stretch">
        <?php foreach($coursesData as $c): ?>
            <!-- Card de tamanho 4 (3 cards por linha em desktop) -->
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card h-100 shadow-sm border-0">
                    
                    <!-- Espaço reservado para a imagem (CAMINHO CORRIGIDO) -->
                    <!-- Salve suas imagens em: assets/images/curso/curso-1.jpg, curso-2.jpg, etc. -->
                    <?php 
                        // Corrigido para 'assets/images/curso/'
                        $imagePath = 'assets/images/curso/curso-' . $c['id'] . '.jpg';
                        $placeholderSrc = "https://placehold.co/600x400/1E3A8A/ffffff?text=Curso+" . $c['id'];
                    ?>
                    <img 
                        src="<?php echo $imagePath; ?>" 
                        class="card-img-top" 
                        alt="Imagem do curso de <?php echo htmlspecialchars($c['title']); ?>"
                        style="height: 200px; object-fit: cover;"
                        onerror="this.onerror=null; this.src='<?php echo $placeholderSrc; ?>'"
                    >

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-primary"><?php echo htmlspecialchars($c['title']); ?></h5>
                        <!-- O resumo foi expandido aqui -->
                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($c['description']); ?></p>
                        <!-- O botão 'Mais Detalhes' foi removido desta seção -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require 'footer.php'; ?>