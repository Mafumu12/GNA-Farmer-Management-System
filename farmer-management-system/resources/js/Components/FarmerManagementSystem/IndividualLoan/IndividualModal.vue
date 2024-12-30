<template>
  <div v-if="isVisible"
    class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
          <h3 class="text-xl font-semibold text-gray-900">Individual Loan Details</h3>
          <button @click="emitClose" type="button"
            class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center">
            <FaTimesCircle />
          </button>
        </div>
        <div class="p-4 md:p-5">
          
          
          
          <p><strong>Amount:</strong> {{ individual.loan_amount }}</p>
          <p><strong>Interest Rate:</strong> {{ individual.interest_rate }} %</p>
          <p><strong>Repayment Duration:</strong> {{ individual.repayment_duration }} months</p>
          <p><strong>Status:</strong> {{ individual.status }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import { FaTimesCircle } from 'vue3-icons/fa';



// Define component props and events
defineProps({
  isVisible: Boolean,
  individual: Object
});
const emit = defineEmits(["close"]);

const emitClose = () => {
  emit('close');
};
</script>
