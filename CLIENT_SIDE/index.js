const map = document.getElementById("map")

const ctx = map.getContext("2d")
const score_element = document.getElementById("score")
const pause = document.getElementById("pause")
const tutorial = document.getElementById("tutorial")
const tutorialPopUp = document.getElementById("tutorial-popup")
const names = document.getElementById("name")
const name_stat = document.getElementById("name-stat")
const failed_stat = document.getElementById("failed-stat")
const stat = document.getElementById('stat')
const start_button =document.getElementById("start")
const x_button = document.getElementById("delete")
const game = document.getElementById("game")
const restart = document.getElementById("restart")
const quit = document.getElementById("quit")
const menu = document.getElementById("menu")

const minute = document.getElementById("minute")
const second = document.getElementById("second")

let seconds = 0
let minutes = 0

console.log("test");

document.getElementById("delete-lb").addEventListener("click", () =>{
    window.location.reload()
})

document.getElementById("ldb-button").addEventListener("click", () =>{
    var lb = JSON.parse(localStorage.getItem("leaderboard"))
    const ldb = document.getElementById("ldb")

    if (!lb) {
        ldb.style.display = "flex"
        return
    }
    
    for (let index = 0; index < lb.length; index++) {
        document.getElementById("ldb-table").innerHTML += `<tr><td>${lb[index].names}</td><td>${lb[index].score}</td><td>${lb[index].time}</td></tr>`
        
    }

    ldb.style.display = "flex"
})

quit.addEventListener("click", () =>{
    window.location.reload()
})

restart.addEventListener("click", () =>{
    pause.style.display = "none"
    status = "play"
    pos = []

    seconds = 0
    minutes = 0
    score = 0
    failed = 0

    startState()
})

tutorial.addEventListener("click", () =>{
    tutorialPopUp.style.display = "flex"
})

start_button.addEventListener("click", () =>{
    if (names.value == "") {
        alert("pls input your usernames")
        return
    }
    
    console.log(names.value);
    stat.style.display = "flex"
    startState()
})

x_button.addEventListener("click", () => {
    tutorialPopUp.style.display = "none"
})

const virus = new Image
virus.src = "./images/coronavirus-gaedba68d4_1280.png"
const button = new Image
button.src = "./images/d.png"

let status = "play"

let score = 0
let failed = 0

let click = {
    d : false,
    f : false,
    j : false,
    k : false
}

map.width = 800
map.height = 800

let pos = [{x: 0, y : 50}]

document.addEventListener("keydown", (e) =>{onKeyClick(e)})
document.addEventListener("keyup", (e) => {onKeyUp(e)})

function onKeyUp(e) {
    click[e.key] = false


}

function pauseState(params) {
    clearInterval(interplay)
    clearInterval(interVirus)
    clearInterval(interTime)
    status = "paused"
    pause.style.display = "flex"
}

