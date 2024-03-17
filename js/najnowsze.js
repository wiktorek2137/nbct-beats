let currentTrackIndex = 0; // Indeks aktualnie odtwarzanego utworu
let tracks = []; // Lista utworów

function newestCreate(){
    $.ajax({
        url: "php/allNewest.php",
        type: "POST",
    success: function(response){
        let NewQuery = JSON.parse(response);
        for (let New of NewQuery) {
            let singleNew = {
                id: New["beat_id"],
                name: New["beat_title"],
                autor: New["producer_name"],
                autorid : New["beat_autor"],
                img: New["beat_cover"],
                bpm: New["beat_bpm"],
                key: New["beat_key"],
                music: New["beat_music"],
                price: New["beat_price"],
            };
            // Sprawdź, czy utwór już istnieje w liście tracks
            let trackExists = tracks.find(track => track.music === singleNew.music);

            if (!trackExists) {
                tracks.push(singleNew); // Dodaj utwór, jeśli nie istnieje
            }

            let NewSection = document.getElementsByClassName("popular-new-section-content")[0];
            let playerTitle = document.getElementById('player-title');
            let playerAutor = document.getElementById('player-autor');
            let playerImg = document.getElementById('player-img');
            let playerBpm = document.getElementById('player-bpm');

            let singleNewEl = document.createElement("div");
            singleNewEl.classList.add("popular-new-section-el");

            let singleNewElImg = document.createElement("div");
            singleNewElImg.classList.add("popular-new-section-el-img");
            singleNewElImg.style.backgroundImage = `url('${singleNew.img}')`;

            let NewElImgBtn = document.createElement("div");
            NewElImgBtn.classList.add("popular-new-section-el-img-btn");
            NewElImgBtn.addEventListener("click", function() {
                music.src = singleNew.music; // Ustaw nowe źródło dla audio
                onPlay(); // Odtwórz muzykę

                console.log(singleNew.id)
                trackIndex(singleNew.id)

                let beatID = singleNew.id;
                let autorID = singleNew.autorid;

                playerTitle.textContent = singleNew.name;
                playerAutor.textContent = singleNew.autor;

                playerTitle.addEventListener("click", function(){
                    window.location.href = `single_beat.php?id=${beatID}`;
                })
                playerAutor.addEventListener("click", function(){
                    window.location.href = `single_autor.php?id=${autorID}`;
                    console.log(autorID);
                })
                playerBpm.textContent = singleNew.bpm+"BPM"+" / "+singleNew.key;
                playerImg.src = singleNew.img;
            });

            let NewElImgText = document.createElement("a");
            NewElImgText.innerHTML = "POSŁUCHAJ";

            let NewElImgIcon = document.createElement("img");
            NewElImgIcon.src = "img/nbct-arrow.svg";

            let singleNewElTitle = document.createElement("div");
            singleNewElTitle.classList.add("popular-new-section-el-title");
            singleNewElTitle.addEventListener("click", function(){
                let beatID = singleNew.id;
                window.location.href = `single_beat.php?id=${beatID}`;
            });

            let singleNewElTitleText = document.createElement("a");
            singleNewElTitleText.innerHTML = singleNew.name;

            let singleNewElAutor = document.createElement("div");
            singleNewElAutor.classList.add("popular-new-section-el-autor");

            let singleNewElAutorText = document.createElement("a");
            singleNewElAutorText.innerHTML = singleNew.autor;
            singleNewElAutorText.addEventListener("click", function(){
                let beatAutorID = singleNew.autorid;
                window.location.href = `single_autor.php?id=${beatAutorID}`;
            });

            // Dodawanie elementów do przycisku
            NewElImgBtn.appendChild(NewElImgText);
            NewElImgBtn.appendChild(NewElImgIcon);

            // Dodawanie przycisku do elementu obrazu
            singleNewElImg.appendChild(NewElImgBtn);

            singleNewElTitle.appendChild(singleNewElTitleText);

            // Dodawanie tekstu autora do elementu autora
            singleNewElAutor.appendChild(singleNewElAutorText);

            // Dodawanie elementów obrazu i autora do głównego elementu
            singleNewEl.appendChild(singleNewElImg);
            singleNewEl.appendChild(singleNewElTitle);
            singleNewEl.appendChild(singleNewElAutor);

            // Dodawanie głównego elementu do sekcji
            NewSection.appendChild(singleNewEl);
        }

    }
})}
newestCreate();

let isPlaying = false;
let isMuted = false;
let player = document.getElementById("player");
let setVolume = document.getElementById("volume");
let currentClock = document.getElementById("currentclock");
let endClock = document.getElementById("endclock");
let timeLine = document.getElementById("timeline");
let playIcon = document.getElementById("playicon");
let volumeIcon = document.getElementById("volumeicon");
let music = new Audio("uploads/music/wiktorek.wav");

