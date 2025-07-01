
document.addEventListener("DOMContentLoaded", function () {
    var slideIndex = 0;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    var slideTimer;

    function showSlide(n) {
        if (n >= slides.length) slideIndex = 0;
        else if (n < 0) slideIndex = slides.length - 1;
        else slideIndex = n;
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            dots[i].style.backgroundColor = "#bbb";
            dots[i].classList.remove("active");
        }
        slides[slideIndex].style.display = "block";
        dots[slideIndex].style.backgroundColor = "#717171";
        dots[slideIndex].classList.add("active");
    }

    function autoSlide() {
        slideIndex++;
        showSlide(slideIndex);
        slideTimer = setTimeout(autoSlide, 5000);
    }

    window.currentSlide = function (n) {
        clearTimeout(slideTimer);
        showSlide(n - 1);
        slideTimer = setTimeout(autoSlide, 5000);
    };

    showSlide(slideIndex);
    slideTimer = setTimeout(autoSlide, 5000);

    let touchStartX = 0;
    let touchEndX = 0;
    const minSwipeDistance = 50;
    const sliderContainer = document.querySelector(".w3-content");

    sliderContainer.addEventListener("touchstart", function (e) {
        touchStartX = e.changedTouches[0].screenX;
    });

    sliderContainer.addEventListener("touchend", function (e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipeGesture();
    });

    function handleSwipeGesture() {
        let deltaX = touchEndX - touchStartX;
        if (Math.abs(deltaX) > minSwipeDistance) {
            clearTimeout(slideTimer);
            if (deltaX < 0) {
                slideIndex++;
            } else {
                slideIndex--;
            }
            showSlide(slideIndex);
            slideTimer = setTimeout(autoSlide, 5000);
        }
    }
});
