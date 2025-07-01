<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.2/css/swiper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.2/js/swiper.min.js"></script>

<style>
.swiper-container {
  width: 100%;
  padding-top: 50px;
  padding-bottom: 50px;
  max-width: 350px;
  margin: 0 auto;
}

.swiper-slide {
  background-position: center;
  background-size: cover;
  width: 76vw;
  background-color: #fff;
  overflow: hidden;
  border-radius: 8px;
}

.picture {
  width: 76vw;
  height: 53vh;
  overflow: hidden;
}

.picture img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: fill;
}

/* Desktop only override */
@media (min-width: 768px) {
  .swiper-container {
    max-width: 350px; /* Let it expand full width */
  }

  .swiper-slide,
  .picture {
    width: 20vw; /* Full width on desktop */
    height: 45vh;  /* Optional: slightly taller on desktop */
  }

  .picture img {
    object-fit: fill; /* Make it look more natural */
  }
}

.detail h3 {
  margin: 0;
  font-size: 20px;
}

.detail span {
  display: block;
  font-size: 16px;
  color: #f44336;
}
</style>


<!-- Slider main container -->
<div class="swiper-container">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <div class="swiper-slide">
      <div class="picture">
        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/New%20Format/5%20(5).jpg" alt="">
      </div>
    </div>
    <div class="swiper-slide">
      <div class="picture">
        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/New%20Format/1%20(9).jpg" alt="">
      </div>
    </div>
    <div class="swiper-slide">
      <div class="picture">
        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/New%20Format/2%20(4).jpg" alt="">
      </div>
    </div>
    <div class="swiper-slide">
      <div class="picture">
        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/New%20Format/7%20(2).jpg" alt="">
      </div>
    </div>
    <div class="swiper-slide">
      <div class="picture">
        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/New%20Format/4%20(4).jpg" alt="">
      </div>
    </div>
    <div class="swiper-slide">
      <div class="picture">
        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/New%20Format/3%20(3).jpg" alt="">
      </div>
    </div>
  </div>
  
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>
  
  <!-- If we need scrollbar -->
  <div class="swiper-scrollbar"></div>
</div>

<script>
var swiper = new Swiper(".swiper-container", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  loop: true,
  coverflowEffect: {
    rotate: 20,
    stretch: 0,
    depth: 350,
    modifier: 1,
    slideShadows: true
  },
  autoplay: {
    delay: 3000, // 3 seconds per slide
    disableOnInteraction: false
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  }
});
</script>