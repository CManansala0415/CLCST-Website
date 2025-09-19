<script setup>
import { ref, onMounted } from 'vue'

const courses = ref({
  college: [
    { id: 1, name: 'Bachelor of Science in Marine Transportation', quote: 'Navigation, seamanship, cargo handling & maritime laws.', image: '/img/bsmt.jpg', type: 'College' },
    { id: 2, name: 'Bachelor of Science in Marine Engineering', quote: 'Marine engine maintenance, power systems & ship safety.', image: '/img/bsmt.jpg', type: 'College' },
    { id: 3, name: 'Bachelor of Science in Criminal Justice', quote: 'Crime prevention, law enforcement & forensic science.', image: '/img/bsmt.jpg', type: 'College' },
    { id: 4, name: 'Bachelor of Science in Customs Administration', quote: 'Customs laws, tariffs, and trade regulations.', image: '/img/bsmt.jpg', type: 'College' },
    { id: 5, name: 'Bachelor of Science in Tourism Management', quote: 'Hotel & restaurant management, tourism & services.', image: '/img/bsmt.jpg', type: 'College' },
    { id: 6, name: 'Bachelor of Science in Information Technology', quote: 'Software, hardware, networking & web systems.', image: '/img/bsmt.jpg', type: 'College' }
  ]
})

const facility = ref([
  { image: '/img/clcst/facility1.jpg' },
  { image: '/img/clcst/facility2.jpg' },
  { image: '/img/clcst/facility3.jpg' },
  { image: '/img/clcst/facility4.jpg' },
  { image: '/img/clcst/facility5.jpg' },
  { image: '/img/clcst/facility6.jpg' },
  { image: '/img/clcst/facility7.jpg' },
])

onMounted(() => {
  const elements = document.querySelectorAll('.fade-in')

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('appear')
        entry.target.classList.remove('disappear')
      } else {
        entry.target.classList.remove('appear')
        entry.target.classList.add('disappear')
      }
    })
  }, { threshold: 0.15 })

  elements.forEach((el, index) => {
    el.style.animationDelay = `${index * 0.25}s`
    observer.observe(el)
  })
})
</script>

<template>
  <section class="hero d-flex flex-column justify-content-start align-items-center text-white text-center py-5">
    <div class="overflow-auto">
      <!-- Background Carousel -->
      <div id="heroCarousel" class="carousel slide carousel-fade w-100 h-100 position-absolute top-0 start-0" data-bs-ride="carousel">
        <div class="carousel-inner h-100">
          <div class="carousel-item h-100" v-for="(value, index) in facility" :key="index" :class="{ active: index === 0 }">
            <div class="hero-slide" :style="{ backgroundImage: `url(${value.image})` }"></div>
          </div>
        </div>
      </div>

      <!-- Hero Content -->
      <div class="container d-flex flex-column justify-content-center align-items-center position-relative fade-in">
        <h3 class="mt-3 display-6 fw-bold text-gradient">Campus & Facilities</h3>
        <p class="w-75 mt-3 hero-text">We are located at CBMU Road / Rizal Avenue, Upper Kalaklan, Olongapo City and B.Mendoza St. City of San Fernando Pampanga.</p>
        <p class="w-75 mt-1 hero-text">Features fully air-conditioned classrooms, computer and maritime labs, a mini-hospital, mini-hotel, school library, cafeteria, automotive workshop, crime lab, auditorium, and more.</p>
        <span class="spaced-text fw-bold glow-text">Accreditation & Recognition</span>
      </div>

      <!-- Programs Highlights -->
      <div class="container mt-3 position-relative">
        <div class="row g-4">
          <div class="col-12 col-md-4 fade-in" v-for="n in 3" :key="n">
            <div class="glass-card p-4 rounded h-100 d-flex flex-column justify-content-center align-items-center text-white shadow-lg hover-tilt">
              <span class="opacity-90 fw-semibold text-center">
                {{ n === 1 ? "100% STCW 95/CHED/IMO compliance for maritime programs" : n === 2 ? "First ISO 9001-certified school (since 1999)" : "High passing rates in TESDA and professional board exams (Marine Eng’g, Crim, Customs, etc.)" }}
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Community -->
      <div class="container d-flex flex-column justify-content-center align-items-center position-relative mt-4 p-4 rounded-4 glass-card fade-in">
        <p class="mt-2 spaced-text fw-bold glow-text">Community & Connections</p>
        <p class="w-75 mt-1 hero-text">Supports local workforce needs in Olongapo and nearby Clark/Subic economic zones. Active partnerships in private and public sectors for OJT, internships, and job placement.</p>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Hero Section */
.hero {
  min-height: 100vh;            /* allow taller height if content stacks */
  width: 100%;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 1rem;
  box-sizing: border-box;
}

.hero-slide {
  height: 100%;
  width: 100%;
  background-position: center;
  background-size: cover;
}

.hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(rgba(0,0,0,1), rgba(0,0,0,0.5), rgba(0,0,0,1));
  z-index: 1;
}

.hero .container {
  position: relative;
  z-index: 2;
  margin-bottom: 1.5rem;
}

/* Responsive text */
.hero h3 {
  font-size: clamp(1.2rem, 4vw, 2rem);
  text-align: center;
}
.hero-text {
  font-size: clamp(0.8rem, 2.5vw, 1rem);
  line-height: 1.5;
  opacity: 0.9;
  text-align: center;
  width: 100%;          /* was w-75 fixed, now flexible */
  max-width: 700px;     /* still limit on desktop */
  margin: auto;
}
.spaced-text {
  font-size: clamp(0.7rem, 2vw, 0.9rem);
  letter-spacing: 0.25rem;
  text-align: center;
}

/* Glass cards */
.glass-card {
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-radius: 1rem;
  border: 1px solid rgba(255, 255, 255, 0.15);
  padding: 1.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
  text-align: center;
}

/* Mobile adjustments */
@media (max-width: 768px) {
  .row.g-4 {
    flex-direction: column !important;
    gap: 1rem !important;
  }
  .hero-text {
    width: 90% !important;   /* avoid cramping */
  }
  .glass-card {
    padding: 1rem;
  }
}
</style>
