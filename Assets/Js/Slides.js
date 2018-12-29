var slideIndex = 0;

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("Svg1");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";        
    }

    slideIndex++;

    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    slides[slideIndex - 1].style.display = "block";
    //Change image every 2 seconds
    setTimeout(showSlides, 5000);
}