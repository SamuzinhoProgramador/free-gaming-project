var altura = 0;
var largura = 0;
var vidas = 1;
var tempo = 0;

var cronometro = setInterval (function() {
    document.getElementById('Tempo').innerHTML = tempo;
    tempo++;
    console.log(tempo);
}, 1000);

function ajustaTamanhoPalcoJogo() {
    altura = window.innerHeight;
    largura = window.innerWidth;
    console.log(largura, altura);
}
ajustaTamanhoPalcoJogo();

function posiçãoRandomica() {

    if(document.getElementById('jegue')){
        document.getElementById('jegue').remove();
        if(vidas > 3){
            window.location.href = 'fim_de_jogo.html';
        }else{
            document.getElementById('v' + vidas).src = "imagens/coracao_vazio.png";
        vidas++;
        }
    }

var posiçãoX = Math.floor(Math.random() * largura) - 90;
var posiçãoY = Math.floor(Math.random() * altura ) -90;

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
    this.src = 'imagens/jegue_morto.png';
    this.removeAttribute('id');
    setTimeout(() => {
      this.remove();
}, 499);
}

document.body.appendChild(jegue);

console.log(posiçãoX, posiçãoY);


}

function tamanhoRandomico() {
    var classe = Math.floor(Math.random() * 3);
    switch(classe){
        case 0:
            return 'jegue1';
        case 1:
            return 'jegue2';
        case 2:
            return 'jegue3';
    }
}

function ladoRandomico() {
        var lado = Math.floor(Math.random() * 2);
    switch(lado){
        case 0:
            return 'ladoA';
        case 1:
            return 'ladoB';
    }
}