<template>
  <PannelLayout>


    <div>



      <div class=" mt-10 lg:flex lg:items-center  lg:justify-center lg:gap-4">


        <div class="my-4">
          <FarmerCount :farmers="farmers" />
        </div>


        <div class="my-4">
          <AddFarmers @register="showRegisterModal = true" />
        </div>
      </div>

      <div class="my-4 lg:w-[1110px] lg:mx-auto">
        <RegisteredFarmers :farmers="farmers" @edit="openEditModal" @delete-farmer="deleteFarmer" />
      </div>
      <div class="my-8 lg:w-[1110px] lg:mx-auto">
        <LoanTable :loans="loans" />
      </div>
      
    </div>

    <RegisterModal v-if="showRegisterModal" :isVisible="showRegisterModal" @close="showRegisterModal = false"
      @farmer-register="fetchFarmers" />
    <EditFarmers v-if="showEditModal" :isVisible="showEditModal" :farmer="selectedFarmer" @close="closeEditModal"
      @farmer-update="fetchFarmers" />



  </PannelLayout>
</template>

<script setup>
import LoanTable from '@/Components/FarmerManagementSystem/LoanTable/LoanTable.vue';
import EditFarmers from '@/Components/FarmerManagementSystem/EditFarmers/EditFarmers.vue';
import RegisteredFarmers from '@/Components/FarmerManagementSystem/RegisteredFarmers/RegisteredFarmers.vue';
import AddFarmers from '@/Components/FarmerManagementSystem/AddFarmers/AddFarmers.vue';
import RegisterModal from '@/Components/FarmerManagementSystem/RegisterFarmers/RegisterModal.vue';
import FarmerCount from '@/Components/FarmerManagementSystem/FarmerCount/FarmerCount.vue';
import PannelLayout from '@/Layouts/PannelLayout.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const farmers = ref([]);
const props = defineProps({loans: {
    type: Array,
    default: () => [], // Default to an empty array if loans are not provided
  },});
const errorMessage = ref('');
const showRegisterModal = ref(false);
const showEditModal = ref(false);
const selectedFarmer = ref(null);

// Fetch farmers from the server
const fetchFarmers = async () => {
  try {
    const response = await axios.get('/');
    farmers.value = response.data.farmers;
     
  } catch (error) {
    errorMessage.value = 'Failed to load farmers. Please try again later.';
  }
};

// Open the edit modal for a selected farmer
const openEditModal = (farmer) => {
  selectedFarmer.value = farmer;
  showEditModal.value = true;
};

// Close the edit modal
const closeEditModal = () => {
  selectedFarmer.value = null;
  showEditModal.value = false;
};

// Delete farmer from the list and the database
const deleteFarmer = async (farmer) => {
  if (confirm(`Are you sure you want to delete "${farmer.first_name}" from the system database?`)) {
    try {
      const response = await axios.delete(`/farmers/${farmer.id}`);
      farmers.value = farmers.value.filter(m => m.id !== farmer.id);
      alert(response.data.message);
    } catch (error) {
      alert('Failed to delete module. Please try again.');
    }
  }
};

onMounted(() => {
  fetchFarmers();
});
</script>