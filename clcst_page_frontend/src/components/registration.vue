<script setup>
import { ref, onMounted, computed } from 'vue';
import { addApplicant } from '../api';

const props = defineProps({
  genderData: {
  },
  civilstatusData: {
  },
  nationalityData: {
  },
  regionData: {
  },
  provinceData: {
  },
  cityData: {
  },
  barangayData: {
  },
  countryData: {
  },
})

const gender = computed(() => {
  return props.genderData
});
const civilstatus = computed(() => {
  return props.civilstatusData
});
const nationality = computed(() => {
  return props.nationalityData
});
const country = computed(() => {
  return props.countryData
});
const region = computed(() => {
  return props.regionData
});
const province = computed(() => {
  return props.provinceData
});
const city = computed(() => {
  return props.cityData
});
const barangay = computed(() => {
  return props.barangayData
});


const age = ref(0)
const yearToday = ref(0)
const saving = ref(false);
const checking = ref(false);
const forUpdate = ref(false)

const filteredBirthCountry = ref([])
const filteredBirthProvince = ref([])
const filteredBirthCity = ref([])

const filteredCurrRegion = ref([])
const filteredCurrProvince = ref([])
const filteredCurrCity = ref([])
const filteredCurrBarangay = ref([])
const filteredCurrZipcode = ref([])

const filteredPermRegion = ref([])
const filteredPermProvince = ref([])
const filteredPermCity = ref([])
const filteredPermBarangay = ref([])
const filteredPermZipcode = ref([])

const sameAddress = ref(false);
const guardianTick = ref(0)
const registrationMode = 'website'
const emit = defineEmits(['registeringStudent'])

// const personal = ref({
//   per_firstname: 'Carl Menard',
//   per_middlename: 'Dianito',
//   per_lastname: 'Manansala',
//   per_suffixname: '',
//   per_gender: 1,
//   per_contact: '9918592816',
//   per_email: 'manansalacarlm@gmail.com',
//   per_birthday: '1998-02-15',
//   per_birth_country: 163,
//   per_birth_province: 354,
//   per_birth_city: 13314,
//   per_birth_zipcode: 2000,
//   per_civilstatus: 2,
//   per_nationality: 76,

//   per_curr_home: '393 SALAPUNGAN ST.',
//   per_curr_region: 3,
//   per_curr_province: 163,
//   per_curr_city: 354,
//   per_curr_barangay: 13314,
//   per_curr_zipcode: 2000,
//   per_perm_home: '393 SALAPUNGAN ST.',
//   per_perm_region: 3,
//   per_perm_province: 163,
//   per_perm_city: 354,
//   per_perm_barangay: 13314,
//   per_perm_zipcode: 2000,
// })

// const familyMembers = ref(
//   [
//     {
//       fam_firstname: 'May',
//       fam_middlename: 'Robiato',
//       fam_lastname: 'Dianito',
//       fam_suffixname: '',
//       fam_relationship: 'Mother',
//       fam_contact: '9918592816',
//       fam_email: 'may123@gmail.com',
//       fam_guardian: 1,
//     },
//     {
//       fam_firstname: 'Vener',
//       fam_middlename: 'Guevarra',
//       fam_lastname: 'Manansala',
//       fam_suffixname: '',
//       fam_relationship: 'Father',
//       fam_contact: '9918592816',
//       fam_email: 'vener123@gmail.com',
//       fam_guardian: 0,
//     }
//   ]
// );

// const awardList = ref([
//   {
//     awr_desc: 'Best in Math',
//     awr_year: '2015',
//   },
//   {
//     awr_desc: 'Best in Science',
//     awr_year: '2016',
//   }
// ]);

// const attainmentList = ref([
//   {
//     pered_school: 'CLCST',
//     pered_from: '2016',
//     pered_to: '2020',
//   },
//   {
//     pered_school: 'CLCST',
//     pered_from: '2012',
//     pered_to: '2016',
//   }
// ]);

