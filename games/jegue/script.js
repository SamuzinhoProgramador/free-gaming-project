function posiçãoRandomica() {

    if(document.getElementById('jegue')){
        document.getElementById('jegue').remove();

        if (document.getElementById('v' + vidas)) {
            document.getElementById('v' + vidas).src = "imagens/coracao_vazio.png";
        }
        
        if(vidas >= 3){
            window.location.href = 'fim_de_jogo.html';
            return;
        }

        vidas++;
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
        this.removeAttribute('id'); 
        this.src = 'imagens/jegue_morto.png';
        setTimeout(() => {
            this.remove();
        }, 499);
    }

    document.body.appendChild(jegue);
    console.log(posiçãoX, posiçãoY);
}


var altura = 0;
var largura = 0;

function ajustaTamanhoPalcoJogo() {
 altura = window.innerHeight;
 largura = window.innerWidth;

 console.log("Largura atual: " + largura, "Altura atual: " + altura); // Para você testar no console
}



