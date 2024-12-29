<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto lg:w-[550px] lg:h-[150px]">

        <p class="text-lg font-bold  my-2 lg:my-4 text-center"> Register Farmer</p>

        <button type="button" @click="$emit('Register')"
            class=" flex items-center justify-center whitespace-nowrap gap-4 w-full   bg-[#D3C11D]   text-[#F4F4F4]   mx-auto   font-medium  text-lg px-5 py-2.5 text-center me-2 my-2 ">
            <FaUserPlus /> <span class="text-lg">Register</span>
        </button>

    </div>


</template>

<script setup>
import { FaUserPlus } from 'vue3-icons/fa';
const emit = defineEmits(['Register']);

</script>
