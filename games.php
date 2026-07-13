<?php 
session_start();
if (!isset($_SESSION['autenticado'])){
    header('Location: login.php?login=erroGames');
    exit; 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="img/controle.png" type="image/png">
  <link rel="stylesheet" href="style.css">
   <title>Free Games</title>
</head>
<body>
  <?php 
    // Como a segurança já foi feita no topo, aqui apenas incluímos o cabeçalho/menu do site
    include("cabecalho.php");
  ?>

  <div id="carousel-root"></div>

  <script>
    // Configurações básicas de estilo direto no corpo da página usando JS
    document.body.style.margin = '0';
    document.body.style.minHeight = '100vh'; // Garante altura total da tela

    // Função autoinvocável (IIFE) para isolar o escopo do código do carrossel
    (function(){
      // Captura o container principal do carrossel
      const root = document.getElementById('carousel-root');
      root.style.position = 'relative';
      root.style.width = '100vw'; // Largura total da tela
      root.style.height = '70vh'; // Altura total da tela
      root.style.overflow = 'hidden'; // Esconde o que passar dos limites da tela
      root.style.background = '#000'; // Fundo preto

      const header = document.createElement('h1');
      header.textContent = 'New Games!';
      header.style.position = 'absolute';
      header.style.top = '20px';
      header.style.left = '20px';
      header.style.zIndex = '3'; // Garante que o título fica na frente das imagens
      header.style.margin = '0';
      header.style.color = '#fff';
      header.style.fontSize = 'clamp(2rem, 3vw, 4rem)'; // Fonte responsiva
      header.style.letterSpacing = '0.1em';
      header.style.textShadow = '0 0 20px rgba(0,0,0,0.8)'; // Sombra preta no texto
      root.appendChild(header); // Adiciona o título na tela

      // Cria a "esteira" (slider) que vai segurar todos os slides lado a lado
      const slider = document.createElement('div');
      slider.style.display = 'flex';
      slider.style.height = '100%';
      slider.style.transition = 'transform 0.8s ease'; // Transição suave ao mudar de slide
      slider.style.willChange = 'transform'; // Otimização de performance para o navegador
      root.appendChild(slider); // Adiciona a esteira dentro do container principal

      // Array (lista) de objetos contendo as informações e imagens de cada jogo
      const slides = [
        {img: 'img/jegue-logo.png', title: 'Esmague o Jegue', desc: 'Divertasse esmagando jegues', link: 'games/jegue/Inicio.html'},
        {img: 'img/jump-logo.png', title: 'Mario pula-pula', desc: 'Desafie-se a bater o recorde!', link: 'games/mario-jump/index.html'},
        //{img: 'img/bee-logo.png', title: 'Flap Bee', desc: 'Chegue mais longe que seus amigos', link: 'games/passaro/index.html'},
        {img: 'img/bomba.jpg', title: 'Mine Sweeper', desc: 'Não exploda', link: 'games/mineSweeper/index.html'}
      ];

      // Laço de repetição para criar a estrutura HTML de cada slide com base na lista acima
      slides.forEach(item => {
        // Cria a caixinha do slide individual
        const slide = document.createElement('div');
        slide.style.minWidth = '100%';
        slide.style.height = '100%';
        slide.style.position = 'relative';
        slide.style.flexShrink = '0'; // Impede o slide de encolher

        //tentativa de criar um a
        const link = document.createElement('a');
        link.href = item.link;
        link.target = "_blank"
        slide.appendChild(link);

        // Cria a imagem do jogo
        const img = document.createElement('img');
        img.src = item.img;
        img.alt = item.title;
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover'; // Ajusta a imagem sem distorcer
        img.style.display = 'block';
        link.appendChild(img);

        // Cria o efeito de sombra/degradê escuro na parte de baixo do slide
        const overlay = document.createElement('div');
        overlay.style.position = 'absolute';
        overlay.style.left = '0';
        overlay.style.bottom = '0';
        overlay.style.width = '100%';
        overlay.style.padding = '30px';
        overlay.style.background = 'linear-gradient(180deg, transparent, rgba(0,0,0,0.85))';
        overlay.style.boxSizing = 'border-box';
        overlay.style.color = '#fff';

        // Cria o título do jogo dentro do slide
        const title = document.createElement('div');
        title.textContent = item.title;
        title.style.fontSize = 'clamp(1.5rem, 2.5vw, 3rem)';
        title.style.fontWeight = '700';
        title.style.marginBottom = '10px';

        // Cria a descrição do jogo dentro do slide
        const desc = document.createElement('div');
        desc.textContent = item.desc;
        desc.style.fontSize = 'clamp(1rem, 2vw, 1.25rem)';

        // Monta a estrutura: coloca o título e descrição na sombra, e a sombra no slide
        overlay.appendChild(title);
        overlay.appendChild(desc);
        slide.appendChild(overlay);
        
        // Adiciona o slide completo dentro da esteira (slider)
        slider.appendChild(slide);
      });

      // Variável de controle para saber qual slide está ativo (começa no 0)
      let current = 0;

      // Função responsável por mover a esteira para mostrar o slide correto
      function show(index){
        // Essa fórmula matemática serve para fazer o carrossel ser infinito
        // Se passar do último, volta pro primeiro. Se for menor que zero, vai pro último.
        current = (index + slides.length) % slides.length;
        
        // Move horizontalmente a esteira usando CSS Translate (ex: -100%, -200%)
        slider.style.transform = 'translateX(' + (-current * 100) + '%)';
      }

      // Inicializa mostrando o primeiro slide (índice 0)
      show(0);

      // Cria um temporizador para mudar de slide automaticamente a cada 4 segundos (4000ms)
      setInterval(function(){ show(current + 1); }, 4000);

      // Evento que escuta o teclado do usuário para navegar usando as setas do teclado
      document.addEventListener('keydown', function(e){
        if (e.key === 'ArrowRight') show(current + 1); // Seta para direita avança
        if (e.key === 'ArrowLeft') show(current - 1);  // Seta para esquerda volta
      });
    })();
  </script>

  <table></table>
  
  <?php 
    // Inclui o arquivo de rodapé do site
    include("rodapé.php"); 
  ?>
</body>
</html>