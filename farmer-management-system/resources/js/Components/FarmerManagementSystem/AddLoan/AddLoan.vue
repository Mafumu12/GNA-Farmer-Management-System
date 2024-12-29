<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto lg:w-[550px] lg:h-[150px]">

        <p class="text-lg font-bold my-2 text-center">Disburse Loans</p>

        <button type="button" @click="$emit('disburse')"
            class=" flex items-center justify-center whitespace-nowrap gap-4 w-full   bg-[#D3C11D]   text-[#F4F4F4]   mx-auto   font-medium  text-lg px-5 py-2.5 text-center me-2 my-2">
            <FaMoneyBill /> <span class="text-lg">Disburse</span>
        </button>

    </div>


</template>

<script setup>
import { FaMoneyBill } from 'vue3-icons/fa';
const emit = defineEmits(['disburse']);

</script>
