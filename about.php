<?php
require 'config.php';
require 'header.php';
?>

<style>
    /* VARIÁVEIS DE CORES (Mantidas) */
    :root {
        --azul-cadeira: #3b5998; /* Azul Escuro Elegante */
        --vermelho-detalhe: #dc2626; /* Vermelho de Contraste e Destaque */
        --branco-fundo: #ffffff; 
        --cinza-claro: #f8f9fa; /* Fundo leve para os cards */
        --cor-texto-principal: #212529; 
        --fonte-principal: 'Poppins', sans-serif;
        --sombra-card: 0 10px 30px rgba(0, 0, 0, 0.05);
        --sombra-card-hover: 0 15px 45px rgba(59, 89, 152, 0.2); 
    }

    /* ---------------------------------- */
    /* ESTILOS DE ELEMENTOS GERAIS */
    /* ---------------------------------- */
    .history-page-container {
        background-color: var(--cinza-claro); /* Fundo mais suave */
        padding: 80px 0; 
        position: relative;
    }

    /* Título (Minimalista e Forte) */
    .case-title {
        color: var(--azul-cadeira);
        font-family: var(--fonte-principal);
        text-transform: uppercase;
        letter-spacing: 5px;
        border-bottom: 2px solid var(--vermelho-detalhe); 
        display: inline-block;
        padding-bottom: 5px;
        font-weight: 800;
        font-size: 2.8rem;
        margin-bottom: 15px;
    }

    .case-lead {
        color: var(--cor-texto-principal);
        font-weight: 400;
        font-size: 1.2rem;
        margin-top: 15px;
        font-family: var(--fonte-principal);
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }


    /* ---------------------------------- */
    /* ESTRUTURA LINHA DO TEMPO (MODERNA) */
    /* ---------------------------------- */
    .timeline-container {
        position: relative;
        padding-left: 0; 
        margin-top: 70px;
    }

    /* A LINHA CENTRAL (Eixo) */
    .timeline-container:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%; 
        width: 2px; /* Linha um pouco mais grossa */
        background-color: var(--azul-cadeira); 
        margin-left: -1px; 
        z-index: 1; 
    }

    .timeline-item {
        position: relative;
        margin-bottom: 70px; /* Espaçamento menor entre os itens */
        padding-top: 50px; 
    }
    
    /* O MARCADOR DO ANO (Pino Central) - NOVO EFEITO */
    .timeline-item::after {
        content: attr(data-year); 
        position: absolute;
        top: 0; 
        left: 50%;
        width: 100px;
        height: 35px;
        background-color: var(--vermelho-detalhe); /* Destaque em Vermelho */
        color: var(--branco-fundo);
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 35px;
        text-align: center;
        border-radius: 4px;
        margin-left: -50px;
        z-index: 11; 
        /* Círculo de Destaque */
        box-shadow: 0 0 0 10px var(--cinza-claro); /* Sombra que "corta" a linha */
        border: 2px solid var(--vermelho-detalhe); 
        transition: all 0.3s ease;
    }
    .timeline-item:hover::after {
        transform: scale(1.05);
        box-shadow: 0 0 0 15px var(--cinza-claro); 
    }
    
    /* ---------------------------------- */
    /* NOVOS CARDS DE EVENTO */
    /* ---------------------------------- */

    .event-card-body {
        background-color: var(--branco-fundo);
        border-radius: 8px;
        box-shadow: var(--sombra-card); 
        padding: 30px;
        height: 100%;
        transition: all 0.4s ease;
        position: relative;
        z-index: 10; 
        margin-top: 25px; 
        border-left: 5px solid var(--azul-cadeira); /* Borda Lateral Moderna */
    }
    
    .event-card-body:hover {
        box-shadow: var(--sombra-card-hover); 
        transform: translateY(-5px); 
    }
    
    .event-card-title {
        color: var(--vermelho-detalhe);
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 10px;
        font-family: var(--fonte-principal);
    }
    
    .event-card-lead {
        font-style: italic;
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 15px;
        display: block;
    }

    /* ---------------------------------- */
    /* ESTILO DA IMAGEM (MAIS AUTÊNTICO) */
    /* ---------------------------------- */
    .timeline-image-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 30px; /* Alinhamento visual com o card */
    }
    .timeline-image-wrapper img {
        width: 90%;
        max-width: 400px;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Sombra Forte */
        border: 3px solid var(--branco-fundo);
        transition: transform 0.3s ease;
    }
    .timeline-image-wrapper img:hover {
        transform: scale(1.02);
    }

    /* ---------------------------------- */
    /* RESPONSIVIDADE (MOBILE FIRST) */
    /* ---------------------------------- */
    
    /* Desktop: Alternância de Posição */
    @media (min-width: 992px) {
        .timeline-right .row {
            flex-direction: row-reverse; /* Inverte texto e imagem */
        }
        /* Remove a Seta Antiga */
        .event-card-body::after {
            content: none !important;
        }
        .timeline-item {
            margin-bottom: 100px;
        }
    }
    
    /* Mobile: Ajustes */
    @media (max-width: 991px) {
        /* Move a linha central para a esquerda */
        .timeline-container:before {
            left: 20px; 
        }
        
        /* Move o pino de ano para o eixo esquerdo */
        .timeline-item::after {
            left: 20px;
            margin-left: -50px;
        }
        
        /* Alinha o card à linha esquerda */
        .event-card-body {
            margin-top: 45px; 
            margin-left: 10px;
            border-left: none; /* Remove a borda lateral */
            border-top: 5px solid var(--azul-cadeira); /* Adiciona borda superior */
        }
        
        /* A imagem fica empilhada */
        .timeline-image-wrapper {
            padding-top: 20px;
            margin-bottom: 20px;
        }
        .timeline-image-wrapper img {
            width: 80%;
            max-width: none;
        }
    }
