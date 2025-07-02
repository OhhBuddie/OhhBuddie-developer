<style>
  .heading {
    font-size: 1.5rem;
    text-align: center;
    margin: 1rem 0;
  }

  .Banner {
    width: 100%;
    max-width: 450px; /* Force mobile size */
    margin: 0 auto 1.5rem auto; /* Centered and spaced */
    padding: 0;
  }

  .couponimg,
  .Banner img,
  video {
    width: 100%;
    display: block;
    border-radius: 8px;
    object-fit: cover;
  }
  @media (min-width: 768px) {
    .Banner {
      max-width: 350px; /* Lock to desktop size */
    }
  }
</style>

<h3 class="heading">Coupons For You</h3>

<div class="Banner">
  <img src="https://slikk-dev-assets-public.s3.ap-south-1.amazonaws.com/other/32bed8ece1f043d4809aecf54aadb23d_Ethnic%20Collection%20Women.png" alt="Coupon">
</div>

<div class="Banner">
  <video autoplay muted loop playsinline>
    <source src="{{ asset('assets/video/usp.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video> 
</div>
