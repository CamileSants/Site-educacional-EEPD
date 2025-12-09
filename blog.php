<?php
// Garante que a sessão está iniciada, pois usaremos ela para posts temporários
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'config.php'; // Inclui seu config.php corrigido
require 'header.php';

// --- CONFIGURAÇÃO DE UPLOAD ---
$uploadDir = __DIR__ . '/uploads/'; 
$uploadURL = 'uploads/'; 
$postMessage = '';
$postType = '';

// --- LÓGICA DE PROCESSAMENTO DO NOVO POST (PHP) ---

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'new_post') {
    
    $caption = trim($_POST['postCaption'] ?? '');
    $title = trim($_POST['postTitle'] ?? '');
    $imageUrl = null; 

    if (empty($caption)) {
        $postMessage = 'A legenda não pode estar vazia.';
        $postType = 'danger';
    } else {
        $uploadSuccess = true; 

        // --- Lógica de Upload de Imagem ---
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                $postMessage = 'ERRO CRÍTICO: Não foi possível acessar ou criar a pasta de uploads.';
                $postType = 'danger';
                $uploadSuccess = false;
            }
        }

        if ($uploadSuccess && isset($_FILES['postImage']) && $_FILES['postImage']['error'] == UPLOAD_ERR_OK) {
            
            $fileTmpPath = $_FILES['postImage']['tmp_name'];
            $fileName = $_FILES['postImage']['name'];
            
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            
            if (!in_array($fileExtension, $allowedfileExtensions)) {
                $postMessage = 'Tipo de arquivo de imagem não permitido.';
                $postType = 'danger';
                $uploadSuccess = false;
            } elseif (!move_uploaded_file($fileTmpPath, $destPath)) {
                $postMessage = 'Erro ao salvar o arquivo de imagem no servidor.';
                $postType = 'danger';
                $uploadSuccess = false;
            } else {
                $imageUrl = $uploadURL . $newFileName;
            }
        }
        // --- Fim Lógica de Upload de Imagem ---

        if ($uploadSuccess) {
               // Simulação de salvamento em um Array de Sessão
            $newPost = [
                'id' => time(), 
                'author' => 'Usuário Local', 
                'title' => $title,
                'date' => date('d \d\e F, Y'),
                'caption' => $caption,
                'image_url' => $imageUrl ?: 'https://placehold.co/600x400/6B7280/ffffff?text=' . urlencode($title ?: 'Novo Post'), 
                'initial_likes' => 0 
            ];

            if (!isset($_SESSION['local_posts'])) {
                $_SESSION['local_posts'] = [];
            }
            array_unshift($_SESSION['local_posts'], $newPost);
            
            header("Location: blog.php");
            exit;
        } else {
            header("Location: blog.php?status=$postType&message=" . urlencode($postMessage));
            exit;
        }
    }
}

// Verifica se há mensagem de status do redirecionamento
if (isset($_GET['status']) && isset($_GET['message'])) {
    $postType = $_GET['status'];
    $postMessage = $_GET['message'];
}

// Conteúdo de exemplo para o feed (posts fixos)
$blogPosts = [
    [
        'id' => 1,
        'author' => 'EEPD',
        'title' => 'InterclasseDUTRA',
        'date' => '28 de novembro, 2025',
        'caption' => 'A equipe UDL dominou e ganhou o futebol masculino!🥇🏆 #Interclasse #Futebol #DS',
        'image_url' => 'assets/images/inter.jpg', // Imagem retangular
        'initial_likes' => 125
    ],
    [
        'id' => 2,
        'author' => 'EEPD',
        'title' => 'Feira Técnica!',
        'date' => '24 de novembro, 2025',
        'caption' => 'Feira técnica dos alunos do 2° Logística e 3° Desenvolvimento de Sistemas #curso #2025 #TrabalhoUnido',
        'image_url' => 'assets/images/feir.jpg', // Imagem retangular
        'initial_likes' => 99
    ],
    [
        'id' => 3,
        'author' => 'EEPD',
        'title' => 'Visita à faculdade FAMINAS',
        'date' => '12 de novembro, 2025',
        'caption' => 'Os estudantes do presidente dutra conhecendo um pouco dos cursos da faculdade faminas. #faculdade #faminas #dinamica',
        'image_url' => 'assets/images/faminas.jpg', // Imagem retangular
        'initial_likes' => 150
    ],
];

