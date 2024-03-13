let logoutBtn = document.getElementById("logoutBtn");
logoutBtn.addEventListener("click", function(){
    window.location.href="php/logout.php";
});
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.panel-menu-item');
    const slides = document.querySelectorAll('.panel-choose-post');

    function changeSlide(slideIndex) {
        slides.forEach(slide => slide.style.display = 'none');
        slides[slideIndex].style.display = 'block';
    }

    menuItems.forEach((item, index) => {
        item.addEventListener('click', () => changeSlide(index));
    });
    changeSlide(0); // Pokaż pierwszy slajd domyślnie
});
function adminNewestBeat(){
    $.ajax({
        url: "php/adminNewestBeat.php",
        type: "POST",
    success: function(response){
        let adminNewestBeatQuery = JSON.parse(response);
        console.log(adminNewestBeatQuery);

        let beatName = document.getElementById("beat-name");
        beatName.innerHTML = adminNewestBeatQuery[0]["beat_title"];

        // Pobranie wszystkich elementów z klasą 'panel-choose-post-content-el-img'
        let beatImgs = document.getElementsByClassName("panel-choose-post-content-el-img");

        // Iteracja przez kolekcję elementów i ustawienie tła dla każdego z nich
        for (let i = 0; i < beatImgs.length; i++) {
            beatImgs[i].style.backgroundImage = `url('${adminNewestBeatQuery[0]["beat_cover"]}')`;
        }

    }
    }
)};
adminNewestBeat();
function adminBeatList() {
    $.ajax({
        url: "php/adminBeatList.php",
        type: "POST",
        success: function(response) {
            let adminBeatListQuery = JSON.parse(response);
            console.log(adminBeatListQuery)
            let beatList = document.getElementsByClassName("panel-choose-post-content-tresci")[0];
            beatList.innerHTML = ''; // Wyczyść listę przed ponownym załadowaniem

            adminBeatListQuery.forEach(function(element) {
                let divEl = document.createElement("div");
                divEl.className = "panel-choose-post-content-tresci-el";
                divEl.setAttribute('data-beat-id', element.beat_id); // Ustawienie atrybutu data-beat-id dla każdego elementu

                divEl.innerHTML = `
                    <div class="panel-choose-post-content-tresci-info ">
                        <div class="panel-choose-post-content-tresci-img" style="background-image: url('${element.beat_cover}')">
                        </div>
                        <div class="panel-choose-post-content-tresci-details">
                            <div class="panel-choose-post-content-tresci-info-title">
                                <a>${element.beat_title}</a>
                            </div>
                            <div class="panel-choose-post-content-tresci-info-desc">
                                <a>${element.beat_bpm}BPM</a>
                                <a>${element.beat_key}</a>
                                <a>${element.cat_name}</a>
                                <a>${element.beat_price}PLN</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-choose-post-content-tresci-views panel-choose-post-content-column">
                        <a>${element.views}</a>
                        <img src="img/eye-white.png" alt="Ilość wyświetleń" class="panel-choose-post-content-icon">
                    </div>
                    <div class="panel-choose-post-content-tresci-like panel-choose-post-content-column">
                        <a>${element.likes}</a>
                        <img src="img/star-white.png" alt="Ilość polubień" class="panel-choose-post-content-icon">
                    </div>
                    <div class="panel-choose-post-content-tresci-sell panel-choose-post-content-column">
                        <a>${element.earnings}PLN</a>
                        <img src="img/money-white.png" alt="Twój zarobek" class="panel-choose-post-content-icon">
                    </div>
                    <div class="panel-choose-post-content-tresci-sell panel-choose-post-content-column">
                        <a class="tresci-delete" data-id="${element.beat_id}">USUŃ</a>
                    </div>
                `;

                beatList.appendChild(divEl);
            });

            attachEventListeners();
        }
    });
}

function attachEventListeners() {
    document.querySelectorAll('.tresci-edit').forEach(button => {
        button.removeEventListener('click', editListener); // Usuń poprzedni nasłuchiwacz, jeśli istnieje
        button.addEventListener('click', editListener);
    });

    document.querySelectorAll('.tresci-delete').forEach(button => {
        button.removeEventListener('click', deleteListener); // Usuń poprzedni nasłuchiwacz, jeśli istnieje
        button.addEventListener('click', deleteListener);
    });
}
function deleteListener() {
    const confirmDelete = confirm("Czy na pewno chcesz usunąć ten rekord?");
    if (confirmDelete) {
        deleteBeat(this.getAttribute('data-id'));
    }
}
function deleteBeat(id) {
    $.ajax({
        url: "php/beatDelete.php", // Endpoint do usuwania
        type: "POST",
        data: { beat_id: id },
        success: function(response) {
            console.log("Usunięto rekord", response);
            adminBeatList(); // Odśwież listę po usunięciu
        },
        error: function(xhr, status, error) {
            console.error("Nie udało się usunąć rekordu", error);
        }
    });
}
adminBeatList(); // Wywołaj funkcję na starcie

