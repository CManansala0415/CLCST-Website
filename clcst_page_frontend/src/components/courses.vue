<script setup>
import { ref, onMounted } from 'vue'

const courses = ref({
  college: [
    {
      id: 1,
      name: 'Criminology',
      quote: 'Crime prevention, law enforcement & forensic science.',
      image: '/img/clcst/crim2.jpg',
      location:'Available areas: Olongapo and San Fernando'
    },
    {
      id: 2,
      name: 'Marine Transportation',
      quote: 'Navigation, seamanship, cargo handling & maritime laws.',
      image: '/img/clcst/bsmt2.jpg',
      location:'Available areas: Olongapo and San Fernando'
    },
    {
      id: 3,
      name: 'Information Technology',
      quote: 'Marine engine maintenance, power systems & ship safety.',
      image: '/img/clcst/bsit2.jpg',
      location:'Available areas: Olongapo and San Fernando'
    },
    {
      id: 4,
      name: 'Hospitality Management',
      quote: 'Hotel & restaurant management, tourism & services.',
      image: '/img/clcst/bshm2.jpg',
      location:'Available areas: Olongapo and San Fernando'
    },
    {
      id: 5,
      name: 'ABM, STEM, HUMSS',
      quote: 'Senior High strands for college prep & career readiness.',
      image: '/img/clcst/shs2.jpg',
      location:'Available areas: Olongapo and San Fernando'
    }
  ]
})

onMounted(() => {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) entry.target.classList.add('visible')
      })
    },
    { threshold: 0.2 }
  )
  document.querySelectorAll('.fade-in').forEach((el) => observer.observe(el))
})
</script>
<template>
  <section class="hero container-fluid">
    <div class="container hero-content">
      <div class="row align-items-center">
        <!-- Left Text -->
        <div class="col-lg-6 col-12 text-section fade-in">
          <h3 class="display-5 mb-3">Achieve Your Dreams</h3>
          <p class="lead mb-4 hero-text">
            CLCST is a respected institution offering quality education in criminology, hospitality, IT, maritime, and senior high school programs.
            With strong ties to industry, modern facilities, and a commitment to excellence,
            <span class="fw-semibold">CELTECH</span> continues to shape future professionals in Zambales and beyond.
          </p>
          <!-- <a href="#courses" class="btn btn-outline-light btn-lg px-4">
            Explore Our Programs
          </a> -->
        </div>

        <!-- Right Carousel -->
        <div class="col-lg-6 col-12 mt-5 mt-lg-0 fade-in">
          <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
              <div
                class="carousel-item"
                v-for="(item, index) in courses.college"
                :key="index"
                :class="{ active: index === 0 }"
              >
                <div class="carousel-bg" :style="{ backgroundImage: `url(${item.image})` }">
                  <div class="carousel-gradient"></div>
                  <div class="carousel-caption-gradient">
                    <h5 class="fw-bold spaced-text text-uppercase fw-bold">{{ item.name }}</h5>
                    <p>{{ item.quote }}</p>
                    <span>{{ item.location }}</span>
                  </div>
                </div>
              </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>



<style scoped>
/* HERO BASE */
.hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  overflow: hidden;
}

.hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(rgba(0, 0, 0, 0.5),
                              rgba(0, 0, 0, 0.7),
                              rgba(0, 0, 0, 1));
}

.hero-content {
  position: relative;
  z-index: 2;
}

/* TEXT SECTION */
.text-section {
  color: #fff;
  text-align: left;
}

/* CAROUSEL */
.carousel-bg {
  width: 100%;
  height: 80vh;
  max-height: 700px;
  background-position: center top;
  background-size: cover;
  /* border-radius: 0.75rem; */
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
  position: relative;
  overflow: hidden;
}

.carousel-gradient {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 50%;
  background: linear-gradient(to top,
              rgba(0, 0, 0, 0.8) 0%,
              rgba(0, 0, 0, 0.3) 70%,
              transparent 100%);
}

.carousel-caption-gradient {
  position: absolute;
  bottom: 1.5rem;
  left: 1.5rem;
  color: #fff;
  z-index: 2;
  opacity: 0;
  animation: fadeInCaption 1s forwards;
}

@keyframes fadeInCaption {
  to {
    opacity: 1;
  }
}

/* RESPONSIVE */
@media (max-width: 991px) {
  .carousel-bg {
    height: 50vh;
  }

  .text-section {
    text-align: center;
  }

  .carousel-caption-gradient {
    font-size: 0.9rem;
    left: 1rem;
    bottom: 1rem;
  }
}

/* FADE IN ANIMATION */
.fade-in {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.fade-in.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Responsive text */
.hero h3 { font-size: clamp(1.5rem, 2vw + 0.5rem, 2.5rem); }
.hero-text { font-size: clamp(12px, 0.9vw + 0.3rem, 16px); letter-spacing: 0.2rem; line-height: 1.8; opacity: 0.9; }

/* Mobile adjustments */
@media (max-width: 768px) {
  .hero-text, .spaced-text { width: 90% !important; }
  .glass-card { padding: 2rem 1.5rem; }
}

.spaced-text {
  font-size: 0.9rem;
  letter-spacing: 0.5rem;
  font-family: 'Inter', sans-serif;
}
</style>
