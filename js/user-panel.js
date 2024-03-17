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