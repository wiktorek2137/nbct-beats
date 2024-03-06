function producersCreate(){
    $.ajax({
        url: "php/producers.php",
        type: "POST",
    success: function(response){
        let producersQuery = JSON.parse(response);
        for (let producer of producersQuery) {
            let singleProducer = {
                id: producer["producer_id"],
                name: producer["producer_name"],
                img: producer["producer_img"],
                // img: 'img/producers/'+producer["producer_img"],
            };

            let prodSection = document.getElementsByClassName("prod-section-content-prods")[0];

            let singleProdEl = document.createElement("div");
            singleProdEl.classList.add("prod-section-el");

            let singleProdElImg = document.createElement("div");
            singleProdElImg.classList.add("futured-section-el-img");
            singleProdElImg.style.backgroundImage = `url('${singleProducer.img}')`;

            let prodElImgBtn = document.createElement("div");
            prodElImgBtn.classList.add("futured-section-el-img-btn");
            prodElImgBtn.addEventListener("click", function(){
                let producerID = singleProducer.id;
                window.location.href = `single_autor.php?id=${producerID}`;
            });

            let prodElImgText = document.createElement("a");
                prodElImgText.innerHTML = "ZOBACZ PRODUKCJE";

            let prodElImgIcon = document.createElement("img");
            prodElImgIcon.src = "img/nbct-arrow.svg";

            let singleProdElBtn = document.createElement("div");
            singleProdElBtn.classList.add("futured-section-el-btn");

            let singleProdElAutor = document.createElement("div");
            singleProdElAutor.classList.add("futured-section-el-autor");

            let singleProdElAutorText = document.createElement("a");
            singleProdElAutorText.innerHTML = singleProducer.name;

            prodElImgBtn.appendChild(prodElImgText);
            prodElImgBtn.appendChild(prodElImgIcon);

            singleProdElImg.appendChild(prodElImgBtn);

            singleProdElAutor.appendChild(singleProdElAutorText);

            singleProdEl.appendChild(singleProdElImg);
            singleProdEl.appendChild(singleProdElAutor);

            prodSection.appendChild(singleProdEl);
        }

    }
})}
producersCreate();