const mario = document.querySelector('#mario');
const pipe = document.querySelector('.pipe');
var time = 0;

setInterval(function(){
    time++;
    document.getElementById("time").innerHTML = `Tempo: ${time} s`;
}, 1000);

const jump = (event) => {
    if (mario.classList.contains('jump')) return;

    if(event.code === 'Space' || event.code === 'ArrowUp' || event.code === 'KeyW'){
        mario.classList.add('jump');
        mario.src = "mario pula.png";
        mario.style.paddingLeft = '70px';
        mario.style.width = '160px';

        setTimeout(() => {
            mario.style.paddingLeft = '0px';
            mario.src = "mario.gif";
            mario.style.width = '170px';
            mario.classList.remove('jump');
        }, 500);
    }
}

const loop = setInterval(() => {
    const pipePosition = pipe.offsetLeft;
    const marioPosition = +window.getComputedStyle(mario).bottom.replace('px', '');

    if(pipePosition <= 120 && pipePosition > 0 && marioPosition < 70){
        pipe.style.animation = 'none';
        pipe.style.left = `${pipePosition}px`;
        
        clearInterval(loop); 
        
        window.location.href = "Fim.html";
    }
}, 10);

document.addEventListener('keydown', jump);