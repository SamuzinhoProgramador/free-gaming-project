<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Free Games</title>
  <link rel="icon" href="img/controle.png" type="image/png">
</head>
<body>
  <?php 
    if (!isset($_SESSION['autenticado'])){
        header('Location: login.php?login=erroGames' );
    }
    include("cabecalho.php");
  ?>
  <!--conteudo-->
  <div id="carousel-root"></div>
  <script>
    document.body.style.margin = '0';
    document.body.style.minHeight = '100vh';
    (function(){
      const root = document.getElementById('carousel-root');
      root.style.position = 'relative';
      root.style.width = '100vw';
      root.style.height = '100vh';
      root.style.overflow = 'hidden';
      root.style.background = '#000';
      const header = document.createElement('h1');
      header.textContent = 'Free Games';
      header.style.position = 'absolute';
      header.style.top = '20px';
      header.style.left = '20px';
      header.style.zIndex = '3';
      header.style.margin = '0';
      header.style.color = '#fff';
      header.style.fontSize = 'clamp(2rem, 3vw, 4rem)';
      header.style.letterSpacing = '0.1em';
      header.style.textShadow = '0 0 20px rgba(0,0,0,0.8)';
      root.appendChild(header);
      const slider = document.createElement('div');
      slider.style.display = 'flex';
      slider.style.height = '100%';
      slider.style.transition = 'transform 0.8s ease';
      slider.style.willChange = 'transform';
      root.appendChild(slider);
      const slides = [
        {img: 'https://via.placeholder.com/1920x1080/0f172a/ffffff?text=Jogo+1', title: 'Aventura épica', desc: 'Descubra novos mundos e desafios.'},
        {img: 'https://via.placeholder.com/1920x1080/111827/ffffff?text=Jogo+2', title: 'Corrida sem limites', desc: 'Velocidade, força e emoção na pista.'},
        {img: 'https://via.placeholder.com/1920x1080/1f2937/ffffff?text=Jogo+3', title: 'Estratégia total', desc: 'Planeje a vitória em cada missão.'}
      ];
      slides.forEach(item => {
        const slide = document.createElement('div');
        slide.style.minWidth = '100%';
        slide.style.height = '100%';
        slide.style.position = 'relative';
        slide.style.flexShrink = '0';
        const img = document.createElement('img');
        img.src = item.img;
        img.alt = item.title;
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        img.style.display = 'block';
        slide.appendChild(img);
        const overlay = document.createElement('div');
        overlay.style.position = 'absolute';
        overlay.style.left = '0';
        overlay.style.bottom = '0';
        overlay.style.width = '100%';
        overlay.style.padding = '30px';
        overlay.style.background = 'linear-gradient(180deg, transparent, rgba(0,0,0,0.85))';
        overlay.style.boxSizing = 'border-box';
        overlay.style.color = '#fff';
        const title = document.createElement('div');
        title.textContent = item.title;
        title.style.fontSize = 'clamp(1.5rem, 2.5vw, 3rem)';
        title.style.fontWeight = '700';
        title.style.marginBottom = '10px';
        const desc = document.createElement('div');
        desc.textContent = item.desc;
        desc.style.fontSize = 'clamp(1rem, 2vw, 1.25rem)';
        overlay.appendChild(title);
        overlay.appendChild(desc);
        slide.appendChild(overlay);
        slider.appendChild(slide);
      });
      let current = 0;
      function show(index){
        current = (index + slides.length) % slides.length;
        slider.style.transform = 'translateX(' + (-current * 100) + '%)';
      }
      show(0);
      setInterval(function(){ show(current + 1); }, 4000);
      document.addEventListener('keydown', function(e){
        if (e.key === 'ArrowRight') show(current + 1);
        if (e.key === 'ArrowLeft') show(current - 1);
      });
    })();
  </script>
  <script src="js/main.js"></script>
  <?php include("rodapé.php"); ?>
    </body>
</html>