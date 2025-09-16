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
          <!-- College -->
          <div class="col-12 col-md-4 fade-in">
            <div class="requirement-card p-3 p-md-4 h-100 d-flex flex-column text-white border border-light border-opacity-25">
              <h5 class="fw-bold mb-3 text-center">College</h5>
              <ul class="mb-0 check-list">
                <li><strong>Form 138</strong> Senior High School Card (Grade 12 Completer)</li>
                <li><strong>Form 137-A</strong> Permanent Record</li>
                <li><strong>Certification of Good Moral Character</strong></li>
                <li><strong>Birth Certificate (PSA, Original)</strong></li>
                <li>Two (2) 2x2 latest photo</li>
                <li><strong>Medical Requirements</strong></li>
                <li><strong>One (1) long brown envelope</strong></li>
              </ul>
            </div>
          </div>

          <!-- Incoming SHS -->
          <div class="col-12 col-md-4 fade-in">
            <div class="requirement-card p-3 p-md-4 h-100 d-flex flex-column text-white border border-light border-opacity-25">
              <h5 class="fw-bold mb-3 text-center">Incoming SHS</h5>
              <ul class="mb-0 check-list">
                <li>Original and photocopy of <strong>Form 138 (Report Card)</strong></li>
                <li><strong>Form 137-A</strong> Permanent Record</li>
                <li><strong>NCAE Result</strong> (if available)</li>
                <li><strong>LRN</strong></li>
                <li><strong>PPPP</strong></li>
                <li><strong>ESC Certificate</strong> (for students with voucher from Private)</li>
                <li><strong>Birth Certificate (PSA, Original)</strong></li>
                <li><strong>Certificate of Good Moral Character</strong></li>
                <li><strong>Certificate of Junior HS Completion</strong></li>
                <li>1x1 & 2x2 latest photo (1 pc each)</li>
                <li><strong>One (1) long brown envelope</strong></li>
              </ul>
            </div>
          </div>

          <!-- Transferee Students -->
          <div class="col-12 col-md-4 fade-in">
            <div class="requirement-card p-3 p-md-4 h-100 d-flex flex-column text-white border border-light border-opacity-25">
              <h5 class="fw-bold mb-3 text-center">Transferee Students</h5>
              <ul class="mb-0 check-list">
                <li><strong>Transfer Credentials (Honorable Dismissal)</strong> from last school attended</li>
                <li><strong>Transcript of Records (TOR)</strong></li>
                <li><strong>Birth Certificate (PSA, Original)</strong></li>
                <li>Two (2) 2x2 latest photo</li>
                <li><strong>Medical Requirements</strong></li>
                <li><strong>One (1) long brown envelope</strong></li>
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
              📱 0917-115-3965<br>
              📱 0908-873-5231<br>
              ☎️ (045) 435-1495<br>
              ☎️ (045) 961-4447
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="fw-bold">Send us a private message on our official FB page</div>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<style scoped>
/* Fade in/out animation */
.fade-in { opacity: 0; transform: translateY(20px); transition: opacity 0.8s ease, transform 0.8s ease; }
.appear { opacity: 1; transform: translateY(0); }
.disappear { opacity: 0; transform: translateY(20px); }

/* Check-list bullets as checkmarks */
.check-list { list-style: none; padding-left: 0; }
.check-list li::before {
  content: "✔";
  color: #0f0;
  margin-right: 8px;
}

/* Hero styles */
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
    /*background: rgba(0, 0, 0, 0.7);*/
    /* dark overlay */
    /* background: linear-gradient( rgba(20,20,20,0.5),rgba(35, 122, 91,0.7),rgba(20,20,20,0.5));  */
    background: linear-gradient(rgba(0, 0, 0, 1), rgba(2, 46, 30, 0.7), rgba(0, 0, 0, 1));
}

.hero .container {
    position: relative;
    z-index: 1;
}

.text-container { position: relative; z-index: 1; }

.hero h2 { font-family: 'Poppins', sans-serif; font-weight: 700; letter-spacing: 1px; font-size: clamp(1.5rem, 4vw, 2rem); }
.hero-text {  font-weight: 300; font-size: clamp(0.9rem, 2.5vw, 1.2rem); line-height: 1.5; opacity: 0.9; }
.spaced-text { font-size: clamp(0.7rem, 1.5vw, 0.85rem); letter-spacing: 0.5rem; font-family: 'Inter', sans-serif; }

/* Requirement Cards */
.requirement-card { background-color: rgba(0,0,0,0.5); }

/* Mobile adjustments */
@media (max-width: 768px) {
  .hero-text, .spaced-text { width: 90% !important; }
  .p-3, .p-4 { padding: 1.5rem !important; }
  .check-list li { font-size: 0.85rem; }
}

@media (max-width: 576px) {
  .check-list li { font-size: 0.8rem; }
  .requirement-card { padding: 1.25rem 1rem; }
  .spaced-text { letter-spacing: 0.3rem; font-size: 0.7rem; }
}
</style>
