<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto">

        <p class="text-lg font-bold my-2 text-center"> Register Farmer</p>

        <button type="button" @click="$emit('Register')"
            class=" flex items-center justify-center whitespace-nowrap gap-4 w-full md:w-1/3 bg-[#17594A]   text-[#F4F4F4]   mx-auto   font-medium  text-lg px-5 py-2.5 text-center me-2 my-2 ">
            <FaUserPlus /> <span class="text-lg">Register</span>
        </button>

    </div>


</template>

<script setup>
import { FaUserPlus } from 'vue3-icons/fa';
const emit = defineEmits(['Register']);

</script>
