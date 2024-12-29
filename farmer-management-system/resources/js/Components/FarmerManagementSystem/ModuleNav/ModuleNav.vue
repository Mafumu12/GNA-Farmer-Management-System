<template>

    <div class="shadow-md bg-white  py-4 px-4 mx-auto lg:w-[265px]  ">


         

     


            <button type="button" @click="$emit('Install')"
                class=" flex items-center justify-center whitespace-nowrap gap-4   bg-[#17594A]   text-[#F4F4F4]    w-full      font-medium  text-sm px-5 py-2.5 text-center   ">
                <FaPlus /> <span>Install Module</span>
            </button>
         
 
    </div>






</template>

<script setup>
import {  FaPlus } from 'vue3-icons/fa';
const emit = defineEmits(['Install']);

</script>