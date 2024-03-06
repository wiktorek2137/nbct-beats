function categoryCreate(){
    $.ajax({
        url: "php/AllCategories.php",
        type: "POST",
    success: function(response){
        let categoriesQuery = JSON.parse(response);
        for (let category of categoriesQuery) {
            let singleCategory = {
                id: category["cat_id"],
                name: category["cat_name"],
                img: category["cat_img"],
            };

            let futuredSection = document.getElementsByClassName("futured-section-content-row")[0];

            let singleFuturedEl = document.createElement("div");
            singleFuturedEl.classList.add("futured-section-el-row");

            let singleFuturedElImg = document.createElement("div");
            singleFuturedElImg.classList.add("futured-section-el-img");
            singleFuturedElImg.style.backgroundImage = `url('${singleCategory.img}')`;

            let futuredElImgBtn = document.createElement("div");
            futuredElImgBtn.classList.add("futured-section-el-img-btn");
            futuredElImgBtn.addEventListener("click", function(){
                let categoryID = singleCategory.id;
                window.location.href = `single_category.php?id=${categoryID}`;
            });

            let futuredElImgText = document.createElement("a");
                futuredElImgText.innerHTML = "ZOBACZ KATEGORIĘ";

            let futuredElImgIcon = document.createElement("img");
            futuredElImgIcon.src = "img/nbct-arrow.svg";

            let singleFuturedElBtn = document.createElement("div");
            singleFuturedElBtn.classList.add("futured-section-el-btn");

            let singleFuturedElAutor = document.createElement("div");
            singleFuturedElAutor.classList.add("futured-section-el-autor");

            let singleFuturedElAutorText = document.createElement("a");
            singleFuturedElAutorText.innerHTML = singleCategory.name;

            futuredElImgBtn.appendChild(futuredElImgText);
            futuredElImgBtn.appendChild(futuredElImgIcon);

            singleFuturedElImg.appendChild(futuredElImgBtn);

            singleFuturedElAutor.appendChild(singleFuturedElAutorText);

            singleFuturedEl.appendChild(singleFuturedElImg);
            singleFuturedEl.appendChild(singleFuturedElAutor);

            futuredSection.appendChild(singleFuturedEl);
        }

    }
})}
categoryCreate();

// function categoryRowCreate(){
//     $.ajax({
//         url: "php/AllCategories.php",
//         type: "POST",
//     success: function(response){
//         let categoriesQuery = JSON.parse(response);
//         for (let category of categoriesQuery) {
//             let singleCategory = {
//                 id: category["cat_id"],
//                 name: category["cat_name"],
//                 img: category["cat_img"],
//             };

//             let futuredSectionRow = document.getElementsByClassName("futured-section-content-row")[0];

//             let singleFuturedEl = document.createElement("div");
//             singleFuturedEl.classList.add("futured-section-el");

//             let singleFuturedElImg = document.createElement("div");
//             singleFuturedElImg.classList.add("futured-section-el-img");
//             singleFuturedElImg.style.backgroundImage = `url('${singleCategory.img}')`;

//             let futuredElImgBtn = document.createElement("div");
//             futuredElImgBtn.classList.add("futured-section-el-img-btn");
//             futuredElImgBtn.addEventListener("click", function(){
//                 let categoryID = singleCategory.id;
//                 window.location.href = `single_category.html?id=${categoryID}`;
//             });

//             let futuredElImgText = document.createElement("a");
//                 futuredElImgText.innerHTML = "ZOBACZ KATEGORIĘ";

//             let futuredElImgIcon = document.createElement("img");
//             futuredElImgIcon.src = "img/nbct-arrow.svg";

//             let singleFuturedElBtn = document.createElement("div");
//             singleFuturedElBtn.classList.add("futured-section-el-btn");

//             let singleFuturedElAutor = document.createElement("div");
//             singleFuturedElAutor.classList.add("futured-section-el-autor");

//             let singleFuturedElAutorText = document.createElement("a");
//             singleFuturedElAutorText.innerHTML = singleCategory.name;

//             futuredElImgBtn.appendChild(futuredElImgText);
//             futuredElImgBtn.appendChild(futuredElImgIcon);

//             singleFuturedElImg.appendChild(futuredElImgBtn);

//             singleFuturedElAutor.appendChild(singleFuturedElAutorText);

//             singleFuturedEl.appendChild(singleFuturedElImg);
//             singleFuturedEl.appendChild(singleFuturedElAutor);

//             futuredSectionRow.appendChild(singleFuturedEl);
//         }

//     }
// })}
// categoryRowCreate();

