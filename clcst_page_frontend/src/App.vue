<script setup>
import { onMounted, computed, nextTick, watch, ref } from 'vue'
import { useRoute } from 'vue-router'
import Home from './components/home.vue'
import Courses from './components/courses.vue'
import About from './components/about.vue'
import Facility from './components/facility.vue'
import Contact from './components/contact.vue'
import Registration from './components/registration.vue'

const route = useRoute()
const path = computed(() => route.path)

// Smooth scroll to section matching the route
const scrollToSection = (selector) => {
  if (!selector || typeof selector !== 'string' || !selector.startsWith('.')) {
    console.error('scrollToSection: invalid selector', selector)
    return
  }

  const section = document.querySelector(selector)
  if (section) {
    section.scrollIntoView({ behavior: 'smooth', block: 'start' })
  } else {
    console.error('scrollToSection: section not found', selector)
  }
}

onMounted(() => {
  nextTick(() => {
    // fade-in effect for all .fade-in elements
    const els = document.querySelectorAll('.fade-in')
    els.forEach((el, idx) => {
      el.classList.remove('show')
      setTimeout(() => el.classList.add('show'), idx * 120)
    })

    // scroll to the correct section on first load
    const sectionClass = route.path.replace('/', '')
    if (sectionClass) {
      scrollToSection(`.${sectionClass}`)
    } else {
      scrollToSection('.home')
    }
  })
})


const registerNow =ref(false)

const register = (want) => {
  // registerNow.value = want
}

// (Optional) If you also want to scroll when the route changes:
watch(() => route.path, (newPath) => {
  const sectionClass = newPath.replace('/', '')
  if (sectionClass) {
    scrollToSection(`.${sectionClass}`)
  } else {
    scrollToSection('.home')
  }
})
</script>


<template>
  <div class="position-relative">

    <!-- Sections -->
    <div class="d-flex flex-column align-items-center justify-content-center">
      <div class="vh-100 bg-success w-100 home">
        <Home @registerStudent="register"/>
      </div>
      <div class="vh-100 nav-green w-100 about">
        <About />
      </div>
      <div class="vh-100 nav-green w-100 courses">
        <Courses />
      </div>
      <div class="vh-100 nav-green w-100 facility">
        <Facility />
      </div>
      <div class="vh-100 nav-green w-100 contact">
        <Contact />
      </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark p-1 shadow-sm shadow-black position-absolute w-100 nav-top nav-green">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="/img/clcst_logo.png" class="rounded-circle shadow p-1" height="50" width="50" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a href="#" @click.prevent="scrollToSection('.home')" class="nav-link px-3">Home</a>
            </li>
            <li class="nav-item">
              <a href="#" @click.prevent="scrollToSection('.about')" class="nav-link px-3">About Us</a>
            </li>
            <li class="nav-item">
              <a href="#" @click.prevent="scrollToSection('.courses')" class="nav-link px-3">Courses</a>
            </li>
            <li class="nav-item">
              <a href="#" @click.prevent="scrollToSection('.contact')" class="nav-link px-3">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  </div>
</template>

<style>
/* Navbar fixed on top with higher z-index */
.nav-top {
  top: 0;
  left: 0;
  z-index: 1050;
  /* higher than sections */
}

/* initial state for fade-in elements */
.fade-in {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 600ms cubic-bezier(.2, .9, .2, 1), transform 600ms cubic-bezier(.2, .9, .2, 1);
  will-change: opacity, transform;
}

.fade-in.show {
  opacity: 1;
  transform: translateY(0);
}

/* Sections can have different bg for testing */
.home {
  background-color: #237a5b;
}

.about {
  background-color: #237a5b;
}

.courses {
  background-color: #237a5b;
}

.facility {
  background-color: #237a5b;
}

.contact {
  background-color: #237a5b;
}

/* Mobile adjustments */
@media (max-width: 768px) {
  .nav-top {
    z-index: 1;
  }
}

/* Mobile navbar fix */
@media (max-width: 768px) {
  .navbar-collapse {
    transition: max-height 0.4s ease, opacity 0.4s ease;
    /* background: linear-gradient(rgba(0,0,0,0), rgba(12, 61, 44,0.9)); */
    width: 100%;
    padding: 1rem;
    z-index: 1;
  }

  .navbar-nav {
    flex-direction: column; /* stack links vertically */
    align-items: flex-start;
  }

  .navbar-nav .nav-link {
    padding: 0.5rem 1rem;
    font-size: 1.1rem;
    letter-spacing: normal; /* reset any large spacing from hero */
  }
}
</style>