</style>

<div class="history-page-container"> 
    <div class="container my-5">
        <header class="text-center mb-5">
            <h1 class="case-title"><i class="bi bi-clock-history me-3"></i>LEGADO INSTITUCIONAL DA EEPD</h1>
            <p class="case-lead">
                Desde o início até a atualidade da Escola Estadual Presidente Dutra</p>
        </header>

        <div class="timeline-container">

            <div class="timeline-item timeline-left" data-year="1966">
                <div class="row align-items-stretch">
                    
                    <div class="col-lg-6">
                        <div class="event-card-body">
                            <span class="fs-6 fw-bold text-uppercase text-muted">A Base de Tudo</span>
                            <h3 class="event-card-title">Início do Presidente Dutra</h3>
                            <span class="event-card-lead"> Origens </span>
                                A Escola Estadual Presidente Dutra é uma 
                                instituição de ensino público localizada em Belo Horizonte, Minas Gerais, 
                                que carrega o nome do ex-presidente brasileiro <b> Eurico Gaspar Dutra </b>(1883-1974), 
                                que governou o Brasil entre 1946 e 1951.<br> A escola representa um marco importante na história educacional da capital mineira, 
                                servindo como pilar fundamental
                                 para a formação de milhares de estudantes ao longo de sua trajetória.  
<span class="text-secondary small d-block mt-2"><i class="bi bi-patch-check-fill me-1"></i> Imagem disponibilizada pelo Google Maps-2009</span>
                        
                              </div>
                    </div>
                    
                    <div class="col-lg-6 d-flex justify-content-center">
                        <div class="timeline-image-wrapper">
                            <img src="assets/images/dutra.pres.jpg" alt="Desenho da Fachada Antiga da Escola">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="timeline-item timeline-right" data-year="2021">
                <div class="row align-items-stretch">
                    
                    <div class="col-lg-6 d-flex justify-content-center">
                        <div class="timeline-image-wrapper">
                            <img src="assets/images/feira.jpg" alt="Primeira feira tecnica de informatica">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="event-card-body">
                            <span class="fs-6 fw-bold text-uppercase text-muted">Novo Ensino Médio</span>
                            <h3 class="event-card-title">Ensino Técnico e Integral</h3>
                            <span class="event-card-lead">A preparação ideal ao futuro dos jovens</span>
                            
                            <p>Durante esta fase de consolidação, a escola ampliou significativamente sua oferta educacional, implementando modalidades 
                            inovadoras de ensino:</p>

                            <b>Ensino Médio Técnico Integral:</b> A escola passou a oferecer cursos técnicos profissionalizantes em regime integral,
                             combinando formação acadêmica com capacitação técnica, preparando os estudantes tanto para o mercado de trabalho 
                             quanto para o ensino superior.

                            <br><b>Projeto Escolar: </b>A instituição integrou programas educacionais especiais voltados para a formação cidadã e o desenvolvimento
                             de competências socioemocionais dos estudantes.

                          <br> <b> Novo Ensino Médio:</b> A escola adaptou-se à reformado Novo Ensino Médio, implementando itinerários formativos diversificados,
                             projetos de vida
                            <span class="text-secondary small d-block mt-2"><i class="bi bi-patch-check-fill me-1"></i>Imagem disponibilizada pelo Instagram @dutrapresidente</span>
                        
                              </div>
                    </div>
                </div>
            </div>

            <div class="timeline-item timeline-left" data-year="2023-HOJE">
                <div class="row align-items-stretch">
                    
                    <div class="col-lg-6">
                        <div class="event-card-body">
                            <span class="fs-6 fw-bold text-uppercase text-muted">Atualidade</span>
                            <h3 class="event-card-title">Novos tempos no Dutra</h3>
                            <span class="event-card-lead"> Todas somos protagonistas!</span>
                            
                           
                               Como instituição pública, a escola enfrenta os desafios típicos da educação brasileira contemporânea, 
                               incluindo a necessidade de recursos adequados, valorização dos profissionais da educação e adaptação às rápidas 
                               transformações tecnológicas e sociais. Apesar destes desafios, a Escola Estadual Presidente Dutra mantém seu compromisso <i>inabalável</i> 
                               com a excelência educacional.
