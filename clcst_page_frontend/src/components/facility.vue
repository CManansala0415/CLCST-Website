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
  }, { threshold: 0.1 })
  
  elements.forEach((el, index) => {
    el.style.animationDelay = `${index * 0.3}s`
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
          <h3 class="mt-3">Campus & Facilities</h3>
          <p class="w-75 mt-3 hero-text">We are located at CBMU Road / Rizal Avenue, Upper Kalaklan, Olongapo City and B.Mendoza St. City of San Fernando Pampanga.</p>
          <p class="w-75 mt-1 hero-text">Features fully air-conditioned classrooms, computer and maritime labs, a mini-hospital, mini-hotel, school library, cafeteria, automotive workshop, crime lab, auditorium, and more.</p>
          <span class="spaced-text fw-bold">Accreditation & Recognition</span>
        </div>

        <!-- Programs List -->
        <div class="container mt-2 position-relative">
          <div class="row g-4">
              <div class="col-12 col-md-4 fade-in" v-for="n in 3" :key="n">
                <div class="glass-card p-3 rounded h-100 d-flex flex-column justify-content-center align-items-center text-white">
                  <span class="opacity-75">
                    {{ n === 1 ? "100% STCW 95/CHED/IMO compliance for maritime programs" : n === 2 ? "First ISO 9001-certified school (since 1999)" : "High passing rates in TESDA and professional board exams (Marine Eng’g, Crim, Customs, etc.)" }}
                  </span>
                </div>
              </div>
          </div>
        </div>

        <div class="container d-flex flex-column justify-content-center align-items-center position-relative mt-2 p-2 rounded-4 fade-in">
          <p class="mt-2 spaced-text fw-bold">Community & Connections</p>
          <p class="w-75 mt-1 hero-text">Supports local workforce needs in Olongapo and nearby Clark/Subic economic zones. Active partnerships in private and public sectors for OJT, internships, and job placement.</p>
        </div>
    </div>
  </section>
</template>

<style scoped>
/* Fade in/out animation */
.fade-in { opacity: 0; transition: opacity 0.8s ease; }
.appear { opacity: 1; }
.disappear { opacity: 0; }

/* Hero Section */
.hero { height: 100vh; position: relative; overflow: hidden; }
.hero-slide { height: 100vh; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; }
.hero::after { content: ""; position: absolute; inset: 0; background: linear-gradient(rgba(0,0,0,1), rgba(0,0,0,0.5), rgba(0,0,0,1)); z-index: 1; }
.hero .container { position: relative; z-index: 2; }

/* Glass cards (no hover animation) */
.glass-card {
  position: relative;
  background: rgba(255, 255, 255, 0.1) !important;
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-radius: 1rem;
  color: #fff;
  overflow: hidden;
}

/* Glow border */
.glow-border { border: 2px solid #8fe4c6; box-shadow: 0 0 px #32ab80, 0 0 3px #32ab80, 0 0 0px #32ab80; }

/* Responsive text */
.hero h3 { font-size: clamp(1.5rem, 2vw + 0.5rem, 2.5rem); }
.hero-text { font-size: clamp(12px, 0.9vw + 0.3rem, 16px); letter-spacing: 0.2rem; line-height: 1.8; opacity: 0.9; }

/* Mobile adjustments */
@media (max-width: 768px) {
  .hero-text, .spaced-text { width: 90% !important; }
  .glass-card { padding: 2rem 1.5rem; }
}
</style>