const personal = ref({
  per_firstname: '',
  per_middlename: '',
  per_lastname: '',
  per_suffixname: '',
  per_gender: '',
  per_contact: '',
  per_email: '',
  per_birthday: '',
  per_birth_country: 0,
  per_birth_province: 0,
  per_birth_city: 0,
  per_birth_zipcode: 0,
  per_civilstatus: '',
  per_nationality: '',

  per_curr_home: '',
  per_curr_region: '',
  per_curr_province: '',
  per_curr_city: '',
  per_curr_barangay: '',
  per_curr_zipcode: '',
  per_perm_home: '',
  per_perm_region: '',
  per_perm_province: '',
  per_perm_city: '',
  per_perm_barangay: '',
  per_perm_zipcode: '',
})

const familyMembers = ref([]);
const awardList = ref([]);
const attainmentList = ref([]);


const famMembersInfo = ref({
  fam_firstname: '',
  fam_middlename: '',
  fam_lastname: '',
  fam_suffixname: '',
  fam_relationship: '',
  fam_contact: '',
  fam_email: '',
})

const awardInfo = ref({
  awr_desc: '',
  awr_year: '',
})

const attainmentInfo = ref({
  pered_school: '',
  pered_from: '',
  pered_to: '',
})

const updateAddress = (type, code) => {
  switch (type) {

    case 'birth-city':
      filteredBirthCity.value = city.value
      filteredBirthCity.value = city.value.filter(e => {
        if (e.provCode == code) {
          return e
        }
      })
      break;

    case 'current-province':
      personal.value.per_curr_city = ''
      personal.value.per_curr_barangay = ''
      filteredCurrCity.value = []
      filteredCurrBarangay.value = []
      filteredCurrProvince.value = province.value
      filteredCurrProvince.value = province.value.filter(e => {
        if (e.regCode == code) {
          return e
        }
      })
      break;

    case 'current-city':
      personal.value.per_curr_barangay = ''
      filteredCurrCity.value = city.value
      filteredCurrCity.value = city.value.filter(e => {
        if (e.provCode == code) {
          return e
        }
      })
      break;

    case 'current-barangay':
      filteredCurrBarangay.value = barangay.value
      filteredCurrBarangay.value = barangay.value.filter(e => {
        if (e.citymunCode == code) {
          return e
        }
      })
      break;

    case 'permanent-province':
      personal.value.per_perm_city = ''
      personal.value.per_perm_barangay = ''
      filteredPermCity.value = []
      filteredPermBarangay.value = []
      filteredPermProvince.value = province.value
      filteredPermProvince.value = province.value.filter(e => {
        if (e.regCode == code) {
          return e
        }
      })
      break;

    case 'permanent-city':
      personal.value.per_perm_barangay = ''
      filteredPermCity.value = city.value
      filteredPermCity.value = city.value.filter(e => {
        if (e.provCode == code) {
          return e
        }
      })
      break;

    case 'permanent-barangay':
      filteredPermBarangay.value = barangay.value
      filteredPermBarangay.value = barangay.value.filter(e => {
        if (e.citymunCode == code) {
          return e
        }
      })
      break;


  }
}

const copyAddress = () => {
  if (sameAddress.value) {

    updateAddress('permanent-province', personal.value.per_curr_region)
    updateAddress('permanent-city', personal.value.per_curr_province)
    updateAddress('permanent-barangay', personal.value.per_curr_city)

    personal.value.per_perm_home = personal.value.per_curr_home
    personal.value.per_perm_region = personal.value.per_curr_region
    personal.value.per_perm_province = personal.value.per_curr_province
    personal.value.per_perm_city = personal.value.per_curr_city
    personal.value.per_perm_barangay = personal.value.per_curr_barangay
    personal.value.per_perm_zipcode = personal.value.per_curr_zipcode

  } else {
    filteredPermProvince.value = []
    filteredPermCity.value = []
    filteredPermBarangay.value = []
    personal.value.per_perm_home = ''
    personal.value.per_perm_region = ''
    personal.value.per_perm_province = ''
    personal.value.per_perm_city = ''
    personal.value.per_perm_barangay = ''
    personal.value.per_perm_zipcode = ''
  }

}