<br>
                                A instituição continua desempenhando papel fundamental na formação educacional e cidadã da juventude belo-horizontina, 
                                sendo reconhecida pela comunidade como espaço de aprendizagem, convivência e desenvolvimento humano. A escola preserva viva a tradição de ensino
                                público de qualidade que a caracteriza desde sua fundação, preparando seus alunos para 
                                serem<b> protagonistas de suas histórias e agentes transformadores da sociedade.</b>

                            <span class="text-secondary small d-block mt-2"><i class="bi bi-patch-check-fill me-1"></i>Imagem disponibilizada pela comissão de formatura 2025</span>
                         </div>
                    </div>
                    
                    <div class="col-lg-6 d-flex justify-content-center">
                        <div class="timeline-image-wrapper">
                            <img src="assets/images/terceiro.jpg" alt="foto antiga">
                        </div>
                    </div>
                </div>
            </div>

            <div class="timeline-item timeline-right" data-year="JORNADA">
                <div class="row align-items-stretch">
                    
                    <div class="col-lg-6 d-flex justify-content-center">
                        <div class="timeline-image-wrapper">
                            <img src="assets/images/ex.jpg" alt="Colação de Grau">
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="event-card-body">
                            <span class="fs-6 fw-bold text-uppercase text-muted">Dedicação</span>
                            <h3 class="event-card-title">Legado EEPD</h3>
                            <span class="event-card-lead">Comunidade Dutra</span>
                            
                           
                           A Escola Estadual Presidente Dutra representa mais do que uma instituição educacional: é parte integrante da identidade cultural e social da comunidade que serve. 
                           Ao longo de sua história, a escola construiu laços profundos com as famílias locais, tornando-se referência de educação pública comprometida 
                           com a formação integral de crianças e jovens.
                          <br> Muitos ex-alunos da Escola Estadual Presidente Dutra mantêm <i>forte vínculo emocional</i> com a instituição, 
                           retornando anos depois para visitar professores, participar de eventos comemorativos ou até mesmo <b>matricular seus próprios filhos</b>, 
                           criando uma tradição familiar de gerações que passaram pelos corredores da escola.

                          <br>  Seu legado se manifesta nas trajetórias de sucesso de seus ex-alunos, na dedicação de seus professores e funcionários, e no reconhecimento da comunidade que 
                            vê na escola um patrimônio educacional a ser preservado e valorizado.
                            
                            <span class="text-secondary small d-block mt-2"><i class="bi bi-patch-check-fill me-1"></i> Imagem disponibilizada por ex-aluno do Dutra </span>
                        
                            </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="history-file text-center">
                    <h4><i class="bi bi-bookmark-star-fill me-2"></i>NOSSO COMPROMISSO COM AS PRÓXIMAS GERAÇÕES</h4>
                    <p class="fs-5 fw-light">Nosso compromisso vai além das paredes da sala de aula, é uma promessa com o futuro de Belo Horizonte e, principalmente, com o potencial ilimitado de cada aluno.

Acreditamos que educar é preparar cidadãos não apenas para o mercado de trabalho, mas para serem agentes de mudança em um mundo em constante evolução.

Nosso objetivo é garantir que as próximas gerações da Presidente Dutra saiam daqui equipadas não só com conhecimento, mas com a confiança e a visão necessárias para construir um futuro mais justo, sustentável e promissor.
<br>
<b>Vocês são os protagonistas EEPD!</b>
   </div>
            </div>
        </div>
        
    </div>
</div>

<?php 
require 'footer.php'; 
?>