function posiçãoRandomica() {

    if(document.getElementById('jegue')){
        document.getElementById('jegue').remove();
        
        // 1. Primeiro remove o coração visualmente
        if (document.getElementById('v' + vidas)) {
            document.getElementById('v' + vidas).src = "imagens/coracao_vazio.png";
        }
        
        // 2. Depois soma a vida perdida
        vidas++;

        // 3. Se passou de 3 vidas perdidas, Game Over imediatamente
        if(vidas > 3){
            window.location.href = 'fim_de_jogo.html';
            return; // Para a execução do código aqui
        }
    }

    var posiçãoX = Math.floor(Math.random() * largura) - 90;
    var posiçãoY = Math.floor(Math.random() * altura ) - 90;

    posiçãoX = posiçãoX < 0 ? 0 : posiçãoX;
    posiçãoY = posiçãoY < 0 ? 0 : posiçãoY;

    var jegue = document.createElement('img');
    jegue.src = 'imagens/Jegue.png';
    jegue.className = tamanhoRandomico() + ' ' + ladoRandomico();
    jegue.style.left = posiçãoX + 'px';
    jegue.style.top = posiçãoY + 'px';
    jegue.style.position = 'absolute';
    jegue.id = 'jegue';
    
    jegue.onclick = function() {
        // Remove o ID para que o IF lá de cima não conte como "vida perdida" enquanto ele some
        this.removeAttribute('id'); 
        this.src = 'imagens/jegue_morto.png';
        setTimeout(() => {
            this.remove();
        }, 499);
    }

    document.body.appendChild(jegue);
    console.log(posiçãoX, posiçãoY);
}