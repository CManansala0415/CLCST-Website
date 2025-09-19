<script setup>
import { onMounted } from 'vue'

onMounted(() => {
  const elements = document.querySelectorAll('.fade-in')

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      const delay = parseFloat(entry.target.dataset.delay) || 0
      entry.target.style.transitionDelay = `${delay}s`
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
    el.dataset.delay = (index * 0.2).toFixed(2) // staggered delay
    observer.observe(el)
  })
})
</script>

<template>
  <section class="hero d-flex flex-column justify-content-center align-items-center text-white text-center">
    <div class="overflow-auto w-100">

      <!-- Hero Heading -->
      <div class="container text-container fade-in mb-4">
        <h3 class="mt-3">Your Journey to a Bright Future Starts Here</h3>
        <p class="hero-text mt-3">
          Submit your requirements to the Office of the Admission. Originals will be verified upon submission.
          Place all documents inside one (1) long brown envelope with your full name and program/strand.
        </p>
        <span class="mt-4 mb-3 spaced-text fw-bold">Requirements</span>
      </div>

      <!-- Requirement Cards -->
      <div class="container mb-5">
        <div class="row g-4">
          <!-- Junior High School Graduate -->
          <div class="col-12 col-md-4 fade-in">
            <div class="requirement-card glass-card p-4 h-100 d-flex flex-column">
              <h5 class="fw-bold mb-4 text-center text-primary">
                🎓 Junior High School Graduate
              </h5>
              <ul class="mb-0 check-list">
                <li>Junior High School Card (Grade 10) F-138A (Original & Photocopy)</li>
                <li>Form 137-A Permanent Record (Original, Copy Valid to CELTECH)</li>
                <li>NCAE Result</li>
                <li>Learning Reference Number (LRN)</li>
                <li>Certificate of Good Moral Character (Original)</li>
                <li>Certificate of Junior High School Completion (Certified Photocopy)</li>
                <li>PSA Birth Certificate (Original)</li>
                <li>1x1 and 2x2 latest photos (1 copy each)</li>
                <li>One (1) long brown envelope</li>
                <li>ESC Certificate (if from Private School)</li>
              </ul>
            </div>
          </div>

          <!-- Senior High School Graduate -->
          <div class="col-12 col-md-4 fade-in">
            <div class="requirement-card glass-card p-4 h-100 d-flex flex-column">
              <h5 class="fw-bold mb-4 text-center text-success">
                🏫 Senior High School Graduate
              </h5>
              <ul class="mb-0 check-list">
                <li>Senior High School Card (Grade 12) F-138A (Original)</li>
                <li>Form 137-A Permanent Record (Original, Copy Valid to CELTECH)</li>
                <li>Certificate of Good Moral Character (Original)</li>
                <li>Senior High School Diploma (Certified Photocopy)</li>
                <li>PSA Birth Certificate (Original)</li>
                <li>Two (2) 2x2 latest photos</li>
                <li>Medical Requirements</li>
                <li>One (1) long brown envelope</li>
              </ul>
            </div>
          </div>

          <!-- Transferee -->
          <div class="col-12 col-md-4 fade-in">
            <div class="requirement-card glass-card p-4 h-100 d-flex flex-column">
              <h5 class="fw-bold mb-4 text-center text-warning">
                🔄 Transferee
              </h5>
              <ul class="mb-0 check-list">
                <li>Honorable Dismissal or Transfer Credentials</li>
                <li>Copy of Grades (if TOR is not yet available)</li>
                <li>Transcript of Records (Original)</li>
                <li>PSA Birth Certificate (Original)</li>
                <li>Two (2) 2x2 latest photos</li>
                <li>Marriage Contract (if Married, Photocopy)</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Contacts -->
      <div class="container mb-5">
        <div class="row text-center text-white g-3 fade-in">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="fw-bold">sf.marketingofficer@clcst.com.ph</div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="fw-bold">
              📱 0933-818-5855<br>
              📱 0917-144-0297<br>
              ☎️ (047) 223-5855<br>
              ☎️ (047) 224-1288
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="fw-bold">Send us a private message on our official FB page</div>
            <a href="https://www.facebook.com/celtechsfp/" target="_blank" rel="noopener noreferrer"
              class="social-link mt-2">
              Visit us on Facebook
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<style scoped>
/* Fade animation */
.fade-in {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.appear {
  opacity: 1;
  transform: translateY(0);
}

.disappear {
  opacity: 0;
  transform: translateY(20px);
}

/* Glass Effect Requirement Cards */
.glass-card {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(12px);
  border-radius: 16px;
  color: #fff;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.glass-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

/* Checklist with modern checkmarks */
.check-list {
  list-style: none;
  padding-left: 0;
}

.check-list li {
  position: relative;
  padding-left: 28px;
  margin-bottom: 12px;
  line-height: 1.5;
  font-size: 0.95rem;
}

.check-list li::before {
  content: "✔";
  position: absolute;
  left: 0;
  top: 0;
  color: #00ffae;
  font-weight: bold;
}

/* Hero */
.hero {
  background: url('/img/clcst.jpg') center center/cover no-repeat;
  min-height: 100vh;
  padding: 2rem 1rem;
  position: relative;
}

.hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(rgba(0, 0, 0, 1), rgba(2, 46, 30, 0.7), rgba(0, 0, 0, 1));
}

.hero .container {
  position: relative;
  z-index: 1;
}

.hero-text {
  font-weight: 300;
  font-size: clamp(0.9rem, 2.5vw, 1.2rem);
  line-height: 1.5;
  opacity: 0.9;
}

.spaced-text {
  font-size: clamp(0.7rem, 1.5vw, 0.85rem);
  letter-spacing: 0.5rem;
  font-family: 'Inter', sans-serif;
}
</style>
