document.addEventListener('DOMContentLoaded', () => {
    /* VARS */
    let gamestatus = [
        'Not stated',
        'Starting',
        'Playing',
        'Finished',
        'Initialising'
    ];

    let gamemodes = [
        '10 in a row',
        'Timer',
        'Death Match'
    ];

    let circle = document.querySelector('.circlecenter');
    let h1 = document.querySelector('h1');
    let waiting = document.querySelector('.waiting');
    let infogamemode = document.querySelector('#gamemode > span');
    let infostatus = document.querySelector('#status > span');
    let btngamemode = document.querySelector('button');

    btngamemode.addEventListener('click', () => {
        Swal.fire({
            title: 'Choisi un mode de jeu',
            input: 'select',
            inputOptions: { ...gamemodes},
            inputPlaceholder: 'Modes disponibles',
            position: 'top-start',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: `Vous avez choisi un nouveau mode de jeu : ${gamemodes[result.value]}`,
                    position: 'top-start'
                })
                updategamemode(result.value);
            }
        })


    })

    /* ------------ */

    function updatestatus(number){
        localStorage.setItem('status', number);
        infostatus.innerHTML = gamestatus[number];
        return gamestatus[number];
    }

    function updategamemode(number){
        localStorage.setItem('gamemode', number);
        infogamemode.innerHTML = gamemodes[number];
        return gamemodes[number];
    }

    function updatescore(number){
        if (number ===  0){
            document.querySelector("#score").innerHTML = '0';
        }
        document.querySelector("#score").innerHTML =  (parseInt(document.querySelector("#score").innerHTML, 10 ) + number).toString();
    }


    let currentStatus = updatestatus(4);
    setTimeout(() =>{
        currentStatus = updatestatus(0);
    }, 1000);

    let currentGamemode;

    if (!localStorage.gamemode){
        currentGamemode = updategamemode(0);
    }else{
        currentGamemode = gamemodes[localStorage.getItem('gamemode')];
    }
    function setup(){
        infogamemode.innerHTML = currentGamemode;
        infostatus.innerHTML = currentStatus;
    }

    setup();
    let maxx = window.innerHeight;
    let maxy = window.innerWidth;

    function generatatedot(width, id){
        let dot = document.createElement("DIV");
        dot.style.width = width;
        dot.style.height = width;
        dot.id = `point${id}`;
        dot.style.display = 'none';
        dot.style.backgroundColor = 'red';
        dot.style.borderRadius = '50%';
        dot.style.position = 'absolute';
        let x;
        let y;
        do {
            x = random(0,maxx)
            y = random(0,maxy)
        }while(!verifyCoords(x,y, maxx, maxy))
        dot.style.top = x.toString();
        dot.style.left = y.toString();
        document.querySelector('.gamezone').appendChild(dot);
    }

    function generator(){
        var width = 15;
        for (let i = 1; i <= 10; i++) {
            generatatedot(width, i);
        }
        currentGamemode = updatestatus(2);

    }

    function gamemoderules(idgamemode){
        if (idgamemode == 0){
            generator()
            recurs();
            function recurs(loop = 1){

                if (loop <= 10){
                    let tempoint = document.querySelector(`#point${loop}`);
                    let secure = true;

                    setTimeout(() => {
                        tempoint.style.display = 'block';
                        tempoint.addEventListener('click', () => {
                            updatescore(1);
                            tempoint.style.display = 'none';
                            circle.addEventListener('mouseover', () => {
                                if (secure){
                                    secure = false;
                                    recurs(loop+1);
                                }
                            });
                        });
                        setTimeout(() => {
                            if (tempoint.style.display !== 'none'){
                                tempoint.style.display = 'none';
                                circle.addEventListener('mouseover', () => {
                                    if (secure){
                                        secure = false;
                                        recurs(loop+1);
                                    }
                                });
                            }
                        }, 2000);

                    }, random(300, 2000));

                }else{
                    updatestatus(3);
                    Swal.fire(`Votre score est de ${document.querySelector("#score").innerHTML}/10`).then(() =>{
                        location.reload();
                    })
                }

            }
        }
    }

    function gameStart(){
        currentStatus = updatestatus(1);
        updateStyle();
        setTimeout(() => {
            circle.style.animationPlayState = 'running';
            circle.addEventListener('mouseover', () => {circle.style.animationPlayState = 'running';});
            circle.addEventListener('mouseout', () => {circle.style.animationPlayState = 'paused';});
            circle.classList.add("hidden");
        }, 200);
        gamemoderules(localStorage.getItem('gamemode'));
    }

    circle.addEventListener('mouseover', () => {
            if(currentStatus === 'Not stated'){
                gameStart();
            }
    })

    setTimeout(() => {
        document.querySelector('.hide').style.opacity = '0';
        setTimeout(() => {
            document.querySelector('.hide').style.display = 'none';
        }, 1000)
    }, 500);

    /* ANNEXE FUNCTION */
    function random(nb1, nb2){
        return  Math.floor((Math.random() * nb2) + nb1);
    }

    function updateStyle(){
        h1.style.opacity = '0';
        waiting.style.opacity = '0';
        circle.classList.add("go");
        btngamemode.style.display = 'none';
    }

    function verifyCoords(x, y, maxx, maxy){
        if ( (x < 310 && y < 160) || ( (x > 0.4*maxx && x< 0.6*maxx) && (y > 0.4*maxy && y< 0.6*maxy) ) ){
            return false
        }
        return true;

    }

});