function startState(params) {


    interTime = setInterval(() =>{

        
        if (seconds == 59) {
            minutes ++
            seconds = 0
        }
        seconds ++
            

    }, 1000)

    game.style.display = "block"
    
    interplay = setInterval(() =>{
        if (seconds <= 9) {
            second.innerHTML = "0" + seconds
        }else{
            second.innerHTML = seconds
        }

        if (minutes <= 9) {
            minute.innerHTML = "0" + minutes
        }else{
            minute.innerHTML = minutes
        }

        score_element.innerHTML = score
        name_stat.innerHTML = names.value
        failed_stat.innerHTML = failed
        drawMap()
        for (let index = 0; index < pos.length; index++) {
            let element = pos[index];
            pos[index].x += 5
    
            if (pos[index].x > 500) {
                failed ++ 
                pos.splice(index, 1)
            }
        }
        drawVirus()
        if (click.d) {
            ctx.globalAlpha = .6; // Set the transparency to 50%
            ctx.fillStyle = "white";
            ctx.fillRect(0, 300, 200, 300);
            ctx.globalAlpha = 1.0; // Reset the transparency
        }
    
        if (click.f) {
            ctx.globalAlpha = .6; // Set the transparency to 50%
            ctx.fillStyle = "white";
            ctx.fillRect(200, 300, 200, 300);
            ctx.globalAlpha = 1.0; // Reset the transparency
        }
    
        if (click.j) {
            ctx.globalAlpha = .6; // Set the transparency to 50%
            ctx.fillStyle = "white";
            ctx.fillRect(400, 300, 200, 300);
            ctx.globalAlpha = 1.0; // Reset the transparency
        }
    
        if (click.k) {
            ctx.globalAlpha = .6; // Set the transparency to 50%
            ctx.fillStyle = "white";
            ctx.fillRect(600, 300, 200, 300);
            ctx.globalAlpha = 1.0; // Reset the transparency
        }
        
        if (failed >= 5) {

            const overTime = document.getElementById("time-over")
            const overScore = document.getElementById("score-over")

            overTime.innerHTML = minute.innerHTML + ":" + second.innerHTML
            overScore.innerHTML = score
            
            var lb = []

            lb = JSON.parse(localStorage.getItem("leaderboard")) || []


            if ((lb.findIndex((val) => val.names == name_stat.innerHTML ) == -1)) {
                lb.push({names: name_stat.innerHTML, score, time : minute.innerHTML + ":" + second.innerHTML})
                localStorage.setItem("leaderboard", JSON.stringify(lb))
            }else{
                let playerIndex = lb.findIndex((val) => val.names == name_stat.innerHTML)
                if (lb[playerIndex].score < score) {
                    console.log("wow");
                    lb.splice(playerIndex, 1)
                    lb.push({names : name_stat.innerHTML, score, time : minute.innerHTML + ":" + second.innerHTML})
                    localStorage.setItem("leaderboard", JSON.stringify(lb))
                }
            }

            console.log("tolo");
            clearInterval(interplay)
            clearInterval(interVirus)
            clearInterval(interTime)
            status = "paused"
            document.getElementById("over").style.display = "flex"

            document.getElementById("restart-over").addEventListener("click", () =>{
                document.getElementById("over").style.display = "none"
                status = "play"
                pos = []
            
                seconds = 0
                minutes = 0
                score = 0
                failed = 0
            
                startState()
            })

            document.getElementById("quit-over").addEventListener("click", () =>{
                window.location.reload()
            })
            
        }
    
    
    }, 10)

     interVirus = setInterval(() =>{
        addVirus()
    }, 1000)
}

function onKeyClick(key){
    const keyPos = {
        d: 50,
        f : 250,
        j : 450,
        k : 650
    }

    if (key.key == "Escape" && status == "play") {
        pauseState()
    }else if( key.key == "Escape" && status == "paused"){
        pause.style.display = "none"
        status = "play"

        startState()
    }

    console.log(key);

    const wow = pos.findIndex((val) => val.y == keyPos[key.key])

    if (wow != -1 && pos[wow].x > 200 && pos[wow].x < 600) {
        score ++ 
        pos.splice(wow, 1)
    }

    click[key.key] = true


    console.log(wow);
}

function drawMap() {
    ctx.fillStyle = "#454647";
    ctx.fillRect(0, 0, map.width, map.height);

    ctx.beginPath()
    ctx.fillStyle = "black"
    ctx.lineWidth = '2'
    ctx.strokeRect(200, 0, 0, map.height)
    ctx.closePath()

    ctx.beginPath()
    ctx.fillStyle = "black"
    ctx.lineWidth = '2'
    ctx.strokeRect(400, 0, 0, map.height)
    ctx.closePath()

    ctx.beginPath()
    ctx.fillStyle = "black"
    ctx.lineWidth = '2'
    ctx.strokeRect(600, 0, 0, map.height)
    ctx.closePath()

    ctx.beginPath()
    ctx.fillStyle = "black"
    ctx.lineWidth = '2'
    ctx.strokeRect(800, 0, 0, map.height)
    ctx.closePath()

    ctx.globalAlpha = 0.3; // Set the transparency to 50%
    ctx.fillStyle = "red";
    ctx.fillRect(0, 300, 800, 300);
    ctx.globalAlpha = 1.0; // Reset the transparency
    
    ctx.drawImage(button, 0, 600, 800, 200);
}

function drawVirus() {
    for (let index = 0; index < pos.length; index++) {
        ctx.drawImage(virus, pos[index].y, pos[index].x, 100, 100);
    }
}

function addVirus(params) {
    const random = Math.floor(Math.random() * 4)
    pos.push({x : 0, y : (random * 200 + 50)})
}


