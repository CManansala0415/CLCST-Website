<script setup>
import { ref } from 'vue'

const courses = ref({
  college: [
    {
      id: 1, name: 'Bachelor of Science in Marine Transportation',
      quote: 'Navigation, seamanship, cargo handling & maritime laws.',
      image: '/img/bsmt.jpg',
      type: 'College'
    },
    {
      id: 2, name: 'Bachelor of Science in Marine Engineering',
      quote: 'Marine engine maintenance, power systems & ship safety.',
      image: '/img/bsmt.jpg',
      type: 'College'
    },
    {
      id: 3, name: 'Bachelor of Science in Criminal Justice',
      quote: 'Crime prevention, law enforcement & forensic science.',
      image: '/img/bsmt.jpg',
      type: 'College'
    },
    {
      id: 4, name: 'Bachelor of Science in Customs Administration',
      quote: 'Customs laws, tariffs, and trade regulations.',
      image: '/img/bsmt.jpg',
      type: 'College'
    },
    {
      id: 5, name: 'Bachelor of Science in Tourism Management',
      quote: 'Hotel & restaurant management, tourism & services.',
      image: '/img/bsmt.jpg',
      type: 'College'
    },
    {
      id: 6, name: 'Bachelor of Science in Information Technology',
      quote: 'Software, hardware, networking & web systems.',
      image: '/img/bsmt.jpg',
      type: 'College'
    }
  ]
})
</script>

<template>
  <!-- Hero Banner Section -->
  <section class="hero d-flex flex-column justify-content-between align-items-center text-white text-center py-3">
    
    <!-- Header Text -->
    <div class="container text-container">
      <h3 class="mt-3">What Makes Us, Us?</h3>
      <p class="hero-text mt-3">
        Trust, Teamwork, Professionalism, Quality and Excellence, Commitment and Passion to Serve, Loyalty
      </p>
      <span class="spaced-text mt-3 mb-3 fw-bold text-uppercase">"We are Transforming Lives"</span>
    </div>

    <!-- Image Carousel -->
    <div class="container carousel-container">
      <!-- Image Carousel -->
      <div class="container">
        <div id="aboutCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active position-relative">
              <div class="carousel-bg" style="background-image: url('/img/clcst/crim1.jpg')"></div>
              <div class="carousel-overlay"></div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item position-relative">
              <div class="carousel-bg" style="background-image: url('/img/clcst/bshm1.jpg')"></div>
              <div class="carousel-overlay"></div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item position-relative">
              <div class="carousel-bg" style="background-image: url('/img/clcst/bsit1.jpg')"></div>
              <div class="carousel-overlay"></div>
            </div>

            <!-- Slide 4 -->
            <div class="carousel-item position-relative">
              <div class="carousel-bg" style="background-image: url('/img/clcst/bsmt1.jpg')"></div>
              <div class="carousel-overlay"></div>
            </div>

            <!-- Slide 5 -->
            <div class="carousel-item position-relative">
              <div class="carousel-bg" style="background-image: url('/img/clcst/shs1.jpg')"></div>
              <div class="carousel-overlay"></div>
            </div>

          </div>

          <!-- Controls -->
          <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>
    </div>

    <!-- Footer Text -->
    <div class="container text-container">
      <p class="hero-text mt-3 mb-0">We are Driven by Trust, United in Excellence</p>
    </div>

  </section>
</template>

<style scoped>
.hero {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 1rem;
  position: relative;
}

.hero::after {
  content: "";
  position: absolute;
  inset: 0;
   background: linear-gradient(rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5));
  z-index: 0;
}

.hero .text-container {
  position: relative;
  z-index: 1;
}

.hero h3 {
  font-size: clamp(1.5rem, 4vw, 2rem);
}

.hero-text {
  font-size: clamp(0.8rem, 2.5vw, 1rem);
  letter-spacing: 0.1rem;
  line-height: 1.5;
  opacity: 0.9;
}

.spaced-text {
  font-size: clamp(0.7rem, 2vw, 0.9rem);
  letter-spacing: 0.3rem;
  font-family: 'Inter', sans-serif;
}

/* Carousel */
.carousel-container {
  width: 100%;
  max-width: 900px;
  margin: 1rem 0;
  z-index: 1;
}

.carousel-bg {
  width: 100%;
  height: clamp(350px, 45vh, 600px); /* larger carousel */
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
  box-shadow: 0 6px 20px rgba(0,0,0,0.25);
  background-color: #000;
}

.carousel-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.3));
}

/* Carousel controls for smaller screens */
@media (max-width: 768px) {
  .carousel-control-prev,
  .carousel-control-next {
    width: 5%;
  }
}

/* Mobile adjustments */
@media (max-width: 576px) {
  .spaced-text {
    letter-spacing: 0.1rem;
    font-size: 0.7rem;
  }
  .hero-text {
    font-size: 0.75rem;
  }
  .carousel-bg {
    height: 40vh; /* taller for mobile */
  }
}
</style>
