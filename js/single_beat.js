let currentTrackIndex = 0; // Indeks aktualnie odtwarzanego utworu
let tracks = []; // Lista utworów
document.addEventListener('DOMContentLoaded', () => {
    let urlParams = new URLSearchParams(window.location.search);
    let beatID = urlParams.get('id');
        $.ajax({
            url: 'php/singleBeat.php',
            type: 'post',
            dataType: 'json',
            data: {id: beatID},
            success:function(singleBeat){
                document.title = singleBeat[0].beat_title+" | "+"NBCT BEATS";
                let beatName = document.getElementById("beat-name");
                beatName.innerHTML = singleBeat[0].beat_title;
                let beatAutorName = document.getElementById("beat-autor-name");
                beatAutorName.innerHTML = singleBeat[0].producer_name;
                beatAutorName.addEventListener("click", function(){
                    window.location.href = `single_autor.php?id=${singleBeat[0].beat_autor}`;
                });
                let beatImg = document.getElementsByClassName("beat-info-el-img")[0];
                beatImg.style.backgroundImage = 'url("' + singleBeat[0].beat_cover + '")';

                let playerTitle = document.getElementById('player-title');
                let playerAutor = document.getElementById('player-autor');
                let playerImg = document.getElementById('player-img');
                let playerBpm = document.getElementById('player-bpm');

                let beatMusic = document.getElementsByClassName("beat-info-el-img-btn")[0];
                beatMusic.addEventListener("click", function() {
                    music.src = singleBeat[0].beat_music; // Ustaw nowe źródło dla audio
                    onPlay(); // Odtwórz muzykę
                    playerTitle.textContent = singleBeat[0].beat_title;
                    playerAutor.textContent = singleBeat[0].producer_name;
                    playerBpm.textContent = singleBeat[0].beat_bpm+"BPM"+" / "+singleBeat[0].beat_key;
                    playerImg.src = singleBeat[0].beat_cover;
                });


                // Sprawdź, czy utwór już istnieje w liście tracks
                let trackExists = tracks.find(track => track.music === singleBeat[0].beat_music);

                if (!trackExists) {
                    tracks.push(singleBeat[0].beat_music); // Dodaj utwór, jeśli nie istnieje
                }

                let beat_desc = document.getElementsByClassName("beat-info-details-desc")[0];

                let beat_desc_cat = document.createElement("a");
                beat_desc_cat.innerHTML = singleBeat[0].cat_name;
                let beat_desc_bpm = document.createElement("a");
                beat_desc_bpm.innerHTML = singleBeat[0].beat_bpm+"BPM";
                let beat_desc_key = document.createElement("a");
                beat_desc_key.innerHTML = singleBeat[0].beat_key;

                beat_desc.appendChild(beat_desc_cat);
                beat_desc.appendChild(beat_desc_bpm);
                beat_desc.appendChild(beat_desc_key);

                let mp3Licence = document.getElementById("mp3Licence");
                mp3Licence.innerHTML = singleBeat[0].beat_price+"PLN";
                let wavLicence = document.getElementById("wavLicence");
                wavLicence.innerHTML = singleBeat[0].beat_price*2+"PLN";
                let stemLicence = document.getElementById("stemLicence");
                stemLicence.innerHTML = singleBeat[0].beat_price*5+"PLN";

                let boxes = document.getElementsByClassName("beat-section-license-content-price");

                // Funkcja do resetowania kolorów tła wszystkich elementów
                function resetBackgroundColors() {
                    for (let i = 0; i < boxes.length; i++) {
                        boxes[i].style.backgroundColor = "#FF3D00";
                    }
                }

                                // Dodaj event listener do pierwszego boxa (MP3)
                boxes[0].addEventListener("click", function() {
                    let price = document.getElementById("acctualPrice");
                    price.innerHTML = singleBeat[0].beat_price + "PLN";
                    resetBackgroundColors(); // Resetuj kolory tła
                    this.style.backgroundColor = "#F7B9B0"; // Ustaw kolor tła dla klikniętego elementu
                    selectedProduct = {
                    type: "MP3",
                    price: singleBeat[0].beat_price,
                    autorid: singleBeat[0].beat_autor,
                    autor: singleBeat[0].producer_name,
                    title: singleBeat[0].beat_title,
                    id: singleBeat[0].beat_id,
                    cover: singleBeat[0].beat_cover,
                };


                });

                // Dodaj event listener do drugiego boxa (WAV)
                boxes[1].addEventListener("click", function() {
                    let price = document.getElementById("acctualPrice");
                    price.innerHTML = singleBeat[0].beat_price * 2 + "PLN";
                    resetBackgroundColors(); // Resetuj kolory tła
                    this.style.backgroundColor = "#F7B9B0"; // Ustaw kolor tła dla klikniętego elementu
                    selectedProduct = {
                    type: "WAV",
                    price: singleBeat[0].beat_price*2,
                    autorid: singleBeat[0].beat_autor,
                    autor: singleBeat[0].producer_name,
                    title: singleBeat[0].beat_title,
                    id: singleBeat[0].beat_id,
                    cover: singleBeat[0].beat_cover,
                };
                });

                // Dodaj event listener do trzeciego boxa (STEM)
                boxes[2].addEventListener("click", function() {
                    let price = document.getElementById("acctualPrice");
                    price.innerHTML = singleBeat[0].beat_price * 5 + "PLN";
                    resetBackgroundColors(); // Resetuj kolory tła
                    this.style.backgroundColor = "#F7B9B0"; // Ustaw kolor tła dla klikniętego elementu
                    selectedProduct = {
                    type: "STEM",
                    price: singleBeat[0].beat_price*5,
                    autorid: singleBeat[0].beat_autor,
                    autor: singleBeat[0].producer_name,
                    title: singleBeat[0].beat_title,
                    id: singleBeat[0].beat_id,
                    cover: singleBeat[0].beat_cover,
                };
                });

                document.getElementById("buy-btn").addEventListener("click", function() {
                    if (selectedProduct) {
                        const koszyk = localStorage.getItem('selectedProduct') ? JSON.parse(localStorage.getItem("selectedProduct")) : [];

                        // Sprawdzenie czy selectedProduct znajduje się już w koszyku
                        const isAlreadyInCart = koszyk.some(item => item.id === selectedProduct.id);

                        if (!isAlreadyInCart) {
                            koszyk.push(selectedProduct);
                            localStorage.setItem('selectedProduct', JSON.stringify(koszyk));
                            console.log('Dodano do koszyka:', koszyk);
                            updateCartItemCount();
                            alert("Produkt dodany do koszyka!");
                        } else {
                            alert("Ten produkt już znajduje się w koszyku.");
                        }
                    } else {
                        alert("Proszę wybrać produkt przed zakupem.");
                    }
                });






            }
})});