// Function to ensure a guardian is always selected
const ensureGuardian = () => {
  // If the current guardian index is invalid, select the first one
  if (guardianTick.value >= familyMembers.value.length) {
    guardianTick.value = familyMembers.value.length ? 0 : null;
  }
  // Update the fam_guardian property for each member
  familyMembers.value.forEach((f, i) => f.fam_guardian = i === guardianTick.value);
}

// Add / Remove Family Members
const addFamMembers = (type, data, index) => {
  if (type === 'add') {
    const convert = { ...data };

    // Check required fields
    if (!convert.fam_firstname || !convert.fam_lastname || !convert.fam_relationship || !convert.fam_contact) {
      Swal.fire({
        title: "Requirements",
        text: "Please fill out all required fields for a family member",
        icon: "question"
      });
      return;
    }

    // Add new member
    familyMembers.value.push(convert);

    // Reset input form
    famMembersInfo.value = {
      fam_firstname: '',
      fam_middlename: '',
      fam_lastname: '',
      fam_suffixname: '',
      fam_relationship: '',
      fam_contact: '',
      fam_email: '',
    };

    // If there was no guardian before, set the first member as guardian
    ensureGuardian();
  }

  if (type === 'remove') {
    // Remove the member
    familyMembers.value.splice(index, 1);

    // If the removed member was the guardian, pick first member as guardian
    if (guardianTick.value === index) {
      guardianTick.value = familyMembers.value.length ? 0 : null;
    } else if (guardianTick.value > index) {
      // Adjust guardianTick if needed
      guardianTick.value -= 1;
    }

    // Update guardian status
    familyMembers.value.forEach((f, i) => f.fam_guardian = i === guardianTick.value);
  }
}


const addAwards = (type, data, index) => {
  if (type == 'add') {
    let convert = { ...data }
    if (
      (!convert.awr_desc) ||
      (!convert.awr_year)
    ) {
      // alert('Please fillout fields for the award')
      Swal.fire({
        title: "Requirements",
        text: "Please fillout fields for the award",
        icon: "question"
      })
    } else {
      awardList.value.push(convert)
      awardInfo.value = {
        awr_desc: '',
        awr_year: '',
      }
    }

  }
  if (type == 'remove') {
    awardList.value.splice(index, 1)
  }
}

const addAttainment = (type, data, index) => {
  if (type == 'add') {
    let convert = { ...data }
    if (
      (!convert.pered_school) ||
      (!convert.pered_from) ||
      (!convert.pered_to)
    ) {
      // alert('Please fillout fields for educational background')
      Swal.fire({
        title: "Requirements",
        text: "Please fillout fields for educational background",
        icon: "question"
      })
    } else {
      attainmentList.value.push(convert)
      attainmentInfo.value = {
        pered_school: '',
        pered_from: '',
        pered_to: '',
      }
    }
  }
  if (type == 'remove') {
    attainmentList.value.splice(index, 1)
  }
}


const booter = async () => {
  let results = personal.value
  if (results) {
    updateAddress('birth-city', results.per_birth_province)
    updateAddress('current-province', results.per_curr_region)
    updateAddress('current-city', results.per_curr_province)
    updateAddress('current-barangay', results.per_curr_city)
    updateAddress('permanent-province', results.per_perm_region)
    updateAddress('permanent-city', results.per_perm_province)
    updateAddress('permanent-barangay', results.per_perm_city)
    personal.value = results
  }
}




onMounted(async () => {
  filteredBirthCountry.value = country.value
  filteredBirthProvince.value = province.value
  filteredBirthCity.value = city.value

  filteredCurrRegion.value = region.value
  filteredPermRegion.value = region.value

  await booter().then((results) => {
    console.log('Booted')
  })

})

