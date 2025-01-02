<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto lg:w-[550px] lg:h-[150px]">
        <p class="text-lg font-bold my-2 lg:my-4 text-center">Total Amount Disbursed</p>
        <div class="flex items-center justify-center gap-8">
            <div class="h-2.5 w-2.5 lg:w-[25px] lg:h-[25px] rounded-full bg-blue-500 me-2"></div>
            <span class="text-lg font-bold my-2 lg:my-4 text-center">K {{ totalAmount }}</span>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    loans: Array, // Array of loan objects
});

// Computed property to calculate the total amount of loans disbursed with status "approved"
const totalAmount = computed(() => {
    return props.loans
        .filter(loan => loan.status === 'approved' || loan.status === 'repaid')  // Filter loans with status "approved"
        .reduce((sum, loan) => sum + parseFloat(loan.loan_amount), 0);
});
</script>
