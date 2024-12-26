<template>

    <div class="shadow-md bg-white py-4 px-4 mx-auto">


        <p class="text-lg font-bold my-2"> Module Creation</p>

        <div class="w-full flex justify-center ">


            <button type="button" @click="$emit('Install')"
                class=" flex items-center whitespace-nowrap gap-2 w-full md:w-1/3 bg-[#17594A]   text-[#F4F4F4]        font-medium  text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                <FaPlus /> <span>Install Module</span>
            </button>
            <button type="button" @click="$emit('Upload')"
                class=" flex items-center gap-2 whitespace-nowrap w-full bg-[#D3C11D]  md:w-1/3   text-[#F4F4F4]     font-medium  text-sm px-5 py-2.5 text-center me-2 mb-2  ">
                <FaFileUpload /> <span>Upload Module</span>
            </button>


        </div>
    </div>






</template>

<script setup>
import { FaFileUpload, FaPlus } from 'vue3-icons/fa';
const emit = defineEmits(['Install', 'Upload']);

</script>