const registerApplicant = async () => {
  emit('registeringStudent', true)
  

  let pers = {
    ...personal.value,
    per_user: 0,
    per_regtype: 2
  }

  let fam = JSON.parse(JSON.stringify(familyMembers.value))
  let awr = JSON.parse(JSON.stringify(awardList.value))
  let att = JSON.parse(JSON.stringify(attainmentList.value))

  let data = {
    personal: pers,
    family: fam,
    awards: awr,
    attainment: att,
  }

  let message = "";

  if (Object.keys(fam).length === 0) {
    message = "Please add at least one family member";
  } else if (Object.keys(att).length === 0) {
    message = "Please add at least one educational attainment";
  }

  if (message) {
    Swal.fire({
      title: "Requirements",
      text: message,
      icon: "question"
    });
    return;
  }

  // If all conditions are met, proceed to add applicant
  saving.value = true;
  addApplicant(data)
    .then((results) => {
      Swal.fire({
        title: "Registration Successful",
        text: "Thank you for registering. We will contact you soon.",
        icon: "success",
        // showCancelButton: true,          // adds a "Cancel" button
        confirmButtonText: "Ok, Got it", // text for confirm button
      }).then((result) => {
        if (result.isConfirmed) {
          // User clicked "Reload Page"
          location.reload();
        } else {
          // User clicked "Stay Here"
          console.log("User chose not to reload.");
        }
      });
    })
    .catch((err) => {
      // console.error('Error during registration:', err);
      Swal.fire({
          title: "Registration Failed",
          text: "An error occurred during registration. Please try again later.",
          icon: "error",
          // showCancelButton: true,            // optional: let user cancel
          confirmButtonText: "Reload Page",
          // cancelButtonText: "Stay Here"
      }).then((result) => {
          if (result.isConfirmed) {
              location.reload(); // reload only if user confirms
          } else {
              console.log("User chose not to reload.");
          }
      });

    });


}