function onPlay(){
    playIcon.src = "img/stop.svg";
    player.style.transform = "translateY(0)";
    music.play();
    isPlaying = true;
}
function onStop(){
    if(isPlaying==true){
        music.pause();
        isPlaying = false;
        playIcon.src = "img/play.svg";
    }
    else{
        music.play();
        isPlaying = true;
        playIcon.src = "img/stop.svg";
    }
}
function trackIndex(a){
    let updateId = a;
    updatePlayCount(updateId)
}
function updatePlayCount(id) {
    console.log(id)
        $.ajax({
            url: "php/beatStatsUpdate.php",
            type: "POST",
            data: { beatId: id },
            success: function(response) {
                console.log("Dodano wyświetlenie", response);
            },
            error: function(xhr, status, error) {
                console.error("Nie udało się dodać wyświetlenia", error);
            }
        });
}
function noPlay(){
    player.style.transform = "translateY(100px)";
}
function playNextTrack() {
    if (tracks.length > 0) {
        currentTrackIndex = (currentTrackIndex + 1) % tracks.length; // Przejście do następnego utworu
        let track = tracks[currentTrackIndex];

        music.src = track.music; // Ustaw nowe źródło dla audio
        music.play(); // Odtwórz muzykę

        // Aktualizacja interfejsu użytkownika
        document.getElementById('player-title').textContent = track.name;
        document.getElementById('player-autor').textContent = track.autor;
        document.getElementById('player-img').src = track.img;
        document.getElementById('player-bpm').textContent = track.bpm + "BPM / " + track.key;

        isPlaying = true;
        playIcon.src = "img/stop.svg";
    }
}
document.getElementById('nextTrackButton').addEventListener('click', playNextTrack);
function playPrevTrack() {
    if (tracks.length > 0) {
        // Sprawdź, czy jesteśmy na początku listy
        if (currentTrackIndex === 0) {
            // Ustaw indeks na ostatni utwór w liście
            currentTrackIndex = tracks.length - 1;
        } else {
            // Zmniejsz indeks o jeden, aby cofnąć do poprzedniego utworu
            currentTrackIndex -= 1;
        }

        let track = tracks[currentTrackIndex];

        music.src = track.music; // Ustaw nowe źródło dla audio
        music.play(); // Odtwórz muzykę

        // Aktualizacja interfejsu użytkownika
        document.getElementById('player-title').textContent = track.name;
        document.getElementById('player-autor').textContent = track.autor;
        document.getElementById('player-img').src = track.img;
        document.getElementById('player-bpm').textContent = track.bpm + "BPM / " + track.key;

        isPlaying = true;
        playIcon.src = "img/stop.svg";

        clearTimeout(playTimer); // Wyczyść poprzedni timer, jeśli istnieje
        playTimer = setTimeout(function() {
            updatePlayCount(); // Ponownie ustaw timer przy wznowieniu odtwarzania
        }, 10000); // Ustaw timer na 20 sekund
    }
}
document.getElementById('prevTrackButton').addEventListener('click', playPrevTrack);
// AUTO PLAY
function initializePlayer() {
    music.addEventListener('ended', function() {
        playNextTrack();
    });
}
initializePlayer();
// GŁOŚNOŚĆ
setVolume.addEventListener("change", function Volume() {
    music.volume = setVolume.value;

    if (music.volume == 0) {
        isMuted = true;
        volumeIcon.src = "img/volume-muted.svg";
    }
    else if (music.volume > 0 && music.volume <= 0.5) {
        isMuted = false;
        volumeIcon.src = "img/volume-min.svg";
    }
    else if (music.volume > 0.5) {
        isMuted = false;
        volumeIcon.src = "img/volume-max.svg";
    }
});
volumeIcon.addEventListener("click", function() {
    if(isMuted) {
        music.volume = 0.5;
        setVolume.value = 0.5;
        isMuted = false;
        volumeIcon.src = "img/volume-max.svg";
    } else {
        music.volume = 0;
        setVolume.value = 0;
        isMuted = true;
        volumeIcon.src = "img/volume-muted.svg";
    }
    updateSliderBackground(setVolume);
});
setVolume.addEventListener('input', function() {
    let value = this.value;
    music.volume = value;
    isMuted = (value == 0);
    volumeIcon.src = isMuted ? "img/volume-muted.svg" : "img/volume-max.svg";
    updateSliderBackground(this);
});
function updateSliderBackground(slider) {
    let value = slider.value;
    let max = slider.max;
    let percentage = (value / max) * 100;
    slider.style.background = 'linear-gradient(to right, #000000 ' + percentage + '%, #fff ' + percentage + '%)';
}
document.getElementById('volume').addEventListener('input', function() {
    let value = this.value;
    let max = this.max;
    let percentage = (value / max) * 100;
    this.style.background = 'linear-gradient(to right, #000000 ' + percentage + '%, white ' + percentage + '%)';
});
music.addEventListener("timeupdate", function() {
    function formatTime(seconds) {
        let minutes = Math.floor(seconds / 60);
        let remainingSeconds = seconds % 60;
        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }
        return minutes + ":" + remainingSeconds;
    }

    let currentTime = Math.round(music.currentTime);
    let currentClock = document.getElementById('currentclock');
    currentClock.innerHTML = formatTime(currentTime);

    let duration = Math.round(music.duration);
    let endClock = document.getElementById('endclock');
    endClock.innerHTML = formatTime(duration);

    let timeLine = document.getElementById('timeline');
    timeLine.value = music.currentTime;
    timeLine.max = music.duration;

    // Aktualizacja tła paska postępu
    let percentage = (music.currentTime / music.duration) * 100;
    timeLine.style.background = 'linear-gradient(to right, #000000 ' + percentage + '%, white ' + percentage + '%)';
});
document.getElementById('timeline').addEventListener('input', function() {
    music.currentTime = this.value;
    let value = this.value;
    let max = this.max;
    let percentage = (value / max) * 100;
    this.style.background = 'linear-gradient(to right, #000000 ' + percentage + '%, white ' + percentage + '%)';
});