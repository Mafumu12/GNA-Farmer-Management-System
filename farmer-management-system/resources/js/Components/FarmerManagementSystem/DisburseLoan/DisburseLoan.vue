<template>
  <div
    v-if="isVisible"
    class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50"
  >
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
          <h3 class="text-xl font-semibold text-gray-900">Loan Registration</h3>
          <button
            @click="emitClose"
            type="button"
            class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center"
          >
            <FaTimesCircle />
          </button>
        </div>
        <div class="p-4 md:p-5">
          <form @submit.prevent="submitForm" class="space-y-4">
            <!-- Farmer Dropdown -->
            <div>
              <label for="farmerId" class="block mb-2 text-sm font-medium text-gray-900">Farmer</label>
              <select
                v-model="farmerId"
                id="farmerId"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required
              >
                <option value="" disabled>Select a farmer</option>
                <option v-for="farmer in farmers" :key="farmer.id" :value="farmer.id">
                  {{ farmer.first_name }} {{ farmer.last_name }}
                </option>
              </select>
            </div>

            <!-- Loan Amount -->
            <div>
              <label for="loanAmount" class="block mb-2 text-sm font-medium text-gray-900">Loan Amount</label>
              <input
                v-model="loanAmount"
                type="number"
                id="loanAmount"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Loan Amount"
                required
              />
            </div>

            <!-- Interest Rate -->
            <div>
              <label for="interestRate" class="block mb-2 text-sm font-medium text-gray-900">Interest Rate (%)</label>
              <input
                v-model="interestRate"
                type="number"
                step="0.01"
                id="interestRate"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Interest Rate"
                required
              />
            </div>

            <!-- Repayment Duration -->
            <div>
              <label for="repaymentDuration" class="block mb-2 text-sm font-medium text-gray-900">Repayment Duration (Months)</label>
              <input
                v-model="repaymentDuration"
                type="number"
                id="repaymentDuration"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Repayment Duration"
                required
              />
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            >
              Register Loan
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { FaTimesCircle } from 'vue3-icons/fa';

// Props
defineProps({
  isVisible: Boolean,
  farmers: {
    type: Array,
    required: true,
  },
});

// Emits
const emit = defineEmits(['close', 'loan-register']);

// Reactive Variables
const farmerId = ref('');
const loanAmount = ref(0);
const interestRate = ref(0);
const repaymentDuration = ref(0);

const submitForm = async () => {
  try {
    const response = await axios.post('/create-loan', {
      farmer_id: farmerId.value,
      loan_amount: loanAmount.value,
      interest_rate: interestRate.value,
      repayment_duration: repaymentDuration.value,
    });

    // Check if the response contains a success message
    if (response.data && response.data.message) {
      alert(response.data.message);  // Display success message
      emit('loan-register');         // Notify parent to update loan list
      emit('close');                  // Close modal
    } else {
      // Handle unexpected response
      alert('Unexpected response format');
    }
  } catch (error) {
    // General error handling
    alert(error.message || 'Error registering loan');
  }
};

// Method to close the modal
const emitClose = () => {
  emit('close');
};

</script>
