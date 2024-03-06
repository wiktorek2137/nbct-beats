document.querySelectorAll('.nav-links-underline').forEach(item => {
    item.addEventListener('mouseenter', function() {
        this.classList.add('animate');
        setTimeout(() => {
            this.classList.remove('animate');
        }, 1000);
    });
});

let producenci = document.getElementById("nav1");
producenci.addEventListener("click", function(){
    window.location.href="producenci.php";
});
let kategorie = document.getElementById("nav2");
kategorie.addEventListener("click", function(){
    window.location.href="kategorie.php";
});
let najnowsze = document.getElementById("nav3");
najnowsze.addEventListener("click", function(){
    window.location.href="najnowsze.php";
});

let loginPage = document.getElementById("login");
if (loginPage) {
    loginPage.addEventListener("click", function() {
        window.location.href = "login_page.php";
    });
}

let registerPage = document.getElementById("register");
if (registerPage) {
    registerPage.addEventListener("click", function() {
        window.location.href = "register_page.php";
    });
}

let catLinks = document.getElementsByClassName("bottom-link");

for (let i = 0; i < catLinks.length; i++) {
    catLinks[i].addEventListener("click", function() {
        window.location.href = `single_category.php?id=${i + 1}`;
    });
}

let cartIcon = document.getElementsByClassName("nav-cart")[0];
cartIcon.addEventListener("click", function(){
    window.location.href = "checkout.php";
});

function updateCartItemCount() {
    const rawData = localStorage.getItem('selectedProduct');
    const cartItems = rawData ? JSON.parse(rawData) : [];
    const itemCount = cartItems.length;
    const itemCountElement = document.getElementsByClassName('nav-cart-count')[0];
    if(itemCount==0){
        itemCountElement.style.display = "none";
    }
    else{
        itemCountElement.style.display = "flex";
        itemCountElement.textContent = ` ${itemCount}`;
    }
}

// Wywołaj funkcję na początku, aby zaktualizować liczbę przy ładowaniu strony
updateCartItemCount();

// Pamiętaj, aby wywołać tę funkcję również po dodaniu lub usunięciu przedmiotu z koszyka




// LOGO HREF
let logo = document.getElementsByClassName("nav-logo")[0];
logo.addEventListener("click", function(){
    window.location.href="home_page.php";
});
