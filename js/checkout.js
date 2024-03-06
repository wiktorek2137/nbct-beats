const key = 'selectedProduct';
const rawData = localStorage.getItem(key);
if (rawData) {
    const data = JSON.parse(rawData);
}

let checkoutSection = document.getElementsByClassName("checkout-section-content-list")[0]; // Pobiera pierwszy element pasujący do klasy
let cartPrice = document.getElementById("cart-price");
let finalPrice = document.getElementById("final-price");
let suma = 0;
let voucherForm = document.getElementById("voucher-code")
let voucherButton = document.getElementsByClassName("checkout-section-content-panel-voucher-title")[0];

if (rawData) {
    const data = JSON.parse(rawData);
    // Zakładając, że checkoutSection jest już zdefiniowany i wskazuje na odpowiedni element w DOM
    data.forEach(item => {
        // SUMOWANIE
        suma += Number(item.price);
        cartPrice.innerHTML = suma+"PLN";
        finalPrice.innerHTML = suma+"PLN";

        // LISTA PANEL
        let checkoutSectionContent = document.getElementsByClassName('checkout-section-content-panel-list')[0]; // Zakładając, że taki element istnieje w DOM

        let checkoutPanelEl = document.createElement("div");
        checkoutPanelEl.classList.add("checkout-section-content-panel-el");

        let checkoutPanelElTitle = document.createElement("div");
        checkoutPanelElTitle.classList.add("checkout-section-content-panel-el-title");

        let checkoutPanelElTitleText = document.createElement("a");
        checkoutPanelElTitleText.innerHTML = item.title;

        let checkoutPanelElPrice = document.createElement("div");
        checkoutPanelElPrice.classList.add("checkout-section-content-panel-el-price"); // Poprawka: zmiana z checkoutPanelElTitle na checkoutPanelElPrice

        let checkoutPanelElPriceText = document.createElement("a"); // Poprawka: zmiana z checkoutPanelElTitlePriceText na checkoutPanelElPriceText
        checkoutPanelElPriceText.innerHTML = item.price + "PLN";

        // Dodawanie elementów do ich rodziców
        checkoutPanelElTitle.appendChild(checkoutPanelElTitleText);
        checkoutPanelElPrice.appendChild(checkoutPanelElPriceText);

        checkoutPanelEl.appendChild(checkoutPanelElTitle);
        checkoutPanelEl.appendChild(checkoutPanelElPrice);

        checkoutSectionContent.appendChild(checkoutPanelEl);

        // LISTA MAIN

        let checkoutSectionEl = document.createElement("div");
        checkoutSectionEl.classList.add("checkout-section-content-el");

        let checkoutSectionElImg = document.createElement("div");
        checkoutSectionElImg.classList.add("checkout-section-content-el-img");
        checkoutSectionElImg.style.backgroundImage = `url('${item.cover}')`;

        let checkoutSectionDesc = document.createElement("div");
        checkoutSectionDesc.classList.add("checkout-section-content-el-desc");

        let checkoutSectionElTitle = document.createElement("div");
        checkoutSectionElTitle.classList.add("checkout-section-content-el-title");
        checkoutSectionElTitle.addEventListener("click", function(){
            let beatID = item.id;
            window.location.href = `single_beat.php?id=${beatID}`;
        });

        let checkoutSectionElTitleText = document.createElement("a");
        checkoutSectionElTitleText.innerHTML = item.title;

        let checkoutSectionElLicence = document.createElement("div");
        checkoutSectionElLicence.classList.add("checkout-section-content-el-licence");

        let checkoutSectionElLicenceType = document.createElement("a");
        checkoutSectionElLicenceType.innerHTML = "Typ licencji: "+item.type;

        let checkoutSectionElLicencePrice = document.createElement("a");
        checkoutSectionElLicencePrice.innerHTML = "Cena: "+item.price+ "PLN";

        let checkoutSectionElLicenceAutor = document.createElement("a");
        checkoutSectionElLicenceAutor.innerHTML = "Autor: "+item.autor;

        let checkoutSectionElDel = document.createElement("div");
        checkoutSectionElDel.classList.add("checkout-section-content-el-del");

        let checkoutSectionElDelText = document.createElement("a");
        checkoutSectionElDelText.innerHTML = "USUŃ Z KOSZYKA";
        checkoutSectionElDelText.href = "#"; // Dodaj, aby zachować zachowanie linku
        checkoutSectionElDelText.addEventListener('click', function(e) {
            e.preventDefault(); // Zapobiegaj domyślnemu zachowaniu linku
            removeFromCart(item.id);
        });

        function removeFromCart(productId) {
            // Znajdź i usuń produkt z danych
            const updatedData = data.filter(item => item.id !== productId);
            // Zaktualizuj Local Storage
            localStorage.setItem('selectedProduct', JSON.stringify(updatedData));
            // Odśwież widok (możesz chcieć zaktualizować DOM lub odświeżyć stronę)
            refreshCartView();
        }

        function refreshCartView() {
            // cartPrice.innerHTML = suma;
            location.reload(); // Prosta metoda odświeżenia, dla bardziej złożonych aplikacji lepiej zaktualizować DOM
        }
        // Dodawanie elementów do siebie, zgodnie z żądaną strukturą
        checkoutSectionElTitle.appendChild(checkoutSectionElTitleText);

        checkoutSectionElLicence.appendChild(checkoutSectionElLicenceType);
        checkoutSectionElLicence.appendChild(checkoutSectionElLicencePrice);
        checkoutSectionElLicence.appendChild(checkoutSectionElLicenceAutor);

        checkoutSectionElTitle.appendChild(checkoutSectionElLicence); // Licencja jest częścią tytułu w tej strukturze
        checkoutSectionElDel.appendChild(checkoutSectionElDelText);

        checkoutSectionDesc.appendChild(checkoutSectionElTitle);
        checkoutSectionDesc.appendChild(checkoutSectionElDel);

        checkoutSectionEl.appendChild(checkoutSectionElImg);
        checkoutSectionEl.appendChild(checkoutSectionDesc);

        checkoutSection.appendChild(checkoutSectionEl);
    });
}

