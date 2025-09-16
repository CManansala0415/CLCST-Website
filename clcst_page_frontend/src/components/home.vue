<script setup>
import { ref, onMounted } from 'vue'
import { getDemograph } from '../api';
import Registration from './registration.vue'

const emit = defineEmits(['registerStudent'])
const gender = ref([])
const civilstatus = ref([])
const nationality = ref([])
const region = ref([])
const province = ref([])
const city = ref([])
const barangay = ref([])
const country = ref([])
const registerStudent = ref(false)
const offRegister = ref(true)
onMounted(() => {
  // Trigger animations after page load
  document.querySelectorAll('.fade-in').forEach((el, index) => {
    el.style.animationDelay = `${index * 0.2}s`
    el.classList.add('show')
  })

  getDemograph().then(data => {
    gender.value = data.gender
    civilstatus.value = data.civilstatus
    nationality.value = data.nationality
    region.value = data.region
    province.value = data.province
    city.value = data.city
    barangay.value = data.barangay
    country.value = data.country
    offRegister.value = false

  }).catch(error => {
    offRegister.value = true
    console.error('Error fetching demograph data:', error);
  });

})

const savingOff = ref(false);
const holdModal = (status) => {
  console.log(status)
  savingOff.value = status
}

</script>

<template>
  <!-- Hero Banner -->
  <section class="hero d-flex flex-column justify-content-center align-items-center text-white text-center">
    <div class="container mt-5 pt-5 d-flex flex-column justify-content-center align-items-center">
      <span class="spaced-text fade-in">CENTRAL LUZON COLLEGE OF SCIENCE AND TECHNOLOGY</span>
      <h1 class="display-4 mt-4 fade-in">We Are the Future</h1>

      <div class="d-flex justify-content-center align-items-center gap-2 w-100 flex-wrap">
        <div class="col-6 col-md-auto text-center text-white small-font fade-in">We Teach</div>
        <div class="col-6 col-md-auto text-center text-white small-font fade-in">We Train</div>
        <div class="col-6 col-md-auto text-center text-white small-font fade-in">We Touch</div>
        <div class="col-6 col-md-auto text-center text-white small-font fade-in">We Transform</div>
      </div>

      <div class="d-flex justify-content-center align-content-center mt-5 mb-5 gap-2 fade-in">
        <button v-if="!offRegister" class="btn btn-success me-2 px-4 py-2" @click="emit('registerStudent', true), registerStudent = true" data-bs-toggle="modal" data-bs-target="#registrationModal">Register Now</button>
        <button v-if="offRegister" class="btn btn-success me-2 px-4 py-2 wait" disabled>Registration Coming Soon!</button>
      </div>
    </div>

    <div class="container mt-3 pt-5 d-flex flex-column justify-content-center align-items-center">
      <div class="d-flex justify-content-center align-items-start gap-2 w-100 my-4 flex-wrap">
        <div class="w-25 flex-fill text-center text-white small-font fade-in p-2">
          "The facilities are great, especially the hotel simulation rooms." 
          <br/>
          – <span class="fw-bold">Karen M., HM Student</span>
        </div>
        <div class="w-25 flex-fill text-center text-white small-font border-start border-end fade-in p-2">
          "Celtech helped me become a seafarer! Thank you to all the supportive instructors." 
          <br/>
          – <span class="fw-bold">John R., BS Marine Grad</span>
        </div>
        <div class="w-25 flex-fill text-center text-white small-font fade-in p-2">
          "I passed my NC II with flying colors thanks to CELTECH's TESDA courses!" 
          <br/>
          – <span class="fw-bold">Roland D., Caregiving Grad</span>
        </div>
      </div>
    </div>

    <!-- Modal -->
      <div class="modal fade" id="registrationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="registrationModalLabel">Registration Form</h1>
              <button v-show="!savingOff" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="registerStudent = false"></button>
            </div>
            <div class="modal-body">
              <Registration v-if="registerStudent" :genderData="gender" :civilstatusData="civilstatus"
                        :nationalityData="nationality" :regionData="region" :provinceData="province" :cityData="city"
                        :barangayData="barangay" :countryData="country" @registeringStudent="holdModal"/>
            </div>
            <div class="modal-footer">
              <button v-show="!savingOff" type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="registerStudent = false">Close</button>
              <!-- <button type="button" class="btn btn-primary">Understood</button> -->
            </div>
          </div>
        </div>
      </div>
    
  </section>
</template>

<style scoped>


.hero {
  background: url('/img/banner.png') center center/cover no-repeat;
  height: 100vh;
  padding: 2rem;
  position: relative;
}

.hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 1));
}

.hero .container {
  position: relative;
  z-index: 1;
}

.spaced-text {
  font-size: 0.7rem;
  letter-spacing: 0.6rem;
  font-family: 'Inter', sans-serif;
}

/* ===== Animations ===== */
.fade-in {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.fade-in.show {
  opacity: 1;
  transform: translateY(0);
}
</style>