</script>
<template>
  <div v-if="saving" class="d-flex flex-column justify-content-center align-items-center" style="height: 300px;">
    <div class="loader mb-5"></div>
    Registering Now Please Wait...
  </div>
  <form v-else method="post" @submit.prevent="registerApplicant()" class="small-font">

    <!-- Personal Information -->
    <div class="card mb-3">
      <div class="card-header bg-dark text-white fw-bold">Personal Information</div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-12 col-md-4">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" v-model="personal.per_firstname" required
              :disabled="saving">
          </div>
          <div class="col-12 col-md-4">
            <label for="middlename" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middlename" v-model="personal.per_middlename"
              :disabled="saving">
          </div>
          <div class="col-12 col-md-4">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" v-model="personal.per_lastname" required
              :disabled="saving">
          </div>
        </div>
        <div class="row g-2 mt-2">
          <div class="col-12 col-md-3">
            <label for="suffixname" class="form-label">Suffix Name</label>
            <input type="text" class="form-control" id="suffixname" v-model="personal.per_suffixname" maxlength="3"
              :disabled="saving">
          </div>
          <div class="col-12 col-md-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" v-model="personal.per_gender" required :disabled="saving">
              <option v-for="gen in gender" :value="gen.gen_id">{{ gen.gen_desc }}</option>
            </select>
          </div>
          <div class="col-12 col-md-3">
            <label for="civilstatus" class="form-label">Civil Status</label>
            <select class="form-select" id="civilstatus" v-model="personal.per_civilstatus" required :disabled="saving">
              <option v-for="cs in civilstatus" :value="cs.cv_id">{{ cs.cv_desc }}</option>
            </select>
          </div>
          <div class="col-12 col-md-3">
            <label for="nationality" class="form-label">Nationality</label>
            <select class="form-select" id="nationality" v-model="personal.per_nationality" required :disabled="saving">
              <option v-for="nat in nationality" :value="nat.nat_id">{{ nat.nat_desc }}</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Information -->
    <div class="card mb-3">
      <div class="card-header bg-dark text-white fw-bold">Contact Information</div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-12 col-md-6">
            <label for="cellphone" class="form-label">Cellphone No.</label>
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1">+639</span>
              <input type="text" class="form-control" id="cellphone" v-model="personal.per_contact" minlength="9"
                maxlength="9" required :disabled="saving"
                @input="personal.per_contact = personal.per_contact.replace(/\D/g, '').slice(0, 9)">
            </div>
          </div>

          <div class="col-12 col-md-6">
            <label for="peremail" class="form-label">Email</label>
            <input type="email" class="form-control" id="peremail" v-model="personal.per_email" required
              :disabled="saving">
          </div>
        </div>
      </div>
    </div>

    <!-- Birth Information -->
    <div class="card mb-3">
      <div class="card-header bg-dark text-white fw-bold">Birth Information</div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-12 col-md-6">
            <label for="bday" class="form-label">Birthday</label>
            <input type="date" class="form-control" id="bday" v-model="personal.per_birthday" required
              :disabled="saving">
          </div>
          <div class="col-12 col-md-6">
            <label for="birthcountry" class="form-label">Birth Country</label>
            <select class="form-select" id="birthcountry" v-model="personal.per_birth_country"
              @change="personal.per_birth_province = 0; personal.per_birth_city = 0" required :disabled="saving">
              <option>- Select Here -</option>
              <option v-for="country in filteredBirthCountry" :value="country.countryID">{{ country.name }}</option>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label for="birthprovince" class="form-label">Birth Province</label>
            <select class="form-select" id="birthprovince" v-model="personal.per_birth_province"
              @change="updateAddress('birth-city', personal.per_birth_province)"
              :disabled="personal.per_birth_country != 163 || saving">
              <option>- Select Here -</option>
              <option v-for="prov in filteredBirthProvince" :value="prov.provCode">{{ prov.provDesc }}</option>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label for="birthcity" class="form-label">Birth City</label>
            <select class="form-select" id="birthcity" v-model="personal.per_birth_city"
              :disabled="((personal.per_birth_province || saving) && personal.per_birth_country == 163) ? false : true">
              <option>- Select Here -</option>
              <option v-for="ct in filteredBirthCity" :value="ct.citymunCode">{{ ct.citymunDesc }}</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Present Address -->
    <div class="card mb-3">
      <div class="card-header bg-dark text-white fw-bold">Present Address</div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-12 col-md-6">
            <label for="presenthome" class="form-label">Address</label>
            <input type="text" class="form-control" v-model="personal.per_curr_home">
          </div>
          <div class="col-12 col-md-6">
            <label for="presentregion" class="form-label">Region</label>
            <select class="form-select" v-model="personal.per_curr_region"
              @change="updateAddress('current-province', personal.per_curr_region)" required :disabled="saving">
              <option>- Select Here -</option>
              <option v-for="reg in filteredCurrRegion" :value="reg.regCode">{{ reg.regDesc }}</option>
            </select>
          </div>
        </div>

        <div class="row g-2 mt-2">
          <div class="col-12 col-md-4">
            <label for="presentprovince" class="form-label">Province</label>
            <select class="form-select" v-model="personal.per_curr_province"
              @change="updateAddress('current-city', personal.per_curr_province)" required :disabled="saving">
              <option>- Select Here -</option>
              <option v-for="prov in filteredCurrProvince" :value="prov.provCode">{{ prov.provDesc }}</option>
            </select>
          </div>
          <div class="col-12 col-md-4">
            <label for="presentcity" class="form-label">City</label>
            <select class="form-select" v-model="personal.per_curr_city"
              @change="updateAddress('current-barangay', personal.per_curr_city)" required :disabled="saving">
              <option>- Select Here -</option>
              <option v-for="ct in filteredCurrCity" :value="ct.citymunCode">{{ ct.citymunDesc }}</option>
            </select>
          </div>
          <div class="col-12 col-md-4">
            <label class="form-label">Barangay</label>
            <select class="form-control" id="preentbarangay" v-model="personal.per_curr_barangay"
              :disabled="personal.per_curr_city || saving ? false : true" required>
              <option>- Select Here -</option>
              <option v-for="(brgy, index) in filteredCurrBarangay" :value="brgy.brgyCode">
                {{ brgy.brgyDesc }}
              </option>
            </select>
          </div>
          <div class="col-12 col-md-4">
            <label for="presentzipcode" class="form-label">Zip Code</label>
            <input type="text" class="form-control" v-model="personal.per_curr_zipcode" :disabled="saving">
          </div>
        </div>

        <div class="d-flex justify-content-center">
          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="sameas" v-model="sameAddress" @change="copyAddress()"
              :disabled="saving">
            <label class="form-check-label" for="sameas">Permanent Address same as Present</label>
          </div>
        </div>
      </div>
    </div>

    <!-- Permanent Address -->
    <div class="card mb-3">
      <div class="card-header bg-dark text-white fw-bold">Permanent Address</div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-12 col-md-6">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" v-model="personal.per_perm_home" :disabled="saving">
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">Region</label>
            <select class="form-select" v-model="personal.per_perm_region"
              @change="updateAddress('permanent-province', personal.per_perm_region)" :disabled="saving">
              <option>- Select Here -</option>
              <option v-for="reg in filteredPermRegion" :value="reg.regCode">{{ reg.regDesc }}</option>
            </select>
          </div>
        </div>

        <div class="row g-2 mt-2">
          <div class="col-12 col-md-4">
            <label class="form-label">Province</label>
            <select class="form-select" v-model="personal.per_perm_province"
              @change="updateAddress('permanent-city', personal.per_perm_province)" :disabled="saving">
              <option>- Select Here -</option>
              <option v-for="prov in filteredPermProvince" :value="prov.provCode">{{ prov.provDesc }}</option>
            </select>
          </div>
          <div class="col-12 col-md-4">
            <label class="form-label">City</label>
            <select class="form-select" v-model="personal.per_perm_city"
              @change="updateAddress('permanent-barangay', personal.per_perm_city)" :disabled="saving">
              <option>- Select Here -</option>
              <option v-for="ct in filteredPermCity" :value="ct.citymunCode">{{ ct.citymunDesc }}</option>
            </select>
          </div>
          <div class="col-12 col-md-4">
            <label class="form-label">Barangay</label>
            <select class="form-control" id="preentbarangay" v-model="personal.per_perm_barangay"
              :disabled="personal.per_perm_city || saving ? false : true" required>
              <option>- Select Here -</option>
              <option v-for="(brgy, index) in filteredPermBarangay" :value="brgy.brgyCode">
                {{ brgy.brgyDesc }}
              </option>
            </select>
          </div>
          <div class="col-12 col-md-4">
            <label class="form-label">Zip Code</label>
            <input type="text" class="form-control" v-model="personal.per_perm_zipcode" :disabled="saving">
          </div>
        </div>
      </div>
    </div>

    <!-- Educational Background -->
    <div class="card mb-3">
      <div class="card-header bg-dark text-white fw-bold">Educational Background</div>
      <div class="card-body">
        <div class="row g-3 d-flex">
          <!-- Left: Add Form (30%) -->
          <div class="col-12 col-md-4 d-flex flex-column" id="award-form">
            <h6>Add Education</h6>
            <div class="mb-2">
              <label class="form-label">School</label>
              <input type="text" class="form-control" v-model="attainmentInfo.pered_school" :disabled="saving">
            </div>
            <div class="mb-2">
              <label class="form-label">Year From</label>
              <input type="text" class="form-control" v-model="attainmentInfo.pered_from" min="1999" max="9999"
                maxlength="4" minlength="4" :disabled="saving"
                @input="attainmentInfo.pered_from = attainmentInfo.pered_from.replace(/\D/g, '').slice(0, 9)">
            </div>
            <div class="mb-2">
              <label class="form-label">Year To</label>
              <input type="text" class="form-control" v-model="attainmentInfo.pered_to" min="1999" max="9999"
                maxlength="4" minlength="4" :disabled="saving"
                @input="attainmentInfo.pered_to = attainmentInfo.pered_to.replace(/\D/g, '').slice(0, 9)">
            </div>
            <button @click="addAttainment('add', attainmentInfo)" type="button"
              class="btn btn-sm btn-primary w-100 mt-auto" :disabled="saving">Add Education</button>
          </div>

          <!-- Right: Table (70%) -->
          <div class="col-12 col-md-8 d-flex flex-column">
            <div class="table-responsive flex-grow-1" style="height:100%;">
              <table class="table table-bordered text-uppercase h-100">
                <thead class="table-dark">
                  <tr>
                    <th>School</th>
                    <th>From</th>
                    <th>To</th>
                    <th width="100px">Command</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="align-middle" v-for="(attain, index) in attainmentList" :key="index">
                    <td>{{ attain.pered_school }}</td>
                    <td>{{ attain.pered_from }}</td>
                    <td>{{ attain.pered_to }}</td>
                    <td>
                      <button @click="addAttainment('remove', attain, index)" type="button"
                        class="btn btn-sm btn-danger" :disabled="saving">Remove</button>
                    </td>
                  </tr>
                  <tr v-if="!attainmentList.length">
                    <td colspan="4">Empty List</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Family Background -->
    <div class="card mb-3">
      <div class="card-header bg-dark text-white fw-bold">Family Background</div>
      <div class="card-body">
        <div class="row g-3 d-flex">
          <!-- Left: Add Form (30%) -->
          <div class="col-12 col-md-4 d-flex flex-column" id="fam-form">
            <h6>Add Family Member</h6>
            <div class="mb-2">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control" v-model="famMembersInfo.fam_firstname" :disabled="saving">
            </div>
            <div class="mb-2">
              <label class="form-label">Middle Name</label>
              <input type="text" class="form-control" v-model="famMembersInfo.fam_middlename" :disabled="saving">
            </div>
            <div class="mb-2">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control" v-model="famMembersInfo.fam_lastname" :disabled="saving">
            </div>
            <div class="mb-2">
              <label class="form-label">Suffix Name</label>
              <input type="text" class="form-control" v-model="famMembersInfo.fam_suffixname" :disabled="saving">
            </div>
            <div class="mb-2">
              <label class="form-label">Relationship</label>
              <input type="text" class="form-control" v-model="famMembersInfo.fam_relationship" :disabled="saving">
            </div>
            <div class="mb-2">
              <label for="cellphone" class="form-label">Cellphone No.</label>
              <div class="input-group">
                <span class="input-group-text">+639</span>
                <input type="text" class="form-control" v-model="famMembersInfo.fam_contact" maxlength="9"
                  @input="famMembersInfo.fam_contact = famMembersInfo.fam_contact.replace(/\D/g, '').slice(0, 9)"
                  :disabled="saving">
              </div>
            </div>
            <div class="mb-2">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" v-model="famMembersInfo.fam_email" :disabled="saving">
            </div>
            <button @click="addFamMembers('add', famMembersInfo)" type="button"
              class="btn btn-sm btn-primary w-100 mt-auto" :disabled="saving">Add Member</button>
          </div>

          <!-- Right: Table (70%) -->
          <div class="col-12 col-md-8 d-flex flex-column">
            <div class="table-responsive flex-grow-1">
              <table class="table table-bordered text-uppercase">
                <thead class="table-dark">
                  <tr>
                    <th>Name</th>
                    <th>Relationship</th>
                    <th>Contact #</th>
                    <th>Email</th>
                    <th>Guardian</th>
                    <th width="100px">Command</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(fam, index) in familyMembers" :key="index" class="align-middle">
                    <td>{{ fam.fam_firstname }} {{ fam.fam_middlename }} {{ fam.fam_lastname }} {{ fam.fam_suffixname }}
                    </td>
                    <td>{{ fam.fam_relationship }}</td>
                    <td>+63{{ fam.fam_contact }}</td>
                    <td style="text-transform: none;">{{ fam.fam_email }}</td>
                    <td>
                      <div class="form-check d-flex justify-content-center gap-1 align-items-center">
                        <input type="radio" class="form-check-input" :id="'fam' + index" v-model="guardianTick"
                          :value="index" @change="ensureGuardian()" />
                        <label class="form-check-label" :for="'fam' + index">Guardian</label>
                      </div>
                    </td>
                    <td>
                      <button @click="addFamMembers('remove', fam, index)" type="button" class="btn btn-sm btn-danger"
                        :disabled="saving">Remove</button>
                    </td>
                  </tr>
                  <tr v-if="!familyMembers.length">
                    <td colspan="6" class="text-center text-muted">No family members added yet.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Awards / Honors -->
    <div class="card mb-3">
      <div class="card-header bg-dark text-white fw-bold">Awards / Honors</div>
      <div class="card-body">
        <div class="row g-3 d-flex">
          <!-- Left: Add Form (30%) -->
          <div class="col-12 col-md-4 d-flex flex-column" id="award-form">
            <h6>Add Award</h6>
            <div class="mb-2">
              <label class="form-label">Award / Honor</label>
              <input type="text" class="form-control" v-model="awardInfo.awr_desc" :disabled="saving">
            </div>
            <div class="mb-2">
              <label class="form-label">Year</label>
              <input type="text" class="form-control" v-model="awardInfo.awr_year" min="1999" max="9999" maxlength="4"
                minlength="4" :disabled="saving"
                @input="awardInfo.awr_year = awardInfo.awr_year.replace(/\D/g, '').slice(0, 9)">
            </div>
            <button @click="addAwards('add', awardInfo)" type="button" class="btn btn-sm btn-primary w-100 mt-auto"
              :disabled="saving">Add Award</button>
          </div>

          <!-- Right: Table (70%) -->
          <div class="col-12 col-md-8 d-flex flex-column">
            <div class="table-responsive flex-grow-1" style="height:100%;">
              <table class="table table-bordered text-uppercase h-100">
                <thead class="table-dark">
                  <tr>
                    <th>Award / Honor</th>
                    <th>Year</th>
                    <th width="100px">Command</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="align-middle" v-for="(award, index) in awardList" :key="index">
                    <td>{{ award.awr_desc }}</td>
                    <td>{{ award.awr_year }}</td>
                    <td>
                      <button @click="addAwards('remove', award, index)" type="button" class="btn btn-sm btn-danger"
                        :disabled="saving">Remove</button>
                    </td>
                  </tr>
                  <tr v-if="!awardList.length">
                    <td colspan="3" class="text-center text-muted">No awards added yet.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Submit Button -->
    <!-- Submit Section -->
    <div class="form-group border p-4 rounded d-flex flex-column justify-content-center gap-3 bg-secondary-subtle">
      <!-- Terms & Conditions -->

      <div
        class="form-group border rounded p-2 d-flex flex-column flex-md-row justify-content-center align-items-center align-items-md-center gap-2">
        <div class="form-check d-flex align-items-center w-75 justify-content-center text-start gap-3">
          <input type="checkbox" class="form-check-input" id="agreeChecker" required :disabled="saving" />
          <label class="form-check-label ms-2 mb-0" for="agreeChecker">
            I, the undersigned, hereby certify that the statements and information provided below are true and correct
            to the best of my knowledge and belief.
            I understand that providing false information may have legal consequences.
          </label>
        </div>
      </div>


      <!-- Buttons -->
      <div class="form-group border rounded p-2 d-flex flex-column flex-md-row justify-content-center gap-2">
        <button @click="clearFields" type="button" class="btn btn-secondary w-100 w-md-auto flex-md-grow-1">
          <i class="me-2 fa-solid fa-rotate-left"></i> Reset Data
        </button>
        <button type="submit" class="btn btn-success w-100 w-md-auto flex-md-grow-1" :disabled="saving">
          <i class="me-2 fa-solid fa-plus"></i> Register Me
        </button>
      </div>
    </div>

  </form>
</template>
<style scoped>
input {
  text-transform: uppercase;
}

input[type="email"] {
  text-transform: none;
}
</style>