voucherButton.addEventListener("click", function(){
    $.ajax({
        url: "php/voucherSearch.php",
        type: "POST",
        dataType: 'json',
        data: {value: voucherForm.value},
    success: function(response){
        if(response[0] == null){

            let voucherErrorSection = document.querySelectorAll(".checkout-section-content-panel-error")[0];

            // Usuwanie istniejącego komunikatu o błędzie, jeśli istnieje
            let existingError = voucherErrorSection.querySelector("a");
            if (!existingError) {
                let voucherError = document.createElement("a");
                voucherError.innerHTML = "Nieprawidłowy kod vouchera";
                voucherErrorSection.appendChild(voucherError);
            }
        }
        else{
            let voucherCode = response[0].voucher_code;
            let voucherValue = response[0].voucher_value;

            let voucherErrorSection = document.querySelector(".checkout-section-content-panel-error");
            let existingError = voucherErrorSection.querySelector("a");
            if (existingError) {
                existingError.remove();
            }

            suma -= voucherValue;
            cartPrice.innerHTML = suma+"PLN";
            finalPrice.innerHTML = suma+"PLN";

            let checkoutSectionContent = document.getElementsByClassName('checkout-section-content-panel-list')[0]

            let checkoutPanelElVoucher = document.createElement("div");
            checkoutPanelElVoucher.classList.add("checkout-section-content-panel-el"); // Poprawka: zmiana z checkoutPanelElVouche na checkoutPanelElVoucher

            let checkoutPanelElTitleVoucher = document.createElement("div");
            checkoutPanelElTitleVoucher.classList.add("checkout-section-content-panel-el-title");

            let checkoutPanelElTitleTextVoucher = document.createElement("a");
            checkoutPanelElTitleTextVoucher.innerHTML = voucherCode;

            let checkoutPanelElTitleTextVoucherDelete = document.createElement("div");
            checkoutPanelElTitleTextVoucherDelete.classList.add("checkout-voucher-delete-btn");
            checkoutPanelElTitleTextVoucherDelete.innerHTML = "X";
            checkoutPanelElTitleTextVoucherDelete.addEventListener("click", function(){
                checkoutPanelElVoucher.remove();
                suma += Number(voucherValue);
                cartPrice.innerHTML = suma+"PLN";
                finalPrice.innerHTML = suma+"PLN";
            });

            let checkoutPanelElPriceVoucher = document.createElement("div");
            checkoutPanelElPriceVoucher.classList.add("checkout-section-content-panel-el-price");

            let checkoutPanelElPriceTextVoucher = document.createElement("a");
            checkoutPanelElPriceTextVoucher.innerHTML = "-"+voucherValue+"PLN";

            // Dodawanie elementów do ich rodziców
            checkoutPanelElTitleVoucher.appendChild(checkoutPanelElTitleTextVoucherDelete);
            checkoutPanelElTitleVoucher.appendChild(checkoutPanelElTitleTextVoucher);
            checkoutPanelElPriceVoucher.appendChild(checkoutPanelElPriceTextVoucher);

            checkoutPanelElVoucher.appendChild(checkoutPanelElTitleVoucher);
            checkoutPanelElVoucher.appendChild(checkoutPanelElPriceVoucher);

            // Zakładając, że checkoutSectionContent jest już zdefiniowane i dostępne w zasięgu
            checkoutSectionContent.appendChild(checkoutPanelElVoucher);

        }

    }});


});