// Adiciona os posts salvos na sessão ao início do array de posts
$finalBlogPosts = array_merge($_SESSION['local_posts'] ?? [], $blogPosts);


// Conteúdo de exemplo para Destaques (mantido)
$popularPosts = [
    ['title' => '#Interclasse'],
    ['title' => ' #TrabalhoUnido'],
    ['title' => '#VisitaàfaculdadeFAMINAS'],
];
?>

<style>
    /* ---------------------------------------------------------------- */
    /* ESTILOS CSS DO FEED (MANTIDOS E AJUSTADOS PARA CURTIDA)         */
    /* ---------------------------------------------------------------- */
    .insta-post {
        margin-bottom: 20px;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        width: 100%;
    }
    .insta-header {
        display: flex;
        align-items: center;
        padding: 12px;
    }
    .insta-header .profile-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-size: 14px;
    }
    .insta-image {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }
    .insta-actions {
        padding: 8px 12px;
        display: flex;
        align-items: center;
    }
    .like-btn {
        background: none;
        border: none;
        color: #262626;
        cursor: pointer;
        padding: 0;
        margin-right: 15px;
        font-size: 24px;
        transition: color 0.1s ease, transform 0.1s ease;
    }
    .like-btn:active { /* Pequeno feedback visual ao clicar */
        transform: scale(0.9);
    }
    .like-btn.liked {
        color: #ED4956; /* VERMELHO PARA CURTIDO */
        animation: heartBeat 0.5s ease-out; /* Animação leve ao curtir */
    }
    .like-count {
        font-weight: bold;
        margin-left: 5px;
        font-size: 14px;
    }
    .insta-caption-area {
        padding: 0 12px 12px;
        font-size: 14px;
    }
    .insta-caption-area .author {
        font-weight: bold;
        margin-right: 5px;
    }
    .popular-card {
        transition: transform 0.2s;
    }
    .popular-card:hover {
        transform: translateY(-2px);
        background-color: #f7f7f7;
    }
    
    /* Animação para feedback visual */
    @keyframes heartBeat {
        0% { transform: scale(1); }
        25% { transform: scale(1.2); }
        50% { transform: scale(1); }
    }

    /* ... (Outros estilos de post/admin card mantidos) ... */
    .new-post-card {
        border: 1px solid #007bff;
        background-color: #ffffff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    .new-post-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
    .new-post-header {
        background: #007bff;
    }
    .profile-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #F3F4F6;
        border: 2px solid #007bff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-size: 1.5rem;
        color: #007bff;
    }
    .post-as-bar {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
</style>

<div class="container mt-4">

    <?php if ($postMessage): ?>
        <div class="alert alert-<?php echo $postType; ?> alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($postMessage); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h1 class="text-center mb-4">Portal de Notícias e Feed EEPD</h1>
    <p class="lead text-center text-muted">Acompanhe os principais destaques, projetos e eventos da escola.</p>

    
    <div class="row">
        
        <div class="col-md-9">
            <h3 class="mb-3 text-primary">Feed Recente</h3>
            
            <div id="localFeed" class="mb-4">
                
                <?php if (empty($finalBlogPosts)): ?>
                    <div class="alert alert-info text-center mt-4">
                        Nenhuma publicação encontrada no feed local. Seja o primeiro a postar!
                    </div>
                <?php endif; ?>

                <?php foreach($finalBlogPosts as $post): ?>
                    <div class="insta-post">
                        
                        <div class="insta-header">
                            <div class="profile-icon"><?php echo htmlspecialchars(substr($post['author'], 0, 1)); ?></div>
                            <div>
                                <div class="fw-bold"><?php echo htmlspecialchars($post['author']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars($post['date']); ?></small>
                            </div>
                        </div>

                        <img src="<?php echo $post['image_url']; ?>" 
                            alt="Imagem do post: <?php echo htmlspecialchars($post['title']); ?>" 
                            class="insta-image">

                        <div class="insta-actions">
                            <button 
                                id="likeBtn_<?php echo $post['id']; ?>" 
                                class="like-btn"
                                data-post-id="<?php echo $post['id']; ?>"
                            >
                                ♡
                            </button>
                            
                            <div class="like-count">
                                <span id="likeCount_<?php echo $post['id']; ?>"><?php echo $post['initial_likes']; ?></span> curtidas
                            </div>
                        </div>

                        <div class="insta-caption-area">
                            <span class="author"><?php echo htmlspecialchars($post['author']); ?></span>
                            <span><?php echo htmlspecialchars($post['caption']); ?></span>
                            <?php if (!empty($post['title'])): ?>
                                <div class="text-primary mt-1">#<?php echo htmlspecialchars(str_replace(' ', '', $post['title'])); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="sticky-top" style="top: 20px;">
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light fw-bold text-success">Destaques Populares</div>
                    <div class="list-group list-group-flush">
                        <?php foreach($popularPosts as $pop): ?>
                            <a href="#" class="list-group-item list-group-item-action popular-card">
                                <small class="fw-bold d-block text-truncate"><?php echo htmlspecialchars($pop['title']); ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="card shadow-lg mb-4 new-post-card">
                    <div class="card-header new-post-header text-white fw-bold d-flex align-items-center">
                        <span class="me-2 fs-5">✍️</span> Nova Publicação
                    </div>
                    <div class="card-body">
                        
                        <div class="post-as-bar">
                            <div class="profile-placeholder">U</div> 
                            <div class="d-flex flex-column align-items-start ms-2">
                                <small class="fw-bold text-muted">Postando como: Usuário Local</small>
                            </div>
                        </div>
                        
                        <form id="postForm" method="POST" action="blog.php" enctype="multipart/form-data">
                            
                            <input type="hidden" name="action" value="new_post"> 
                            
                            <div class="mb-3">
                                <label for="postCaption" class="form-label small fw-bold">O que está acontecendo?</label>
                                <textarea class="form-control" id="postCaption" name="postCaption" rows="4" placeholder="Compartilhe seu projeto ou novidade!" required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="postTitle" class="form-label small fw-bold text-muted">Título (Opcional)</label>
                                <input type="text" class="form-control form-control-sm" id="postTitle" name="postTitle" placeholder="Dê um nome ao seu post...">
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted d-block">Adicionar Mídia:📷</label>
                                <div class="d-flex align-items-center">
                                    <input type="file" 
                                            name="postImage"
                                            id="postImageFile" 
                                            class="form-control form-control-sm" 
                                            accept="image/*">
                                </div>
                            </div>
                            
                            <button type="submit" id="submitPostBtn" class="btn btn-success w-100 fw-bold">
                                <span class="me-1">✅</span> Publicar Localmente
                            </button>
                        </form>
                    </div>
                </div>

               <div class="text-center mt-4 p-3 border-top">
    <p class="text-muted small mb-1">Siga-nos nas redes!</p>
    
    <div class="d-flex justify-content-center">
        
        <a href="https://www.facebook.com/eepdutra#" target="_blank" class="text-decoration-none mx-2">
            <span class="fs-4" title="Facebook">👍</span> 
        </a>
        
        <a href="https://www.instagram.com/dutrapresidente/" target="_blank" class="text-decoration-none mx-2">
            <span class="fs-4" title="Instagram">🖼️</span>
        </a>
        
        <a href="https://api.whatsapp.com/send?phone=5531999572716" target="_blank" class="text-decoration-none mx-2">
            <span class="fs-4" title="YouTube/Vídeos">📱</span>
        </a>
        
    </div> 

            </div> </div>

    </div>
    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os botões de curtir na página
    const likeButtons = document.querySelectorAll('.like-btn');

    likeButtons.forEach(button => {
        // Inicializa o botão com o estado 'disliked' (não curtido)
        button.textContent = '♡'; 
        
        // Atribui um listener de clique a cada botão
        button.addEventListener('click', function() {
            // Obtém o ID do post a partir do ID do botão (ex: likeBtn_1 -> 1)
            const postId = this.id.split('_')[1]; 
            
            // Seleciona o elemento de contagem
            const likeCountElement = document.getElementById('likeCount_' + postId);
            let currentLikes = parseInt(likeCountElement.textContent);

            // Verifica se o botão já foi curtido (tem a classe 'liked')
            const isLiked = this.classList.contains('liked');

            if (isLiked) {
                // Se já estava curtido, descurtir
                this.classList.remove('liked');
                likeCountElement.textContent = currentLikes - 1;
                this.textContent = '♡'; // Coração vazio
                
            } else {
                // Se não estava curtido, curtir
                this.classList.add('liked');
                likeCountElement.textContent = currentLikes + 1;
                this.textContent = '♥'; // Coração preenchido (vermelho)
            }
            
            // Nota: Este estado é apenas visual e local. Ele será resetado ao recarregar a página.
        });
    });
});
</script>

<?php require 'footer.php'; ?>