function beatFuturedCreate(){
    $.ajax({
        url: "php/singleBeatFutured.php",
        type: "POST",
    success: function(response){
        let NewQuery = JSON.parse(response);
        for (let New of NewQuery) {
            let singleNew = {
                id : New["beat_id"],
                name: New["beat_title"],
                autorid : New["beat_autor"],
                autor: New["producer_name"],
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

            let BeatFuturedSection = document.getElementsByClassName("beat-futured-section-content")[0];
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
                playerTitle.textContent = singleNew.name;
                playerAutor.textContent = singleNew.autor;
                playerBpm.textContent = singleNew.bpm+"BPM"+" / "+singleNew.key;
                playerImg.src = singleNew.img;
            });

            let NewElImgText = document.createElement("a");
            NewElImgText.innerHTML = "POSŁUCHAJ";

            let NewElImgIcon = document.createElement("img");
            NewElImgIcon.src = "img/nbct-arrow.svg";

            let singleNewElTitle = document.createElement("div");
            singleNewElTitle.classList.add("popular-new-section-el-title");

            let singleNewElTitleText = document.createElement("a");
            singleNewElTitleText.innerHTML = singleNew.name;
            singleNewElTitleText.addEventListener("click", function(){
                let beatID = singleNew.id;
                window.location.href = `single_beat.php?id=${beatID}`;
            });

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
            BeatFuturedSection.appendChild(singleNewEl);
        }

    }
})}
beatFuturedCreate();
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
        document.getElementById('player-title').textContent = track.name;
        document.getElementById('player-autor').textContent = track.autor;
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