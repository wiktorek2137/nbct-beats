document.addEventListener('DOMContentLoaded', () => {
    let urlParams = new URLSearchParams(window.location.search);
    let categoryID = urlParams.get('id');
        $.ajax({
            url: 'php/singleCategory.php',
            type: 'post',
            dataType: 'json',
            data: {id: categoryID},
            success:function(category){
                document.title = category[0].cat_name+" | "+"NBCT BEATS";
                let cat = document.getElementById("category-name");
                cat.innerHTML = category[0].cat_name;
                let cat_img = document.getElementsByClassName("beat-info-el-img")[0];
                cat_img.style.backgroundImage = 'url("' + category[0].cat_img + '")';

                // let cat_desc = document.getElementsByClassName("beat-info-details-desc")[0];
                // let cat_desc_text = document.createElement("a");
                // cat_desc_text.innerHTML = producer[0].producer_desc;
                // cat_desc.appendChild(autor_desc_text);
            }
        });
        $.ajax({
            url: 'php/singleCategoryBeats.php',
            type: 'post',
            dataType: 'json',
            data: {id: categoryID},
            success: function(categoryBeat) {
                console.log(categoryBeat)
                // Zakładamy, że producerBeat jest już poprawnie sparsowanym obiektem JSON
                for (let NewestBeat of categoryBeat) {
                    let singleNewestBeat = {
                        id: NewestBeat["beat_id"],
                        name: NewestBeat["beat_title"],
                        autor: NewestBeat["producer_name"],
                        autorid: NewestBeat["beat_autor"],
                        img: NewestBeat["beat_cover"],
                        bpm: NewestBeat["beat_bpm"],
                        key: NewestBeat["beat_key"],
                        music: NewestBeat["beat_music"],
                        price: NewestBeat["beat_price"],
                    };

                    // Sprawdź, czy utwór już istnieje w liście tracks
                    let trackExists = tracks.find(track => track.music === singleNewestBeat.music);

                    if (!trackExists) {
                        tracks.push(singleNewestBeat); // Dodaj utwór, jeśli nie istnieje
                    }


                    let PopularNewSection = document.getElementsByClassName("beat-futured-section-content")[0];
                    let playerTitle = document.getElementById('player-title');
                    let playerAutor = document.getElementById('player-autor');
                    let playerImg = document.getElementById('player-img');
                    let playerBpm = document.getElementById('player-bpm');

                    let singlePopularNewEl = document.createElement("div");
                    singlePopularNewEl.classList.add("popular-new-section-el");

                    let singlePopularNewElImg = document.createElement("div");
                    singlePopularNewElImg.classList.add("popular-new-section-el-img");
                    singlePopularNewElImg.style.backgroundImage = `url('${singleNewestBeat.img}')`;

                    let PopularNewElImgBtn = document.createElement("div");
                    PopularNewElImgBtn.classList.add("popular-new-section-el-img-btn");
                    PopularNewElImgBtn.addEventListener("click", function() {
                        music.src = singleNewestBeat.music; // Ustaw nowe źródło dla audio
                        onPlay(); // Odtwórz muzykę

                        let beatID = singleNewestBeat.id;
                        let autorID = singleNewestBeat.autorid;

                        playerTitle.textContent = singleNewestBeat.name;
                        playerAutor.textContent = singleNewestBeat.autor;

                        playerTitle.addEventListener("click", function(){
                            window.location.href = `single_beat.php?id=${beatID}`;
                        })
                        playerAutor.addEventListener("click", function(){
                            window.location.href = `single_autor.php?id=${autorID}`;
                            console.log(autorID);
                        })

                        playerBpm.textContent = singleNewestBeat.bpm+"BPM"+" / "+singleNewestBeat.key;
                        playerImg.src = singleNewestBeat.img;
                    });

                    let PopularNewElImgText = document.createElement("a");
                    PopularNewElImgText.innerHTML = "POSŁUCHAJ";

                    let PopularNewElImgIcon = document.createElement("img");
                    PopularNewElImgIcon.src = "img/nbct-arrow.svg";

                    let singlePopularNewElTitle = document.createElement("div");
                    singlePopularNewElTitle.classList.add("popular-new-section-el-title");
                    singlePopularNewElTitle.addEventListener("click", function(){
                        let beatID = singleNewestBeat.id;
                        window.location.href = `single_beat.php?id=${beatID}`;
                    });

                    let singlePopularNewElTitleText = document.createElement("a");
                    singlePopularNewElTitleText.innerHTML = singleNewestBeat.name;

                    let singlePopularNewElAutor = document.createElement("div");
                    singlePopularNewElAutor.classList.add("popular-new-section-el-autor");

                    let singlePopularNewElAutorText = document.createElement("a");
                    singlePopularNewElAutorText.innerHTML = singleNewestBeat.autor;
                    singlePopularNewElAutorText.addEventListener("click", function(){
                        let beatAutorID = singleNewestBeat.autorid;
                        window.location.href = `single_autor.php?id=${beatAutorID}`;
                    });

                    // Dodawanie elementów do przycisku
                    PopularNewElImgBtn.appendChild(PopularNewElImgText);
                    PopularNewElImgBtn.appendChild(PopularNewElImgIcon);

                    // Dodawanie przycisku do elementu obrazu
                    singlePopularNewElImg.appendChild(PopularNewElImgBtn);

                    singlePopularNewElTitle.appendChild(singlePopularNewElTitleText);

                    // Dodawanie tekstu autora do elementu autora
                    singlePopularNewElAutor.appendChild(singlePopularNewElAutorText);

                    // Dodawanie elementów obrazu i autora do głównego elementu
                    singlePopularNewEl.appendChild(singlePopularNewElImg);
                    singlePopularNewEl.appendChild(singlePopularNewElTitle);
                    singlePopularNewEl.appendChild(singlePopularNewElAutor);

                    // Dodawanie głównego elementu do sekcji
                    PopularNewSection.appendChild(singlePopularNewEl);
                }}

        });

});


let currentTrackIndex = 0; // Indeks aktualnie odtwarzanego utworu
let tracks = []; // Lista utworów
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
        let beatID = track.id;
        let trackUrl = `single_beat.php?id=${beatID}`;

        let autorID = track.autorId;
        let autorUrl = `single_autor.php?id=${autorID}`;


        // Ustawienie nazwy utworu jako odnośnika
        let playerTitle = document.getElementById('player-title');
        playerTitle.innerHTML = `<a href="${trackUrl}">${track.name}</a>`;

        // Ustawienie autora jako odnośnika
        let playerAutor = document.getElementById('player-autor');
        playerAutor.innerHTML = `<a href="${autorUrl}">${track.autor}</a>`;

        document.getElementById('player-img').src = track.img;
        document.getElementById('player-bpm').textContent = track.bpm + "BPM / " + track.key;

        isPlaying = true;
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
